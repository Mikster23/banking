<?php

class Paybill extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('user_model');
      $this->load->database('default');


}

public function index()
{

  $data2['merchant'] = $this->user_model->getmerch();
 //$this->load->view('teller/manageview.php',$data2);


  $this->load->view('user/paybillview.php',$data2);
}
function loadpayview(){

  $this->load->view('user/paybillview.php');
}


function pay(){
  $account = (int) $this->input->post('user_owned');
  $databal=$this->user_model->getbalance_acctnum($account);


  $dataacctidtype = $this->user_model->getownedacctid($account);


  $accounttype = (int) $dataacctidtype['account_name'];

  $datafee = $this->user_model->getatmfee($accounttype);

  $penaltyfee = (int)$datafee['penalty'];
  $transactionfee = (int) $datafee['atm_fee'];
  $minwithdraw = (int) $datafee['minwith'];
  $maintainbal = (int) $datafee['minbalance'];
  $amount= (int)$this->input->post('user_amount') - $transactionfee;

  $amountcheck = (int)$this->input->post('user_amount');
  $amounthistory = (int)$this->input->post('user_amount');
  $bal = (int) $databal['balance'];
  //$balfinal = $bal - $amount;
  $id =  (int)$this->session->userdata('user_id');
  $pin = $this->input->post('user_pin');
  $pintrue =   $this->session->userdata('user_pin');
  $balbefore = $bal;

  if($bal > $maintainbal){

    $penaltyfee = 0;

  }
  $balafter = $bal - ($amountcheck + $transactionfee +$penaltyfee);

  if($pin != $pintrue){
    echo $pin . "fake == true" . $pintrue;
    $this->session->set_flashdata('error_msg', 'Wrong Pin Number');
    redirect('/paybill');
  }


  if(empty($amount)){
    $this->session->set_flashdata('error_msg', 'Please Fill In Empty fields');
    redirect('/paybill');


  }
  if($amount <0 ){

    $this->session->set_flashdata('error_msg', 'No Negative Input!');
    redirect('paybill');
  }






  $data = array(
      'referencenum' =>  $this->input->post('user_reference'),
      'payer_id' => $id,
      'merchant_name' => $this->input->post('user_merchant'),
      'amount' =>(int) $amount
    );
  $insert = $this->user_model->paybill($data);

  $this->session->set_flashdata('success_msg', "Success Pay!");






    $history=array(
    'user_id'=>$account,
    'action'=>'Bill Pay',
    'amount'=>$amount,
    'remarks'=>'Pay Bill'
      );
  $this->user_model->user_history($history);




  //$this->session->set_userdata('user_withdrawablebalance',$tempbal-$data2['minbalance']);

  //$wb = (int) $this->session->userdata('user_withdrawablebalance');


  $user_withdraw=array(

    //  'pin'=>$this->input->post('user_pin'),
    'balance' => $balafter,


  );


  $id =  $this->session->userdata('user_id');

if($bal<$maintainbal){

  $this->session->set_flashdata('success_msg', 'Withdraw Successful! <br> Penalty has been issued Account Below Maintaining Balance of : PHP '.$maintainbal.'<br> Penalty Fee : PHP '.$penaltyfee);
}
else{

  $this->session->set_flashdata('success_msg', 'Withdraw Successful! Transaction Fee : PHP '.$transactionfee);
}



  $withdraw_check=$this->user_model->user_withdraw($id,$account,$user_withdraw);
redirect('/paybill');



}


}
?>
