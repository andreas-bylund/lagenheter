<?php
class Login_model extends CI_Model {

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function check_if_token_exists($token)
  {
    $this->db->select('mail');
    $this->db->where('token', $token);
    $this->db->where('used', 0);

    $query = $this->db->get('reset_password');

    if($query->num_rows() > 0)
    {
      return $query->row()->mail;
    }
  }

  public function already_activ_reset_password($mail)
  {
    $this->db->where('mail', $mail);
    $this->db->where('used', 0);

    $query = $this->db->get('reset_password');

    if($query->num_rows() > 0)
    {
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }

  public function add_reset_password($data)
  {
    $this->db->insert('reset_password', $data);

    if($this->db->affected_rows() > 0)
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }
  }

  public function reset_password_validate_mail($string)
  {
    $this->db->select('*');
    $this->db->where('activated', 1);
    $this->db->where('mail', $string);

    $query = $this->db->get('users');

    if($query->num_rows() > 0)
    {
      return TRUE;
    }
    else
    {
      return FALSE;
    }

  }

  public function validate_login($data)
  {
    $this->db->select('mail, password');
    $this->db->where('mail', $data['mail']);

    $query = $this->db->get('users');

    if($query->num_rows() > 0)
    {
      $row = $query->row();

      #The mailadress does exist
      if(crypt($data['password'], $row->password) == $row->password)
      {
        #Password -> Correct!
        return TRUE;
      }
      else
      {
        #Password -> Wrong!
        return FALSE;
      }
    }
    else
    {
      return FALSE;
    }
  }
}
