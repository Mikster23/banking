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
  $id = (int) $this->input ->post('user_accountnum');


  $data2=$this->teller_model->checkacctnum($id);
  //$userbalance = $data2['balance'] +$amount;

  $idtrue = (int) $data2['accountnum'];

  $bal =   $data2['balance'];

  $pin = $this->input->post('user_pin');
  $pintrue =   $this->session->userdata('user_pin');
  $userid = (int) $data2['id'];
  if(!$data2){
        echo $id . "fake == true" . $idtrue;
        $this->session->set_flashdata('error_msg', 'Account Number does not match any of the records');
        redirect('/tellerdeposit');
  }

else if($amount > $bal){
  $this->session->set_flashdata('error_msg', 'The Client Has Insufficient Balance');
  redirect('/tellerwithdraw');

}

else{
  $history=array(
  'accountnum'=>(int)$this->session->userdata('user_acctnum'),
  'action'=>'Withdraw made by Teller:'.$this->session->set_userdata('user_lastname'),
  'amount'=>$amount,
  'remarks'=>'test'
    );
$this->teller_model->user_history($history);

//$this->session->set_flashdata('success_msg', 'Withdraw Successful!');
  $user_withdraw=array(

//  'pin'=>$this->input->post('user_pin'),
  'balance' => $bal-$amount


    );
    $min=array(

    'id'=> (int) $data2['account_type']


      );

      $data3=$this->teller_model->checkmindeposit($min['id']);
      $checkbal = $bal-$amount;
      $min = (int) $data3['minbalance'];

  //  $this->session->set_userdata('user_balance',$bal-$amount);
  //  $tempbal =    $this->session->userdata('user_balance');
  //  $this->session->set_userdata('user_withdrawablebalance',$tempbal-$data3['minbalance']);
        if($checkbal >= $min){
          $this->session->set_flashdata('success_msg', 'Withdraw Successful!');
          $withdraw_check=$this->teller_model->user_withdraw($userid,$user_withdraw);

          echo json_encode(array("status" => TRUE));
          redirect('/tellerwithdraw');
          }
else{
  $this->session->set_flashdata('error_msg', 'Cannot Withdraw greater than your withdrawable balance!');
  redirect('/tellerwithdraw');
}
}
}
}
?>
