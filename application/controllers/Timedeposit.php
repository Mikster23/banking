<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timedeposit extends CI_Controller {

public function __construct(){

        parent::__construct();

	$this->load->model('user_model');
    $this->load->database('default');
	$this->load->helper('url');
	$id = (int)$this->session->userdata('user_id');

}

public function index()
{
	//$data=array();
	$id = (int)$this->session->userdata('user_id');
	$data['view_table'] = $this->user_model->view_timeDeposit($id ); //change id
if(!$data){
	foreach ($data['view_table'] as $value) {
			$curr = date("Y-m-d");
			if($value->widthDate==$curr &&$value->status==0){
				$total=($value->amount*$value->interest)+$value->amount;
				$this->user_model->update_timeDeposit($id ,$total,$value->tdeptID); //change id
			}
	}
}
	$data1['view_account'] = $this->user_model->get_acctnum($id ); //change id
	$this->load->view('user/timedeposit.php',$data1);

}

public function maketimedep()
{
	//$amtDept= (int)$this->input->post('amtDept');
	$tPlacement= (int)$this->input->post('tPlacement');
	$acctNum= $this->input->post('acctNum');
	$inptAcct= $this->input->post('inptAcct');
	$curr= $this->input->post('curr');
	$amtDept = $this->input->post('amtDept');
	$id = $this->session->userdata('user_id');


	$id =  0; //(int)$this->session->userdata('user_id');


	$interest=0;
	$dateTdy = date("Y-m-d");
	$widthTdy=0;
	$data['getRate'] = $this->user_model->getRate();
	$data['getRate'] = $this->user_model->getRate();
			foreach($data['getRate']  as $grate){
				$arry[] = $grate->rates;
			}
						if($curr=='PHP'){
							if ($tPlacement==30){
								$widthTdy = date('Y-m-d', strtotime(' + 30 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[0];
								}
								else if ($amtDept>=50000 || $amtDept < 100000){
									$interest=$arry[1];
								}
								else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
									$interest=$arry[2];
								}
								else if (($amtDept>=50000 || $amtDept < 1000000)){
									$interest=$arry[3];
								}
								else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000) ){
									$interest=$arry[4];
								}
								else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
									$interest=$arry[5];
								}
								else if ($amtDept>=20000000){
									$interest=$arry[5];
								}
							}
							if ($tPlacement==60){
								$widthTdy = date('Y-m-d', strtotime(' + 60 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[6];
							  }
							  else if ($amtDept>=50000 || $amtDept < 100000){
								$interest=$arry[7];
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
								$interest=$arry[8];
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000){
								$interest=$arry[9];
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
								$interest=$arry[10];
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000) ){
								$interest=$arry[11];
							  }
							  else if ($amtDept>=20000000){
								$interest=$arry[11];
							  }
							}
							if ($tPlacement==90){
								$widthTdy = date('Y-m-d', strtotime(' + 90 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[12];
							  }
							  else if ($amtDept>=50000 || $amtDept < 100000&&$grate->day==90){
								$interest=$arry[13];
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000) ){
								$interest=$arry[14];
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000){
								$interest=$arry[15];
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000) ){
								$interest=$arry[16];
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000) ){
								$interest=$arry[17];
							  }
							  else if ($amtDept>=20000000 ){
								$$interest=$arry[17];
							  }
							}
							if ($tPlacement==180){
								$widthTdy = date('Y-m-d', strtotime(' + 180 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[18];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000) ){
								$interest=$arry[19];
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
								$interest=$arry[20];
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000 ){
								$interest=$arry[21];
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
								$interest=$arry[22];
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
								$interest=$arry[23];
							  }
							  else if ($amtDept>=20000000){
								$interest=$arry[23];
							  }
							}
							if ($tPlacement==360){
								$widthTdy = date('Y-m-d', strtotime(' + 360 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[24];
							  }
							  else if ($amtDept>=50000 || $amtDept < 100000){
								$interest=$arry[25];
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
								$interest=$arry[26];
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000){
								$interest=$arry[27];
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
								$interest=$arry[28];
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
								$interest=$arry[29];
							  }
							  else if ($amtDept>=20000000){
								$interest=$arry[29];
							  }
							}
						}
						else if ($curr =='USD'){
							if ($tPlacement==30){
								$widthTdy = date('Y-m-d', strtotime(' + 30 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[30];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000)){
								$interest=$arry[31];
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
								$interest=$arry[32];
							  }
							}
							if ($tPlacement==60){
								$widthTdy = date('Y-m-d', strtotime(' + 60 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[33];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000) ){
								$interest=$arry[34];
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
								$interest=$arry[35];
							  }
							}
							if ($tPlacement==90){
								$widthTdy = date('Y-m-d', strtotime(' + 90 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[36];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000) ){
								$interest=$arry[37];
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
								$interest=$arry[38];
							  }
							}
							if ($tPlacement==180){
								$widthTdy = date('Y-m-d', strtotime(' + 180 days'));
								if (($amtDept>=1000 || $amtDept < 10000) ){
									$interest=$arry[39];
							  }
							  else if (($amtDept>=10000 || $amtDept < 50000) ){
								$interest=$arry[41];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000)){
								$interest=$arry[42];
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000) ){
								$interest=$arry[43];
							  }
							  else if ($amtDept>=500000){
								$interest=$arry[44];
							  }
							}
							if ($tPlacement==360){
								$widthTdy = date('Y-m-d', strtotime(' + 360 days'));
								if (($amtDept>=1000 || $amtDept < 10000)){
									$interest=$arry[45];
							  }
							  else if (($amtDept>=10000 || $amtDept < 50000)){
								$interest=$arry[46];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000)){
								$interest=$arry[47];
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000)){
								$interest=$arry[48];
							  }
							  else if (($amtDept>=500000||$amtDept < 500000) ){
								$interest=$arry[49];
							  }
							}
						}




	  $tDeposit=array(
	  'acctID' => $inptAcct,
	  'placement'=>$tPlacement,
	  'amount'=>$amtDept,
	  'interest'=>$interest,
	  'intDate'=>$dateTdy,
	  'widthDate'=>$widthTdy,
	  'userID'=>$id , //change id
	  'currency'=>$curr,
	  'status'=>0
	);
	$this->user_model->user_timeDeposit($tDeposit);
	$addT=array(
		  'user_id'=>$inptAcct,
		  'action'=>'Time Deposit: Deposit',
		  'amount'=>$amtDept,
		  'remarks'=>$id.' '.$curr
		);
	$this->user_model->user_timeDepositTr($addT);


	echo json_encode(array("status" => TRUE));
	$data2['view_table'] = $this->user_model->view_timeDeposit($id );//change id
	$data2['view_account'] = $this->user_model->get_acctnum($id ); //change id
	$this->load->view('user/timedeposit.php',$data2);



}

