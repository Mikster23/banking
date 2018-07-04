<?php
class Crud_model extends CI_Model {

  public function __construct()
  {
    $this->load->database();
  }

  public function get_news()
  {
    $query = $this->db->get('user');
    return $query->result_array();
  }
  public function getacctype(){
    $query = $this->db->get('account_type');
    return $query->result_array();

  }



  public function pending($id =0)
  {
    $query = $this->db->get_where('user', array('status' => $id));
    return $query->result_array();
  }

  public function getname(){

    $this->db->select('*');
    $this->db->from('user');



    if($query=$this->db->get())
    {
      return $query->result_array();
    }
    else{
      return false;
    }

  }
  public function getacctname(){

    $this->db->select('*');
    $this->db->from('account_type');



    if($query=$this->db->get())
    {
      return $query->result_array();
    }
    else{
      return false;
    }

  }


  public function pendingenroll($id =0)
  {
    $query = $this->db->get_where('accounts', array('status' => $id));
    return $query->result_array();
  }
  public function accept($id = 0){
    $status = 1;
    $this->db->set('status',$status);
    $this->db->where('id', $id);
    return $this->db->update('user');

  }
  public function acceptaccount($id = 0){
    $status = 1;
    $this->db->set('status',$status);
    $this->db->where('holder_id', $id);
    return $this->db->update('accounts');

  }
  public function deactivateaccount($id = 0){
    $status = 0;
    $this->db->set('status',$status);
    $this->db->where('id', $id);
    return $this->db->update('accounts');

  }



  public function get_news_by_id($id = 0)
  {
    if ($id === 0)
    {
      $query = $this->db->get('user');
      return $query->result_array();
    }

    $query = $this->db->get_where('user', array('id' => $id));
    return $query->row_array();
  }

  public function getacctypebyid($id = 0)
  {
    if ($id === 0)
    {
      $query = $this->db->get('account_Type');
      return $query->result_array();
    }

    $query = $this->db->get_where('account_type', array('id' => $id));
    return $query->row_array();
  }

  public function getholderid($id =0){
    $this->db->select('*');
    $this->db->from('accounts');
    $this->db->where('id',$id);


    if($query=$this->db->get())
    {
      return $query->row_array();
    }
    else{
      return false;
    }

  }
  public function getemail($id =0){
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('id',$id);


    if($query=$this->db->get())
    {
      return $query->row_array();
    }
    else{
      return false;
    }
  }



  public function set_acctype($id = 0)
  {
    $this->load->helper('url');

    //$slug = url_title($this->input->post('title'), 'dash', TRUE);

    $data = array(
      'name' => $this->input->post('acc_name'),
      'minbalance' => $this->input->post('acc_maintain'),
      'opening_balance' => $this->input->post('acc_opening'),
      'atm_fee' => $this->input->post('acc_atm'),
      'otc_fee' => $this->input->post('acc_otc'),

      'depatm' => $this->input->post('dep_atm'),
      'withatm' => $this->input->post('with_atm'),
      'deptel' => $this->input->post('dep_tel'),
      'withtel' => $this->input->post('with_tel'),

      'interest' => $this->input->post('acc_interest')

    );



    if ($id == 0) {
      $this->db->insert('account_type', $data);
    } else {
      $this->db->where('id', $id);
      return $this->db->update('account_type', $data);
    }
  }


  public function set_news($id = 0)
  {
    $this->load->helper('url');
    $val = 0;
    //$slug = url_title($this->input->post('title'), 'dash', TRUE);

    $id = $this->input->post('m_id');
  //  $pin = mt_rand(1000, 9999);
  //  $acctnum = mt_rand(100000000, 999999999);



    $data = array(
      'firstname' => $this->input->post('m_fname'),
      'lastname' => $this->input->post('m_lname'),
      'address' => $this->input->post('m_address'),
      'email' => $this->input->post('m_email'),
      'birthday' => $this->input->post('m_bday'),
      'age' => $this->input->post('m_age'),
      'mobile' => $this->input->post('m_mobile'),
      'pin' => $this->input->post('m_pin'),
      'password' => $this->input->post('m_pass'),
      'user_type' => (int)$this->input->post('m_type')
    );

    if ($id == 0) {
      return $this->db->insert('user', $data);
    } else {
      $this->db->where('id', $id);
      return $this->db->update('user', $data);
    }
  }

  public function delete_news($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('user');
  }
  public function delete_acct($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('account_type');
  }


  public function gethuman($id = 0)
  {
    if ($id === 0)
    {
      $query = $this->db->get('user');
      return $query->result_array();
    }

    $query = $this->db->get_where('user', array('id' => $id));
    return $query->row_array();
  }
}
