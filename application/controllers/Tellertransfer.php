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
 if(empty($amount)){

   $this->session->set_flashdata('error_msg', 'Please Fill in Empty Fields');
         redirect('/tellertransfer');
 }



    /*$sourcedata= $this->teller_model->checkexist_acctnum($sourceacct);
   $destinationdata= $this->teller_model->checkexist_acctnum($destinationacct);


    if(!$sourcedata){
      echo $this->session->set_flashdata('error_msg', 'Source Account Number Does not Match any of the Records');
      redirect('/tellertransfer');
    }
    if(!$destinationdata){
      echo $this->session->set_flashdata('error_msg', 'Destination Account Number Does not Match any of the Records');
      redirect('/tellertransfer');
    }*/



      $checkdestbal=$this->teller_model->getuseracctid($destinationacct);
      $checksourcebal=$this->teller_model->getuseracctid($sourceacct);
      $checkbal = $checksourcebal['balance'];
      $checkbaldest = $checkdestbal['balance'];


      if($amount > $checkbal){
        $this->session->set_flashdata('error_msg', 'The source has insufficient balance ' );
      redirect('/tellertransfer');

    }
//    $sourcebalafter = $sourcebalance - $amount;






  //  $tobalance =  $data2['balance'];

  //  $this->session->set_userdata('user_id',$data['id']);






  //  $amount= (int)$this->input->post('user_amount');
  //  $baltransfer = $tobalance +  $amount;
   $toacct = (int)$this->input->post('user_toacctnum');
    //$bal =   $this->session->userdata('user_balance');
//    $id =  $this->session->userdata('user_id');

    $balafter = (double) $checkbal - $amount;
    $balafter2 = (double) $checkbaldest + $amount;
    $pin = $this->input->post('user_pin');

    $transfer=array(

  //  'pin'=>$this->input->post('user_pin'),
    'balance' => $balafter



      );

          $transfer2=array(

        //  'pin'=>$this->input->post('user_pin'),
          'balance' => $balafter2



            );

    $trans_check2=$this->teller_model->transfer2($destinationacct,$transfer2);
    $trans_check=$this->teller_model->transfer($sourceacct,$transfer);





    //$data2=$this->user_model->checkmindeposit($min['id']);
  //  $this->session->set_userdata('user_balance',$bal-$amount);
  //  $id =  $this->session->userdata('user_id');
  //  $tempbal =    $this->session->userdata('user_balance');
  //  $tempwith    = $this->session->userdata('user_withdrawablebalance');
  //  $this->session->set_userdata('user_withdrawablebalance',$tempwith - $amount);
    //$sourceid = $sourcedata2['id'];

/*
    $history=array(
    'accountnum'=>$sourceacct,
    'action'=>'Transfer Funds by Teller',
    'to_accountnum' => $destinationacct,
    'amount'=>$amount,
    'remarks'=>$remarks
      );
    $this->teller_model->user_history($history);*/


   $this->session->set_flashdata('success_msg', 'TRANSFER SUCCESSFUL');


echo json_encode(array("status" => TRUE));
  //$this->session->set_flashdata('success_msg', 'Success');
redirect('/tellertransfer');






  redirect('/tellertransfer');

}




}
?>
