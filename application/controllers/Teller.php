<?php

class Teller extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('teller_model');
      $this->load->database('default');


}
function loaddash(){

  $this->load->view('teller/dashboard.php');

}
function loadmanage(){
$this->load->view('teller/manageview.php');

}
function loadtransaction(){
  $arr['person'] = $this->teller_model->get_all_human();
$this->load->view('teller/tellertransactionview.php',$arr);

}

}
?>
