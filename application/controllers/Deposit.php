<?php

class Deposit extends CI_Controller {

  public function __construct(){

    parent::__construct();

    $this->load->model('user_model');
    $this->load->database('default');


  }

  public function index()
  {
    /*
    $id =  (int) $this->session->userdata('user_id');
//getyour owned accounts
  $query = $this->db->query('SELECT * FROM accounts WHERE holder_id ='.$id);
$data  =   array();
$data2 = array();
foreach ($query->result_array() as $row):
            $data[] = $row['holder_id'];
            $data2[] = $row['account_name'];



endforeach;




  $query2 = $this->db->query('SELECT * FROM account_type');
  $data3 = array();
  $candepacctnum = array();
  //get account_type with the accountid you owned
  foreach ($query2->result_array() as $row):
              $data3[] = $row['id'];

              for($i = 0 ; $i<sizeof($data2) ; $i++){
                  if((int)$data2[$i] == (int)$row['id'])

                  {
                      //check if your owned account can deposit/withdraw through atm
                      if((int)$row['depatm'] ==1){

                        $candepacctnum[] =$data2[$i];

                      }

                  }

                echo $data2[$i];
              }



  endforeach;

//print_r($candepacctnum);


$query3 = $this->db->query('SELECT * FROM accounts where holder_id='.$id);
$data4 = array();

//get aaccountnumber
//$datafinal["acctnumbers"]= array();
//print_r($candepacctnum);
foreach ($query3->result_array() as $row):
  echo '<br>'.$row['account_name'];
  $temp = (int)$row['account_name'];
          for($i = 0 ; $i<sizeof($candepacctnum) ; $i++){

               if($temp == $candepacctnum[$i]){

                //get all account numbers of the account type that can deposit/withdraw
                echo "true";
          //       echo $row['account_name'] . "candep : " .$candepacctnum[$i];
              //   $datafinal[$i]=  (int)$row['accountnum'];


          /*     $options = array(

              'accountnum' => (int)$row['accountnum'],
            );
            $datafinal['acctnumbers'] = $options;*/
/*
             $datafinal['acctnumbers'] = array($row['accountnum']);


               }

          }



endforeach;

print_r($datafinal['acctnumbers'][0]);

*/


 $this->load->view('user/depositview.php');
  }

  public function tellerdeposit()
  {
    $this->load->view('teller/depositview.php');
  }

  public function loadteller()
  {
    $this->load->view('teller/deposittellerview.php');
  }

  public function makedeposit()
  {




    $account = (int) $this->input->post('user_owned');
$databal=$this->user_model->getbalance_acctnum($account);


    $dataacctidtype = $this->user_model->getownedacctid($account);


    $accounttype = (int) $dataacctidtype['account_name'];
        $datafee = $this->user_model->getatmfee($accounttype);

        $transactionfee = (int) $datafee['atm_fee'];
        $amounttest= (int)$this->input->post('user_amount');
  $amount= (int)$this->input->post('user_amount') - $transactionfee;
  $amounthistory = (int)$this->input->post('user_amount');
$bal = (int) $databal['balance'];
    $id =  $this->session->userdata('user_id');
    $pin = $this->input->post('user_pin');
    $pintrue =   $this->session->userdata('user_pin');

 $balbefore = $bal;
 $balafter = $bal + $amount;
    if($pin != $pintrue){
      echo $pin . "fake == true" . $pintrue;
      $this->session->set_flashdata('error_msg', 'Wrong Pin Number');
      redirect('/deposit');
    }

    if($amounttest < 0){
      $this->session->set_flashdata('error_msg', 'No Negative Values');
      redirect('/deposit');

    }
    if(empty($amount)){
      $this->session->set_flashdata('error_msg', 'Please Fill In Empty fields');
      redirect('/deposit');


    }

      $history=array(
        'user_id'=>(int)$this->session->userdata('user_id'),
        'action'=>'Deposit through ATM',
        'amount'=>$amounthistory,
        'to_accountnum' =>$account,
        'transaction_fee'=>$transactionfee,
        'balbefore' => $balbefore,
        'balafter' => $balafter,
        'remarks'=>''
      );
      $this->user_model->user_history($history);



      $user_deposit=array(

        //  'pin'=>$this->input->post('user_pin'),
        'balance' => $bal + $amount,


      );


      $this->user_model->user_deposit($id,$account,$user_deposit);


      $this->session->set_flashdata('success_msg', 'Deposit Successful! <br> Transaction Fee : PHP '.$transactionfee);
      echo json_encode(array("status" => TRUE));
      redirect('/deposit');

  }



  public function tellermakedeposit()
  {



    $amount= (int)$this->input->post('user_amount');
    $id = (int) $this->input ->post('user_accountnum');


    $data2=$this->user_model->checkacctnum($id);
    $idtrue = (int) $data2['accountnum'];

    $bal =   $this->session->userdata('user_balance');

    $pin = $this->input->post('user_pin');
    $pintrue =   $this->session->userdata('user_pin');

    if(!$data2){
      echo $id . "fake == true" . $idtrue;
      $this->session->set_flashdata('error_msg', 'Account Number does not match');
      redirect('/deposit');
    }
    else{/*
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
*/}

}


}
?>
