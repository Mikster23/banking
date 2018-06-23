<?php

class Withdraw extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('user_model');
      $this->load->database('default');


}

public function index()
{
  $this->load->view('user/withdrawview.php');
}

public function makewithdraw()
{



  $amount= (int)$this->input->post('user_amount');

  $bal =   $this->session->userdata('user_balance');
$id =  $this->session->userdata('user_id');
$pin = $this->input->post('user_pin');
$pintrue =   $this->session->userdata('user_pin');

if($pin != $pintrue){
echo $pin . "fake == true" . $pintrue;
  $this->session->set_flashdata('error_msg', 'Wrong Pin Number');
redirect('/withdraw');
}
else if($amount > $bal){
  $this->session->set_flashdata('error_msg', 'Insufficient Balance');
  redirect('/withdraw');

}
else{
  $history=array(
  'accountnum'=>(int)$this->session->userdata('user_acctnum'),
  'action'=>'Withdraw',
  'amount'=>$amount,
  'remarks'=>'test'
    );
$this->user_model->user_history($history);

$this->session->set_flashdata('success_msg', 'Withdraw Successful!');
  $user_withdraw=array(

//  'pin'=>$this->input->post('user_pin'),
  'balance' => $bal-$amount


    );
    $this->session->set_userdata('user_balance',$bal-$amount);
    $id =  $this->session->userdata('user_id');

      $withdraw_check=$this->user_model->user_withdraw($id,$user_withdraw);

echo json_encode(array("status" => TRUE));
redirect('/withdraw');
}
}
}
?>
