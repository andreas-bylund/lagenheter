<?php
class Register_model extends CI_Model {

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function set_stripe_user_id($string, $mail)
  {
    $this->db->set('stripe_user_id', $string);
    $this->db->where('mail', $mail);

    $this->db->update('users');
  }

  public function user_already_stripe_customer($mail)
  {
    $this->db->select('stripe_user_id');
    $this->db->where('mail', $mail);

    $query = $this->db->get('users');

    $data = $query->row();

    if($data->stripe_user_id)
    {

      return $data->stripe_user_id;
    }
    else
    {
      return FALSE;
    }
  }

  public function get_mail_by_token($token)
  {
    $this->db->select('mail');
    $this->db->where('activation_token', $token);

    $query = $this->db->get('users');

    $row = $query->row();

    return $row->mail;
  }

  private function activate_user($token)
  {
    $this->db->set('activated', 1);
    $this->db->where('activation_token', $token);

    $this->db->update('users');
  }

  public function check_if_token_exists($token)
  {
    $this->db->select('mail');
    $this->db->where('activation_token', $token);
    $this->db->where('activated', 0);
    $this->db->limit(1);

    $this->db->get('users');

    if($this->db->affected_rows() > 0)
    {
      $this->activate_user($token);

      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  public function add_member($data)
  {
    $this->db->insert('users', $data);

    if($this->db->affected_rows() > 0)
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }
}
