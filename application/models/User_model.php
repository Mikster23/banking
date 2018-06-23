<?php
class User_model extends CI_model{



public function register_user($user){


$this->db->insert('user', $user);

}
public function user_deposit($id, $user_deposit){


  $this->db->where('id', $id);
  $this->db->update('user', $user_deposit);
		return $this->db->affected_rows();
}
public function user_history($history){

  $this->db->insert('transaction', $history);
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


}


?>
