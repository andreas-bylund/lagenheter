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
   * Kontoinställningar - view
   */
  public function change_settings()
  {
    $this->load->library('form_validation');

    $this->load->model('member_model');
    $mail = $this->session->userdata('mail');

    $data['userdata'] = $this->member_model->fetch_userdata($mail);

    $this->template->load('templates\member', 'member/settings', $data);
  }

  public function change_settings_send()
  {
    $this->load->library('form_validation');

    //Formulär regl - Mailadressen
    $this->form_validation->set_rules('mail', 'Mail',
    'trim|required|valid_email',
      array(
        'required'      =>  'You have not provided %s.',
        'valid_email'   =>  '%s is not a valid mail'
      )
    );

    //Formulär regel - Namn
    $this->form_validation->set_rules('name', 'Namn', 'trim|required');

    //Formulär regel - Lösenord
    $this->form_validation->set_rules('password', 'Password', 'trim');

    //Formulär regel - Lösenord två
    $this->form_validation->set_rules('password_two', 'Password',
    'trim|matches[password]');

    //Formulär regel - Mobilnummer
    $this->form_validation->set_rules('cellphone', 'Mobilnummer',
     'trim|required|numeric',
       array(
         'required' =>  'You have not provided %s.',
         'numeric'  =>  'Inte ett giltigt mobilnummer'
       )
     );

    if($this->form_validation->run() == FALSE)
    {

      $this->load->model('member_model');
      $mail = $this->session->userdata('mail');

      $data['userdata'] = $this->member_model->fetch_userdata($mail);

      $this->template->load('templates\member', 'member/settings', $data);
    }
    else
    {

      #Datan gick igenom reglerna. Lägger till medlem i databasen
      $this->load->model('member_model');

      $update_data['name'] = $this->input->post('name');
      $update_data['mail'] = $this->input->post('mail');
      $update_data['cellphone'] = $this->input->post('cellphone');

      //Lösenord
      if($this->input->post('password') !== "[hemligtlosenord]")
      {
        $update_data['password'] = $this->hash_password($this->input->post('password'));
      }

      $result = $this->member_model->update_settings($update_data);

      if($result)
      {
        $this->session->set_flashdata('success', 'Dina inställningar har blivit uppdaterade');

        redirect('dashboard/settings');
      }
      else
      {
        $this->session->set_flashdata('error', 'Inget har uppdaterats.');

        redirect('dashboard/settings');
      }
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
