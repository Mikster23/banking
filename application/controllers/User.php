<?php

class User extends CI_Controller {

  public function __construct(){

    parent::__construct();

    $this->load->model('user_model');
    $this->load->database('default');


  }



  function loadtellerchangepass(){

    $this->load->view('teller/changepassview.php');
  }


    function loadadminchangepass(){

      $this->load->view('admin/changepassview.php');
    }

function loadchangepass(){

  $this->load->view('user/changepassview.php');
}
  function login_user(){


    $user_login=array(

      'email'=>$this->input->post('user_email'),
      'password'=> $this->input->post('user_password')

    );
    $min=array(

      'id'=>(int)$this->session->userdata('user_accttype')


    );

  //  $data2=$this->user_model->checkmindeposit($min['id']);

    $data=$this->user_model->login_user($user_login['email'],$user_login['password']);
    if((int)$data['status']==0){
      $this->session->set_flashdata('error_msg', "Account is not Yet Approved please wait. or wrong credentials");
      redirect("/");


    }
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
          $this->session->set_userdata('user_password',$data['password']);
//      $this->session->set_userdata('user_withdrawablebalance',$data['balance']  - $data2['minbalance']);

      $this->session->set_userdata('user_accttype',$data['account_type']);





      $mindep = $data2['minbalance'];
      $curbal =  (int)$this->session->userdata('user_balance');

      if($curbal < $mindep){
        echo $curbal;
        $this->session->set_flashdata('error_msg', "Your Current Balance : PHP ". $data['balance']."<br> Your Account is Below the Minimum Balance : PHP ". $mindep. " Go to the nearest ATM or Bank to Deposit");
        //  redirect('/');
      }
      $this->session->set_userdata('user_acctname',$data2['name']);
      //  $this->session->set_userdata('user_balance',$data['balance'] - $data2['minbalance']);
    //  $this->session->set_userdata('user_totalbalance',$data['balance'] - $data2['minbalance']);
      $type = (int) $data['user_type'];

      if($type ==1){
        /*  $acct=  (int)$this->session->userdata('user_acctnum');
        $user_chect=array(

        'name' => $acct


      );

      $data2=$this->user_model->login_user($user_check['email'],$user_login['password']);
      if($data2)*/
      redirect('user/loaddash');
      $this->load->view('partials/user_sidebar.php');

      $this->load->view('partials/user_sidebar.php');

    }
    else if($type ==2){

      redirect('teller/loaddash');
      $this->load->view('partials/teller_sidebar.php');

      $this->load->view('partials/teller_sidebar.php');


    }
    else if($type ==3){

      redirect('Cruduser/loaddash');
      $this->load->view('partials/admin_sidebar.php');

      $this->load->view('partials/admin_sidebar.php');


    }
    else{
      $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
      redirect('/');
    }

  }
  else{
    $this->session->set_flashdata('error_msg', "error occured");
    $this->load->view("index.php");

  }

}
function loadtransaction(){
  $id =  (int)$this->session->userdata('user_id');

  $data['usertrans'] = $this->user_model->get_history($id);
  $this->load->view('user/transactionview.php',$data);
}
function loadmyaccount(){
    $id =  (int)$this->session->userdata('user_id');
  $data['user_acctname'] = $this->user_model->getacctname();
  $data['myacct']= $this->user_model->getownedacct($id);
  $data['user'] = $this->user_model->get_news($id);
  $this->load->view('user/myaccountview.php',$data);
}
function loaddash(){
  $id =  (int)$this->session->userdata('user_id');
  $data['usertrans'] = $this->user_model->get_history($id);
  $this->load->view('user/dashboard.php',$data);
}
function user_profile(){

  $this->load->view('user_profile.php');

}

