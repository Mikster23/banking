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
$id = $this->session->userdata('user_id');
$amount = $this->input->post('user_amount');
$bal =   (int) $this->session->userdata('user_balance');
$id =  $this->session->userdata('user_id');
$pin = $this->input->post('user_pin');
$pintrue =   $this->session->userdata('user_pin');
$data3=$this->user_model->checkmindeposit($min['id']);
$wb = (int) $this->session->userdata('user_withdrawablebalance');
$min2 = (int) $data3['minbalance'];

if(!empty($amount)){
    if($amount > $wb){
    $this->session->set_flashdata('error_msg', 'Insufficient Balance');
    redirect('/paybill');

  }
  else{
  $data = array(
      'referencenum' =>  $this->input->post('user_reference'),
      'payer_id' => $id,
      'merchant_name' => $this->input->post('user_merchant'),
      'amount' =>(int) $amount
    );
  $insert = $this->user_model->paybill($data);
  echo json_encode(array("status" => TRUE));
  $this->session->set_flashdata('success_msg', "Success Pay!");






    $history=array(
    'accountnum'=>(int)$this->session->userdata('user_acctnum'),
    'action'=>'Bill Pay',
    'amount'=>$amount,
    'remarks'=>'Pay Bill'
      );
  $this->user_model->user_history($history);




  //$this->session->set_userdata('user_withdrawablebalance',$tempbal-$data2['minbalance']);

  //$wb = (int) $this->session->userdata('user_withdrawablebalance');


    $user_withdraw=array(

  //  'pin'=>$this->input->post('user_pin'),
    'balance' => $bal-$amount


      );
      $min=array(

      'id'=>(int)$this->session->userdata('user_accttype')


        );
          $data2=$this->user_model->checkmindeposit($min['id']);
        $min = (int)$data2['minbalance'];
        $tot = ($bal-$amount) - $min;
        $tbal = $bal-$amount;

      $tempbal =    $this->session->userdata('user_balance');
      $this->session->set_userdata('user_balance',$bal-$amount);

      $this->session->set_userdata('user_withdrawablebalance',$tot);


      $id =  $this->session->userdata('user_id');

  //$this->session->set_flashdata('success_msg', 'Withdraw Successful!'.$wb);
     $withdraw_check=$this->user_model->user_withdraw($id,$user_withdraw);
redirect('paybill');
    }
}
else{
    $this->session->set_flashdata('error_msg', "Please fill Empty Fields!");
  redirect('paybill');

}


}


}
?>