public function extendTD(){
	//insert and update of deposit

	//$wDate1= $this->input->post('wDate1');
	$id =  $this->session->userdata('user_id');
	$currch = $this->input->post('currch');
	$id_stored = $this->input->post('id_stored');
	$acctnum = $this->input->post('acctnum');
	$hld_curr = $this->input->post('hld_curr');
	$chooseAcctN = $this->input->post('chooseAcctN');
	$hld_amt = $this->input->post('hld_amt');
	$amtDept = $this->input->post('amtDep1');

	echo $acctnum;
		echo $chooseAcctN;
		echo ' '.$hld_amt; //
		echo ' '.$id_stored;
			$data['view_user'] = $this->user_model->view_user($id ,$chooseAcctN); //change id

			foreach ($data['view_user'] as $valuee) {
						$total=$valuee->balance+$amtDept;
						$this->user_model->update_user($id ,$total,$chooseAcctN); //change id

						if ($amtDept<$hld_amt){
							$total=$hld_amt-$amtDept;
							if ($total>0){
								//$this->user_model->update_user($id ,$total,$acctnum); //change id
								$this->user_model->update_timeDeposit($id ,$total,$id_stored); //change id

								$dateTdy = date("Y-m-d");
									$widthTdy=0;
									$data['getRate'] = $this->user_model->getRate();
			foreach($data['getRate']  as $grate){
				$arry[] = $grate->rates;
			}
						if($curr=='PHP'){
							if ($tPlacement==30){
								$widthTdy = date('Y-m-d', strtotime(' + 30 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[0];
								}
								else if ($amtDept>=50000 || $amtDept < 100000){
									$interest=$arry[1];
								}
								else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
									$interest=$arry[2];
								}
								else if (($amtDept>=50000 || $amtDept < 1000000)){
									$interest=$arry[3];
								}
								else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000) ){
									$interest=$arry[4];
								}
								else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
									$interest=$arry[5];
								}
								else if ($amtDept>=20000000){
									$interest=$arry[5];
								}
							}
							if ($tPlacement==60){
								$widthTdy = date('Y-m-d', strtotime(' + 60 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[6];
							  }
							  else if ($amtDept>=50000 || $amtDept < 100000){
								$interest=$arry[7];
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
								$interest=$arry[8];
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000){
								$interest=$arry[9];
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
								$interest=$arry[10];
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000) ){
								$interest=$arry[11];
							  }
							  else if ($amtDept>=20000000){
								$interest=$arry[11];
							  }
							}
							if ($tPlacement==90){
								$widthTdy = date('Y-m-d', strtotime(' + 90 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[12];
							  }
							  else if ($amtDept>=50000 || $amtDept < 100000&&$grate->day==90){
								$interest=$arry[13];
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000) ){
								$interest=$arry[14];
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000){
								$interest=$arry[15];
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000) ){
								$interest=$arry[16];
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000) ){
								$interest=$arry[17];
							  }
							  else if ($amtDept>=20000000 ){
								$$interest=$arry[17];
							  }
							}
							if ($tPlacement==180){
								$widthTdy = date('Y-m-d', strtotime(' + 180 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[18];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000) ){
								$interest=$arry[19];
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
								$interest=$arry[20];
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000 ){
								$interest=$arry[21];
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
								$interest=$arry[22];
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
								$interest=$arry[23];
							  }
							  else if ($amtDept>=20000000){
								$interest=$arry[23];
							  }
							}
							if ($tPlacement==360){
								$widthTdy = date('Y-m-d', strtotime(' + 360 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[24];
							  }
							  else if ($amtDept>=50000 || $amtDept < 100000){
								$interest=$arry[25];
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
								$interest=$arry[26];
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000){
								$interest=$arry[27];
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
								$interest=$arry[28];
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
								$interest=$arry[29];
							  }
							  else if ($amtDept>=20000000){
								$interest=$arry[29];
							  }
							}
						}
						else if ($curr =='USD'){
							if ($tPlacement==30){
								$widthTdy = date('Y-m-d', strtotime(' + 30 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[30];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000)){
								$interest=$arry[31];
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
								$interest=$arry[32];
							  }
							}
							if ($tPlacement==60){
								$widthTdy = date('Y-m-d', strtotime(' + 60 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[33];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000) ){
								$interest=$arry[34];
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
								$interest=$arry[35];
							  }
							}
							if ($tPlacement==90){
								$widthTdy = date('Y-m-d', strtotime(' + 90 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=$arry[36];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000) ){
								$interest=$arry[37];
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
								$interest=$arry[38];
							  }
							}
							if ($tPlacement==180){
								$widthTdy = date('Y-m-d', strtotime(' + 180 days'));
								if (($amtDept>=1000 || $amtDept < 10000) ){
									$interest=$arry[39];
							  }
							  else if (($amtDept>=10000 || $amtDept < 50000) ){
								$interest=$arry[41];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000)){
								$interest=$arry[42];
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000) ){
								$interest=$arry[43];
							  }
							  else if ($amtDept>=500000){
								$interest=$arry[44];
							  }
							}
							if ($tPlacement==360){
								$widthTdy = date('Y-m-d', strtotime(' + 360 days'));
								if (($amtDept>=1000 || $amtDept < 10000)){
									$interest=$arry[45];
							  }
							  else if (($amtDept>=10000 || $amtDept < 50000)){
								$interest=$arry[46];
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000)){
								$interest=$arry[47];
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000)){
								$interest=$arry[48];
							  }
							  else if (($amtDept>=500000||$amtDept < 500000) ){
								$interest=$arry[49];
							  }
							}
						}

												$tDeposit=array(
												  'acctID' => $acctnum,
												  'placement'=>$tPlacement,
												  'amount'=>$total,
												  'interest'=>$interest,
												  'intDate'=>$dateTdy,
												  'widthDate'=>$widthTdy,
												  'userID'=>$id, //change id
												  'currency'=>$curr,
												  'status'=>0
												);
												$this->user_model->user_timeDeposit($tDeposit);

							}

						}
						else{
							$this->session->set_flashdata('error_msg', 'Amount is greater than the value');
						}
			}




			$addT=array(
			  'user_id'=> $acctnum,
			  'action'=>'Time Deposit: Extend',
			  'amount'=>$amtDept,
			  'to_accountnum'=>$chooseAcctN,
			  'remarks'=>$id  //change id
			);
			$this->user_model->user_timeDepositTr($addT);
			$data1['view_account'] = $this->user_model->get_acctnum($id ); //change id
			$this->load->view('user/timedeposit.php',$data1);


}

