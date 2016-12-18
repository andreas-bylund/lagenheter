<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();

    //Kontrollera om användaren är inloggad
    if(!$this->check_if_user_logged_in())
    {
      redirect('login');
    }
  }

  /**
   * Startsidan - View
   */
  public function index()
  {
    $this->template->load('templates\member', 'member/index');
  }


  /**
   * Butik - view
   */
  public function store()
  {
    $this->template->load('templates\member', 'member/store');
  }

  /**
   * Kundtjänst - view
   */
  public function zendesk_start()
  {
    $this->load->library('form_validation');

    $this->template->load('templates\member', 'member/support');
  }

  public function send_support_mail()
  {
    $this->load->library('email');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('meddelande', 'meddelande',
     'trim|required',
       array(
         'required' =>  'Du måste skriva ett %s.'
       )
     );

    if($this->form_validation->run() == FALSE)
    {
      $this->template->load('templates\member', 'member/support');
    }
    else
    {
      $this->email->initialize(array(
        'protocol' => 'smtp',
        'smtp_host' => 'smtp.sendgrid.net',
        'smtp_user' => $this->config->item('sendgrid_username'),
        'smtp_pass' => $this->config->item('sendgrid_password'),
        'smtp_port' => 587,
        'crlf' => "\r\n",
        'newline' => "\r\n"
      ));

      $this->email->from($this->session->userdata('mail'), $this->session->userdata('mail'));
      $this->email->to('kundtjanst@lagenhetsbevakning.se');
      $this->email->subject('Nytt supportärende');
      $this->email->message($this->input->post('meddelande'));
      $this->email->send();

      $this->session->set_flashdata('success', 'Tack för ditt meddelande! Vi kommer svara så snabbt vi kan!');

      redirect('dashboard/support');
    }
  }

  /**
   * Återta avslutad prenumeration
   * $id = Stripe user id
   * $plan = Subscription plan (Namnet på planen)
   */
  public function resume_subscription($id, $plan)
  {
    require_once(APPPATH.'libraries/stripe-php-4.1.1/stripe.php');

    \Stripe\Stripe::setApiKey("sk_test_FNSsLoAU1Q3HHjNfytNbxToK");

    $subscription = \Stripe\Subscription::retrieve($id);
    $subscription->plan = $plan;
    $subscription->save();

    redirect('dashboard/subscriptions');
  }

  /**
   * Processera prenumerationen
   * $item = namnet på subscription planen
   */
  public function process_subscription($item)
  {
    $this->load->model('member_model');

    $mail = $_POST['stripeEmail'];

    if($item == "stockholm")
    {
      $plan = "stockholm-erbjudande";
    }
    else
    {
      echo "Error";
      exit();
      //Fixa till bättre
    }

    require_once(APPPATH.'libraries/stripe-php-4.1.1/stripe.php');

    \Stripe\Stripe::setApiKey("sk_test_FNSsLoAU1Q3HHjNfytNbxToK");

    //Kontrollera om användaren redan finns som kund hos stripe
    $stripe_user_id = $this->member_model->user_already_stripe_customer($mail);

    if($stripe_user_id)
    {
      //Redan medlem hos stripe. Lägger på subscription på nuvarande användaren
      try
      {
        $response = \Stripe\Subscription::create(array(
          "customer" => $stripe_user_id,
          'source' => $_POST['stripeToken'],
          "plan" => $plan
        ));

        $data['stripe_user_id'] = $response->customer;
        $data['stripe_sub_id'] = $response->id;
        $data['active'] = 1;

        //Lägger till standard trigger för användaren
        $this->member_model->add_trigger($data);
      }
      catch(Exception $e)
      {
        error_log("unable to sign up customer:" . $_POST['stripeEmail'].
          ", error:" . $e->getMessage());
          echo $e->getMessage();
          exit();
      }

      redirect('dashboard/thankyou');
    }
    else
    {
      //Användaren är inte reggad hos stripe sedan tidigare. Skapar ny användare.
      try
      {
        $customer = \Stripe\Customer::create(array(
          'email' => $_POST['stripeEmail'],
          'source' => $_POST['stripeToken'],
          'plan' => $plan
        ));

        //Sätter "Stripe user id" på användarne
        $this->member_model->set_stripe_user_id($customer->id, $mail);

        //Lägger till "stripe_user_id" i användaren sessoin
        $this->session->set_userdata('stripe_user_id', $customer->id);

        $data['stripe_user_id'] = $customer->id;
        $data['stripe_sub_id'] = $customer->subscription->id;
        $data['active'] = 1;

        //Lägger till standard trigger för användaren
        $this->member_model->add_trigger($data);

        //Skickar vidare kunden till "Tack!" sidan
        redirect('dashboard/thankyou');
      }
      catch(Exception $e)
      {
        header('Location:oops.html');
        error_log("unable to sign up customer:" . $_POST['stripeEmail'].
          ", error:" . $e->getMessage());
      }
    }
  }

  /**
   * Listar alla prenumerationer - Stripe-API
   * Hämtar data från Stripe-API och returnar den
   */
  public function my_subscriptions()
  {
    $this->load->model('member_model');

    $mail = $this->session->userdata('mail');

    //Hämtar användardata
    $data['userdata'] = $this->member_model->fetch_userdata($mail);

    //Användaren har inget "Stripe-user-id" satt i databasen
    if(empty($data['userdata']->stripe_user_id))
    {
      return FALSE;
    }
    else
    {
      require_once(APPPATH.'libraries/stripe-php-4.1.1/stripe.php');

      \Stripe\Stripe::setApiKey("sk_test_FNSsLoAU1Q3HHjNfytNbxToK");

      $stripe_sub_response = \Stripe\Subscription::all(array(
        'limit' => 100, //Max antal prenumerationer som hämtas
        'customer' => $data['userdata']->stripe_user_id,
        'status'  => 'active'
      ));

      $data['subscriptions'] = $stripe_sub_response;

      $this->template->load('templates\member', 'member/subscriptions', $data);
    }
  }

  /**
   * Ändra "Trigger-inställningar" - View
   * $stripe_sub_id = Prenumeration-id (Stripe-API)
   */
  public function edit_subscription($stripe_sub_id)
  {
    $this->load->model('member_model');

    //Användaren nuvarande inställningar
    $data['current_settings'] = $this->member_model->current_trigger_settings(
      $stripe_sub_id,
      $this->session->userdata('stripe_user_id')
    );

    $data['stripe_sub_id'] = $stripe_sub_id;

    $this->template->load('templates\member', 'member/edit_subscription', $data);
  }

  /**
   * Ändra "Trigger-inställningarna" - Funktion
   */
  public function edit_subscription_process()
  {
    $stripe_sub_id = $this->input->post('stripe_sub_id');

    //Hyra min
    if($this->input->post('hyra_min') == NULL)
    {
      $hyra_min = 1000;
    }
    else
    {
      $hyra_min = $this->input->post('hyra_min');
    }

    //Hyra max
    if($this->input->post('hyra_max') == NULL)
    {
      $hyra_max = 30000;
    }
    else
    {
      $hyra_max = $this->input->post('hyra_max');
    }

    //Rum min
    if($this->input->post('rum_min') == NULL)
    {
      $rum_min = 1;
    }
    else
    {
      $rum_min = $this->input->post('rum_min');
    }

    //Rum max
    if($this->input->post('rum_max') == NULL)
    {
      $rum_max = 10;
    }
    else
    {
      $rum_max = $this->input->post('rum_max');
    }

    //Kvm min
    if($this->input->post('kvm_min') == NULL)
    {
      $kvm_min = 10;
    }
    else
    {
      $kvm_min = $this->input->post('kvm_min');
    }

    //Kvm max
    if($this->input->post('kvm_max') == NULL)
    {
      $kvm_max = 250;
    }
    else
    {
      $kvm_max = $this->input->post('kvm_max');
    }

    //Kontrollera så att inte "min" värdet är större än "max" värdet
    if($hyra_min > $hyra_max)
    {
      $this->session->set_flashdata('error', '"Minimum hyran" kan inte vara större än "Maximum hyran".');

      redirect('dashboard/subscription/edit/'.$stripe_sub_id.'');
    }

    elseif($rum_min > $rum_max)
    {
      $this->session->set_flashdata('error', '"Minimum antal rum" kan inte vara större än "Maximum antal rum".');

      redirect('dashboard/subscription/edit/'.$stripe_sub_id.'');
    }

    elseif($kvm_min > $kvm_max)
    {
      $this->session->set_flashdata('error', '"Minimum kvm" kan inte vara större än "Maximum kvm".');

      redirect('dashboard/subscription/edit/'.$stripe_sub_id.'');
    }
    else
    {
      $data = array (
        'min_hyra'  =>  $hyra_min,
        'max_hyra'  =>  $hyra_max,
        'min_rum'   =>  $rum_min,
        'max_rum'   =>  $rum_max,
        'min_kvm'   =>  $kvm_min,
        'max_kvm'   =>  $kvm_max,
        'stripe_sub_id' =>  $stripe_sub_id,
        'stripe_user_id'  => $this->session->userdata('stripe_user_id')
      );

      //Uppdatera Trigger inställningarna för användaren
      $this->load->model('member_model');

      $this->member_model->update_trigger_settings($data);

      $this->session->set_flashdata('success', 'Dina inställningar har blivit uppdaterad!');

      redirect('dashboard/subscription/edit/'.$stripe_sub_id.'');
    }

  }

  /**
   * Avsluta prenumeration
   * $stripe_sub_id = Prenumeration-id (Stripe-API)
   */
  public function stop_subscription($stripe_sub_id)
  {
    require_once(APPPATH.'libraries/stripe-php-4.1.1/stripe.php');

    \Stripe\Stripe::setApiKey("sk_test_FNSsLoAU1Q3HHjNfytNbxToK");

    $subscription = \Stripe\Subscription::retrieve($stripe_sub_id);

    $subscription->cancel(array('at_period_end' => true));

    redirect('dashboard/subscriptions');
  }

  /**
   * Cancel subscription - View
   */
  public function cancel_confirmed()
  {
    echo "It's ended....";
    //<-- Fixa till
  }

  /**
   * "Thank you" sida - View
   * Visas när en medlem har startat en prenumeration
   */
  public function thankyou()
  {
    $this->template->load('templates\member', 'member/thankyou');
  }

  /**
   * Kontoinställningar - view
   */
  public function change_settings()
  {
    $this->load->library('table');
    $this->load->library('form_validation');

    $this->load->model('member_model');

    $mail = $this->session->userdata('mail');

    //Hämtar användaren data
    $data['userdata'] = $this->member_model->fetch_userdata($mail);

    $this->template->load('templates\member', 'member/settings', $data);
  }

  /**
   * Ändra kontoinställningar - Process
   */
  public function change_settings_send()
  {
    $this->load->model('member_model');
    $this->load->library('form_validation');

    //Formulär regl - Mailadressen
    $this->form_validation->set_rules('mail', 'e-postadress',
    'trim|required|valid_email',
      array(
        'required'      =>  'Du måste ange din %s.',
        'valid_email'   =>  'Inte giltigt %s'
      )
    );

    //Formulär regel - Namn
    $this->form_validation->set_rules('name', 'namn', 'trim|required',
      array(
        'required'      =>  'Du måste ange ditt %s'
      )
    );

    //Formulär regel - Lösenord
    $this->form_validation->set_rules('password', 'Password', 'trim');

    //Formulär regel - Lösenord två
    $this->form_validation->set_rules('password_two', 'Password',
    'trim|matches[password]',
      array(
        'matches' =>  'Lösenorden matchar inte varandra.'
      )
    );

    //Formulär regel - Mobilnummer
    $this->form_validation->set_rules('cellphone', 'mobilnummer',
     'trim|required|numeric',
       array(
         'required' =>  'Du måste ange ditt %s.',
         'numeric'  =>  'Inte ett giltigt %s'
       )
     );

    if($this->form_validation->run() == FALSE)
    {
      $mail = $this->session->userdata('mail');

      //Hämtar användardata
      $data['userdata'] = $this->member_model->fetch_userdata($mail);

      $this->template->load('templates\member', 'member/settings', $data);
    }
    else
    {
      //Datan gick igenom reglerna. Lägger till medlem i databasen
      $update_data['name'] = $this->input->post('name');
      $update_data['mail'] = $this->input->post('mail');
      $update_data['cellphone'] = $this->input->post('cellphone');

      //Kontrollerar om användaren har angett något lösenord att uppdatera
      if(!empty($this->input->post('password')))
      {
        $update_data['password'] = $this->hash_password($this->input->post('password'));
      }

      /**
       * Uppdatera användarens inställningar
       * return $return = true/false
       */
      $result = $this->member_model->update_settings($update_data);

      if($result)
      {
        $this->session->set_flashdata('success', 'Dina inställningar har blivit uppdaterade');
      }
      else
      {
        $this->session->set_flashdata('error', 'Inget har uppdaterats.');
      }

      redirect('dashboard/settings');
    }
  }

  /**
   * Överblick stad - View
   */
  public function stockholm_overview()
  {
    $this->template->load('templates\member', 'member/stockholm');
  }

  /**
   * Logga ut användaren genom att förstöra alla sessions
   */
  public function sign_out()
  {
    $this->session->sess_destroy();

    redirect('login');
  }

  /**
   * Kontrollera om "logged_in" session är satt
   */
  private function check_if_user_logged_in()
  {

    if($this->session->userdata('logged_in') == TRUE)
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  /**
   * Hasha lösenordet funktion
   * $string = lösenordet som ska hashas
   */
  private function hash_password($string)
  {
    return password_hash($string, PASSWORD_DEFAULT);
  }
}
