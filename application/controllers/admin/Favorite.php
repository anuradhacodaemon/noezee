<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Favorite extends CI_Controller {

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
        $this->load->model('admin/favorite_model');
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
            $data = array();
            $this->load->view('admin', $data);
        } else {
            

            
            if (isset($_GET['search'])) {
                $filterData['search'] = $_GET['search'];
                //$this->session->set_userdata('search', $_POST['search']);
            } else {
                $filterData['search'] = '';
            }
            if (isset($_GET['record_limit'])) {
                $config['per_page'] = $_GET['record_limit'];
                //$this->session->set_userdata('search', $_POST['search']);
            } else {
                $config['per_page'] = RECORD_LIMIT;
            }
            if (isset($_GET['sort_by'])) {
                $data['sort_by'] = $sortData['sort_by'] = $_GET['sort_by'];
            } else {
                $data['sort_by'] = $sortData['sort_by'] = '';
            }
            if (isset($_GET['sort_direction'])) {
                $data['sort_direction'] = $sortData['sort_direction'] = $_GET['sort_direction'];
            } else {
                $data['sort_direction'] = $sortData['sort_direction'] = '';
            }
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);

            $config['base_url'] = base_url() . MASTERADMIN . '/favorite';

            $config['total_rows'] = $this->favorite_model->get_count_media($filterData);
            //$config['per_page'] = RECORD_LIMIT;
            $page = ($record_num) ? $record_num : 0;
            $config['reuse_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;
            if ($page > 0)
                $page = ($page - 1) * $config['per_page'];
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data["page_no"] = $page;
            $data["total_rows"] = $config['total_rows'];
            $data["record_limit"] = $config['per_page'];
            //$data['client'] = $this->media->get_client(0);
            //$data['project'] = $this->media->get_project(0);
            // $data['neighborhood'] = $this->media->get_neighborhood();
            $data["joblisting"] = $this->favorite_model->get_media('', $config["per_page"], $page, $filterData, $sortData);
            $this->template->view('admin/favorite/index', array_merge($data, $filterData));
        }
    }

   

   
    }

    /* End of file home.php */
    /* Location: ./application/controllers/home.php */    