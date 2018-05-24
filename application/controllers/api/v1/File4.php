<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class File4 extends REST_Controller {

    /**
      @Name File Controller
      Description:  Class represents controller for File module REST API CALL
      Operations : uploadFile
      @Author : Anuradha Chakraborti
      For Codaemon Softwares Pvt. Ltd.
      For project - neoZee
      @params
      @return
      @since    20-12-2017
      @createdDate 20-12-2017

      @link : http://localhost/neozee/api/v1/(var)/image/uploadpic
      @link : http://localhost/neozee/api/v1/(var)/image/uploadpic
      @link : http://localhost/neozee/api/v1/(type)/uploadfile
     *
     */
    public function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('file_model');
        $this->load->library('s3');
        //var_dump($this->s3->listBuckets());
    }

    public function uploadFile_post() {
        // if (!class_exists('S3'))
        //require_once('application/libraries/S3.php');


        $this->load->helper(array('form', 'url'));
        $this->form_validation->set_rules('file_name', 'file_name', 'callback_file_check');
       //$this->form_validation->set_rules('user_id', 'user_id', 'required');
        //$this->form_validation->set_rules('device_id', 'device_id', 'required');




        if ($this->form_validation->run() == true) {
            //$data1 = $this->upload->data();

            $s3 = '';

            $fileName = time() . $_FILES['file_name']['name'];
            $fileTempName = $_FILES['file_name']['tmp_name'];

            if (S3::putObject(S3::inputFile($fileTempName), "myneozeebucket", $fileName, S3::ACL_PUBLIC_READ)) {
                //echo "<strong>We successfully uploaded your file.</strong>";


                $data_store['name'] = $fileName;
                $data_store['type'] = pathinfo($fileName, PATHINFO_EXTENSION);

                $id = $this->file_model->add_media($data_store);
                $user_data1 = array('file_name' => $data_store['name'],
                    "media_id" => $id);
                $message = set_response_message('success', "File Upload Successfull", $user_data1, 1, REST_Controller::HTTP_OK);
            } else {
                //echo "<strong>Something went wrong while uploading your file... sorry.</strong>";

                $message = set_response_message('success', "File Upload unSuccessfull", [], 1, REST_Controller::HTTP_OK);
            }



            /** $config['upload_path'] = './upload/category/';
              $config['allowed_types'] = 'gif|jpg|png|mp4';
              //$config['max_size']             = 8000;
              //$config['max_width']            = 1024;
              //$config['max_height']           = 768;
              $config['encrypt_name'] = TRUE;
              $this->load->library('upload', $config);
              $this->upload->set_allowed_types('*');
              if (!$this->upload->do_upload('file_name')) {
              $error = array('error' => $this->upload->display_errors());
              $message = set_response_message('error', "error", array($error), 0, REST_Controller::HTTP_BAD_REQUEST);
              } else {
              $data1 = $this->upload->data();
              $data_store['name'] = $data1['file_name'];
              $data_store['type'] = $data1['file_ext'];
              $this->file_model->add_media($data_store);
              $data = array('upload_data' => $data1); */
            // $message = set_response_message('success', "File Upload Successfull", $user_data1, 1, REST_Controller::HTTP_OK);
            // }
        } else {

            $message = set_response_message('fail', validation_errors(), [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    /*
     * file value and type check during validation
     */

    /*
     * file value and type check during validation
     */

    public function file_check($str) {
        $allowed_mime_type_arr = array('mp4', 'gif', 'jpeg', 'jpg', 'png', 'bmp', '3gp', 'webm', 'webp', 'mkv');
        $mime = pathinfo($_FILES['file_name']['name'], PATHINFO_EXTENSION);
        if (isset($_FILES['file_name']['name']) && $_FILES['file_name']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

    public function uploadFile_get($userId = 0) {

        $fields = "*";
        if ($this->get("fields")) {
            $fields = $this->get("fields");
        }
        if ($this->get('page')) {
            $page = $this->get('page');
        } else {
            $page = '';
        }
        if ($this->get('limit')) {
            $limit = $this->get('limit');
        } else {
            $limit = '';
        }
        try {

            //print_r($this->get('email'));
            //print_r($this->get('user_password'));
            //die;
            if ($userId) {
                $filter['id'] = $userId;
                $user_data = $this->file_model->get_user($fields, $page = null, 1, $filter);
            } else if ($this->get('user_id')) {
                $filter['neo_media.user_id'] = $this->get('user_id');
                $user_data = $this->file_model->get_user($fields, $page = null, 1, $filter);
                $numData = $this->file_model->get_user_count($fields, $page = null, 1, $filter);
            } else if ($this->get("filter") || $this->get("order")) {
                $this->load->library("query_generator");
                if ($this->get("filter"))
                    $this->query_generator->setfilters($this->get("filter"));
                if ($this->get("order"))
                    $this->query_generator->setOrder($this->get("order"));
                $filters = $this->query_generator->getFilter();
                if (array_key_exists('user_password', $filters)) {//checking for password
                    $filters['user_password'] = md5($filters['user_password']);
                }
                $user_data = $this->file_model->get_user($fields, $page, $limit, $filters, $this->query_generator->getLike(), $this->query_generator->getOrder()
                );
            } else {
                $user_data = $this->file_model->get_user($fields, $page, $limit);
            }
            if (isset($filters) && (array_key_exists('user_password', $filters) && array_key_exists('username', $filters)) && (empty($filters['username']) || empty($filters['user_password']))) {
                $message = set_response_message('fail', 'Please Fill All Mandatory Fields', [], 0, REST_Controller::HTTP_BAD_REQUEST);
            } else if (!empty($user_data)) {
                if ($this->get('user_id') && !empty($user_data)) {
                    // $user_data1 = $this->file_model->get_device_parent($this->get('id'));
                    // $user_data2 = $this->file_model->get_device_child($this->get('id'));
                    if (!empty($user_data)) {

                        $parentid = $this->get('parent_device_id');
                        $childid = $this->get('child_device_id');
                        foreach ($user_data as $k => $v) {
                            //  'gif|jpg|png|jpeg|bmp|webp|3gp|mp4|webm|mkv'
                            if ($user_data[$k]['type'] == '.jpg' || $user_data[$k]['type'] == '.jpeg' || $user_data[$k]['type'] == '.gif' || $user_data[$k]['type'] == '.png' || $user_data[$k]['type'] == '.bmp') {
                                $type = 'image';
                                $thumnailurl = base_url() . MEDIAPATH . $user_data[$k]['name'];
                            }
                            if ($user_data[$k]['type'] == '.webp' || $user_data[$k]['type'] == '.3gp' || $user_data[$k]['type'] == '.mp4' || $user_data[$k]['type'] == '.webm' || $user_data[$k]['type'] == '.mkv') {
                                $type = 'video';
                                $thumnailurl = base_url() . MEDIAPATH1;
                            }


                            $user_data1[] = array('id' => $user_data[$k]['id'],
                                "type" => $type,
                                "medianame" => $user_data[$k]['name'],
                                "add_date" => $user_data[$k]['add_date'],
                                "url" => base_url() . MEDIAPATH3 . $user_data[$k]['name'],
                                "thumbnailUrl" => $thumnailurl,
                                "device_id" => $user_data[$k]['device_id']);
                        }
                        $message = set_response_message_media('success', $parentid, $childid, "Media found successfully.", $user_data1, $numData, REST_Controller::HTTP_OK);
                    } else {
                        $message = set_response_message('fail', 'No media found', $user_data, count($user_data), REST_Controller::HTTP_OK);
                    }
                } else {



                    $message = set_response_message('fail', 'No media found', $user_data, count($user_data), REST_Controller::HTTP_OK);
                }
            } else {
                $message = set_response_message('fail', 'No media found', $user_data, count($user_data), REST_Controller::HTTP_OK);
            }
        } catch (Exception $e) {
            $user_data = '';
            $message = set_response_message('fail', $e->getMessage(), $user_data, count($user_data), REST_Controller::HTTP_OK);
        }
        $this->set_response($message, $message['status_code']);
    }

}
