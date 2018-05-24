<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clientforgot extends CI_Controller {

    /**
      @Name Category Controller
      Description:  Class represents controller for technician login
      Operations : login,logout ,dashboard
      @Author : Anuradha Chakraborti
      For Codaemon Softwares Pvt. Ltd.
      For project - Technician Search
      @params
      @return
      @since    6-3-2017
      @createdDate 6-3-2017
      @link : http:xyz.com/technician/
     *
     */
    public function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('clientpassword_model');
      
    }

    public function index($id = '') {


        $data['user'] = $id;
        $this->load->view('clientforgot', $data);
    }

    /**
     * This method used to forgot password.
     * @param password and confirm password in form.
     * @return true or false.
     * @url /technician/home/forgotpassword
     * @exception 
     * @see 
     */
    public function forgotpassword( $id = '') {
        
        $link = explode('&', urldecode($id));
        echo $data['user'] = $link[0]; 
        
        $result = $this->clientpassword_model->checkUrl($link[0]);
       // print_r($result[0]->reset_url);
         echo $url = 'http://' . $_SERVER['SERVER_NAME'].':82' . $_SERVER['REQUEST_URI'];
         echo '<pre>';
        print_r($result[0]);
        if ($url == $result[0]->reset_url)
            $this->load->view('clientforgot', $data);
        else
            echo $this->lang->line('wronglink');
    }

    /**
     * This method used to change password.
     * @param password and confirm password in form.
     * @return true or false.
     * @url /technician/home/forgotpassword
     * @exception 
     * @see 
     */
    public function changePassword() {
        $data=array();
        if ($this->form_validation->run('dispatcher/changepassword') == true) {
            
            $password = $this->security->xss_clean($_POST['password']);
            $userId = $this->security->xss_clean($_POST['user']);
             $result = $this->clientpassword_model->changePassword(md5($password), $userId);
            if ($result==1) {
                $sucess = 'password reset successfull';
               // $this->session->sess_destroy();
                              $this->session->set_flashdata('item', array('message' => '<font color=red>' . $sucess . '</font>', 'class' => 'success'));
 
              //echo "<script type='text/javascript'>window.top.close();</script>";
                 redirect('parent','refresh');
                
            } else {
               $unsucess = 'password reset unsuccessful';
                $this->session->set_flashdata('item', array('message' => '<font color=red>' . $unsucess . '</font>', 'class' => 'success'));
                redirect($_SERVER['HTTP_REFERER']);

            }
        } else {
           
           $this->session->set_flashdata('item', array('message' => '<font color=red>' . validation_errors() . '</font>', 'class' => 'success'));
           //$this->load->view('clientforgot', $data);
           redirect($_SERVER['HTTP_REFERER']);
        }
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */