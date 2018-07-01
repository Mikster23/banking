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

public function user_deposit($id,$acctnum, $user_deposit){

  $this->db->where('holder_id',$id);
  $this->db->where('accountnum', $acctnum);

  $this->db->update('accounts', $user_deposit);
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
public function get_history($id = 0){
/*  if(isset($_POST["order"]))
         {
              $order_column = array(null, "action", "amount", "created_at");
              $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
         }*/
         $this->db->select('*');
         $this->db->from('transaction');
         $this->db->where('user_id',$id);
         $this->db->or_where('receiver_id',$id);
         $query = $this->db->get();
         return $query->result_array();




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
public function user_withdraw($id,$acctnum, $user_withdraw){


  $this->db->where('holder_id', $id);
    $this->db->where('accountnum', $acctnum);
  $this->db->update('accounts', $user_withdraw);
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
    $this->db->from('accounts');
  $this->db->where('account_name',$acctnum);
     $query = $this->db->get();
     if ($query->num_rows() > 0){
         return true;
     }
     else{
         return false;
     }


}
public function getbalance_acctnum($acctnum){

  $this->db->select('*');
  $this->db->from('accounts');
  $this->db->where('accountnum',$acctnum);

   if($query=$this->db->get())
   {
       return $query->row_array();
   }
   else{
     return false;
   }


}

public function getatmfee($id){

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
//fetching single row;
public function getownedacctid($id){

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




public function transfer($acctnum,$amount){

    $this->db->where('accountnum', $acctnum);
    $this->db->update('accounts', $amount);
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
 function getacctid($id = 0){

    $response = array();

    // Select record
    $this->db->select('id');
   $this->db->from('account_type');
   $this->db->where('id',$id);
    $q = $this->db->get();
    $response = $q->result_array();

    return $response;
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
   $this->db->where('status',1);
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

 function checkmaintaining($id){


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



//-->
public function user_timeDeposit($tDeposit){

  $this->db->insert('timedeposit', $tDeposit);
}
public function update_timeDeposit($id,$data,$tdeptID){

$this->db->set('amount', $data);
$this->db->set('status', 1);
$this->db->where('userID', $id);
$this->db->where('tdeptID', $tdeptID);
$this->db->update('timedeposit');
return $this->db->affected_rows();
}
public function update_timeDepositA($data,$tdeptID){

$this->db->set('amount', $data);
$this->db->set('status', 1);
//$this->db->where('userID', $id);
$this->db->where('tdeptID', $tdeptID);
$this->db->update('timedeposit');
return $this->db->affected_rows();
}

public function update_timeDepositE($id,$data,$tdeptID,$plc){

$this->db->set('amount', $data);
$this->db->set('status', 0);
$this->db->set('intDate', $plc);
$this->db->set('intDate', $plc);
$this->db->set('placement', $plc);
$this->db->where('userID', $id);
$this->db->where('tdeptID', $tdeptID);

$this->db->update('timedeposit');
return $this->db->affected_rows();
}
public function update_user($id,$totalbal,$accountnum){

$this->db->set('balance', $totalbal);
$this->db->where('id', $id);
$this->db->where('accountnum', $accountnum);
$this->db->update('user');
return $this->db->affected_rows();
}
public function update_userA($totalbal,$accountnum){

$this->db->set('balance', $totalbal);
//$this->db->where('id', $id);
$this->db->where('accountnum', $accountnum);
$this->db->update('user');
return $this->db->affected_rows();
}

public function useer_sameAcc($datasame){

 $this->db->set('amount', $data);
 $this->db->set('status', 1);
 $this->db->where('userID', $id);
 $this->db->where('tdeptID', $tdeptID);
 $this->db->update('user');
return $this->db->affected_rows();
}

public function user_timeDepositTr($addT){

  $this->db->insert('transaction', $addT);
}
public function view_user($addT,$acctID){

	$this->db->select('*');
    $this->db->from('user');
	$this->db->where('id',$addT);
	//$this->db->where('accountnum',$acctID);
    $query = $this->db->get();
     if ($query->num_rows() > 0){
			 $result =  $query->result();
			 return $result;
		}
     else{
         return false;
     }
}
public function view_userA($acctID){

	$this->db->select('*');
    $this->db->from('user');
	//$this->db->where('id',$addT);
	$this->db->where('accountnum',$acctID);
    $query = $this->db->get();
     if ($query->num_rows() > 0){
			 $result =  $query->result();
			 return $result;
		}
     else{
         return false;
     }
}
public function check_userA($acctID){

	$this->db->select('*');
    $this->db->from('user');
	//$this->db->where('id',$addT);
	$this->db->where('accountnum',$acctID);
    $query = $this->db->get();
     if ($query->num_rows() > 0){
			 $result =  $query->result();
			 return true;
		}
     else{
         return false;
     }
}


public function view_timeDeposit($id){

	$this->db->select('*');
    $this->db->from('timedeposit');
	$this->db->where('userID',$id);
    $query = $this->db->get();
     if ($query->num_rows() > 0){
			 $result =  $query->result();
			 return $result;
		}
     else{
         return false;
     }
}
public function view_timeDepositA($id){

	$this->db->select('*');
    $this->db->from('timedeposit');
	//$this->db->where('acctID',$id);
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

public function get_acctnum($id){
	$this->db->distinct();
	$this->db->select('*');
    $this->db->from('timedeposit');
	$this->db->where('userID',$id);
	$this->db->group_by('acctID');
    $query = $this->db->get();
     if ($query->num_rows() > 0){
			 $result =  $query->result();
			 return $result;
		}
     else{
         return false;
     }
}
//->


}



?>
