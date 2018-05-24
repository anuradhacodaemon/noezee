<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class File2 extends REST_Controller {

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
        $this->load->library('S3');
        //var_dump($this->s3->listBuckets());
    }

    public function uploadFile_post() {
        // if (!class_exists('S3'))
        //require_once('application/libraries/S3.php');
        //$file_contents = fopen($filename, "r");
        //if (file_exists($filename)) {
        // echo 'file found!';
        //} else {
        // echo 'my_settings.txt does not exist';
        // }
        // die;

        $this->load->helper(array('form', 'url'));
        $this->form_validation->set_rules('file_name', 'file_name', 'callback_file_check');
        $this->form_validation->set_rules('user_id', 'user_id', 'required');
        $this->form_validation->set_rules('device_id', 'device_id', 'required');




        if ($this->form_validation->run() == true) {
            //$data1 = $this->upload->data();
            //echo 'd';
            $s3 = '';

            $fileName = time() . $_FILES['file_name']['name'];


            $fileTempName = $_FILES['file_name']['tmp_name'];

            $filename1 = './upload/category/';



            // $this->_create_thumbnail($fileName, 141, 141);
            //die;
            //$this->load->library('image_lib');
            //print_r($fileName);
            // die;
            // die;
            if (S3::putObject(S3::inputFile($fileTempName), "myneozeebucket", $fileName, S3::ACL_PUBLIC_READ)) {

                /** check file is image or not then create thum and upload * */
                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'bmp');

                $filename = $_FILES['file_name']['name'];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);

                if (in_array($ext, $allowed)) {
                    $this->_create_thumbnail($fileName, 255, 255);
                    $upload_img = $this->session->userdata['ProfilePic'];
                    S3::putObjectFile($filename1 . 'thumb/' . $upload_img, "myneozeebucket", 'thumb/' . $upload_img . '', S3::ACL_PUBLIC_READ);

                    $data_store['image_thumb'] = $this->session->userdata['ProfilePic'];
                    /** second thumbnail * */
                    $upload_img1 = $this->session->userdata['ProfilePic1'];
                    S3::putObjectFile($filename1 . 'thumb2/' . $upload_img1, "myneozeebucket", 'thumb_app/' . $upload_img1 . '', S3::ACL_PUBLIC_READ);
                    //unlink($filename1 . $upload_img);
                    //unlink($filename1 . 'thumb/' . $upload_img);
                    //unlink($filename1 . 'thumb2/' . $upload_img1);
                    $data_store['image_thumb1'] = $this->session->userdata['ProfilePic1'];
                }

                if (isset($_FILES['file_vname']['name'])) {
                    $filevName = time() . $_FILES['file_vname']['name'];
                    $filevname = $_FILES['file_vname']['name'];
                    $ext1 = pathinfo($filevname, PATHINFO_EXTENSION);
                    if (in_array($ext1, $allowed)) {
                        $this->_create_thumbnailv($filevName, 255, 255);

                        $upload_img = $this->session->userdata['VideoPic'];
                        S3::putObjectFile($filename1 . 'vthumb/' . $upload_img, "myneozeebucket", 'thumbvideo/' . $upload_img . '', S3::ACL_PUBLIC_READ);

                        $data_store['video_thumb'] = $this->session->userdata['VideoPic'];
                        /** second thumbnail * */
                        $upload_img1 = $this->session->userdata['VideoPic1'];
                        S3::putObjectFile($filename1 . 'vthumb2/' . $upload_img1, "myneozeebucket", 'thumb_appvideo/' . $upload_img1 . '', S3::ACL_PUBLIC_READ);
                        unlink($filename1 . $upload_img);
                        unlink($filename1 . 'vthumb/' . $upload_img);
                        unlink($filename1 . 'vthumb2/' . $upload_img1);
                        $data_store['video_thumb1'] = $this->session->userdata['VideoPic1'];
                    }
                }


                $data_store['name'] = $fileName;
                $data_store['orig_name'] = $_FILES['file_name']['name'];
                $data_store['update_date'] = date("Y-m-d H:i:s");
                $data_store['type'] = pathinfo($fileName, PATHINFO_EXTENSION);
                $data_store['user_id'] = $this->post('user_id');

                $data_store['device_id'] = $this->post('device_id');
                $id = $this->file_model->add_media($data_store);

                 $num=$this->file_model->check_log($data_store['orig_name'], $data_store['device_id']);
                if($num>0)
                {
                    $this->file_model->update_log($data_store['orig_name'], $data_store['device_id']);   
                }
                $user_data1 = array('file_name' => $data_store['name'],
                    "user_id" => $data_store['user_id'], "device_id" => $data_store['device_id']);
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

    public function log_post() {
        $is_valid = validate($this->config->item('log_insert_rules'));
        if ($is_valid) {
            foreach ($this->post() as $key => $value) {
                $mediaData[$key] = $value;
            }
          $mediaData['log_date'] = date("Y-m-d H:i:s");

            try {
                
                
                 $num=$this->file_model->check_log($mediaData['file_name'], $mediaData['device_id']);
                if($num==0)
                {
                $mediaId = $this->file_model->add_log($mediaData);
                ; // register technician Record
                if ($mediaId > 0) {


                    $filter['log_id'] = $mediaId;
                    $fields = '';
                    //$media_data2 = $this->favorite_model->get_media($fields, $page = null, 1, $filter);

                    $message = set_response_message('success', ' log  added successfully.', $mediaData, 1, REST_Controller::HTTP_CREATED);
                } else {
                    $message = set_response_message('fail', 'Internal server error while adding media.', [], 0, REST_Controller::HTTP_OK);
                }
                
                }
                else {
                    $message = set_response_message('fail', 'Already added', [], 0, REST_Controller::HTTP_OK);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), array($mediaData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $message = set_response_message('fail', validation_errors(), [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    /*
     * file value and type check during validation
     */

    public function file_check($str) {
        $allowed_mime_type_arr = array('mp4', 'gif', 'jpeg', 'jpg', 'png', 'bmp', '3gp', 'webm', 'webp', 'mkv');
        $allowed_mime_type_arr1 = array('gif', 'jpeg', 'jpg', 'png', 'bmp');


        $mime = pathinfo($_FILES['file_name']['name'], PATHINFO_EXTENSION);
        if (isset($_FILES['file_name']['name']) && $_FILES['file_name']['name'] != "") {
            if (in_array($mime, $allowed_mime_type_arr)) { {

                   /** if (in_array($mime, $allowed_mime_type_arr1)) {
                        $dimension = getimagesize($_FILES['file_name']['tmp_name']);
                        $width = $dimension[0];
                        $height = $dimension[1];
                        if ($width < 260 || $height < 260) {

                            $this->form_validation->set_message('file_check', 'Image is too small');
                            return false;
                        }
                    } **/
                    return true;
                }
            } else {
                $this->form_validation->set_message('file_check', 'Please select only image/video file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }

    function _create_thumbnail($fileName, $width, $height) {

        $upload_conf = array(
            'upload_path' => realpath('./upload/category/'),
            'allowed_types' => 'gif|jpg|jpeg|png|bmp',
            'encrypt_name' => true,
        );

        $this->load->library('upload');
        $this->upload->initialize($upload_conf);
        $field_name = 'ProfilePic';

        if (!$this->upload->do_upload('file_name', '')) {

            $error['upload'] = $this->upload->display_errors();
        } else {
            $upload_data = $this->upload->data();
            $resize_conf = array(
                'upload_path' => realpath('./upload/category/thumb/'),
                'source_image' => $upload_data['full_path'],
                'new_image' => $upload_data['file_path'] . '/thumb/' . $upload_data['file_name'],
                'width' => $width,
                'height' => $height);

            $this->load->library('image_lib');
            $this->image_lib->initialize($resize_conf);


            // do it!
            if (!$this->image_lib->resize()) {
                // if got fail.
                $error['resize'] = $this->image_lib->display_errors();
            } else {
                $upload_data1 = $this->upload->data();
                $resize_conf1 = array(
                    'upload_path' => realpath('./upload/category/thumb2/'),
                    'source_image' => $upload_data1['full_path'],
                    'new_image' => $upload_data1['file_path'] . '/thumb2/' . $upload_data1['file_name'],
                    'width' => 200,
                    'height' => 200);

                $this->load->library('image_lib');
                $this->image_lib->initialize($resize_conf1);
                $this->image_lib->resize();
                $data_to_store['ProfilePic'] = $upload_data['file_name'];
                $data1['ProfilePic'] = $upload_data['file_name'];
                $data1['ProfilePic1'] = $upload_data1['file_name'];
                $this->session->set_userdata($data1);
            }
        }
    }

    function _create_thumbnailv($filevName, $width, $height) {

        $upload_conf = array(
            'upload_path' => realpath('./upload/category/'),
            'allowed_types' => 'gif|jpg|jpeg|png|bmp',
            'encrypt_name' => true,
        );

        $this->load->library('upload');
        $this->upload->initialize($upload_conf);
        $field_name = 'VideoPic';

        if (!$this->upload->do_upload('file_vname', '')) {

            $error['upload'] = $this->upload->display_errors();
        } else {

            $upload_data = $this->upload->data();
            // print_r($upload_data);
            $resize_conf = array(
                'upload_path' => realpath('./upload/category/vthumb/'),
                'source_image' => $upload_data['full_path'],
                'new_image' => $upload_data['file_path'] . '/vthumb/' . $upload_data['file_name'],
                'width' => $width,
                'height' => $height);

            $this->load->library('image_lib');
            $this->image_lib->initialize($resize_conf);


            // do it!
            if (!$this->image_lib->resize()) {
                // if got fail.
                $error['resize'] = $this->image_lib->display_errors();
            } else {
                $upload_data1 = $this->upload->data();
                $resize_conf1 = array(
                    'upload_path' => realpath('./upload/category/vthumb2/'),
                    'source_image' => $upload_data1['full_path'],
                    'new_image' => $upload_data1['file_path'] . '/vthumb2/' . $upload_data1['file_name'],
                    'width' => 200,
                    'height' => 200);

                $this->load->library('image_lib');
                $this->image_lib->initialize($resize_conf1);
                $this->image_lib->resize();
                $data_to_store['VideoPic'] = $upload_data['file_name'];
                $data1['VideoPic'] = $upload_data['file_name'];
                $data1['VideoPic1'] = $upload_data1['file_name'];
                $this->session->set_userdata($data1);
            }
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
                        $favorite = $this->get('is_favorite');
                        foreach ($user_data as $k => $v) {
                            //  'gif|jpg|png|jpeg|bmp|webp|3gp|mp4|webm|mkv'
                            if ($user_data[$k]['type'] == '.jpg' || $user_data[$k]['type'] == '.jpeg' || $user_data[$k]['type'] == '.gif' || $user_data[$k]['type'] == '.png' || $user_data[$k]['type'] == '.bmp' || $user_data[$k]['type'] == 'jpg' || $user_data[$k]['type'] == 'jpeg' || $user_data[$k]['type'] == 'gif' || $user_data[$k]['type'] == 'png' || $user_data[$k]['type'] == 'bmp') {
                                $type = 'image';
                                //$thumnailurl = base_url() . MEDIAPATH . $user_data[$k]['name'];
                                $thumnailurl = MEDIAPATH5 . $user_data[$k]['image_thumb1'];
                            }
                            if ($user_data[$k]['type'] == '.webp' || $user_data[$k]['type'] == '.3gp' || $user_data[$k]['type'] == '.mp4' || $user_data[$k]['type'] == '.webm' || $user_data[$k]['type'] == '.mkv' || $user_data[$k]['type'] == 'webp' || $user_data[$k]['type'] == '3gp' || $user_data[$k]['type'] == 'mp4' || $user_data[$k]['type'] == 'webm' || $user_data[$k]['type'] == 'mkv') {
                                $type = 'video';
                                if($user_data[$k]['video_thumb1'])
                                    $thumnailurl = MEDIAPATH7 . $user_data[$k]['video_thumb1'];
                                    else
                                $thumnailurl = base_url() . MEDIAPATH1;
                            }
                            //$url=base_url() . MEDIAPATH . $user_data[$k]['name'];
                            $url = MEDIAPATH3 . $user_data[$k]['name'];
                            $num = $this->file_model->get_favorite($user_data[$k]['id'], $childid);

                            if ($num > 0)
                                $is_favorite = true;
                            else
                                $is_favorite = false;
                            if ($favorite == 1) {
                                $user_data1[] = array('id' => $user_data[$k]['id'],
                                    "type" => $type,
                                    "medianame" => $user_data[$k]['name'],
                                    "add_date" => date("F d Y H:i:s", strtotime($user_data[$k]['add_date'])),
                                    "url" => base_url() . MEDIAPATH . $user_data[$k]['name'],
                                    "thumbnailUrl" => $thumnailurl,
                                    "device_id" => $user_data[$k]['device_id'],
                                    "is_favorite" => $is_favorite
                                );
                            } else {
                                $user_data1[] = array('id' => $user_data[$k]['id'],
                                    "type" => $type,
                                    "medianame" => $user_data[$k]['name'],
                                    "add_date" => date("F d Y H:i:s", strtotime($user_data[$k]['add_date'])),
                                    "url" => $url,
                                    "thumbnailUrl" => $thumnailurl,
                                    "device_id" => $user_data[$k]['device_id']);
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

    public function favorite_get($userId = 0) {

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

            /* limit calculate */
            $limit = RECORD_LIMIT;
            $pageNo = $this->get('page');
            // GET PAGE AND OFFSET VALUE
            if ($pageNo > 0) {
                $page = $pageNo - 1;
                $offset = $page * $limit;
            } else {
                $page = 0;
                $offset = 0;
            }

            // COUNT TOTAL NUMBER OF ROWS IN TABLE

            $total_rows = $this->file_model->get_userfavorite_count($userId);

            // DETERMINE NUMBER OF PAGES
            if ($total_rows > $limit) {
                $number_of_pages = ceil($total_rows / $limit);
                $pages = $pageNo;
            } else {
                $pages = 1;
                $number_of_pages = 1;
            }
            /* limit calculate */
            if ($userId) {

                $filter['d.user_id'] = $userId;
                $user_data = $this->file_model->get_userfavorite($fields, $page = null, 1, $filter);
            } else if ($this->get('user_id')) {

                $filter['d.user_id'] = $this->get('user_id');
                //$user_data = $this->file_model->get_userfavorite1($offset, $limit, $filter);
                // $numData =count($user_data);
                $user_data = $this->file_model->get_userfavorite($fields, $page = null, 1, $filter);
                $numData = $this->file_model->get_userfavorite_count($fields, $page = null, 1, $filter);
            } else if ($this->get("filter") || $this->get("order")) {
                $this->load->library("query_generator");
                if ($this->get("filter"))
                    $this->query_generator->setfilters($this->get("filter"));
                if ($this->get("order"))
                    $this->query_generator->setOrder($this->get("order"));
                $filters = $this->query_generator->getFilter();

                $user_data = $this->file_model->get_userfavorite($fields, $page, $limit, $filters, $this->query_generator->getLike(), $this->query_generator->getOrder()
                );
            } else {
                $user_data = $this->file_model->get_userfavorite($fields, $page, $limit);
            }
            if (!empty($user_data)) {
                if ($this->get('user_id') && !empty($user_data)) {
                    // $user_data1 = $this->file_model->get_device_parent($this->get('id'));
                    // $user_data2 = $this->file_model->get_device_child($this->get('id'));
                    if (!empty($user_data)) {
                        $userID = $this->get('user_id');
                        $parentid = $this->get('parent_device_id');
                        $fav = '';
                        foreach ($user_data as $k => $v) {
                            $a = count($fav);
                            $fav = $this->file_model->get_favoritelist($user_data[$k]['user_id'], $user_data[$k]['device_id']);
                            $fav1 = array();
                            foreach ($fav as $k1 => $v1) {

                                if ($fav[$k1]['type'] == '.jpg' || $fav[$k1]['type'] == '.jpeg' || $fav[$k1]['type'] == '.gif' || $fav[$k1]['type'] == '.png' || $fav[$k1]['type'] == '.bmp' || $fav[$k1]['type'] == 'jpg' || $fav[$k1]['type'] == 'jpeg' || $fav[$k1]['type'] == 'gif' || $fav[$k1]['type'] == 'png' || $fav[$k1]['type'] == 'bmp') {
                                    $type = 'image';
                                    //$thumnailurl = base_url() . MEDIAPATH . $fav[$k1]['name'];
                                    $thumnailurl = MEDIAPATH5 . $fav[$k1]['image_thumb1'];
                                }
                                if ($fav[$k1]['type'] == '.webp' || $fav[$k1]['type'] == '.3gp' || $fav[$k1]['type'] == '.mp4' || $fav[$k1]['type'] == '.webm' || $fav[$k1]['type'] == '.mkv' || $fav[$k1]['type'] == 'webp' || $fav[$k1]['type'] == '3gp' || $fav[$k1]['type'] == 'mp4' || $fav[$k1]['type'] == 'webm' || $fav[$k1]['type'] == 'mkv') {
                                    $type = 'video';
                                     if($fav[$k1]['video_thumb1'])
                                    $thumnailurl = MEDIAPATH7 . $fav[$k1]['video_thumb1'];
                                    else
                                $thumnailurl = base_url() . MEDIAPATH1;
                                }

                                $url = MEDIAPATH3 . $fav[$k1]['name'];
                                $fav1[$k1] = array('id' => $fav[$k1]['fav_id'],
                                    "type" => $type,
                                    "medianame" => $fav[$k1]['name'],
                                    "add_date" => date("F d Y H:i:s", strtotime($fav[$k1]['add_date'])),
                                    "url" => MEDIAPATH3 . $fav[$k1]['name'],
                                    "thumbnailUrl" => $thumnailurl,
                                    "device_id" => $fav[$k1]['device_id']
                                );
                            }

                            $data1[] = array('childID' => $user_data[$k]['device_id'],
                                "child_name" => $user_data[$k]['device_name'],
                                "data" => $fav1
                            );
                        }
                        $message = set_response_message_fmedia('success', $userID, $parentid, "Media found successfully.", $data1, $numData, REST_Controller::HTTP_OK);
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

    public function favorite_post() {
        $favid = $this->post('fav_id');

        if ($favid <= 0) {
            $message = set_response_message('fail', "Bad Request", [], 0, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            try {
                $returnData = $this->file_model->delete_favorite($favid);
                if ($returnData > 0) {
                    $user_data1 = array('fav_id' => $favid);

                    $message = set_response_message('success', 'favorite media deleted successfully', $user_data1, 1, REST_Controller::HTTP_OK);
                } else {
                    $message = set_response_message('fail', 'favorite media already deleted', [], 0, REST_Controller::HTTP_OK);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
            $this->set_response($message, $message['status_code']);
        }
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

                    $message = set_response_message('success', 'media deleted successfully', $user_data1, 1, REST_Controller::HTTP_OK);
                } else {
                    $message = set_response_message('fail', 'Internal server error while deleting media', [], 0, REST_Controller::HTTP_OK);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
            $this->set_response($message, $message['status_code']);
        }
    }

}
