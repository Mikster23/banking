<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

//This is the Controller for codeigniter crud using ajax application.
class Manage extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	 public function __construct()
	 	{
	 		parent::__construct();
			$this->load->helper('url');
	 		$this->load->model('manage_model');
	 	}


	public function index()
	{

    /*
    $sourcedata2 = $this->teller_model->getbalance_acctnum($sacct['accountnum']);
    $destinationdata2 = $this->teller_model->getbalance_acctnum($dacct['accountnum']);
    $sourcebalance = (int) $sourcedata2['balance'];
    $destinationbalance = (int) $destinationdata2['balance']; */
 $arr['user_acctname'] = $this->manage_model->getacctname();
		$data['person']=$this->manage_model->get_all_books();
    //$data2['account_type'] = $this->manage_model->getacct();
   //$this->load->view('teller/manageview.php',$data2);
   $arr['account_type'] = $this->manage_model->getacct();
   $arr['account_name'] = $this->manage_model->getacctname();
   $arr['user_type'] = $this->manage_model->getuser();
   $arr['person'] = $this->manage_model->get_all_books();
		$this->load->view('teller/manageview.php',$arr);
	}
	public function manage_add()
		{

          $pin = mt_rand(1000, 9999);
          $acctnum = mt_rand(100000000, 999999999);
			$data = array(
					'firstname' => $this->input->post('user_firstname'),
					'lastname' => $this->input->post('user_lastname'),
					'address' => $this->input->post('user_address'),
					'email' => $this->input->post('user_email'),
          'password' => md5($this->input->post('user_password')),
          'age' => $this->input->post('user_age'),
          'mobile' => $this->input->post('user_mobile'),
          'balance' => $this->input->post('user_balance'),
          'account_type' => $this->input->post('user_accttype'),
          'pin' => $pin,
          'accountnum' => $acctnum,
          'user_type' => 1
				);
			$insert = $this->manage_model->human_add($data);
			echo json_encode(array("status" => TRUE));
		}
		public function ajax_edit($id)
		{
			$data = $this->manage_model->get_by_id($id);
			//echo $id;
			echo json_encode($data);
		}
		public function view_user(){

			$id = $this->uri->segment(3);

			if (empty($id))
			{
				show_404();
			}

			$data['user_acctname'] = $this->manage_model->getacctnamemanage();
			$data['myacct']= $this->manage_model->getownedacct($id);
			$data['user'] = $this->manage_model->get_news($id);
			$this->load->view('teller/userview.php',$data);

		}

		public function manage_update()
	{
		$data = array(
				'firstname' => $this->input->post('user_firstname'),
				'lastname' => $this->input->post('user_lastname'),
				'address' => $this->input->post('user_address'),
				'email' => $this->input->post('user_email'),
				'password' => $this->input->post('user_password'),
				'birthday' => $this->input->post('user_birthday'),
				'age' => $this->input->post('user_age'),
				'mobile' => $this->input->post('user_mobile'),
				'account_type' => $this->input->post('user_accttype')
			);
			$user_accountnum=$this->input->post('user_accountnum');
		$this->manage_model->human_update($user_accountnum, $data);
		echo json_encode(array("status" => TRUE));
	}

	public function manage_delete($id)
	{
		$this->manage_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}



}
