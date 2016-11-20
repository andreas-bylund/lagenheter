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

	public function index()
	{
		$this->template->load('templates\public', 'start');
	}

  public function register()
  {
    $this->load->helper('form');

    $this->template->load('templates\public', 'register');
  }

  public function register_send()
  {
    $this->load->library('form_validation');

    $activation_token = $this->random_token_generator(12);

    $this->form_validation->set_rules('mail', 'Mail',
    'trim|required|valid_email|is_unique[users.mail]',
      array(
        'required'      =>  'You have not provided %s.',
        'valid_email'   =>  '%s is not a valid mail'
      )
    );

    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    $this->form_validation->set_rules('number', 'Mobilnummer',
     'trim|required|numeric',
       array(
         'required' =>  'You have not provided %s.',
         'numeric'  =>  '%s är inte ett giltigt mobilnummer'
       )
     );

    if($this->form_validation->run() == FALSE)
    {
      $this->template->load('templates\public', 'register');
    }
    else
    {
      $this->load->model('register_model');

      $data['name'] = $this->input->post('name');
      $data['mail'] = $this->input->post('mail');
      $data['cellphone'] = $this->input->post('number');
      $data['activation_token'] = $activation_token;
      $data['password']   = $this->hash_password($this->input->post('password'));

      if($this->register_model->add_member($data))
      {
        #Send Activation mail
        $mail_data['to'] = $this->input->post('mail');
        $mail_data['subject'] = 'Aktiva ditt konto';
        $mail_data['message'] = $activation_token;

        $this->send_mail($mail_data);

        redirect('activate');
      }
      else
      {
        echo "Något gick fel";
      }
    }
  }

  public function activation_mail()
  {
    $this->template->load('templates\public', 'activate_mail');
  }

  public function change_password_send($token)
  {
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
        echo "Lösenordet ändrat";
      }
    }
  }

  public function check_token($token)
  {
    #Check if token exists
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

  public function change_password($token)
  {
    $mail = $this->check_token($token);

    if($mail)
    {
      $data['token'] = $token;
      $data['mail'] = $mail;
    }
    else
    {
      echo "Den fanns inte alls";
    }

    $this->template->load('templates\public', 'change_password', $data);
  }

  public function activate_user($token)
  {
    #Check if token exists
    $this->load->model('register_model');

    $result = $this->register_model->check_if_token_exists($token);

    if($result)
    {
      #The token did exists, the user have been activated
      echo "Token did exists";
    }
    else
    {
      #The token didn't exist
      $this->session->set_flashdata('error', 'Error meddelande - Nyckeln accepteras inte');

      redirect('activate');
    }
  }

  private function send_mail($mail_data)
  {
    #Mall att använda vid behov

    /*
    $mail_data['to'] = ;
    $mail_data['subject'] '';
    $mail_data['message'] '';
    */

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

  private function hash_password($string)
  {
    return password_hash($string, PASSWORD_DEFAULT);
  }

  public function forgot_password()
  {
    #Få ange ett nytt lösenord

    #Sedan får användaren logga in med det nya lösenordet

    $this->load->helper('form');

    $this->template->load('templates\public', 'reset_password');
  }

  public function forgot_password_send()
  {
    $mail = $this->input->post('mail');
    $token = $this->random_token_generator(20);

    $this->load->model('login_model');

    $result = $this->login_model->reset_password_validate_mail($mail);
    $result_already = $this->login_model->already_activ_reset_password($mail);

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

  public function login()
  {
    $this->load->helper('form');

    $this->template->load('templates\public', 'login');
  }

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
      $data['mail']     = $this->input->post('mail');
      $data['password'] = $this->input->post('password');

      if($this->validate_login($data))
      {
        echo 'Skicka vidare till "/user"';
      }
      else
      {
        $this->session->set_flashdata('error', 'Något stämmer inte, har du angett rätt uppgifter?');

        redirect('login');
      }
    }
  }

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

  private function random_token_generator($length)
  {
    return bin2hex(openssl_random_pseudo_bytes($length));
  }
}
