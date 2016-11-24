<?php
class Member_model extends CI_Model {

  public function __construct()
  {
    // Call the CI_Model constructor
    parent::__construct();
  }

  public function fetch_userdata($mail)
  {
    $this->db->select('user_id, name, cellphone, mail, stripe_user_id');
    $this->db->where('mail', $mail);

    $query = $this->db->get('users');

    $row = $query->row();

    return $row;
  }

  public function update_settings($data)
  {
    $this->db->where('mail', $data['mail']);
    $this->db->update('users', $data);

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
