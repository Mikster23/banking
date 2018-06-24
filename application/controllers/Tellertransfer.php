<?php
class Tellertransfer extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('teller_model');
      $this->load->database('default');


}

public function index()
{
  $this->load->view('teller/transfertellerview.php');
}
public function loadfund()
{
  $this->load->view('teller/transferhistory.php');
}


public function maketransfer()
{
  $amount= (int)$this->input->post('user_amount');
  $remarks = $this->input->post('user_remarks');
  $bal =   $this->session->userdata('user_balance');
  $sourceacct = (int) $this->input->post('user_fromacctnum');
  $destinationacct = (int) $this->input->post('user_toacctnum');
  $rembal = 0;
  $sacct=array(

  'accountnum'=>$sourceacct

    );
  $dacct=array(

    'accountnum'=>$destinationacct

      );

    $sourcedata= $this->teller_model->checkexist_acctnum($sacct['accountnum']);
    $destinationdata= $this->teller_model->checkexist_acctnum($dacct['accountnum']);
    if(!$sourcedata){
      echo $this->session->set_flashdata('error_msg', 'Source Account Number Does not Match any of the Records');
      redirect('/tellertransfer');
    }
    if(!$destinationdata){
      echo $this->session->set_flashdata('error_msg', 'Destination Account Number Does not Match any of the Records');
      redirect('/tellertransfer');
    }


    $sourcedata2 = $this->teller_model->getbalance_acctnum($sacct['accountnum']);


if($sourcedata && $destinationdata)
{




/*
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
     $data2=$this->user_model->checkmindeposit($min['id']);
    $this->session->set_userdata('user_balance',$bal-$amount);
    $id =  $this->session->userdata('user_id');
    $tempbal =    $this->session->userdata('user_balance');
    $tempwith    = $this->session->userdata('user_withdrawablebalance');
    $this->session->set_userdata('user_withdrawablebalance',$tempwith - $amount);
    $withdraw_check=$this->user_model->user_withdraw($id,$user_withdraw);



    $history=array(
    'accountnum'=>(int)$this->session->userdata('user_acctnum'),
    'action'=>'Transfer Funds',
    'to_accountnum' => $toacct,
    'amount'=>$amount,
    'remarks'=>$remarks
      );
    $this->user_model->user_history($history);


  echo $this->session->set_flashdata('success_msg', 'TRANSFER SUCCESSFUL');


echo json_encode(array("status" => TRUE)); */
  $this->session->set_flashdata('error_msg', 'Success');
redirect('/tellertransfer');
}


else{

  $this->session->set_flashdata('error_msg', 'Account Does not Exist');
  redirect('/tellertransfer');
}
}



}
?>
