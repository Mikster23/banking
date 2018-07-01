<?php
class Account extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->helper('url_helper');
        $this->load->database('default');

    }
  public function accept(){
  $id = $this->uri->segment(3);




  $status = 1;

    $data = $this->crud_model->gethuman($id);
      $email = $data['email'];

      $accept=array(

      'status' => $status
        );

        if($this->crud_model->accept($id)){

          $this->session->set_flashdata('success_msg', "ACCOUNT SUCCESSFULLY ACTIVATED.");


        }
          $this->crud_model->acceptaccount($id);
    $config = Array(
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://smtp.googlemail.com',
    'smtp_port' => 465,
    'smtp_user' => 'devfeutechbanking@gmail.com',
    'smtp_pass' => '123Qwe1!',
    'mailtype'  => 'html',
    'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");

  //$this->load->library('email',$config);
$this->email->from('devfeutechbanking@gmail.com', 'Admin');
$this->email->to($email);
$this->email->subject('Account Activation');
$this->email->message('Hello your account has been successfully activated you may log in to your account now https://feutech-banking-system.herokuapp.com');
$result = $this->email->send();
echo $result;
//redirect('accept');
    redirect("account");


  }

  public function acceptenroll(){
    $id = (int) $this->uri->segment(3);
  //  $idr = (int) $this->uri->segment(4);

    $dataaccounts = $this->crud_model->getholderid($id);
    if($dataaccounts){

      echo 'success';
    }
    $holder = (int)  $dataaccounts['holder_id'];

    $datauser = $this->crud_model->getemail($holder);

    $recepient = $datauser['email'];

    //echo 'email'.$recepient."-----";


//echo $idr;

    $status = 1;

      //$data = $this->crud_model->gethuman($id);
        //$email = $data['email'];

      $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'devfeutechbanking@gmail.com',
      'smtp_pass' => '123Qwe1!',
      'mailtype'  => 'html',
      'charset'   => 'iso-8859-1'
    );
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");

    //$this->load->library('email',$config);
    $this->email->from('devfeutechbanking@gmail.com', 'Admin');
    $this->email->to($recepient);
    $this->email->subject('Account Enrollment');
    $this->email->message('Hello Enrollment For Additional  account has been  accepted you may now use your additional account  https://feutech-banking-system.herokuapp.com ');
    $result = $this->email->send();
    echo 'email'.$result;
    //redirect('accept');

    $accept=array(

    'status' => $status
      );


      if(  $this->crud_model->acceptaccount($id)){
        $this->session->set_flashdata('success_msg', "ACCOUNT SUCCESSFULLY ACTIVATED.");
     redirect("account/loadenroll");

      }


  }
  public function deactivate(){
    $id = (int) $this->uri->segment(3);
  //  $idr = (int) $this->uri->segment(4);

    $dataaccounts = $this->crud_model->getholderid($id);
    if($dataaccounts){

      echo 'success';
    }
    $holder = (int)  $dataaccounts['holder_id'];

    $datauser = $this->crud_model->getemail($holder);

    $recepient = $datauser['email'];

    //echo 'email'.$recepient."-----";


//echo $idr;

    $status = 1;

      //$data = $this->crud_model->gethuman($id);
        //$email = $data['email'];

      $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'devfeutechbanking@gmail.com',
      'smtp_pass' => '123Qwe1!',
      'mailtype'  => 'html',
      'charset'   => 'iso-8859-1'
    );
    $this->load->library('email', $config);
    $this->email->set_newline("\r\n");

    //$this->load->library('email',$config);
    $this->email->from('devfeutechbanking@gmail.com', 'Admin');
    $this->email->to($recepient);
    $this->email->subject('Account Enrollment');
    $this->email->message('Your account has been  Deactivated in https://feutech-banking-system.herokuapp.com ');
    $result = $this->email->send();
    echo 'email'.$result;
    //redirect('accept');

    $accept=array(

    'status' => $status
      );


      if(  $this->crud_model->deactivateaccount($id)){
        $this->session->set_flashdata('success_msg', "ACCOUNT SUCCESSFULLY DEACTIVATED.");
     redirect("account/loadenroll");

      }


  }
    function loadenroll(){
         $data['user_name'] = $this->crud_model->getname();
         $data['user_enroll'] = $this->crud_model->pendingenroll();
         $data['user_acctname'] = $this->crud_model->getacctname();
      $this->load->view('admin/pendingenrollview.php',$data);


    }
    function loaddash(){

      $this->load->view('admin/dashboard.php');

    }
    function loadmem(){
    $data['user'] = $this->crud_model->get_news();
      $this->load->view('admin/members.php',$data);

    }
    function loadadd(){
       $data['acctype'] = $this->crud_model->getacctype();
      $this->load->view('admin/addacctypeview.php',$data);

    }

    function loadnew(){
      $this->load->helper('form');
      $this->load->library('form_validation');
$this->load->view('admin/newacct.php');
    }

    function logout(){
$this->session->sess_destroy();
$this->load->view('index.php');
    }
    public function index()
  {

  //  $data2['account'] = $this->user_model->getacct();
   //$this->load->view('teller/manageview.php',$data2);

   $data['user'] = $this->crud_model->pending();
    //$this->load->view('admin/pendingaccountsview.php',$data2);
    $this->load->view('admin/pendingaccountsview.php',$data);
  }


    public function view($slug = NULL)
    {
        $data['news_item'] = $this->news_model->get_news($slug);

        if (empty($data['news_item']))
        {
            show_404();
        }

        $data['title'] = $data['news_item']['title'];

        $this->load->view('partials/admin_sidebar');
        $this->load->view('admin/members', $data);
    }

    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');




            //$this->load->view('templates/header', $data);

            //$this->load->view('templates/footer');


            $this->crud_model->set_news();
                $this->session->set_flashdata('success_msg', "ACCOUNT SUCCESSFULLY ADDED.");
          $data['acctype'] = $this->crud_model->getacctype();
            $data['user'] = $this->crud_model->get_news();
           $this->load->view('admin/members.php',$data);

    }
    public function add(){
          $this->load->helper('form');
              $data['account_type'] = $this->crud_model->getacctype();
        $this->load->view('admin/newMember',$data);
    }

    public function edit()
    {
      $id = $this->uri->segment(3);

      if (empty($id))
      {
          show_404();
      }

      $this->load->helper('form');
      $this->load->library('form_validation');

      $data['title'] = 'Edit a news item';
      $data['news_item'] = $this->crud_model->getacctypebyid($id);

      $this->form_validation->set_rules('acc_name', 'acc_name', 'required');

      if ($this->form_validation->run() === FALSE)
      {
        $data['acctype'] = $this->crud_model->getacctype();
          $this->load->view('partials/admin_sidebar', $data);
          $this->load->view('admin/editAcct', $data);

      }
      else
      {
          $this->crud_model->set_acctype($id);
          //$this->load->view('news/success');
          $data['acctype'] = $this->crud_model->getacctype();
            $this->session->set_flashdata('success_msg', "ACCOUNT SUCCESSFULLY EDITED.");
          $this->load->view('admin/addacctypeview', $data);
      }
    }

    public function acctinsert(){

        $this->crud_model->set_acctype();
        $this->session->set_flashdata('success_msg', "ACCOUNT SUCCESSFULLY ADDED.");
          $data['acctype'] = $this->crud_model->getacctype();
        $this->load->view('admin/addacctypeview',$data);
    }

    public function delete()
    {
        $id = $this->uri->segment(3);

        if (empty($id))
        {
            show_404();
        }

        $news_item = $this->crud_model->getacctypebyid($id);

        $this->crud_model->delete_acct($id);
        $data['user'] = $this->crud_model->get_news();
        $this->load->view('admin/members', $data);
    }
}
?>
