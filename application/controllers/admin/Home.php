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
        $this->load->model('admin/adminlogin_model');
       
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
        if (!isset($this->session->userdata['userdata']['ud'])) {
            $this->load->view('admin', $data);
        } else {
            // redirect('admin/pages', 'refresh');
           
            $this->template->view('admin/media/index', $data);
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
        $this->load->model('admin/adminlogin_model');

        if ($this->form_validation->run('admin1/login') == true) {

            $username = $this->security->xss_clean($_POST['username']);
            $password = $this->security->xss_clean($_POST['password']);
            $result = $this->adminlogin_model->validate($username, $password);
            if (!$result) {
                 $error = 'Invalid username/password';
                $this->session->set_flashdata('item', array('message' => '<font color=red>' . $error . '</font>', 'class' => 'success'));
                redirect('admin/', 'refresh');
            } else {


                /* Load the view using template */
                redirect('admin/media', 'refresh');
            }
        } else {

          $this->session->set_flashdata('item', array('message' => '<font color=red>' . validation_errors() . '</font>', 'class' => 'success'));
            $this->load->view('admin', $data);
        }
    }

    /**
     * This method used logout form web admin.

     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('admin/');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */