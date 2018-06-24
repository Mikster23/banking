<?php

class Teller extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('user_model');
      $this->load->database('default');


}
function loaddash(){

  $this->load->view('teller/dashboard.php');
}

}
?>
