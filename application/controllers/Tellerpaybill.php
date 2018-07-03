<?php

class Tellerpaybill extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('teller_model');
      $this->load->database('default');


}

public function index()
{

  $data2['merchant'] = $this->teller_model->getmerch();
 //$this->load->view('teller/manageview.php',$data2);


  $this->load->view('teller/tellerpaybillview.php',$data2);
}
function loadpayview(){

  $this->load->view('teller/tellerpaybillview.php');
}


function pay(){
  $account = (int) $this->input->post('user_account');
  //$databal=$this->teller_model->getbalance_acctnum($account);


  $dataacctidtype =$this->teller_model->getuseracctid($account);
  $accounttype = (int) $dataacctidtype['account_name'];
  $datafee = $this->teller_model->getotcfee($accounttype);




  $transactionfee = (int) $datafee['otc_fee'];
  $minwithdraw = (int) $datafee['minwith'];
  $maintainbal = (int) $datafee['minbalance'];
  $amount= (int)$this->input->post('user_amount') - $transactionfee;

  $amountcheck = (int)$this->input->post('user_amount');
  $amounthistory = (int)$this->input->post('user_amount');
  $bal = (int) $dataacctidtype['balance'];
  //$balfinal = $bal - $amount;
  $id =  (int)$this->session->userdata('user_id');
  $pin = $this->input->post('user_pin');
  $pintrue =   $this->session->userdata('user_pin');
  $balbefore = $bal;

  if($bal > $maintainbal){

    $penaltyfee = 0;

  }
  $balafter = $bal - ($amountcheck + $transactionfee +$penaltyfee);



  if(empty($amount)){
    $this->session->set_flashdata('error_msg', 'Please Fill In Empty fields');
    redirect('/tellerpaybill');


  }
  if($amount > $balafter ){

    $this->session->set_flashdata('error_msg', 'Account has Insufficient Balance');
    redirect('/tellerpaybill');

  }


$tellerid=  (int)$this->session->userdata('user_id');


  $data = array(
      'referencenum' =>  $this->input->post('user_reference'),
      'payer_id' => $account,
      'merchant_name' => $this->input->post('user_merchant'),
      'amount' =>(int) $amount
    );
  $insert = $this->teller_model->paybill($data);








    $history=array(
    'user_id'=>$tellerid,
    'from_accountnum' => $account,
    'action'=>'Bill Pay',
    'amount'=>$amount,
    'remarks'=>'Pay Bill'
      );
  $this->teller_model->user_history($history);




  //$this->session->set_userdata('user_withdrawablebalance',$tempbal-$data2['minbalance']);

  //$wb = (int) $this->session->userdata('user_withdrawablebalance');


  $user_withdraw=array(

    //  'pin'=>$this->input->post('user_pin'),
    'balance' => $balafter,


  );


  $id =  $this->session->userdata('user_id');



  $withdraw_check=$this->teller_model->user_withdraw($account,$user_withdraw);


$this->session->set_flashdata('success_msg', 'Successfully paybill <br> Penalty for below maintaining balance : PHP '.$transactionfee);

redirect('/tellerpaybill');



}


}
?>
