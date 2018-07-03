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


    if(empty($amount)){
      $this->session->set_flashdata('error_msg', 'Please Fill In Empty fields');
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
        $this->session->set_flashdata('success_msg', 'Withdraw Successful! <br></br> <br> Transaction Fee : PHP '.$transactionfee." <br> Penalty Fee : ". $penaltyfee.'<br>Account Number : '. $account);
    //  echo json_encode(array("status" => TRUE));
    redirect('/withdraw');





    //  redirect('/withdraw');
  }

}
?>
