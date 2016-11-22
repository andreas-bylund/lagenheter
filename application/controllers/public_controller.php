<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_controller extends CI_Controller {


  public function test()
  {
    $test1 = true;
    $test2 = true;

    if($test1 && $test2)
    {
      echo "Båda TRUE";
    }
    else
    {
      echo "Något gick fel";
    }
  }

  /**
   * Startsidan - view
   */
	public function index()
	{
		$this->template->load('templates\public', 'start');
	}

  /**
   * Bli medlem - view
   */
  public function register()
  {
    $this->load->helper('form');

    $this->template->load('templates\login', 'register');
  }

  /**
   * Bli medlem - hantera datan
   */
  public function register_send()
  {
    $this->load->library('form_validation');

    //Skapa en aktiveringstoken som används för att aktivera kontot
    $activation_token = $this->random_token_generator(12);

    //Formulär regl - Mailadressen
    $this->form_validation->set_rules('mail', 'Mail',
    'trim|required|valid_email|is_unique[users.mail]',
      array(
        'required'      =>  'You have not provided %s.',
        'valid_email'   =>  '%s is not a valid mail'
      )
    );

    //Formulär regel - Namn
    $this->form_validation->set_rules('name', 'Namn', 'trim|required');

    //Formulär regel - Lösenord
    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    //Formulär regel - Mobilnummer
    $this->form_validation->set_rules('number', 'Mobilnummer',
     'trim|required|numeric',
       array(
         'required' =>  'You have not provided %s.',
         'numeric'  =>  '%s är inte ett giltigt mobilnummer'
       )
     );

    if($this->form_validation->run() == FALSE)
    {
      $this->template->load('templates\login', 'register');
    }
    else
    {
      #Datan gick igenom reglerna. Lägger till medlem i databasen
      $this->load->model('register_model');

      $data['name'] = $this->input->post('name');
      $data['mail'] = $this->input->post('mail');
      $data['cellphone'] = $this->input->post('number');
      $data['activation_token'] = $activation_token;
      $data['password']   = $this->hash_password($this->input->post('password'));

      //Om vi lyckas lägga till användaren i databasen
      if($this->register_model->add_member($data))
      {
        #Send Activation mail
        $mail_data['to'] = $this->input->post('mail');
        $mail_data['subject'] = 'Aktiva ditt konto';
        $mail_data['message'] = $activation_token; //<--- Fixa till

        $this->send_mail($mail_data);

        redirect('activate');
      }
      else
      {
        echo "Något gick fel"; //<--- Fixa till.

        //Logga felet
        //Fixa en errorsida
      }
    }
  }

  /**
   * "Dags att aktivera ditt konto" - View
   * Dennsa sida kommer fram när användaren har blivit
   * medlem och måste aktivera sitt konto för att använda
   * denna tjänst.
   */
  public function activation_mail()
  {
    $this->template->load('templates\login', 'activate_mail');
  }

  /**
   * Ändra lösenord handtering
   */
  public function change_password_send($token)
  {
    /* Kontrollerar om den token som finns i databasen
    Om token finns i databasen skickar den tillbaka mailadressen som
    token är kopplad till */
    $mail = $this->check_token($token);

    if($mail)
    {
      $data['token'] = $token;
      $data['mail'] = $mail;

      $this->load->library('form_validation');

      $this->form_validation->set_rules('password', 'Password', 'trim|required');

      $this->form_validation->set_rules('password_two', 'Password',
      'trim|required|matches[password]');

      if($this->form_validation->run() == FALSE)
      {
        $this->template->load('templates\public', 'change_password', $data);
      }
      else
      {
        echo "Lösenordet ändrat"; //<--- Fixa till en bättre view
      }
    }
  }

  /**
   * Kontrollerar om token för [LÖSENORD RESET] finns
   */
  public function check_token($token)
  {
    $this->load->model('login_model');

    $mail = $this->login_model->check_if_token_exists($token);

    if($mail)
    {
      return $mail;
    }
    else
    {
      return FALSE;
    }
  }

  /**
   * Ändra lösenord - view
   */
  public function change_password($token)
  {
    /* Kontrollerar om token finns. Finns den skickar den tillbaka Mailadressen
    Som token är kopplad till. */
    $mail = $this->check_token($token);

    if($mail)
    {
      $data['token'] = $token;
      $data['mail'] = $mail;
    }
    else
    {
      echo "Den fanns inte alls"; //<-- Fixa till
    }

    $this->template->load('templates\public', 'change_password', $data);
  }

  /**
   * Aktivera användaren
   */
  public function activate_user($token)
  {
    $this->load->model('register_model');

    //Kontrollera om token för aktivera användaren finns
    //Finns token så kommer användaren bli aktiverad.
    $result = $this->register_model->check_if_token_exists($token);

    if($result)
    {
      //Fixa till ett flashmeddelade som talar om att användaren har blivit aktiverad.

      $this->load->model('register_model');

      $mail = $this->register_model->get_mail_by_token($token);

      //SKapa användare hos Stripe
      require_once(APPPATH.'libraries/stripe-php-4.1.1/stripe.php');

      \Stripe\Stripe::setApiKey("sk_test_FNSsLoAU1Q3HHjNfytNbxToK");

      $test = \Stripe\Customer::create(array(
        "email" => $mail
      ));

      //$this->session->set_flashdata('message', 'Meddelande');
      redirect('login');

    }
    else
    {
      //Token fanns inte
      $this->session->set_flashdata('error', 'Nyckeln fanns inte');

      redirect('activate');
    }
  }


  /**
   * Skicka mail via SENDGRID
   * $mail_data['to'] = ;
   * $mail_data['subject'] '';
   * $mail_data['message'] '';
   */
  private function send_mail($mail_data)
  {
    $this->load->library('email');

    $this->email->initialize(array(
      'protocol' => 'smtp',
      'smtp_host' => 'smtp.sendgrid.net',
      'smtp_user' => $this->config->item('sendgrid_username'),
      'smtp_pass' => $this->config->item('sendgrid_password'),
      'smtp_port' => 587,
      'crlf' => "\r\n",
      'newline' => "\r\n"
    ));

    $this->email->from('no-reply@andreasbylund.se', 'Andreas Bylund');
    $this->email->to($mail_data['to']);
    $this->email->subject($mail_data['subject']);
    $this->email->message($mail_data['message']);
    $this->email->send();

    //echo $this->email->print_debugger();

  }

  /**
   * Hasha lösenordet funktion
   */
  private function hash_password($string)
  {
    return password_hash($string, PASSWORD_DEFAULT);
  }

  /**
   * Återställa lösenordet - view
   */
  public function forgot_password()
  {
    $this->load->helper('form');

    $this->template->load('templates\login', 'reset_password');
  }

  /**
   * Hantera byte av lösenord - function
   * (1) Kontrollerar om det verkligen är ett lösenord som anges
   * (2) Kontrollerar om mailen finns reggad och om det redan pågår en reset
   */
  public function forgot_password_send()
  {
    $mail = $this->input->post('mail');
    $token = $this->random_token_generator(20);

    //Kontrollera om det verkligen är en mailadress
    $this->load->library('form_validation');

    $this->form_validation->set_rules('mail', 'Mailadress', 'trim|required|valid_email');

    if($this->form_validation->run() == FALSE)
    {
      $this->template->load('templates\public', 'reset_password');
    }
    else
    {
      $this->load->model('login_model');

      $result = $this->login_model->reset_password_validate_mail($mail);
      $result_already = $this->login_model->already_active_reset_password($mail);

      if($result && $result_already)
      {
        #Lägger till informationen i databasen
        $reset_data['mail'] = $this->input->post('mail');
        $reset_data['token'] = $token;
        $reset_data['created_at'] = date("Y:m:d h:i:s");
        $this->login_model->add_reset_password($reset_data);

        #Skicka mail till användaren
        $mail_data['to'] = $this->input->post('mail');
        $mail_data['subject'] = 'Återställ ditt lösenord';
        $mail_data['message'] = $token;

        $this->send_mail($mail_data);

        $this->session->set_flashdata('succes', 'Kolla in din mail....');

        redirect('reset_password');
      }
      else
      {
        $this->session->set_flashdata('error', 'Den mailadressen finns inte i vårt
        system eller så....');

        redirect('reset_password');
      }
    }
  }

  /**
   * Logga in - view
   */
  public function login()
  {
    $this->load->helper('form');

    $this->template->load('templates\login', 'login');
  }

  /**
   * Häntera login data
   */
  public function login_send()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('mail', 'Mail',
    'trim|required|valid_email',
      array(
        'required'      =>  'You have not provided %s.',
        'valid_email'   =>  '%s is not a valid mail'
      )
    );

    $this->form_validation->set_rules('password', 'Password', 'trim|required');

    if($this->form_validation->run() == FALSE)
    {
      $this->template->load('templates\public', 'login');
    }
    else
    {
      #No errors, check if username and passwords validates
      $data['mail'] = $this->input->post('mail');
      $data['password'] = $this->input->post('password');

      if($this->validate_login($data))
      {

        $this->session->set_userdata('logged_in', TRUE);
        $this->session->set_userdata('mail', $data['mail']);

        redirect('dashboard');

      }
      else
      {
        $this->session->set_flashdata('error', 'Något stämmer inte, har du angett rätt uppgifter?');

        redirect('login');
      }
    }
  }

  /**
   * Validerar mail och lösenordet
   */
  private function validate_login($data)
  {
    $this->load->model('login_model');

    if($this->login_model->validate_login($data))
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  /**
   * Skapar en random token
   * Param: $length = längd på token
   */
  private function random_token_generator($length)
  {
    return bin2hex(openssl_random_pseudo_bytes($length));
  }
}
