<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
      @Name Category Controller
      Description:  Class represents controller for dispatcher login
      Operations : login,logout ,dashboard
      @Author : Anuradha Chakraborti
      For Codaemon Softwares Pvt. Ltd.
      For project - Technician Search
      @params
      @return
      @since    6-3-2017
      @createdDate 6-3-2017
      @link : http:xyz.com/dispatcher/
     *
     */
    public function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('parent/parentlogin_model');
       
    }

    /**
     * This method used to login for dispatcher depends username and password entere.
     * @param username and password in form.
     * @return login id for dispatcher if true.
     * @url /dispatcher/
     * @exception 
     * @see 
     */
    public function index() {

        $data = array();
        $page = array();
        if (!isset($this->session->userdata['ud'])) {
            $this->load->view('parent', $data);
        } else {
            // redirect('parent/pages', 'refresh');
           
            
            $data['header'] = $this->load->view('elements/header', $page, true);
            // $data['nav'] = $this->load->view('elements/navigation', $page, true);
            $data['layout_content'] = $this->load->view('pages/medialist', array_merge($data, $filterData), true);
            //footer content
            $data['footer'] = $this->load->view('elements/footer', $page, true);
            //  main layout 
            //$data['msg']=$msg;
            $this->load->view('layouts/default_template', $data);
            //$this->template->view('parent/media/index', $data);
        }
    }

    /**
     * This method used to login for dispatcher depends username and password entered.
     * @param username and password in form.
     * @return login id for dispatcher if true.
     * @url /dispatcher/
     * @exception 
     * @see 
     */
    public function login() {
        $data = array();
        $this->load->model('parent/parentlogin_model');

        if ($this->form_validation->run('admin/login') == true) {

            $username = $this->security->xss_clean($_POST['email']);
            $password = $this->security->xss_clean($_POST['password']);
            $result = $this->parentlogin_model->validate($username, $password);
          // die;
            if (!$result) {
                 $error = 'Invalid username/password';
                $this->session->set_flashdata('item', array('message' => '<font color=red>' . $error . '</font>', 'class' => 'success'));
                redirect('parent/', 'refresh');
            } else {


                /* Load the view using template */
                redirect('parent/media', 'refresh');
            }
        } else {

          $this->session->set_flashdata('item', array('message' => '<font color=red>' . validation_errors() . '</font>', 'class' => 'success'));
            $this->load->view('parent', $data);
        }
    }

    /**
     * This method used logout form web parent.

     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('parent/');
    }
    
    public function terms()
    {
        $this->load->view('terms');
    }
     public function privacy()
    {
        $this->load->view('privacy');
    }
     public function welcome()
    {
       $data = array();
        if (!isset($this->session->userdata['ud'])) {
            $this->load->view('parent', $data);
        } else {
            $page = array();
            $data['header'] = $this->load->view('elements/header', $page, true);
            //$data['nav'] = $this->load->view('elements/navigation', $page, true);
            $data['layout_content'] = $this->load->view('pages/welcome', $data, true);
            //footer content
            $data['footer'] = $this->load->view('elements/footer', $page, true);
            $this->load->view('layouts/default_template', $data);
            
        }
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */