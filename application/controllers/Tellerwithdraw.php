<?php

class Tellerwithdraw extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('teller_model');
      $this->load->database('default');


}

public function index()
{
  $this->load->view('teller/withdrawtellerview.php');
}

public function tellermakewithdraw()
{


  $amount= (int)$this->input->post('user_amount');
  $account = (int) $this->input ->post('user_accountnum');

  $dataacctidtype = $this->teller_model->getuseracctid($account);


  $accounttype = (int) $dataacctidtype['account_name'];
  $id = (int)$dataacctidtype['holder_id'];
  $bal = (int) $dataacctidtype['balance'];
  $balafter = $bal - $amount;
  $checkactivated = (int) $dataacctidtype['status'];
  if(empty($amount) || empty($account)){

    $this->session->set_flashdata('error_msg', 'Please Fill up Empty field/s');
    redirect('/tellerwithdraw');
  }
  if($amount > $bal ){

    $this->session->set_flashdata('error_msg', 'Insufficient Balance');
    redirect('/tellerwithdraw');

  }
  if( $bal <0 ){

    $this->session->set_flashdata('error_msg', 'No Negative Values');
    redirect('/tellerwithdraw');

  }
  if($checkactivated == 0 ) {

    $this->session->set_flashdata('error_msg', 'Account is not Activated you cannot withdraw to this account');
    redirect('/tellerwithdraw');

  }
  $datafee = $this->teller_model->getotcfee($accounttype);

  $transactionfee = (int) $datafee['otc_fee'];
  $checkcandep = (int) $datafee['withtel'];

  if($checkcandep == 0){

    $this->session->set_flashdata('error_msg', 'Sorry But this account cant Withdraw through teller');
    redirect('/tellerwithdraw');

  }
  $data2=$this->teller_model->checkacctnum($account);
  $userbalance = $data2['balance'] +$amount;

  $idtrue = (int) $data2['accountnum'];

  //$bal =   $this->session->userdata('user_balance');

  $pin = $this->input->post('user_pin');
  $pintrue =   $this->session->userdata('user_pin');
  $userid = (int) $data2['id'];
if(!$data2){
      echo $id . "fake == true" . $idtrue;
      $this->session->set_flashdata('error_msg', 'Account Number does not match any of our records');
      redirect('/tellerwithdraw');
}
if(empty($amount)){
  $this->session->set_flashdata('error_msg', 'Fill in Empty Fields');
  redirect('/tellerwithdraw');

}

$history=array(
 'to_accountnum'=>$account,
 'action'=>'History made by Teller:',
 'amount'=>$amount,
 'remarks'=>'Teller Withdraw'
   );
$this->teller_model->user_history($history);

//$this->session->set_flashdata('success_msg', 'Withdraw Successful!');
$user_withdraw=array(

  //  'pin'=>$this->input->post('user_pin'),
  'balance' => $balafter,


);


$id =  $this->session->userdata('user_id');



$withdraw_check=$this->teller_model->user_withdraw($account,$user_withdraw);
$this->session->set_flashdata('success_msg', 'Withdraw Successful');
//  echo json_encode(array("status" => TRUE));
redirect('/tellerwithdraw');

          redirect('/tellerwithdraw');


}
}
?>
