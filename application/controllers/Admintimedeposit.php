<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admintimedeposit extends CI_Controller {

public function __construct(){

        parent::__construct();

	$this->load->model('user_model');
    $this->load->database('default');
	$this->load->helper('url');


}

public function index()
{
	//$data=array();
	//$id = (int)$this->session->userdata('user_id');
	$this->load->view('admin/admintimedeposit.php');

}

public function tellerdeposit()
{
  $this->load->view('teller/tellertimedeposit.php');
}

public function loadteller()
{
  $this->load->view('teller/tellertimedeposit.php');
}

public function maketimedep()
{
	//$amtDept= (int)$this->input->post('amtDept');
	$tPlacement= (int)$this->input->post('tPlacement');
	//$acctNum= $this->input->post('numacct');
	$inptAcct= $this->input->post('inptAcct');
	$curr= $this->input->post('curr');
	$amtDept = $this->input->post('amtDept');
	$id =  0; //(int)$this->session->userdata('user_id');
	
	$data['view_user'] = $this->user_model->check_userA($inptAcct);
	if ($data['view_user']){
			$interest=0;
			$dateTdy = date("Y-m-d");
			$widthTdy=0;
						if($curr=='PHP'){
							if ($tPlacement==30){
							$widthTdy = date('Y-m-d', strtotime(' + 30 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									  $interest=0.00250;
								}
								else if ($amtDept>=50000 || $amtDept < 100000){
									$interest=0.00375;
								}
								else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
									$interest=0.00500;
								}
								else if ($amtDept>=50000 || $amtDept < 1000000){
									$interest=0.00625;
								}
								else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
									$interest=0.00750;
								}
								else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
									$interest=0.00875;
								}
								else if ($amtDept>=20000000){
									$interest=0.00875;
								}
							}
							if ($tPlacement==60){
								$widthTdy = date('Y-m-d', strtotime(' + 60 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=0.00250;
							  }
							  else if ($amtDept>=50000 || $amtDept < 100000){
								  $interest=0.00375;
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
								  $interest=0.00500;
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000){
								  $interest=0.00625;
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
								  $interest=0.00750;
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
								  $interest=0.00875;
							  }
							  else if ($amtDept>=20000000){
								  $interest=0.00875;
							  }
							}
							if ($tPlacement==90){
								$widthTdy = date('Y-m-d', strtotime(' + 90 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=0.00250;
							  }
							  else if ($amtDept>=50000 || $amtDept < 100000){
								  $interest=0.00375;
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
								  $interest=0.00500;
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000){
								  $interest=0.00625;
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
								  $interest=0.00750;
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
								  $interest=0.00875;
							  }
							  else if ($amtDept>=20000000){
								  $interest=0.00875;
							  }
							}
							if ($tPlacement==180){
								$widthTdy = date('Y-m-d', strtotime(' + 180 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=0.00500;
							  }
							  else if ($amtDept>=50000 || $amtDept < 100000){
								  $interest=0.00625;
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
								  $interest=0.00750;
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000){
								  $interest=0.00875;
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
								  $interest=.01;
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
								  $interest=.01125;
							  }
							  else if ($amtDept>=20000000){
								  $interest=.01125;
							  }
							}
							if ($tPlacement==360){
								$widthTdy = date('Y-m-d', strtotime(' + 360 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=0.00500;
							  }
							  else if ($amtDept>=50000 || $amtDept < 100000){
								  $interest=0.00625;
							  }
							  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
								  $interest=0.00750;
							  }
							  else if ($amtDept>=50000 || $amtDept < 1000000){
								  $interest=0.00875;
							  }
							  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
								  $interest=.01;
							  }
							  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
								  $interest=.01125;
							  }
							  else if ($amtDept>=20000000){
								  $interest=.01125;
							  }
							}
						}
						else if ($curr=='USD'){
							if ($tPlacement==30){
								$widthTdy = date('Y-m-d', strtotime(' + 30 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=0.00500;
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000)){
									$interest=0.00625;
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
									$interest=0.00875;
							  }
							}
							if ($tPlacement==60){
								$widthTdy = date('Y-m-d', strtotime(' + 60 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=0.00500;
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000)){
									$interest=0.00625;
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
									$interest=0.00875;
							  }
							}
							if ($tPlacement==90){
								$widthTdy = date('Y-m-d', strtotime(' + 90 days'));
								if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
									$interest=0.00625;
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000)){
									$interest=0.00750;
							  }
							  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
									$interest=0.01;
							  }
							}
							if ($tPlacement==180){
								$widthTdy = date('Y-m-d', strtotime(' + 180 days'));
								if ($amtDept>=1000 || $amtDept < 10000){
									$interest=0.00750;
							  }
							  else if ($amtDept>=10000 || $amtDept < 50000){
								  $interest=0.00875;
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000)){
									$interest=0.01;
							  }
							  else if ($amtDept>=100000 || $amtDept < 500000){
									$interest=0.01250;
							  }
							  else if ($amtDept>=500000){
									$interest=0.01375;
							  }
							}
							if ($tPlacement==360){
								$widthTdy = date('Y-m-d', strtotime(' + 360 days'));
								if ($amtDept>=1000 || $amtDept < 10000){
									$interest=0.00875;
							  }
							  else if ($amtDept>=10000 || $amtDept < 50000){
								  $interest=0.01;
							  }
							  else if (($amtDept>=50000 || $amtDept < 100000)){
									$interest=0.011250;
							  }
							  else if ($amtDept>=100000 || $amtDept < 500000){
									$interest=0.01375;
							  }
							  else if ($amtDept>=500000){
									$interest=0.01500;
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
			  'userID'=>0, //change id
			  'currency'=>$curr,
			  'status'=>0
			);
			$this->user_model->user_timeDeposit($tDeposit);
			$addT=array(
				  'user_id'=>$inptAcct,
				  'action'=>'Admin Time Deposit: Deposit',
				  'amount'=>$amtDept,
				  'remarks'=>$id.' '.$curr
				);
			$this->user_model->user_timeDepositTr($addT);
			
			
			echo json_encode(array("status" => TRUE));
			$data2['view_table'] = $this->user_model->view_timeDepositA($inptAcct);//change id
			//$data2['view_account'] = $this->user_model->get_acctnum(28); //change id
			$this->load->view('admin/admintimedeposit.php',$data2);
	}
	else{
		$this->session->set_flashdata('error_msg', 'No Account Number');
		//$data2['view_table'] = $this->user_model->view_timeDepositA($inptAcct);//change id
			//$data2['view_account'] = $this->user_model->get_acctnum(28); //change id
			//$this->load->view('admin/admintimedeposit.php',$data2);
	}


}

