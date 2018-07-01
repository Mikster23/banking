<?php
class Teller_model extends CI_model{



  function checkacctnum($id){


    $this->db->select('*');
    $this->db->from('accounts');
    $this->db->where('accountnum',$id);


    if($query=$this->db->get())
    {
        return $query->row_array();
    }
    else{
      return false;
    }

  }
  public function getotcfee($id){

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
  public function getuseracctid($id){

    $this->db->select('*');
    $this->db->from('accounts');
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


    $this->db->where('accountnum', $id);
    $this->db->update('accounts', $user_deposit);
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


    $this->db->where('accountnum', $id);
    $this->db->update('accounts', $user_withdraw);
  		return $this->db->affected_rows();
  }
  public function get_all_human()
  {
  $this->db->from('transaction');
  $query=$this->db->get();
  return $query->result();
  }



  public function checkexist_acctnum($acctnum){

      $this->db->select('*');
      $this->db->from('user');
    $this->db->where('accountnum',$acctnum);
       $query = $this->db->get();
       if ($query->num_rows() > 0){
           return true;
       }
       else{
           return false;
       }


  }
  public function getbalance_acctnum($acctnum){
    echo $acctnum . "hi s";
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('accountnum',$acctnum);

     if($query=$this->db->get())
     {
         return $query->row_array();
     }
     else{
       return false;
     }


  }

  public function transfer($acctnum,$amount){

      $this->db->where('accountnum', $acctnum);
      $this->db->update('user', $amount);
    		return $this->db->affected_rows();


  }

}


?>
