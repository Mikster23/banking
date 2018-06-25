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
}