public function extendTD(){
	//insert and update of deposit
	//insert and update of deposit
	
	//$wDate1= $this->input->post('wDate1');
	$id =  $this->session->userdata('user_id');
	$curr = $this->input->post('currch');
	$id_stored = $this->input->post('id_stored');
	$acctnum = $this->input->post('acctnum');
	$hld_curr = $this->input->post('hld_curr');
	$chooseAcctN = $this->input->post('chooseAcctN1');
	$hld_amt = $this->input->post('hld_amt');
	$amtDept = $this->input->post('amtDep1');
	$tPlacement = $this->input->post('placement');
	$data1['view_user'] = $this->user_model->check_userA($chooseAcctN);
	if ($data1['view_user']){
	
	echo $acctnum;
		echo $chooseAcctN;
		echo ' '.$hld_amt;
		echo ' '.$id_stored;
			$data['view_user'] = $this->user_model->view_userA($chooseAcctN); //change id
		
			foreach ($data['view_user'] as $valuee) {
						$total=$valuee->balance+$amtDept;
						$this->user_model->update_userA($total,$chooseAcctN); //change id
						
						if ($amtDept<$hld_amt){
							$total=$hld_amt-$amtDept;
							if ($total>0){
								//$this->user_model->update_userA($total,$acctnum); //change id
								$this->user_model->update_timeDepositA($total,$id_stored); //change id
								
								$dateTdy = date("Y-m-d");
									$widthTdy=0;
												if($curr=='PHP'){
													if ($tPlacement==30){
													$widthTdy = date('Y-m-d', strtotime(' + 30 days'));
														if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
															  $interest=0.00250;
														}
														else if ($amtDept>=50000 || $amtDept < 100000){
															$interest=0.00375;
														}
														else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
															$interest=0.00500;
														}
														else if ($amtDept>=50000 || $amtDept < 1000000){
															$interest=0.00625;
														}
														else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
															$interest=0.00750;
														}
														else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
															$interest=0.00875;
														}
														else if ($amtDept>=20000000){
															$interest=0.00875;
														}
													}
													if ($tPlacement==60){
														$widthTdy = date('Y-m-d', strtotime(' + 60 days'));
														if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
															$interest=0.00250;
													  }
													  else if ($amtDept>=50000 || $amtDept < 100000){
														  $interest=0.00375;
													  }
													  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
														  $interest=0.00500;
													  }
													  else if ($amtDept>=50000 || $amtDept < 1000000){
														  $interest=0.00625;
													  }
													  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
														  $interest=0.00750;
													  }
													  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
														  $interest=0.00875;
													  }
													  else if ($amtDept>=20000000){
														  $interest=0.00875;
													  }
													}
													if ($tPlacement==90){
														$widthTdy = date('Y-m-d', strtotime(' + 90 days'));
														if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
															$interest=0.00250;
													  }
													  else if ($amtDept>=50000 || $amtDept < 100000){
														  $interest=0.00375;
													  }
													  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
														  $interest=0.00500;
													  }
													  else if ($amtDept>=50000 || $amtDept < 1000000){
														  $interest=0.00625;
													  }
													  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
														  $interest=0.00750;
													  }
													  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
														  $interest=0.00875;
													  }
													  else if ($amtDept>=20000000){
														  $interest=0.00875;
													  }
													}
													if ($tPlacement==180){
														$widthTdy = date('Y-m-d', strtotime(' + 180 days'));
														if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
															$interest=0.00500;
													  }
													  else if ($amtDept>=50000 || $amtDept < 100000){
														  $interest=0.00625;
													  }
													  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
														  $interest=0.00750;
													  }
													  else if ($amtDept>=50000 || $amtDept < 1000000){
														  $interest=0.00875;
													  }
													  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
														  $interest=.01;
													  }
													  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
														  $interest=.01125;
													  }
													  else if ($amtDept>=20000000){
														  $interest=.01125;
													  }
													}
													if ($tPlacement==360){
														$widthTdy = date('Y-m-d', strtotime(' + 360 days'));
														if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
															$interest=0.00500;
													  }
													  else if ($amtDept>=50000 || $amtDept < 100000){
														  $interest=0.00625;
													  }
													  else if (($amtDept>=100000 || $amtDept < 200000)||($amtDept>=200000 || $amtDept < 500000)){
														  $interest=0.00750;
													  }
													  else if ($amtDept>=50000 || $amtDept < 1000000){
														  $interest=0.00875;
													  }
													  else if (($amtDept>=1000000 || $amtDept < 3000000)||($amtDept>=3000000 || $amtDept < 5000000)){
														  $interest=.01;
													  }
													  else if (($amtDept>=5000000 || $amtDept < 10000000)||($amtDept>=10000000 || $amtDept < 20000000)){
														  $interest=.01125;
													  }
													  else if ($amtDept>=20000000){
														  $interest=.01125;
													  }
													}
												}
												else if ($curr=='USD'){
													if ($tPlacement==30){
														$widthTdy = date('Y-m-d', strtotime(' + 30 days'));
														if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
															$interest=0.00500;
													  }
													  else if (($amtDept>=50000 || $amtDept < 100000)){
															$interest=0.00625;
													  }
													  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
															$interest=0.00875;
													  }
													}
													if ($tPlacement==60){
														$widthTdy = date('Y-m-d', strtotime(' + 60 days'));
														if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
															$interest=0.00500;
													  }
													  else if (($amtDept>=50000 || $amtDept < 100000)){
															$interest=0.00625;
													  }
													  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
															$interest=0.00875;
													  }
													}
													if ($tPlacement==90){
														$widthTdy = date('Y-m-d', strtotime(' + 90 days'));
														if (($amtDept>=1000 || $amtDept < 10000)||($amtDept>=10000 || $amtDept < 50000)){
															$interest=0.00625;
													  }
													  else if (($amtDept>=50000 || $amtDept < 100000)){
															$interest=0.00750;
													  }
													  else if (($amtDept>=100000 || $amtDept < 500000)||($amtDept>=500000)){
															$interest=0.01;
													  }
													}
													if ($tPlacement==180){
														$widthTdy = date('Y-m-d', strtotime(' + 180 days'));
														if ($amtDept>=1000 || $amtDept < 10000){
															$interest=0.00750;
													  }
													  else if ($amtDept>=10000 || $amtDept < 50000){
														  $interest=0.00875;
													  }
													  else if (($amtDept>=50000 || $amtDept < 100000)){
															$interest=0.01;
													  }
													  else if ($amtDept>=100000 || $amtDept < 500000){
															$interest=0.01250;
													  }
													  else if ($amtDept>=500000){
															$interest=0.01375;
													  }
													}
													if ($tPlacement==360){
														$widthTdy = date('Y-m-d', strtotime(' + 360 days'));
														if ($amtDept>=1000 || $amtDept < 10000){
															$interest=0.00875;
													  }
													  else if ($amtDept>=10000 || $amtDept < 50000){
														  $interest=0.01;
													  }
													  else if (($amtDept>=50000 || $amtDept < 100000)){
															$interest=0.011250;
													  }
													  else if ($amtDept>=100000 || $amtDept < 500000){
															$interest=0.01375;
													  }
													  else if ($amtDept>=500000){
															$interest=0.01500;
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
			  'action'=>'Admin Time Deposit: Extend',
			  'amount'=>$amtDept,
			  'to_accountnum'=>$chooseAcctN,
			  'remarks'=>28 //change id
			);
			$this->user_model->user_timeDepositTr($addT);
			$data2['view_table'] = $this->user_model->view_timeDepositA($chooseAcctN);//change id
			//$data2['view_account'] = $this->user_model->get_acctnum(28); //change id
			$this->load->view('admin/admintimedeposit.php',$data2);
	}
	else{
		$this->session->set_flashdata('error_msg', 'No Account Number');
		$data2['view_table'] = $this->user_model->view_timeDepositA($chooseAcctN);//change id
			//$data2['view_account'] = $this->user_model->get_acctnum(28); //change id
			$this->load->view('admin/admintimedeposit.php',$data2);
	}


	
}

