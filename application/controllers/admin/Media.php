<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Media extends CI_Controller {

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
        $this->load->library('pagination');
        $this->load->model('admin/media_model');
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

            $config['base_url'] = base_url() . MASTERADMIN . '/media';

            $config['total_rows'] = $this->media_model->get_count_media($filterData);
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
            $data["joblisting"] = $this->media_model->get_media('', $config["per_page"], $page, $filterData, $sortData);
            $this->template->view('admin/media/index', array_merge($data, $filterData));
        }
    }

    public function details($jobId = 0, $page = 0) {


        $data = array();
        if (!isset($this->session->userdata['userdata']['ud'])) {
            $data = array();
            $this->load->view('admin', $data);
        } else {
            $data['jobDetails'] = $this->media_model->get_mediadetails($jobId);

            /* Load the view using template */

            $this->template->view('admin/media/mediadetails', $data);
        }
    }

    public function edit($mediaid) {
        if (!isset($this->session->userdata['userdata']['ud'])) {
            $data = array();
            $this->load->view('admin', $data);
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $data = array();
                if ($this->form_validation->run('media/edit') == true) {
                    $data['confirm_status']=$this->input->post('confirm_status');
                    $data['apk_path']=$this->input->post('apk_path');
                    $data['tokenid']=$this->input->post('tokenid');
                    if (!empty($_FILES['apk']['name'])) {
                        $new_name = time() . $_FILES["apk"]['name'];
                        $config['upload_path'] = './uploads/store/apk/';
                        $config['allowed_types'] = 'jpg|apk';
                        $config['file_name'] = $new_name;
                        //$ext = end((explode(".", $new_name)));
                        $ext = pathinfo($_FILES["apk"]["name"])['extension'];
                        //Load upload library and initialize configuration
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('apk')) {
                            $uploadData = $this->upload->data();
                            $picture = $uploadData['file_name'];
                        } else {
                            $picture = $this->input->post('apk_hidden');
                        }
                    }  
                    else {
                            $picture = $this->input->post('apk_hidden');
                        }
                        $data['apk']=$picture;
                        $result = $this->media->edit_media($this->input->post('tokenid'), $data['apk'],$data['apk_path'],$data['confirm_status']);
                        if (!$result) {
                            $this->session->set_flashdata('item', array('message' => '<font color=red>Invalid Data.</font>', 'class' => 'success'));
                            redirect('admin/media/edit/' . $mediaid, 'refresh');
                        } else {
                            /* template the view using template */
                            redirect('admin/media', 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('item', array('message' => '<font color=red>' . validation_errors() . '</font>', 'class' => 'success'));
                        redirect('admin/media/edit/' . $mediaid, 'refresh');
                    }
                } else {
                    $last = $this->uri->total_segments();
                    $id = $this->uri->segment($last);
                    $data["pages"] = $this->media->get_mediadetails($mediaid);
                    //print_r($id);exit;
                    $this->template->view('admin/media/edit', $data);
                }
            }
        }
    }

    /* End of file home.php */
    /* Location: ./application/controllers/home.php */    