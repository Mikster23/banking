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
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.googlemail.com';
    $config['smtp_port'] = 465;
    $config['smtp_user'] = 'devfeutechbanking@gmail.com';
    $config['smtp_pass'] = '123Qwe1!';

  $this->load->library('email',$config);
$this->email->from('devfeutechbanking@gmail.com', 'Admin');
$this->email->to('mharon.gundayao@gmail.com');
$this->email->subject('Account Activation');
$this->email->message('Hello your account has been successfully activated you may log in to your account now');
$this->email->send();
redirect('/');
/*
  $accept=array(

  'status' => $status
    );

    if($this->crud_model->accept($id)){
      $this->crud_model->acceptaccount($id);
      $this->session->set_flashdata('success_msg', "ACCOUNT SUCCESSFULLY ACTIVATED.");
      redirect("account");

    }*/

  }
    function loaddash(){

      $this->load->view('admin/dashboard.php');

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


            $this->crud_model->set_acctype();

          $data['acctype'] = $this->crud_model->getacctype();
           $this->load->view('admin/addacctypeview.php',$data);

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
          $this->load->view('partials/admin_sidebar', $data);
          $this->load->view('admin/editAcct', $data);

      }
      else
      {
          $this->crud_model->set_acctype($id);
          //$this->load->view('news/success');
          $data['acctype'] = $this->crud_model->getacctype();
          $this->load->view('admin/addacctypeview', $data);
      }
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
