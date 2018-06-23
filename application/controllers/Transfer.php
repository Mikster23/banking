<?php
class Transfer extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('user_model');
      $this->load->database('default');


}

public function index()
{
  $this->load->view('user/transferview.php');
}


public function maketransfer()
{
  $amount= (int)$this->input->post('user_amount');
  $remarks = $this->input->post('user_remarks');
  $bal =   $this->session->userdata('user_balance');
  $toacct = (int) $this->input->post('user_acctnum');
  $rembal = 0;
  $acct=array(

  'accountnum'=>$toacct

    );

    $data=$this->user_model->checkexist_acctnum($acct['accountnum']);
    $data2 = $this->user_model->getbalance_acctnum($acct['accountnum']);
if($data && $data2)
{





    $tobalance =  $data2['balance'];

  //  $this->session->set_userdata('user_id',$data['id']);






    $amount= (int)$this->input->post('user_amount');
    $baltransfer = $tobalance +  $amount;
    $toacct = (int)$this->input->post('user_acctnum');
    $bal =   $this->session->userdata('user_balance');
    $id =  $this->session->userdata('user_id');
    $pin = $this->input->post('user_pin');

    $transfer=array(

  //  'pin'=>$this->input->post('user_pin'),
    'balance' => $baltransfer



      );


    $trans_check=$this->user_model->transfer($toacct,$transfer);

    $user_withdraw=array(

    //  'pin'=>$this->input->post('user_pin'),
      'balance' => $bal-$amount


    );
    $this->session->set_userdata('user_balance',$bal-$amount);
    $id =  $this->session->userdata('user_id');

    $withdraw_check=$this->user_model->user_withdraw($id,$user_withdraw);



    $history=array(
    'accountnum'=>(int)$this->session->userdata('user_acctnum'),
    'action'=>'Deposit',
    'to_accountnum' => $toacct,
    'amount'=>$amount,
    'remarks'=>$remarks
      );
    $this->user_model->user_history($history);


  echo $this->session->set_flashdata('success_msg', 'TRANSFER SUCCESSFUL');


echo json_encode(array("status" => TRUE));
redirect('/transfer');
}


else{

  $this->session->set_flashdata('error_msg', 'Account Does not Exist');
  redirect('/transfer');
}
}
}
?>
