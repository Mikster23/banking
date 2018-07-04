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




    $account = (int) $this->input->post('user_owned');
    $databal=$this->user_model->getbalance_acctnum($account);


    $dataacctidtype = $this->user_model->getownedacctid($account);


    $accounttype = (int) $dataacctidtype['account_name'];

    $datafee = $this->user_model->getatmfee($accounttype);


    $transactionfee = (int) $datafee['atm_fee'];
    $minwithdraw = (int) $datafee['minwith'];
    $maintainbal = (int) $datafee['minbalance'];
    $amount= (int)$this->input->post('user_amount') - $transactionfee;
$amounttest= (int)$this->input->post('user_amount');
    $amountcheck = (int)$this->input->post('user_amount');
    $amounthistory = (int)$this->input->post('user_amount');
    $bal = (int) $databal['balance'];

    $lastupdated = $dataacctidtype['created_at'];

if($amounttest < $minwithdraw){

  $this->session->set_flashdata('error_msg', 'Below Minimum Withdrawable Amount! Minimum : PHP '.$minwithdraw);
  redirect('/withdraw');
}
    $date2 = new DateTime($lastupdated);
    $timezone = date_default_timezone_get();
    date_default_timezone_set('Asia/Singapore');
    $date = date('m/d/Y h:i:s a', time());
    $date3 = new DateTime($date);

    $diff=date_diff($date2,$date3);


    $diffdate =  $diff->format("%a");

$monthsdelayed = floor($diffdate/30);
    //$balfinal = $bal - $amount;
    $id =  (int)$this->session->userdata('user_id');
    $pin = $this->input->post('user_pin');
    $pintrue =   $this->session->userdata('user_pin');
    $balbefore = $bal;
    $penaltyfee = (int)$datafee['penalty'];

/*$penaltyfee = 0;
   if($bal < $maintainbal && $monthsdelayed >= 1){
    $penaltyfee = (int)$datafee['penalty']*$monthsdelayed;
}*/

    if($bal > $maintainbal){

      $penaltyfee = 0;

    }
    $balafter = $bal - ($amountcheck + $transactionfee +$penaltyfee);

    if($pin != $pintrue){
      echo $pin . "fake == true" . $pintrue;
      $this->session->set_flashdata('error_msg', 'Wrong Pin Number');
      redirect('/withdraw');
    }

    if($balafter <0){


      $this->session->set_flashdata('error_msg', 'Insufficient Balance');
      redirect('/withdraw');
    }


    if(empty((int)$amount)){
      $this->session->set_flashdata('error_msg', 'Please Fill In Empty fields');
      redirect('withdraw');


    }
    if($amounttest <0 ){

      $this->session->set_flashdata('error_msg', 'No Negative Input!');
      redirect('withdraw');
    }



    $history=array(
      'user_id'=>(int)$this->session->userdata('user_id'),
      'action'=>'Withdraw through ATM',
      'amount'=>$amounthistory,
      'to_accountnum' =>$account,
      'transaction_fee'=>$transactionfee,
      'balbefore' => $balbefore,
      'balafter' => $balafter,
      'penalty' => $penaltyfee,
      'remarks'=>''
    );
    $this->user_model->user_history($history);




    //$this->session->set_userdata('user_withdrawablebalance',$tempbal-$data2['minbalance']);

    //$wb = (int) $this->session->userdata('user_withdrawablebalance');


    $user_withdraw=array(

      //  'pin'=>$this->input->post('user_pin'),
      'balance' => $balafter,


    );

    $id =  $this->session->userdata('user_id');





    $withdraw_check=$this->user_model->user_withdraw($id,$account,$user_withdraw);


        $this->session->set_flashdata('success_msg', 'Withdraw Successful! <br></br> <br> Transaction Fee : PHP '.$transactionfee." <br> Penalty Fee : ". $penaltyfee.'<br>Account Number : '. $monthsdelayed);
    //  echo json_encode(array("status" => TRUE));
    redirect('/withdraw');





    //  redirect('/withdraw');
  }

}
?>
