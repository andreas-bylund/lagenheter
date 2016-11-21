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

  public function index()
  {
    $this->template->load('templates\member', 'member/index');
  }

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
}
