<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//This is the Book Model for CodeIgniter CRUD using Ajax Application.
class Manage_model extends CI_Model
{

	var $table = 'user';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


public function get_all_books()
{
$this->db->select('*');
 $this->db->from('user');
$query=$this->db->get();
return $query->result();
}


	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function human_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function human_update($where, $data)
	{	$this->db->where('accountnum', (int)$where);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

  function getacct(){

     $response = array();

     // Select record
     $this->db->select('*');
    $this->db->from('account_type');
     $q = $this->db->get();
     $response = $q->result_array();

     return $response;
   }
	 public function getacctnamemanage(){

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
	 public function get_news($id = 0)
	 {
		 $query = $this->db->get_where('user', array('id' => $id));

		 return $query->result_array();
	 }

	 function getownedacct($id = 0){

	    $response = array();

	    // Select record
	    $this->db->select('*');
	   $this->db->from('accounts');
	   $this->db->where('holder_id',$id);

	    $q = $this->db->get();
	    $response = $q->result_array();

	    return $response;
	  }

   function getacctname(){

      $response = array();

      // Select record
      $this->db->select('*');
     $this->db->from('account_type');
      $q = $this->db->get();
      $response = $q->result_array();

      return $response;
    }


   function getuser(){

      $response = array();

      // Select record
      $this->db->select('*');
      $this->db->from('user_type');
      $q = $this->db->get();
      $response = $q->result_array();

      return $response;
    }
}
