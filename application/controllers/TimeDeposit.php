<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeDeposit extends CI_Controller {

public function __construct(){

        parent::__construct();

	$this->load->model('user_model');
    $this->load->database('default');
	$this->load->helper('url');


}

public function index()
{
	//$data=array();
	$data['view_table'] = $this->user_model->view_timeDeposit();
	$this->load->view('user/timedeposit.php',$data);
	foreach ($data['view_table'] as $value) {
			$curr = date("Y-m-d");
			if($value->widthDate==$curr){
				$this->user_model->update_timeDeposit($id,$value);
			}
	}
	//$this->load->view('user/timedeposit.php');

}

public function tellerdeposit()
{
  $this->load->view('teller/timedeposit.php');
}

public function loadteller()
{
  $this->load->view('teller/timedeptttellerview.php');
}

public function maketimedep()
{
	$amount= (int)$this->input->post('amtDept');
	$tPlacement= (int)$this->input->post('tPlacement');
	$id =  (int)$this->session->userdata('user_id');
	$interest=0;
	$dateTdy = date("Y-m-d");
	$widthTdy=0;
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



	  $tDeposit=array(
    'acctID' => $id,
	  'placement'=>$tPlacement,
	  'amount'=>$amount,
	  'interest'=>$interest,
	  'intDate'=>$dateTdy,
	  'widthDate'=>$widthTdy,
	);
	$this->user_model->user_timeDeposit($tDeposit);

	echo json_encode(array("status" => TRUE));
	redirect('/timedeposit');


}

public function addTransaction(){
	//insert and update of deposit
	$amtDep1 = $this->input->post('amtDep1');
	$wDate1= $this->input->post('wDate1');
$id =  $this->session->userdata('user_id');

	$addT=array(
	  'accountnum'=>(int)$this->session->userdata('user_acctnum'),
	  'action'=>'Time Deposit',
	  'amount'=>$amtDep1,
	  'remarks'=>$wDate1.$id
	);
	$this->user_model->user_timeDepositTr($addT);
	$data1 = array(
    'amount'	=>  $amtDep1
		);
	$this->user_model->update_timeDeposit($id,$data1);

}
}

?>