public function addTransaction(){
	//insert and update of deposit
	
	//$wDate1= $this->input->post('wDate1');
	$id =  $this->session->userdata('user_id');
	//$currch = $this->input->post('currch');
	$id_stored = $this->input->post('id_stored');
	$acctnum = $this->input->post('acctnum');
	$hld_curr = $this->input->post('hld_curr');
	$chooseAcctN = $this->input->post('chooseAcctN1');
	$hld_amt = $this->input->post('hld_amt');
	$amtDep1 = $this->input->post('amtDep1');
	
		echo $acctnum;
		echo $chooseAcctN;
		echo ' '.$hld_amt;
		echo ' '.$id_stored;
		$data1['view_user'] = $this->user_model->check_userA($chooseAcctN);
	if ($data1['view_user']){
			$data['view_user'] = $this->user_model->view_userA($chooseAcctN); //change id
		
			foreach ($data['view_user'] as $valuee) {
						$total=$valuee->balance+$amtDep1;
						$this->user_model->update_userA($total,$chooseAcctN); //change id
						
						if ($amtDep1<$hld_amt){
							$total=$hld_amt-$amtDep1;
							if ($total>0){
								$this->user_model->update_userA($total,$acctnum); //change id
								$this->user_model->update_timeDepositA(0,$id_stored); //change id
							}
							
						}
						else{
							$this->session->set_flashdata('error_msg', 'Amount is greater than the value');
						}
			}
			
			$addT=array(
			  'user_id'=> $acctnum,
			  'action'=>'Admin Time Deposit: Withdrawal',
			  'amount'=>$amtDep1,
			  'to_accountnum'=>$chooseAcctN,
			  'remarks'=>28 //change id
			);
			$this->user_model->user_timeDepositTr($addT);
			$data2['view_table'] = $this->user_model->view_timeDepositA($chooseAcctN);//change id
			//$data2['view_account'] = $this->user_model->get_acctnum(28); //change id
			$this->load->view('admin/admintimedeposit.php',$data2);

	}

else{
		$this->session->set_flashdata('error_msg', 'No Account Number');
		$data2['view_table'] = $this->user_model->view_timeDepositA($chooseAcctN);//change id
			//$data2['view_account'] = $this->user_model->get_acctnum(28); //change id
			$this->load->view('admin/admintimedeposit.php',$data2);
	}
}
}

?>
