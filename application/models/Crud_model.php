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
            'inter_fee' => $this->input->post('acc_inter'),
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

        //$slug = url_title($this->input->post('title'), 'dash', TRUE);

        $data = array(
            'firstname' => $this->input->post('m_fname'),
            'lastname' => $this->input->post('m_lname'),
            'address' => $this->input->post('m_address'),
            'email' => $this->input->post('m_email'),
            'birthday' => $this->input->post('m_bday'),
            'age' => $this->input->post('m_age'),
            'mobile' => $this->input->post('m_mobile'),
            'accountnum' => $this->input->post('m_accnt'),
            'pin' => $this->input->post('m_pin'),
            'password' => $this->input->post('m_pass'),
            'account_type' => $this->input->post('m_accnttype'),
            'user_type' => $this->input->post('m_type')
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
