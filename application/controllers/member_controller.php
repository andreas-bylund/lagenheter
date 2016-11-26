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

  public function resume_subscription($id, $plan)
  {
    require_once(APPPATH.'libraries/stripe-php-4.1.1/stripe.php');

    \Stripe\Stripe::setApiKey("sk_test_FNSsLoAU1Q3HHjNfytNbxToK");

    $subscription = \Stripe\Subscription::retrieve($id);
    $subscription->plan = $plan;
    $subscription->save();

    redirect('dashboard');
  }

  public function process_subscription($item)
  {
    $this->load->model('register_model');
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
    $stripe_user_id = $this->register_model->user_already_stripe_customer($mail);

    if($stripe_user_id)
    {
      //Redan medlem hos stripe. Lägger på subscription på nuvarande användaren
      try
      {
        $response = \Stripe\Subscription::create(array(
          "customer" => $stripe_user_id,
          'source'  => $_POST['stripeToken'],
          "plan" => $plan
        ));
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
          'source'  => $_POST['stripeToken'],
          'plan' => $plan
        ));

        $this->register_model->set_stripe_user_id($customer->id, $mail);

        $this->session->set_userdata('stripe_user_id', $customer->id);

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

  public function list_subscriptions()
  {
    $this->load->model('member_model');

    $mail = $this->session->userdata('mail');

    $data['userdata'] = $this->member_model->fetch_userdata($mail);

    if(empty($data['userdata']->stripe_user_id))
    {
      return FALSE;
    }
    else
    {
      require_once(APPPATH.'libraries/stripe-php-4.1.1/stripe.php');

      \Stripe\Stripe::setApiKey("sk_test_FNSsLoAU1Q3HHjNfytNbxToK");

      $stripe_sub_response = \Stripe\Subscription::all(array(
        'limit' => 100,
        'customer' => $data['userdata']->stripe_user_id,
        'status'  => 'active'
      ));

      return $stripe_sub_response;
    }
  }

  /**
   * "Thank you" page
   * Visas när en medlem har startat en prenumeration
   */
  public function thankyou()
  {
    $this->template->load('templates\member', 'member/thankyou');
  }

  /**
   * Startsidan - View
   */
  public function index()
  {
    //Hämta alla aktiva prenumerationer
    $data['subscriptions'] = $this->list_subscriptions();

    if(!$data['subscriptions'])
    {
      $data['subscriptions'] = FALSE;
    }

    $this->template->load('templates\member', 'member/index', $data);
  }

  public function edit_subscription($id)
  {
    $this->template->load('templates\member', 'member/edit_subscription');
  }

  public function stop_subscription($id)
  {

    require_once(APPPATH.'libraries/stripe-php-4.1.1/stripe.php');

    \Stripe\Stripe::setApiKey("sk_test_FNSsLoAU1Q3HHjNfytNbxToK");

    $subscription = \Stripe\Subscription::retrieve($id);

    $subscription->cancel(array('at_period_end' => true));

    redirect('dashboard/cancel_confirmed');
  }

  public function cancel_confirmed()
  {
    echo "It's ended....";
  }

  /**
   * Kontoinställningar - view
   */
  public function change_settings()
  {
    $this->load->library('form_validation');
    $this->load->library('table');
    $this->load->model('member_model');

    $mail = $this->session->userdata('mail');

    $data['userdata'] = $this->member_model->fetch_userdata($mail);

    $this->template->load('templates\member', 'member/settings', $data);
  }

  public function change_settings_send()
  {
    $this->load->library('form_validation');

    $this->load->model('member_model');

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

      $data['userdata'] = $this->member_model->fetch_userdata($mail);

      $this->template->load('templates\member', 'member/settings', $data);
    }
    else
    {
      #Datan gick igenom reglerna. Lägger till medlem i databasen

      $update_data['name'] = $this->input->post('name');
      $update_data['mail'] = $this->input->post('mail');
      $update_data['cellphone'] = $this->input->post('cellphone');

      //Lösenord
      if(!empty($this->input->post('password')))
      {
        $update_data['password'] = $this->hash_password($this->input->post('password'));
      }

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
   */
  private function hash_password($string)
  {
    return password_hash($string, PASSWORD_DEFAULT);
  }
}
