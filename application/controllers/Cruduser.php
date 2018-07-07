<?php
class Cruduser extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('crud_model');
    $this->load->helper('url_helper');
    $this->load->database('default');

  }

  function loaddash(){
    $data['user'] = $this->crud_model->pending();
    $this->load->view('admin/dashboard.php',$data);
    //  $data['user'] = $this->crud_model->get_news();
    //$data['title'] = 'News archive';
    //    $this->load->view('admin/members', $data);


  }
  function loadmember(){

    $data['user'] = $this->crud_model->get_news();
    //$data['title'] = 'News archive';
    $this->load->view('admin/members', $data);
    //  redirect('cruduser');

  }
  public function index()
  {
    //  $data['user'] = $this->crud_model->get_news();
    //$data['title'] = 'News archive';
    //    $this->load->view('admin/members', $data);

    $data['user'] = $this->crud_model->pending();
    //$this->load->view('admin/pendingaccountsview.php',$data2);
    $this->load->view('admin/pendingaccountsview.php',$data);
  }



  public function create()
  {
    $this->load->helper('form');
    $this->load->library('form_validation');

    $data['title'] = 'Create a news item';

    $this->form_validation->set_rules();
    $this->form_validation->set_rules();






      $data['user'] = $this->crud_model->get_news();
      $this->load->view('admin/members', $data);

  }

  public function view_user(){

    $id = $this->uri->segment(3);

    if (empty($id))
    {
      show_404();
    }

    $data['user_acctname'] = $this->crud_model->getacctname();
    $data['myacct']= $this->crud_model->getownedacct($id);
    $data['user'] = $this->crud_model->getnewsbyid($id);
    $this->load->view('admin/adminuserview.php',$data);

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
    $data['news_item'] = $this->crud_model->get_news_by_id($id);
    $data['account_type'] = $this->crud_model->getacctype();
    $this->form_validation->set_rules('m_fname', 'M_fname', 'required');
    $this->form_validation->set_rules('m_lname', 'M_lname', 'required');

    if ($this->form_validation->run() === FALSE)
    {
      $this->load->view('partials/admin_sidebar', $data);
      $this->load->view('admin/editMember', $data);

    }
    else
    {
      $this->crud_model->set_news($id);
      //$this->load->view('news/success');
      $data['user'] = $this->crud_model->get_news();
      $this->session->set_flashdata('success_msg', 'User Successfully Edited!.');
      $this->load->view('admin/members', $data);
    }
  }

  public function delete()
  {
    $id = $this->uri->segment(3);

    if (empty($id))
    {
      show_404();
    }

    $news_item = $this->crud_model->get_news_by_id($id);

    $this->crud_model->delete_news($id);
    $data['user'] = $this->crud_model->get_news();
    $this->load->view('admin/members', $data);
  }
}
