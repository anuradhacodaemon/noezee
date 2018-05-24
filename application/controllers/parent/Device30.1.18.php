<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Device extends CI_Controller {

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
        $this->load->model('parent/device_model');
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
        if (!isset($this->session->userdata['ud'])) {
            $data = array();
            $this->load->view('parent', $data);
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

            $config['base_url'] = BASE_URL . 'parent/device';

            $config['total_rows'] = $this->device_model->get_count_media($filterData);
            //$config['per_page'] = RECORD_LIMIT;
            $page = ($record_num) ? $record_num : 0;
            $config['reuse_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;
            if ($page > 0)
                $page = ($page - 1) * $config['per_page'];

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Prev';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data["page_no"] = $page;
            $data["total_rows"] = $config['total_rows'];
            $data["record_limit"] = $config['per_page'];
            //$data['client'] = $this->media->get_client(0);
            //$data['project'] = $this->media->get_project(0);
            // $data['neighborhood'] = $this->media->get_neighborhood();


            $data["joblisting"] = $this->device_model->get_media('', $config["per_page"], $page, $filterData, $sortData);
            $data['header'] = $this->load->view('elements/header', $page, true);
            //$data['nav'] = $this->load->view('elements/navigation', $page, true);
            $data['layout_content'] = $this->load->view('pages/devicelist', array_merge($data, $filterData), true);
            //footer content
            $data['footer'] = $this->load->view('elements/footer', $page, true);
            //  main layout 
            //$data['msg']=$msg;
            $this->load->view('layouts/default_template', $data);
//$this->template->view('admin/device/index', array_merge($data, $filterData));
        }
    }

    public function details($userId = 0, $pageNo = 0) {


        $data = array();
        if (!isset($this->session->userdata['ud'])) {
            $data = array();
            $this->load->view('parent', $data);
        } else {

            $page = array();
            $data = array();
            $config['base_url'] = BASE_URL . 'parent/device/details/' . $userId;
            $config['total_rows'] = $this->device_model->get_devicedetail_count($userId);
            //$config['page_query_string'] = TRUE;
            //$config['reuse_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;

            // init params
            $params = array();
            $limit_per_page = 1;
            $page = $pageNo;
            $total_records = $this->device_model->get_devicedetail_count($userId);
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            //$config["uri_segment"] = 3;
            if ($total_records > 0) {
                // custom paging configuration
                $config['num_links'] = 1;
                $config['use_page_numbers'] = TRUE;
                $config['reuse_query_string'] = TRUE;

                //$config['num_links'] = 5;
                $config['full_tag_open'] = '<ul class="pagination">';
                $config['full_tag_close'] = '</ul>';
                $config['first_link'] = false;
                $config['last_link'] = false;
                $config['first_tag_open'] = '<li>';
                $config['first_tag_close'] = '</li>';
                $config['prev_link'] = 'Prev';
                $config['prev_tag_open'] = '<li class="prev">';
                $config['prev_tag_close'] = '</li>';
                // $config['next_link'] = 'Next';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['last_tag_open'] = '<li>';
                $config['last_tag_close'] = '</li>';
                $config['cur_tag_open'] = '<li class="active"><a href="#">';
                $config['cur_tag_close'] = '</a></li>';
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $this->pagination->initialize($config);
                $data['pagination'] = $this->pagination->create_links();
            }       
                $data["page_no"] = $pageNo;
                $data["total_rows"] = $config['total_rows'];
                $data["record_limit"] = $config['per_page'];

                $data['joblisting'] = $this->device_model->get_mediadetails($limit_per_page, $page * $limit_per_page, $userId);
                // $data['technicianList'] = $this->jobs->get_technicianlist($page, $config['per_page'], $data['jobDetails'][0]['category_id']);
            

            /* Load the view using template */
            $data['header'] = $this->load->view('elements/header', $page, true);
            $data['nav'] = $this->load->view('elements/navigation', $page, true);
            $data['layout_content'] = $this->load->view('pages/devicedetails', $data, true);
            //footer content
            $data['footer'] = $this->load->view('elements/footer', $page, true);
            //  main layout 
            //$data['msg']=$msg;
            $this->load->view('layouts/default_template', $data);
            // $this->template->view('admin/device/devicedetails', $data);
        }
    }

    public function media($type, $deviceId, $pageNo = 0) {

        $data = array();
        if (!isset($this->session->userdata['ud'])) {
            $data = array();
            $this->load->view('parent', $data);
        } else {

            $page = array();
            $data = array();
            $config['base_url'] = BASE_URL . 'parent/device/media/' . $type . '/' . $deviceId;
            $config['total_rows'] = $this->device_model->get_devicemediadetail_count($deviceId, $type);
            //$config['page_query_string'] = TRUE;
            //$config['reuse_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;
            $config['per_page'] = RECORD_LIMIT;

            if ($pageNo > 0) {
                $pageNo = RECORD_LIMIT * $pageNo;
                $config['per_page'] = $pageNo;
                $pageNo = RECORD_LIMIT;
            } else {
                $pageNo = 0;
            }
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Prev';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();

            $data["page_no"] = $pageNo;
            $data["total_rows"] = $config['total_rows'];
            $data["record_limit"] = $config['per_page'];
            $data["type"] = $type;
            $data["device_id"] = $deviceId;

            $data['joblisting'] = $this->device_model->get_devicemediadetails($pageNo, $config['per_page'], $deviceId, $type);
            // $data['technicianList'] = $this->jobs->get_technicianlist($page, $config['per_page'], $data['jobDetails'][0]['category_id']);
            /* Load the view using template */
            $data['header'] = $this->load->view('elements/header', $page, true);
            //$data['nav'] = $this->load->view('elements/navigation', $page, true);
            $data['layout_content'] = $this->load->view('pages/devicemedia', $data, true);
            //footer content
            $data['footer'] = $this->load->view('elements/footer', $page, true);
            //  main layout 
            //$data['msg']=$msg;
            $this->load->view('layouts/default_template', $data);
            // $this->template->view('admin/device/devicedetails', $data);
        }
    }

    public function favorite($deviceId, $date = '', $pageNo = 0) {
        $this->load->model('parent/media_model');
        $data = array();

        if (!isset($this->session->userdata['ud'])) {
            $data = array();
            $this->load->view('parent', $data);
        } else {


            $page = array();
            $data = array();
            $filterData['device_id'] = $deviceId;

            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);

            $config['base_url'] = BASE_URL . 'parent/device/favorite/' . $deviceId . '/' . $date;

            $config['total_rows'] = $this->media_model->get_count_mediadevice($filterData);
            //$config['per_page'] = RECORD_LIMIT;
            $config['use_page_numbers'] = TRUE;
            $config['per_page'] = RECORD_LIMIT;

            if ($pageNo > 0) {
                $pageNo = RECORD_LIMIT * $pageNo;
                $config['per_page'] = $pageNo;
                $page = RECORD_LIMIT;
            } else {
                $pageNo = 0;
            }

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Prev';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();

            $data["page_no"] = $pageNo;
            $data["total_rows"] = $config['total_rows'];
            $data["record_limit"] = $config['per_page'];
            $data["device_id"] = $deviceId;
            $data["date"] = $date;
            //$data['client'] = $this->media->get_client(0);
            //$data['project'] = $this->media->get_project(0);
            // $data['neighborhood'] = $this->media->get_neighborhood();
            $data["joblisting"] = $this->media_model->get_mediadevice($pageNo, $config['per_page'], $filterData);

            $data['header'] = $this->load->view('elements/header', $page, true);
            $data['layout_content'] = $this->load->view('pages/favorite', array_merge($data, $filterData), true);
            //footer content
            $data['footer'] = $this->load->view('elements/footer', $page, true);
            //  main layout 
            //$data['msg']=$msg;
            $this->load->view('layouts/default_template', $data);
            //$this->template->view('admin/media/index', array_merge($data, $filterData));
        }
    }

}

/* End of file home.php */
    /* Location: ./application/controllers/home.php */    