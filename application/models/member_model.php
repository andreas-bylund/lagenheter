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

  public function add_trigger($data)
  {
    $this->db->insert('user_triggers', $data);
  }

  public function current_trigger_settings($stripe_sub_id, $stripe_user_id)
  {
    $this->db->select('*');

    $this->db->where('stripe_user_id', $stripe_user_id);
    $this->db->where('stripe_sub_id', $stripe_sub_id);

    $query = $this->db->get('user_triggers');

    if($query->num_rows() > 0)
    {
      return $query->row();
    }
    else
    {
      return FALSE;
    }
  }

  public function update_trigger_settings($settings)
  {
    $this->db->where('stripe_sub_id', $settings['stripe_sub_id']);
    $this->db->where('stripe_user_id', $settings['stripe_user_id']);
    
    $this->db->update('user_triggers', $settings);
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
