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
  $camount= (int)$this->input->post('user_amount');
  $remarks = $this->input->post('user_remarks');
  $bal =   $this->session->userdata('user_balance');
  $sourceacct = (int) $this->input->post('user_fromacctnum');
  $destinationacct = (int) $this->input->post('user_toacctnum');
  $rembal = 0;

if(!empty($camount) && !empty($sourceacct) && !empty($destinationacct))
{
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
    $destinationdata2 = $this->teller_model->getbalance_acctnum($dacct['accountnum']);
    $sourcebalance = (int) $sourcedata2['balance'];
    $destinationbalance = (int) $destinationdata2['balance'];

    $min=array(

    'id'=> (int) $sourcedata2['account_type']


      );

      $checkwithdraw=$this->teller_model->checkmindeposit($min['id']);
      $checkbal = $sourcebalance-$amount;
      $balcheck = (int) $checkwithdraw['minbalance'];
      $allow = $sourcebalance - $balcheck;
      if($amount > $allow){
        $this->session->set_flashdata('error_msg', 'The amount is over the allowed withdrawable balance of the source account number!' . '<br> Allowable withdraw : PHP ' .$allow );
      redirect('/tellertransfer');

    }
    $sourcebalafter = $sourcebalance - $amount;

if($sourcedata && $destinationdata)
{





  //  $tobalance =  $data2['balance'];

  //  $this->session->set_userdata('user_id',$data['id']);






  //  $amount= (int)$this->input->post('user_amount');
  //  $baltransfer = $tobalance +  $amount;
   $toacct = (int)$this->input->post('user_toacctnum');
    //$bal =   $this->session->userdata('user_balance');
//    $id =  $this->session->userdata('user_id');
    $pin = $this->input->post('user_pin');
    $destbalance =  (double) $destinationdata2['balance'] +$amount;
    $transfer=array(

  //  'pin'=>$this->input->post('user_pin'),
    'balance' => $destbalance



      );

    $sourcebalance = (double) $sourcedata2['balance'] -$amount;
    $trans_check=$this->teller_model->transfer($toacct,$transfer);

    $user_withdraw=array(

    //  'pin'=>$this->input->post('user_pin'),
      'balance' => $sourcebalance


    );
    //$data2=$this->user_model->checkmindeposit($min['id']);
  //  $this->session->set_userdata('user_balance',$bal-$amount);
  //  $id =  $this->session->userdata('user_id');
  //  $tempbal =    $this->session->userdata('user_balance');
  //  $tempwith    = $this->session->userdata('user_withdrawablebalance');
  //  $this->session->set_userdata('user_withdrawablebalance',$tempwith - $amount);
    $sourceid = $sourcedata2['id'];
    $withdraw_check=$this->teller_model->user_withdraw($sourceid,$user_withdraw);



    $history=array(
    'accountnum'=>$sourceacct,
    'action'=>'Transfer Funds by Teller',
    'to_accountnum' => $destinationacct,
    'amount'=>$amount,
    'remarks'=>$remarks
      );
    $this->teller_model->user_history($history);


   $this->session->set_flashdata('success_msg', 'TRANSFER SUCCESSFUL');


echo json_encode(array("status" => TRUE));
  //$this->session->set_flashdata('success_msg', 'Success');
redirect('/tellertransfer');
}


else{

  $this->session->set_flashdata('error_msg', 'Account Does not Exist');
  redirect('/tellertransfer');
}
}else{
  $this->session->set_flashdata('error_msg', 'Please Enter account number and amount');
  redirect('/tellertransfer');

}
}



}
?>
