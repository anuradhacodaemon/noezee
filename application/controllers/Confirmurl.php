<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Confirmurl extends CI_Controller {

    /**
      @Name Category Controller
      Description:  Class represents controller for technician login
      Operations : login,logout ,dashboard
      @Author : Anuradha Chakraborti
      For Codaemon Softwares Pvt. Ltd.
      For project - Neozee
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
        $this->load->model('confirmurl_model');
    }

    public function index($id = '') {
        $link = explode('&', urldecode($id));
        $data['user'] = $link[0];
        $result = $this->confirmurl_model->checkUrl($link[0]);
        // print_r($result[0]->reset_url);
        $url = 'http://' . $_SERVER['SERVER_NAME'] . ':82' . $_SERVER['REQUEST_URI'];
        if ($link[0] == $result[0]->id)
        {
            $this->confirmurl_model->changeUrl($link[0]);
            echo 'Your account is confirmed successfully';
        }
        else
        echo 'Your account is not yet confirm.';
    }

    

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */