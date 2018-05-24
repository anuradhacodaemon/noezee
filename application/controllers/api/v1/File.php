<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class File extends REST_Controller {

    /**
      @Name File Controller
      Description:  Class represents controller for File module REST API CALL
      Operations : uploadFile
      @Author : Anuradha Chakraborti
      For Codaemon Softwares Pvt. Ltd.
      For project - neoZee
      @params
      @return
      @since    25-10-2017
      @createdDate 25-10-2017

      @link : http://localhost/neozee/api/v1/(var)/image/uploadpic
      @link : http://localhost/neozee/api/v1/(var)/image/uploadpic
      @link : http://localhost/neozee/api/v1/(type)/uploadfile
     *
     */
    public function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('file_model');
    }

    public function uploadFile_post() {


        $this->load->helper(array('form', 'url'));
        $this->form_validation->set_rules('file_name', 'file_name', 'callback_file_check');
        //$this->form_validation->set_rules('user_id', 'user_id', 'required');
        // $this->form_validation->set_rules('device_id', 'device_id', 'required');

        if ($this->form_validation->run() == true) {
            $data1 = $this->upload->data();
            $data_store['name'] = $data1['file_name'];

            $user_data1 = array('file_name' => $data_store['name'],
                'media_id' => $this->session->userdata['media_id']);

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
            $message = set_response_message('success', "File Upload Successfull", $user_data1, 1, REST_Controller::HTTP_OK);
            // }
        } else {

            $message = set_response_message('fail', validation_errors(), [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function uploadFile1_post($mediaId = 0) {
        foreach ($this->post() as $key => $value) {
            $userData[$key] = $value;
        }
        $id = $userData['id'];
        unset($userData['id']);
        try {
            $update = $this->file_model->update_file($id, $userData); // update client Record
            if ($update) {
                $filter['id'] = $mediaId;
                //$userRecord = $this->file_model->get_user('*', $page = null, 1, $filter);
                $message = set_response_message('success', "media details updated successfull", $userData, 1, REST_Controller::HTTP_OK);
            } else {
                $message = set_response_message('fail', "Internal server error while updating user", [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), array($userData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function resizeImage_post() {
        if ($this->post('image') != '') {
            $type = $this->uri->segment(3);
            //Set Validation rules defined in fileupload_rules
            switch ($type) {
                case "category":
                    $resizeConfig = $this->config->item('category_resize_rules');
                    break;
                default:
                    $rules = array();
                    break;
            }
            $resizeConfig['source_image'] = $resizeConfig['source_image'] . $this->post('image');
            $resizeConfig['new_image'] = $resizeConfig['new_image'] . $this->post('image');
            $this->load->library('image_lib');
            $this->image_lib->clear();
            $this->image_lib->initialize($resizeConfig); //Initialize LIbrary
            if ($this->image_lib->resize()) {//Resize
                $this->image_lib->clear();
                chmod($resizeConfig['new_image'], 0777); //Change Permission
                $message = set_response_message('success', "Image Resize Successfull", array('source_image' => ltrim($resizeConfig['source_image'], '.'), 'resize_image' => ltrim($resizeConfig['new_image'], '.')), 1, REST_Controller::HTTP_OK);
            } else {
                $message = set_response_message('error', "Image Resize Failed", [], 0, REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            $message = set_response_message('error', "Invalid Image", [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function uploadCamerapic_post() {
        $type = $this->uri->segment(3);
        //Set Validation rules defined in fileupload_rules  https://www.browserling.com/tools/file-to-base64
        switch ($type) {
            case "client":
                $rules = $this->config->item('client_profile_rules');
                break;
            case "technician":
                $rules = $this->config->item('technician_profile_rules');
                break;
            case "category":
                $rules = $this->config->item('category_rules');
                break;
            case "job":
                $rules = $this->config->item('job_complete_file_rules');
                break;
            default:
                $rules = array();
                break;
        }
        $imageString = $this->post('file');
        $imageArr = explode(';base64,', $imageString);
        $data = str_replace(' ', '+', array_pop($imageArr));
        $data = base64_decode($data); // Decode image using base64_decode
        $f = finfo_open();
        $mime_type = finfo_buffer($f, $data, FILEINFO_MIME_TYPE); //Get Image Type
        list($mime, $ext) = explode('/', $mime_type); //Get Image Extension
        finfo_close($f);
        sleep(1);
        $fileName = time() . '.' . $ext;
        $filePath = $rules['upload_path'];
        $file = $filePath . $fileName; //Now you can put this image data to your desired file using file_put_contents function like below:
        if (file_put_contents($file, $data)) {
            chmod($file, 0777); //change permission
            $fileData['file_name'] = $fileName;
            $fileData['relative_path'] = ltrim($filePath, ".");
            $fileData['full_path'] = ltrim($file, ".");
            $fileData['image_type'] = $ext;
            if ($type == 'category') {// Resize category Image
                $resizeConfig = $this->config->item('category_resize_rules');
                $resizeConfig['source_image'] = $resizeConfig['source_image'] . $fileName;
                $resizeConfig['new_image'] = $resizeConfig['new_image'] . $fileName;
                $this->load->library('image_lib');
                $this->image_lib->clear();
                $this->image_lib->initialize($resizeConfig); //Initialize LIbrary
                if ($this->image_lib->resize()) {//Resize
                    $this->image_lib->clear();
                    chmod($resizeConfig['new_image'], 0777); //Change Permission
                    $fileData['resize_image'] = ltrim($resizeConfig['new_image'], '.');
                }
            }
            $message = set_response_message('success', "File Upload Successfull", array($fileData), 1, REST_Controller::HTTP_OK);
        } else {
            $message = set_response_message('fail', "File Upload Failed", [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

    /*
     * file value and type check during validation
     */

    public function file_check($str) {
        $config = array(
            'allowed_types' => 'gif|jpg|png|jpeg|bmp|webp|3gp|mp4|webm|mkv',
            'upload_path' => './upload/category/'
        );

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file_name')) {
            $this->form_validation->set_message('file_check', $this->upload->display_errors());
            return false;
        } else {
            $data1 = $this->upload->data();
            $data_store['name'] = $data1['file_name'];
            $data_store['type'] = $data1['file_ext'];
            $data_store['user_id'] = 0;
            $data_store['device_id'] = 0;
            $id = $this->file_model->add_media($data_store);
            $this->session->set_userdata('media_id', $id);
            return true;
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
                $filter['parent_device_id'] = $this->get('parent_device_id');
                $filter['child_device_id'] = $this->get('child_device_id');
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
                        $userID = $this->get('user_id');
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

                            $num = $this->file_model->get_favorite($user_data[$k]['id'], $childid);
                            if ($num > 0)
                                $is_favorite = true;
                            else
                                $is_favorite = false;
                            if ($childid == '') {
                                $user_data1[] = array('id' => $user_data[$k]['id'],
                                    "type" => $type,
                                    "medianame" => $user_data[$k]['name'],
                                    "add_date" => $user_data[$k]['add_date'],
                                    "url" => base_url() . MEDIAPATH . $user_data[$k]['name'],
                                    "thumbnailUrl" => $thumnailurl,
                                    "device_id" => $user_data[$k]['device_id']);
                            } else {
                                $user_data1[] = array('id' => $user_data[$k]['id'],
                                    "type" => $type,
                                    "medianame" => $user_data[$k]['name'],
                                    "add_date" => $user_data[$k]['add_date'],
                                    "url" => base_url() . MEDIAPATH . $user_data[$k]['name'],
                                    "thumbnailUrl" => $thumnailurl,
                                    "device_id" => $user_data[$k]['device_id'],
                                    "is_favorite" => $is_favorite
                                );
                            }
                        }
                        $message = set_response_message_media('success', $userID, $parentid, $childid, "Media found successfully.", $user_data1, $numData, REST_Controller::HTTP_OK);
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

    public function media_post() {
        $mediaid = $this->post('media_id');
        $userId = $this->post('user_id');
        $child_DeviceID = $this->post('child_deviceid');
        $appVersion = $this->post('appVersion');
        if ($userId <= 0 || $userId == '' || $mediaid <= 0 || $mediaid == '') {
            $message = set_response_message('fail', "Bad Request", [], 0, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            try {
                $returnData = $this->file_model->delete_media($userId, $mediaid);
              
                if ($returnData > 0) {
                    $user_data1 = array('user_id' => $userId,
                        "media_id" => $mediaid,
                        "child_DeviceID" => $child_DeviceID);
                 $this->file_model->delete_mediafav($userId, $mediaid);
                    $message = set_response_message('success', 'media deleted successfully', $user_data1, 1, REST_Controller::HTTP_OK);
                } else {
                    $message = set_response_message('fail', 'Internal server error while deleting media', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
            $this->set_response($message, $message['status_code']);
        }
    }

}
