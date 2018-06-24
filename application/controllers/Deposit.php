<?php

class Deposit extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('user_model');
      $this->load->database('default');


}

public function index()
{
  $this->load->view('user/depositview.php');
}

public function makedeposit()
{



  $amount= (int)$this->input->post('user_amount');

  $bal =   $this->session->userdata('user_balance');
$id =  $this->session->userdata('user_id');
$pin = $this->input->post('user_pin');
$pintrue =   $this->session->userdata('user_pin');

if($pin != $pintrue){
echo $pin . "fake == true" . $pintrue;
  $this->session->set_flashdata('error_msg', 'Wrong Pin Number');
redirect('/deposit');
}
else{
  $history=array(
  'accountnum'=>(int)$this->session->userdata('user_acctnum'),
  'action'=>'Deposit',
  'amount'=>$amount,
  'remarks'=>'test'
    );
$this->user_model->user_history($history);

$this->session->set_flashdata('success_msg', 'Deposit Successful!');

  $user_deposit=array(

//  'pin'=>$this->input->post('user_pin'),
  'balance' => $bal+ $amount


    );
      $data2=$this->user_model->checkmindeposit($min['id']);
    $this->session->set_userdata('user_balance',$bal+$amount);
    $tempbal =    $this->session->userdata('user_balance');
    $tempwith    = $this->session->userdata('user_withdrawablebalance');
    $this->session->set_userdata('user_withdrawablebalance',$tempwith + $amount);
    $id =  $this->session->userdata('user_id');
    $clause = "where id =";
      $deposit_check=$this->user_model->user_deposit($id,$user_deposit);

echo json_encode(array("status" => TRUE));
redirect('/deposit');
}
}
}
?>
