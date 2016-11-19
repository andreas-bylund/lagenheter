<?php
class Register_model extends CI_Model {

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
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
