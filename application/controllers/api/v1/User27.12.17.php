<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

/**
 * <h1>User!</h1>
 * The User controller is used to perform all user related operations
 * like add/edit/delete/view/etc. Mainly function under this class return JSON string.
 * <p>
 * <b>Note:</b> This class may be improved to return result in different format like array.
 *
 * @author  Anuradha Chakraborti
 * @version 1.0
 * @see
 * @since   2017-12-17
 */
class User extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function index_get($userId = 0) {

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

            if ($userId) {
                $filter['user_id'] = $userId;
                $user_data = $this->user_model->get_user($fields, $page = null, 1, $filter);
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
                $user_data = $this->user_model->get_user($fields, $page, $limit, $filters, $this->query_generator->getLike(), $this->query_generator->getOrder()
                );
            } else {
                $user_data = $this->user_model->get_user($fields, $page, $limit);
            }
            if (isset($filters) && (array_key_exists('user_password', $filters) && array_key_exists('username', $filters)) && (empty($filters['username']) || empty($filters['user_password']))) {
                $message = set_response_message('fail', 'Please Fill All Mandatory Fields', [], 0, REST_Controller::HTTP_BAD_REQUEST);
            } else if (!empty($user_data)) {
                /* if ($filters['user_password']) {


                  $user_data1 = array('id' => $user_data[0]['id'],
                  "username" => $user_data[0]['username'],
                  "email" => $user_data[0]['email'],
                  "device_id" => $user_data[0]['device_id']);
                  $message = set_response_message('success', "User found successfully.", $user_data1, count($user_data), REST_Controller::HTTP_OK);
                  } else { */
                if ($this->get('email') && $this->get('user_password')) {
                    $filter['email'] = $this->get('email');
                    $filter['user_password'] = md5($this->get('user_password'));
                    $user_data = $this->user_model->get_user($fields, $page = null, 1, $filter);
                    if (!empty($user_data)) {
                        $message = set_response_message('success', "User found successfully.", $user_data, count($user_data), REST_Controller::HTTP_OK);
                    } else {
                        $message = set_response_message('fail', 'No user found', $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    }
                } else {


                    $message = set_response_message('success', "User found successfully.", $user_data, count($user_data), REST_Controller::HTTP_OK);
                }

                /* } */
            } else {
                $message = set_response_message('fail', 'No user found', $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function index_post() {
        $is_valid = validate($this->config->item('user_insert_rules'));
        if ($is_valid) {
            foreach ($this->post() as $key => $value) {
                $userData[$key] = $value;
            }

            $userData['created_date'] = date("Y-m-d H:i:s");
            $userData['status'] = 1;
            $userData['user_password'] = md5($userData['user_password']);
            try {
                $userId = $this->user_model->register_user($userData); // register technician Record
                if ($userId > 0) {

                    //$userData['user_id'] = $userId;
                    /* $userData = array($userData);
                      $user_data1 = array('id' => $userId,
                      "username" => $userData['username'],
                      "user_password" => $userData['user_password'],
                      "email" => $userData['email']
                      ); */
                    $filter['id'] = $userId;
                    $fields = '';
                    $user_data2 = $this->user_model->get_user($fields, $page = null, 1, $filter);
                    /** $message = set_response_message('success', 'User added successfully.', array('id' => $userId,
                      "username" => $userData['username'],
                      "user_password" => $userData['user_password'],
                      "email" => $userData['email']), count($userData), REST_Controller::HTTP_CREATED);
                     * */
                    $message = set_response_message('success', 'User added successfully.', $user_data2, count($user_data2), REST_Controller::HTTP_CREATED);
                } else {
                    $message = set_response_message('fail', 'Internal server error while adding user.', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), array($userData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $message = set_response_message('fail', validation_errors(), [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function index_put($userId = 0) {
        foreach ($this->put() as $key => $value) {
            $userData[$key] = $value;
        }
        if ($userData['user_password'] == '') {
            $userData['user_password'] = $userData['hidden_password'];
        } else {
            $userData['user_password'] = md5($userData['user_password']);
        }
        unset($userData['hidden_password']);
        try {
            $update = $this->user_model->update_user($userId, $userData); // update client Record
            if ($update) {
                $filter['user_id'] = $userId;
                $userRecord = $this->user_model->get_user('*', $page = null, 1, $filter);
                $message = set_response_message('success', "Dispatcher updated successfull", $userRecord, count($userRecord), REST_Controller::HTTP_OK);
            } else {
                $message = set_response_message('fail', "Internal server error while updating user", [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), array($userData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function index_delete($userId) {

        if ($userId <= 0 || $userId == '') {
            $message = set_response_message('fail', "Bad Request", [], 0, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            try {
                $returnData = $this->user_model->delete_user($userId);
                if ($returnData > 0) {
                    $message = set_response_message('success', 'user deleted successfully', [], 0, REST_Controller::HTTP_OK);
                } else {
                    $message = set_response_message('fail', 'Internal server error while deleting user', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
            $this->set_response($message, $message['status_code']);
        }
    }

    public function userdevice_post() {
        $is_valid = validate($this->config->item('user_device_rules'));
        if ($is_valid) {
            foreach ($this->post() as $key => $value) {
                $userData[$key] = $value;
            }

            $userData['created_date'] = date("Y-m-d H:i:s");
            $userData['status'] = 1;
            //$userData['userid'] = $this->post('user_id');
            try {
                $userId = $this->user_model->register_userdevice($userData); // register technician Record
                if ($userId > 0) {
                    //$userData['userid'] = $this->post('user_id');
                    $userData = array($userData);
                    $message = set_response_message('success', 'User device added successfully.', $userData, count($userData), REST_Controller::HTTP_CREATED);
                } else {
                    $message = set_response_message('fail', 'Internal server error while adding user.', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), array($userData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $message = set_response_message('fail', validation_errors(), [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function userdevice_get($userId) {
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

            if ($userId) {
                $filter['userid'] = $userId;
                $user_data = $this->user_model->get_device($fields, $page = null, 1, $filter);
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
                $user_data = $this->user_model->get_device($fields, $page, $limit, $filters, $this->query_generator->getLike(), $this->query_generator->getOrder()
                );
            } else {
                $user_data = $this->user_model->get_device($fields, $page, $limit);
            }
            if (isset($filters) && (array_key_exists('user_password', $filters) && array_key_exists('username', $filters)) && (empty($filters['username']) || empty($filters['user_password']))) {
                $message = set_response_message('fail', 'Please Fill All Mandatory Fields', [], 0, REST_Controller::HTTP_BAD_REQUEST);
            } else if (!empty($user_data)) {

                if ($filters['user_password']) {


                    $user_data1 = array('id' => $user_data[0]['id'],
                        "username" => $user_data[0]['username'],
                        "email" => $user_data[0]['email'],
                        "device_id" => $user_data[0]['device_id']);
                    $message = set_response_message('success', "User found successfully.", $user_data1, count($user_data), REST_Controller::HTTP_OK);
                } else {
                    $message = set_response_message('success', "User found successfully.", $user_data, count($user_data), REST_Controller::HTTP_OK);
                }
            } else {
                $message = set_response_message('fail', 'No user found', $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

}
