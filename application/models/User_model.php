<?php
class User_model extends CI_model{

 var $select_column = array("accountnum", "action", "amount", "created_at");

public function register_user($user){


$this->db->insert('user', $user);

}

public function getlatest_id(){
  $this->db->select_max('id');
  $this->db->from('user');
  //$query = $this->db->get();

  if($query=$this->db->get())
  {
      return $query->row_array();
  }
  else{
    return false;
  }
}

public function register_acct($accounts){


$this->db->insert('accounts', $accounts);

}

public function user_deposit($id, $user_deposit){


  $this->db->where('id', $id);
  $this->db->update('user', $user_deposit);
		return $this->db->affected_rows();
}
public function user_history($history){

  $this->db->insert('transaction', $history);
}
/*
public function make_query()
     {
          $this->db->select($this->select_column);
          $this->db->from('user');
          if(isset($_POST["search"]["value"]))
          {
               $this->db->like("first_name", $_POST["search"]["value"]);
               $this->db->or_like("last_name", $_POST["search"]["value"]);
          }
          if(isset($_POST["order"]))
          {
               $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
          }
          else
          {
               $this->db->order_by('id', 'DESC');
          }
     }*/
public function get_history($id){
/*  if(isset($_POST["order"]))
         {
              $order_column = array(null, "action", "amount", "created_at");
              $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
         }*/
  if(isset($_POST["search"]["value"]))  {

    $this->db->select('accountnum,action,amount,created_at');
    $this->db->from('transaction');
    $this->db->limit($_POST['length'], $_POST['start']);
    $this->db->or_like("action", $_POST["search"]["value"]);
    $this->db->or_like("amount", $_POST["search"]["value"]);
    $this->db->or_like("created_at", $_POST["search"]["value"]);
    $this->db->where('accountnum',$id);
    if($query=$this->db->get())
    {
       $result =  $query->result();
        //return $query->row_array();
        return $result;
    }
    else{
      return false;
    }
  }

  $this->db->from('transaction');
  $this->db->where('accountnum',$id);
  if($query=$this->db->get())
  {
     $result =  $query->result();
      //return $query->row_array();
      return $result;
  }
  else{
    return false;
  }




}

public function get_transferhistory($id){
/*  if(isset($_POST["order"]))
         {
              $order_column = array(null, "action", "amount", "created_at");
              $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
         }*/
  if(isset($_POST["search"]["value"]))  {

    $this->db->select('accountnum,action,amount,remarks,to_accountnum,created_at');
    $this->db->from('transaction');
    $this->db->limit($_POST['length'], $_POST['start']);
    $this->db->or_like("action", $_POST["search"]["value"]);
    $this->db->or_like("amount", $_POST["search"]["value"]);
    $this->db->or_like("remarks", $_POST["search"]["value"]);
    $this->db->or_like("created_at", $_POST["search"]["value"]);
    $this->db->where('accountnum',$id);
    $where = "to_accountnum is  NOT NULL";
    $this->db->where($where);
    if($query=$this->db->get())
    {
       $result =  $query->result();
        //return $query->row_array();
        return $result;
    }
    else{
      return false;
    }
  }





}
public function user_withdraw($id, $user_deposit){


  $this->db->where('id', $id);
  $this->db->update('user', $user_deposit);
		return $this->db->affected_rows();
}


public function login_user($email,$pass){

  $this->db->select('*');
  $this->db->from('user');
  $this->db->where('email',$email);
  $this->db->where('password',$pass);

  if($query=$this->db->get())
  {
      return $query->row_array();
  }
  else{
    return false;
  }


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
  $this->db->select('balance');
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

public function email_check($email){

  $this->db->select('*');
  $this->db->from('user');
  $this->db->where('email',$email);
  $query=$this->db->get();

  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }

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
 public function get_all_human()
 {
 $this->db->from('user');
 $query=$this->db->get();
 return $query->result();
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

 public function user_timeDeposit($tDeposit){

   $this->db->insert('timedeposit', $tDeposit);
 }
 public function update_timeDeposit($id,$data){

 $this->db->where('id', $id);
  $this->db->update('timedeposit', $data);
 return $this->db->affected_rows();
 }

 public function user_timeDepositTr($addT){

   $this->db->insert('transaction', $addT);
 }
 public function view_timeDeposit(){

 	$this->db->select('*');
     $this->db->from('timedeposit');
     $query = $this->db->get();
      if ($query->num_rows() > 0){
 			 $result =  $query->result();
 			 return $result;
 		}
      else{
          return false;
      }
 }
 public function get_timeDeposit($id){

 	$this->db->select('*');
     $this->db->from('timedeposit');
 	$this->db->where('tDeptID',$id);
     $query = $this->db->get();
      if ($query->num_rows() > 0){
 			 $result =  $query->result();
 			 return $result;
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

  public function paybill($data){


  $this->db->insert('payhistory', $data);

  }

}



?>
