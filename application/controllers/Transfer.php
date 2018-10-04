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
public function loadfund()
{
  $this->load->view('user/transferhistory.php');
}


public function maketransfer()
{


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



  $amount= (int)$this->input->post('user_amount');

  $toacct = (int) $this->input->post('user_acctnum');
  $rembal = 0;
    $wb = (int) $this->session->userdata('user_withdrawablebalance');

    if($bal > $maintainbal){

      $penaltyfee = 0;

    }
    $balafter = $bal - ($amountcheck + $transactionfee +$penaltyfee);

    if($pin != $pintrue){
      echo $pin . "fake == true" . $pintrue;
      $this->session->set_flashdata('error_msg', 'Wrong Pin Number');
      redirect('/transfer');
    }


    if(empty($amount ) || empty($toacct)){
      $this->session->set_flashdata('error_msg', 'Please Fill In Empty fields');
      redirect('transfer');


    }
    if($amountcheck <0 ){

      $this->session->set_flashdata('error_msg', 'No Negative Input!');
      redirect('transfer');
    }


  $acct=array(

  'accountnum'=>$toacct

    );

    $data=$this->user_model->checkexist_acctnum($acct['accountnum']);
    $data2 = $this->user_model->getbalance_acctnum($acct['accountnum']);
    $toid = (int) $data2['holder_id'];
if(!$data2){

  $this->session->set_flashdata('error_msg', 'Please Fill In Empty fields');
  redirect('transfer');

}



    $tobalance =  $data2['balance'];

  //  $this->session->set_userdata('user_id',$data['id']);







    $baltransfer = $tobalance +  $amount;
    $toacct = (int)$this->input->post('user_acctnum');

    $pin = $this->input->post('user_pin');
    $remarks = $this->input->post('user_remarks');
    $transfer=array(

  //  'pin'=>$this->input->post('user_pin'),
    'balance' => $baltransfer



      );


    $trans_check=$this->user_model->transfer($toacct,$transfer);

    $user_withdraw=array(

      //  'pin'=>$this->input->post('user_pin'),
      'balance' => $balafter,


    );


    $id =  $this->session->userdata('user_id');

if($bal<$maintainbal){

    $this->session->set_flashdata('success_msg', 'Transfer Successful! <br> Penalty has been issued Account Below Maintaining Balance of : PHP '.$maintainbal.'<br> Penalty Fee : PHP '.$penaltyfee);
}
else{

    $this->session->set_flashdata('success_msg', 'Transfer Successful! Transaction Fee : PHP '.$transactionfee);
}



    $withdraw_check=$this->user_model->user_withdraw($id,$account,$user_withdraw);


    $history=array(
    'user_id'=>(int) $id,
    'action'=>'Transfer Fund',
    'to_accountnum' => $toacct,
    'receiver_id' => $toid,
    'amount'=>$amount,
    'remarks'=>$remarks
      );
    $this->user_model->user_history($history);



echo json_encode(array("status" => TRUE));
redirect('/transfer');



}
}
?>
