<?php

class User extends CI_Controller {

public function __construct(){

        parent::__construct();

  	$this->load->model('user_model');
      $this->load->database('default');


}

function login_user(){
  $user_login=array(

  'email'=>$this->input->post('user_email'),
  'password'=>md5($this->input->post('user_password'))

    );

    $data=$this->user_model->login_user($user_login['email'],$user_login['password']);
      if($data)
      {
        $this->session->set_userdata('user_id',$data['id']);
        $this->session->set_userdata('user_email',$data['email']);
        $this->session->set_userdata('user_firstname',$data['firstname']);
        $this->session->set_userdata('user_lastname',$data['lastname']);
        $this->session->set_userdata('user_age',$data['age']);
        $this->session->set_userdata('user_mobile',$data['mobile']);
        $this->session->set_userdata('user_acctnum',$data['accountnum']);
        $this->session->set_userdata('user_pin',$data['pin']);
        $this->session->set_userdata('user_balance',$data['balance']);
        $type = (int) $data['user_type'];
        if($type ==1){
          $this->load->view('user/index.php');
          $this->load->view('partials/user_sidebar.php');

        }
        else{
            $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
            redirect('/');
        }
      }


      else{
        $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
      $this->load->view("index.php");

      }
}
function loadtransaction(){

  $this->load->view('user/transactionview.php');
}
function user_profile(){

$this->load->view('user_profile.php');

}

public function index()
{
  $this->load->view('user/register.php');
}
public function loadlogin(){
$this->load->view('index.php');

}
public function transhistory(){
$id =  (int)$this->session->userdata('user_acctnum');
//echo $id;
$user_trans=array(

'accountnum'=>$id


  );
  $data = array();
  $data2= $this->user_model->get_history($user_trans['accountnum']);
  /*$data2 = array(
        'accountnum' => $data2[0],
        'action' => $data2[1],
        'amount' => $data2[2],
        'created_at' => $data2[3]
    );*/

    $data = array();
         foreach($data2 as $row)
         {
              $sub_array = array();
          if($row->accountnum == $id){
              $sub_array[] = $id;
              $sub_array[] = $row->action;
              $sub_array[] = $row->amount;
              $sub_array[] = $row->created_at;
              $data[] = $sub_array; }
         }
         $output = array(

                       "data"                    =>     $data
                  );
    //print_r($data2);

 echo json_encode($output);
          //   print_r($output);
//print_r($data);
  //  echo json_encode($this->user->with('id')->get($id));

  //  $this->load->view('user/transactionview.php', $data);
}


public function transferhistory(){
$id =  (int)$this->session->userdata('user_acctnum');
//echo $id;
$user_trans=array(

'accountnum'=>$id


  );
  $data = array();
  $data2= $this->user_model->get_transferhistory($user_trans['accountnum']);
  /*$data2 = array(
        'accountnum' => $data2[0],
        'action' => $data2[1],
        'amount' => $data2[2],
        'created_at' => $data2[3]
    );*/


    $data = array();
  //  $actions = 'Transfer Funds';
         foreach($data2 as $row)
         {
              $sub_array = array();


//  $temp = implode("",$row->action);;

if($row->to_accountnum === NULL){


}
  else  if($row->accountnum == $id || $row->to_accountnum == $id)
     {
        $sub_array[] = $id;
        $sub_array[] = $row->action;
        $sub_array[] = $row->amount;
        $sub_array[] = $row->remarks;
        $sub_array[] = $row->to_accountnum;
        $sub_array[] = $row->created_at;
        $data[] = $sub_array;
      }


       }
         $output = array(

                       "data"                    =>     $data
                  );
    //print_r($data2);

 echo json_encode($output);
          //   print_r($output);
//print_r($data);
  //  echo json_encode($this->user->with('id')->get($id));

  //  $this->load->view('user/transactionview.php', $data);
}
public function register_user(){
    $pin = mt_rand(1000, 9999);
    $acctnum = mt_rand(100000000, 999999999);
      $user=array(
      'firstname'=>$this->input->post('user_firstname'),
      'lastname'=>$this->input->post('user_lastname'),
      'address'=>$this->input->post('user_address'),
      'email'=>$this->input->post('user_email'),
      'password'=>md5($this->input->post('user_password')),
      'birthday'=>$this->input->post('user_birthday'),
      'age'=>$this->input->post('user_age'),
      'mobile'=>$this->input->post('user_mobile'),
      'pin' => $pin,
      'accountnum' => $acctnum
        );
        print_r($user);

$email_check=$this->user_model->email_check($user['email']);

if($email_check){
  $this->user_model->register_user($user);
  $this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
  redirect('/user/loadlogin');

}
else{

  $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
  redirect('user');


}

}




}
?>
