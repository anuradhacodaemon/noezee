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

        $Json = '{
   
    "received_parent_id": "5D1CEE6B-77D3-444E-8B33-CB8589CD3352",
    "data":[ {
        "sent_user_address": "919960707890",
        "received_user_address": "919455096071",
        "content": "hello",
        "recevied_date": "2018-06-02 05:48:06",
        "date_sent": "2018-05-02 23:48:04",
        "received_parent_id": "5D1CEE6B-77D3-444E-8B33-CB8589CD3352",
        "currentdate": "2018-06-02",
        "currenttime": "05:48:06",
        "status": 1
    },
    {
        "sent_user_address": "919960707890",
        "received_user_address": "919455096071",
        "content": "hello",
        "recevied_date": "2018-06-02 05:48:06",
        "date_sent": "2018-05-02 23:48:04",
        "received_parent_id": "5D1CEE6B-77D3-444E-8B33-CB8589CD3352",
        "currentdate": "2018-06-02",
        "currenttime": "05:48:06",
        "status": 1
    }]
}';
        $json = file_get_contents('php://input');
        //var_dump(json_decode($json));
        $array = json_decode($json);
        foreach ($array->data as $k => $v) {
            print_r($v->sent_user_address);
            echo '<br>';
            
            //var_dump(json_decode($v)); 
        }

        die;

        $is_valid = validate($this->config->item('message_insert_rules'));


        if ($is_valid) {
            foreach ($this->post() as $key => $value) {
                $userData[$key] = $value;
            }

            $userData['recevied_date'] = gmdate("Y-m-d H:i:s ", $userData['recevied_date'] / 1000);
            $userData['date_sent'] = date("Y-m-d H:i:s", $userData['date_sent'] / 1000);
            $rd = $this->ConvertGMTToLocalTimezone($userData['recevied_date'], TIMEZONE);
            $userData['recevied_date'] = date('Y-m-d H:i:s', strtotime($rd));
            $sd = $this->ConvertGMTToLocalTimezone($userData['date_sent'], TIMEZONE);
            $userData['date_sent'] = date('Y-m-d H:i:s', strtotime($sd));

            $userData['currentdate'] = date("Y-m-d", strtotime($userData['recevied_date']));
            $userData['currenttime'] = date("H:i:s", strtotime($userData['recevied_date']));
            $userData['status'] = 1;
//echo date_default_timezone_get();
//die;

            try {
                $userId = $this->message_model->addfeedback($userData); // register technician Record
                if ($userId > 0) {


                    $filter['msg_id'] = $userId;
                    $fields = '';
                    //$user_data2 = $this->message_model->get_message($fields, $page = null, 1, $filter);


                    /* $user_data1 = array('sent_user_address' => $user_data2[0]['sent_user_address'],
                      'received_user_address' => $user_data2[0]['received_user_address'],
                      "content" => $user_data2[0]['content']
                      );

                     */

                    $message = set_response_message('success', ' Message added successfully.', $userData, 1, REST_Controller::HTTP_CREATED);
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

    public function ConvertGMTToLocalTimezone($gmttime, $timezoneRequired) {
        $system_timezone = date_default_timezone_get();
        date_default_timezone_set("GMT");
        $gmt = date("Y-m-d h:i:s A");
        $local_timezone = $timezoneRequired;
        date_default_timezone_set($local_timezone);
        $local = date("Y-m-d h:i:s A");
        date_default_timezone_set($system_timezone);
        $diff = (strtotime($local) - strtotime($gmt));
        $date = new DateTime($gmttime);
        $date->modify("+$diff seconds");
        $timestamp = $date->format("m-d-Y H:i:s");
        return $timestamp;
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


            $filter['sent_user_address'] = $this->post('sent_user_address');
            $user_data = $this->message_model->get_senderlist($fields, $page, $limit, $filter, '', '');

            if (!empty($user_data)) {

                foreach ($user_data as $k => $v) {

                    //$user_data2 = $this->message_model->get_user($user_data[$k]['received_user_address']);
                    $user_data1[] = array('user_id' => $user_data[$k]['received_user_address']
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


            $filter['sent_user_id'] = $this->post('received_user_address'); // login user
            $user_data = $this->message_model->get_receviedlist($this->post('received_user_address'));

            if (!empty($user_data)) {

                foreach ($user_data as $k => $v) {
                    $user_data3 = '';
                    $date = $this->get_day_name($user_data[$k]['currentdate']);

                    $user_data2 = $this->message_model->get_receviedmessage($this->post('received_user_id'), $user_data[$k]['currentdate']);

                    foreach ($user_data2 as $k1 => $v1) {
                        $user_data3[] = array('content' => $user_data2[$k1]['content'],
                            'email' => $user_data2[$k1]['email'],
                            'time' => date('H:i:s A', strtotime($user_data2[$k1]['currenttime']))
                        );
                    }

                    $user_data1[] = array('Date' => $date,
                        'Message' => $user_data3
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

                    $user_data2 = $this->message_model->get_sendermessage($this->post('sent_user_id'), $user_data[$k]['currentdate']);

                    foreach ($user_data2 as $k1 => $v1) {
                        $user_data2[] = array('content' => $user_data2[$k1]['content'],
                            'email' => $user_data2[$k1]['email'],
                            'time' => date('H:i:s A', strtotime($user_data2[$k1]['currenttime']))
                        );
                    }

                    $user_data1[] = array('Date' => $date,
                        'Message' => $user_data2
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
        } else if ($date == date('Y-m-d', date("Y-m-d H:i:s") - (24 * 60 * 60))) {
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