public function addTransaction(){
	//insert and update of deposit

	//$wDate1= $this->input->post('wDate1');
	$id =  $this->session->userdata('user_id');
	$curr = $this->input->post('currch');
	$id_stored = $this->input->post('id_stored');
	$acctnum = $this->input->post('acctnum');
	$hld_curr = $this->input->post('hld_curr');
	$chooseAcctN = $this->input->post('chooseAcctN');
	$hld_amt = $this->input->post('hld_amt');
	$amtDep1 = $this->input->post('amtDep1');

	$tPlacement= $this->input->post('placement');

		echo $acctnum;
		echo $chooseAcctN;
		echo ' '.$hld_amt;
		echo ' '.$id_stored;
			$data['view_user'] = $this->user_model->view_user($id ,$chooseAcctN); //change id
			if ($data['view_user']!=false){
				foreach ($data['view_user'] as $valuee) {
							$total=$valuee->balance+$amtDep1;
							$this->user_model->update_user($id ,$total,$chooseAcctN); //change id

							if ($amtDep1<$hld_amt){
								$total=$hld_amt-$amtDep1;
								if ($total>0){
									$this->user_model->update_user($total,$chooseAcctN); //change id
									$this->user_model->update_timeDeposit(0,$id_stored); //change id

								}
							else{
								$this->session->set_flashdata('error_msg', 'Amount is greater than the value');
							}

							}
				}

				$addT=array(
				  'user_id'=> $acctnum,
				  'action'=>'Time Deposit: Withdrawal',
				  'amount'=>$amtDep1,
				  'to_accountnum'=>$chooseAcctN,
				  'remarks'=>$id  //change id
				);
				$this->user_model->user_timeDepositTr($addT);

				$data1['view_account'] = $this->user_model->get_acctnum($id ); //change id

			}
			else{
				$this->session->set_flashdata('error_msg', 'Cannot enter');
			}
			$data1['view_account'] = $this->user_model->get_acctnum($id ); //change id
			$this->load->view('user/timedeposit.php',$data1);
			//$this->load->view('user/timedeposit.php');

	}
}
