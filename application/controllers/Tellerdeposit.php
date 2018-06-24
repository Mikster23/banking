<?php

class Tellerdeposit extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('teller_model');
      $this->load->database('default');


}

public function index()
{
  $this->load->view('teller/deposittellerview.php');
}


public function loadteller()
{
  $this->load->view('teller/deposittellerview.php');
}



public function tellermakedeposit()
{



  $amount= (int)$this->input->post('user_amount');
  $id = (int) $this->input ->post('user_accountnum');


  $data2=$this->teller_model->checkacctnum($id);
  $userbalance = $data2['balance'] +$amount;

  $idtrue = (int) $data2['accountnum'];

  $bal =   $this->session->userdata('user_balance');

  $pin = $this->input->post('user_pin');
  $pintrue =   $this->session->userdata('user_pin');
  $userid = (int) $data2['id'];
if(!$data2){
      echo $id . "fake == true" . $idtrue;
      $this->session->set_flashdata('error_msg', 'Account Number does not match');
      redirect('/tellerdeposit');
}
else{


 $history=array(
  'accountnum'=>(int)$this->session->userdata('user_acctnum'),
  'action'=>'Deposit made by Teller:'.$this->session->set_userdata('user_lastname'),
  'to_accountnum' => $idtrue,
  'amount'=>$amount,
  'remarks'=>'Teller Deposit'
    );
$this->teller_model->user_history($history);



  $user_deposit=array(

//  'pin'=>$this->input->post('user_pin'),
  'balance' => $userbalance


    );

    $clause = "where id =";
      $deposit_check=$this->teller_model->teller_deposit($userid,$user_deposit);
$amount= (int)$this->input->post('user_amount');
$this->session->set_flashdata('success_msg', 'PHP '.$amount.' Successfully Deposited to: '.$data2['lastname']."Account Number : " . + $idtrue);

echo json_encode(array("status" => TRUE));
redirect('/tellerdeposit');
}

}


}
?>
