<?php

class Teller extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('teller_model');
      $this->load->database('default');


}
function loaddash(){
  $id =  (int)$this->session->userdata('user_id');

  $data['usertrans'] = $this->teller_model->get_history($id);
  $this->load->view('teller/dashboard.php',$data);
}
function loadmanage(){
$this->load->view('teller/manageview.php');

}
function loadtransaction(){
  $id =  (int)$this->session->userdata('user_id');

  $data['usertrans'] = $this->teller_model->get_history($id);
  $this->load->view('teller/tellertransactionview.php',$data);

}

}
?>