public function index()
{


  $data['account_type'] = $this->user_model->getacct();
  $this->load->view('user/register.php',$data);
  //print_r($data);
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
  if($row->accountnum == $id ){
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
  //  else  if($row->accountnum == $id || $row->to_accountnum == $id)
  else
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
public function changepass(){
$id =  (int)$this->session->userdata('user_id');
$data = $this->user_model->getoldpass($id);

//$oldpass = $this->input->post('user_oldpass');
$oldpass = $data['password'];
  $oldpass2 = $this->input->post('user_oldpass');
  echo $oldpass;
  echo $oldpass2;
  if($oldpass != $oldpass2){


    $this->session->set_flashdata('error_msg', 'Old Password Did not match');
    redirect('user/loadchangepass');

  }
  else{
  $newpass = $this->input->post('user_newpass');
    $this->session->set_userdata('user_id',$data['id']);
  $this->user_model->changepassword($id,$newpass);
      $this->session->set_flashdata('success_msg', 'Password change successfully');
redirect('user/loadchangepass');
}
}

public function changepassteller(){
$id =  (int)$this->session->userdata('user_id');
$data = $this->user_model->getoldpass($id);

//$oldpass = $this->input->post('user_oldpass');
$oldpass = $data['password'];
  $oldpass2 = $this->input->post('user_oldpass');
  echo $oldpass;
  echo $oldpass2;
  if($oldpass != $oldpass2){


    $this->session->set_flashdata('error_msg', 'Old Password Did not match');
    redirect('user/loadtellerchangepass');

  }
  else{
  $newpass = $this->input->post('user_newpass');
    $this->session->set_userdata('user_id',$data['id']);
  $this->user_model->changepassword($id,$newpass);
      $this->session->set_flashdata('success_msg', 'Password change successfully');
redirect('user/loadtellerchangepass');
}
}


public function changepassadmin(){
$id =  (int)$this->session->userdata('user_id');
$data = $this->user_model->getoldpass($id);

//$oldpass = $this->input->post('user_oldpass');
$oldpass = $data['password'];
  $oldpass2 = $this->input->post('user_oldpass');
  echo $oldpass;
  echo $oldpass2;
  if($oldpass != $oldpass2){


    $this->session->set_flashdata('error_msg', 'Old Password Did not match');
    redirect('user/loadadminchangepass');

  }
  else{
  $newpass = $this->input->post('user_newpass');
    $this->session->set_userdata('user_id',$data['id']);
  $this->user_model->changepassword($id,$newpass);
      $this->session->set_flashdata('success_msg', 'Password change successfully');
redirect('user/loadadminchangepass');
}
}
public function getmindep(){
  // POST data

  $postData = $this->input->post();

  // load model
  $this->load->model('user_model');

  // get data
  $data = $this->user_model->getacct($postData);
  echo json_encode($data);
}

public function register_user(){

  $pin = mt_rand(1000, 9999);
  $acctnum = mt_rand(100000000, 999999999);




  $user=array(
    'firstname'=>$this->input->post('user_firstname'),
    'lastname'=>$this->input->post('user_lastname'),
    'address'=>$this->input->post('user_address'),
    'email'=>$this->input->post('user_email'),
    'password'=>$this->input->post('user_password'),
    'birthday'=>$this->input->post('user_birthday'),
    'age'=>$this->input->post('user_age'),
    'mobile'=>$this->input->post('user_mobile'),
    'account_type' => $this->input->post('user_accttype'),
    'pin' => $pin,
    'accountnum' => $acctnum
  );


//  print_r($user);

  //echo "latest iD ". $latestid;
//  print_r($addacct);

  $email_check=$this->user_model->email_check($user['email']);

  if($email_check){

    $this->user_model->register_user($user);

    $maxid = $this->user_model->getlatest_id();


    $latestid = $maxid['id'];
    $addacct=array(
      'holder_id'=>(int)$latestid,
      'account_name' => $this->input->post('user_accttype'),
      'accountnum' => $acctnum
    );

    $this->load->library('form_validation');
 // field name, error message, validation rules
 $config = array(
     array(
         'field' => 'user_firstname',
         'label' => 'First Name',
         'rules' => 'required|regex_match[/^[a-zA-Z ]+$/]',
     ),
     array(
         'field' => 'user_lastname',
         'label' => 'Last Name',
         'rules' => 'required|regex_match[/^[a-zA-Z ]+$/]',
     ),

     array(
         'field' => 'user_mobile',
         'label' => 'Contact Number',
         'rules' => 'required|exact_length[11]|numeric',
     ),
     array(
         'field' => 'user_password',
         'label' => 'Password',
         'rules' => 'required|min_length[8]|max_length[32]',
     ),

 );

 $this->form_validation->set_rules($config);
 $this->form_validation->set_error_delimiters('','<br>');
 if($this->form_validation->run() == FALSE)
 {
  $this->session->set_flashdata('error_msg', validation_errors());
  redirect('user');
 }
 else
 {
   $this->user_model->register_acct($addacct);
   $this->session->set_flashdata('success_msg', 'Registered successfully. Please Wait for The Confirmation of an Administrator.');
   redirect('/user/loadlogin');
 }



  }
  else{

    $this->session->set_flashdata('error_msg', 'Email Already Exist.');
    redirect('user');


  }

}

public function enrollacct()
{
  $pin = (int)$this->input->post('user_pin');
  $tpin = (int)$this->session->userdata('user_pin');

  if($pin != $tpin){
    $this->session->set_flashdata('error_msg', 'Wrong User Pin');
    redirect('user/loadenroll');

  }
  else{


  $id =  (int)$this->session->userdata('user_id');
  $acctid = (int)$this->input->post('user_accttype');

  $checkexist = $this->user_model->checkhave_accttype($acctid,$id);

  if($checkexist){
    $this->session->set_flashdata('error_msg', 'You already have that account type!');
    redirect('user/loadenroll');


  }
  $check = (int) $checkexist['account_name'];
    $checkexist =
    $acctnum = mt_rand(100000000, 999999999);
    $latestid = (int)$this->session->userdata('user_id');
    $addacct=array(
      'holder_id'=>(int)$latestid,
      'account_name' => $this->input->post('user_accttype'),
      'accountnum' => $acctnum
    );
    $this->session->set_flashdata('success_msg', 'Enrollment Success Please Wait for the Confirmation of The Administrator');
    $this->user_model->register_acct($addacct);
    redirect('user/loadenroll');
  }



}
public function loadenroll(){
  $this->load->helper('form');
  $data['account_type'] = $this->user_model->getacct();
  $data['acctype'] = $this->user_model->getacct();
  $this->load->view('user/enrollacctview',$data);


}




}
?>
