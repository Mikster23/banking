<?php
class Teller_model extends CI_model{



  function checkacctnum($id){


    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('accountnum',$id);


    if($query=$this->db->get())
    {
        return $query->row_array();
    }
    else{
      return false;
    }

  }


  public function user_history($history){

    $this->db->insert('transaction', $history);
  }


  public function teller_deposit($id, $user_deposit){


    $this->db->where('id', $id);
    $this->db->update('user', $user_deposit);
  		return $this->db->affected_rows();
  }


  function checkmindeposit($id){


    $this->db->select('*');
    $this->db->from('account_type');
    $this->db->where('id',$id);


    if($query=$this->db->get())
    {
        return $query->row_array();
    }
    else{
      return false;
    }

  }

  public function user_withdraw($id, $user_withdraw){


    $this->db->where('id', $id);
    $this->db->update('user', $user_withdraw);
  		return $this->db->affected_rows();
  }



}


?>
