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
  $account = (int) $this->input ->post('user_accountnum');

  $dataacctidtype = $this->teller_model->getuseracctid($account);


  $accounttype = (int) $dataacctidtype['account_name'];
  $id = (int)$dataacctidtype['holder_id'];
  $bal = (int) $dataacctidtype['balance'];

  $checkactivated = (int) $dataacctidtype['status'];
  $atype = (int) $dataacctidtype['account_name'];
  if($checkactivated == 0 ) {

    $this->session->set_flashdata('error_msg', 'Account is not Activated you cannot deposit to this account');
    redirect('/tellerdeposit');

  }
  $datafee = $this->teller_model->getotcfee($accounttype);




  $transactionfee = $datafee['otc_fee'];
  $checkcandep = (int) $datafee['deptel'];

  if($checkcandep == 0){

    $this->session->set_flashdata('error_msg', 'Sorry But this account cant deposit through teller');
    redirect('/tellerdeposit');

  }
  $data2=$this->teller_model->checkacctnum($account);
  $userbalance = $data2['balance'] +$amount;

  $idtrue = (int) $data2['accountnum'];

  //$bal =   $this->session->userdata('user_balance');

  $pin = $this->input->post('user_pin');
  $pintrue =   $this->session->userdata('user_pin');
if($pin != $pintrue){

  $this->session->set_flashdata('error_msg', 'WRONG PIN NUMBER FOR TELLER ACCOUNT');
  redirect('/tellerdeposit');


}
if($amount <0 ){
  $this->session->set_flashdata('error_msg', 'No Negative Input!');
  redirect('/tellerdeposit');


}

  $userid = (int) $data2['id'];
if(!$data2){
      echo $id . "fake == true" . $idtrue;
      $this->session->set_flashdata('error_msg', 'Account Number does not match any of our records');
      redirect('/tellerdeposit');
}
if(empty($amount)){
  $this->session->set_flashdata('error_msg', 'Fill in Empty Fields');
  redirect('/tellerdeposit');

}

$tellerid=  (int)$this->session->userdata('user_id');
$history=array(
'user_id' =>  $tellerid,
  'to_accountnum'=>$account,
  'action'=>'Deposit made by Teller:',
  'amount'=>$amount,
  'transaction_fee' =>(int)$transactionfee,
  'remarks'=>'Teller Deposit'
    );
$this->teller_model->user_history($history);



$user_deposit=array(

  //  'pin'=>$this->input->post('user_pin'),
  'balance' => ($bal-$transactionfee) + $amount,


);
/*
$min=array(

  'id'=>(int)$this->session->userdata('user_accttype')


);
$data2=$this->user_model->checkmindeposit($min['id']);
$min = (int)$data2['minbalance']; */
/*  $this->session->set_userdata('user_balance',$bal+$amount);
$tot = ($bal+$amount)-$min;


$tempbal =    $this->session->userdata('user_balance');
$tempwith    = $this->session->userdata('user_withdrawablebalance');
$this->session->set_userdata('user_withdrawablebalance',$tot);
$id =  $this->session->userdata('user_id');
$clause = "where id ="; */

$this->teller_model->teller_deposit($account,$user_deposit);
$amount= (int)$this->input->post('user_amount');
$this->session->set_flashdata('success_msg', 'PHP '.$amount.' Successfully Deposited to: '.$data2['lastname']."Account Number : " .  $idtrue . "Transaction fee : PHP ".$transactionfee);

echo json_encode(array("status" => TRUE));
redirect('/tellerdeposit');


}


}
?>
