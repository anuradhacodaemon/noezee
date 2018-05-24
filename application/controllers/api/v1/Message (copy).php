<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

/**
 * <h1>Feedback!</h1>
 * The Feedback controller is used to perform all user related operations
 * like add/edit/delete/view/etc. Mainly function under this class return JSON string.
 * <p>
 * <b>Note:</b> This class may be improved to return result in different format like array.
 *
 * @author  Anuradha Chakraborti
 * @version 1.0
 * @see
 * @since   2017-12-17
 */
class Message extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('message_model');
    }

    public function index_post() {
        $is_valid = validate($this->config->item('message_insert_rules'));
        if ($is_valid) {
            foreach ($this->post() as $key => $value) {
                $userData[$key] = $value;
            }

            $userData['created_date'] = date("Y-m-d H:i:s");
            $userData['currentdate'] = date("Y-m-d");
            $userData['currenttime'] = date("H:i:s");
            $userData['status'] = 1;

            try {
                $userId = $this->message_model->addfeedback($userData); // register technician Record
                if ($userId > 0) {


                    $filter['msg_id'] = $userId;
                    $fields = '';
                    $user_data2 = $this->message_model->get_message($fields, $page = null, 1, $filter);


                    $user_data1 = array('sent_user_id' => $user_data2[0]['sent_user_id'],
                        'received_user_id' => $user_data2[0]['received_user_id'],
                        "content" => $user_data2[0]['content']
                    );

                    $message = set_response_message('success', ' Message added successfully.', $user_data1, count($user_data2), REST_Controller::HTTP_CREATED);
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

    public function senderlist_post($userId = 0) {

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


            $filter['sent_user_id'] = $this->post('sent_user_id');
            $user_data = $this->message_model->get_senderlist($fields, $page, $limit, $filter, '', '');

            if (!empty($user_data)) {

                foreach ($user_data as $k => $v) {

                    $user_data2 = $this->message_model->get_user($user_data[$k]['received_user_id']);
                    $user_data1[] = array('user_id' => $user_data[$k]['received_user_id'],
                        "email" => $user_data2[0]['email']
                    );
                }

                $message = set_response_message('success', 'User found successfully.', $user_data1, count($user_data), REST_Controller::HTTP_OK);

                /* } */
            } else {
                $message = set_response_message('fail', 'No user found', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }
    
     public function receviedlist_post($userId = 0) {

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


            $filter['sent_user_id'] = $this->post('received_user_id'); // login user
            $user_data = $this->message_model->get_receviedlist($this->post('received_user_id'));

            if (!empty($user_data)) {
                 
                foreach ($user_data as $k => $v) {
                    $user_data3 ='';
                    $date = $this->get_day_name($user_data[$k]['currentdate']);

                    $user_data2 = $this->message_model->get_receviedmessage($this->post('received_user_id'),$user_data[$k]['currentdate']);
                    
                    foreach ($user_data2 as $k1 => $v1) {
                        $user_data3[] = array('content' => $user_data2[$k1]['content'],
                                'email' => $user_data2[$k1]['email'],
                            'time' => date('H:i:s A',strtotime($user_data2[$k1]['currenttime']))
                    ); 
                    }
                    
                    $user_data1[] = array('Date' => $date,
                                           'Message'=> $user_data3
                    );
                
                }

                $message = set_response_message('success', 'User message found successfully.', $user_data1, count($user_data), REST_Controller::HTTP_OK);

                /* } */
            } else {
                $message = set_response_message('fail', 'No user  message found', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function sendermessage_post($userId = 0) {
        $this->load->helper('date');
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



            $user_data = $this->message_model->get_senderdate($this->post('sent_user_id'));

            if (!empty($user_data)) {

                foreach ($user_data as $k => $v) {
                    $date = $this->get_day_name($user_data[$k]['currentdate']);

                    $user_data2 = $this->message_model->get_sendermessage($this->post('sent_user_id'),$user_data[$k]['currentdate']);
                    
                    foreach ($user_data2 as $k1 => $v1) {
                        $user_data2[] = array('content' => $user_data2[$k1]['content'],
                                'email' => $user_data2[$k1]['email'],
                            'time' => date('H:i:s A',strtotime($user_data2[$k1]['currenttime']))
                    ); 
                    }
                    
                    $user_data1[] = array('Date' => $date,
                                           'Message'=> $user_data2
                    );
                }

                $message = set_response_message('success', 'User message found successfully.', $user_data1, count($user_data), REST_Controller::HTTP_OK);

                /* } */
            } else {
                $message = set_response_message('fail', 'No user message found', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function get_day_name($timestamp) {
        
        $date = $timestamp;

        if ($date == date('Y-m-d')) {
            $date = 'Today';
        } else if ($date == date('Y-m-d',date("Y-m-d H:i:s") - (24 * 60 * 60))) {
            $date = 'Yesterday';
        } else
            $date = date('M d Y', strtotime($timestamp));
        return $date;
    }

    public function index_delete($userId) {

        if ($userId <= 0 || $userId == '') {
            $message = set_response_message('fail', "Bad Request", [], 0, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            try {
                $returnData = $this->message_model->delete_user($userId);
                if ($returnData > 0) {
                    $message = set_response_message('success', 'Message deleted successfully', [], 0, REST_Controller::HTTP_OK);
                } else {
                    $message = set_response_message('fail', 'Internal server error while deleting user', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
            $this->set_response($message, $message['status_code']);
        }
    }

}
