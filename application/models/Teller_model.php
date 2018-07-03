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
  public function get_history($id = 0){
  /*  if(isset($_POST["order"]))
           {
                $order_column = array(null, "action", "amount", "created_at");
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
           }*/
           $this->db->select('*');
           $this->db->from('transaction');
           $this->db->where('user_id',$id);
           $query = $this->db->get();
           return $query->result_array();




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
      $this->db->from('accounts');
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

   public function getmerch(){

      $response = array();

      // Select record
      $this->db->select('*');
     $this->db->from('merchant');
      $q = $this->db->get();
      $response = $q->result_array();

      return $response;
    }

  public function transfer($acctnum,$amount){

      $this->db->where('accountnum', $acctnum);
      $this->db->update('accounts', $amount);
    		return $this->db->affected_rows();


  }
  public function transfer2($acctnum,$amount){

      $this->db->where('accountnum', $acctnum);
      $this->db->update('accounts', $amount);
    		return $this->db->affected_rows();


  }
  public function paybill($data){


  $this->db->insert('payhistory', $data);

  }


}


?>
