<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Senders extends CI_Controller {

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
        $this->load->library('pagination');
        $this->load->model('parent/message_model');
    }

    public function index($device_id=0,$pageNo=0) {

        $data = array();
        if (!isset($this->session->userdata['ud'])) {
            $data = array();
            $this->load->view('parent', $data);
        } else {

            $page = array();
            $data = array();
            $filterData['received_child_id'] = $device_id;
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);

            $config['base_url'] = BASE_URL . 'parent/senders';

             $total_rows = $this->message_model->get_senders_count($filterData);
            $limit = RECORD_LIMIT;

            // GET PAGE AND OFFSET VALUE
            if ($pageNo > 0) {
                $page = $pageNo - 1;
                $offset = $page * $limit;
            } else {
                $page = 0;
                $offset = 0;
            }

            // COUNT TOTAL NUMBER OF ROWS IN TABLE

           
            if ($total_rows > $limit) {
                $number_of_pages = ceil($total_rows / $limit);
                $pages = $pageNo;
            } else {
                $pages = 1;
                $number_of_pages = 1;
            }
            $data['total_rows'] = $total_rows;
            $data['device_id'] = $device_id;
            $data['number_of_pages'] = $number_of_pages;
            $data['page'] = $pages;
            $data["joblisting"] = $this->message_model->get_senders($offset, $limit, $filterData);
            $data['header'] = $this->load->view('elements/header', $page, true);
            //$data['nav'] = $this->load->view('elements/navigation', $page, true);
            $data['layout_content'] = $this->load->view('pages/senders', $data, true);
            //footer content
            $data['footer'] = $this->load->view('elements/footer', $page, true);
            $this->load->view('layouts/default_template', $data);
        }
    }

}

/* End of file home.php */
    /* Location: ./application/controllers/home.php */    