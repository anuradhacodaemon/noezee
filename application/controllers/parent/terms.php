<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Terms extends CI_Controller {

    /**
      @Name Category Controller
      Description:  Class represents controller for dispatcher login
      Operations : login,logout ,dashboard
      @Author : Anuradha Chakraborti
      For Codaemon Softwares Pvt. Ltd.
      For project - Neozee
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
       
       
    }

    
    public function index() {
    
        $this->load->view('terms');
    }

}

/* End of file home.php */
    /* Location: ./application/controllers/home.php */    