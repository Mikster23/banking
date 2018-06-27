<?php
class Cruduser extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
       $this->load->helper('url_helper');
    }

    function loaddash(){

      $data['user'] = $this->crud_model->get_news();
      //$data['title'] = 'News archive';
      $this->load->view('admin/members', $data);
  //  redirect('cruduser');

    }
    public function index()
    {
        $data['user'] = $this->crud_model->get_news();
        //$data['title'] = 'News archive';
        $this->load->view('admin/members', $data);
    }



    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('m_fname', 'M_fname', 'required');
        $this->form_validation->set_rules('m_lname', 'M_lname', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            //$this->load->view('templates/header', $data);
            $this->load->view('admin/newMember');
            //$this->load->view('templates/footer');

        }
        else
        {
            $this->crud_model->set_news();

            $data['user'] = $this->crud_model->get_news();
            $this->load->view('admin/members', $data);
        }
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
