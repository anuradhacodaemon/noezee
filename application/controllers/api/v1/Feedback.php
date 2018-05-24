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
class Feedback extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('feedback_model');
    }

    public function index_post() {
        $is_valid = validate($this->config->item('feedback_insert_rules'));
        if ($is_valid) {
            foreach ($this->post() as $key => $value) {
                $userData[$key] = $value;
            }

            $userData['created_date'] = date("Y-m-d H:i:s");
            $userData['status'] = 1;

            try {
                $userId = $this->feedback_model->addfeedback($userData); // register technician Record
                if ($userId > 0) {


                    $filter['id'] = $userId;
                    $fields = '';
                    $user_data2 = $this->feedback_model->get_user($fields, $page = null, 1, $filter);


                    $user_data1 = array('user_id' => $user_data2[0]['user_id'],
                        "content" => $user_data2[0]['content']
                    );

                    $message = set_response_message('success', ' Feedback added successfully.', $user_data1, count($user_data2), REST_Controller::HTTP_CREATED);
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

    public function index_delete($userId) {

        if ($userId <= 0 || $userId == '') {
            $message = set_response_message('fail', "Bad Request", [], 0, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            try {
                $returnData = $this->feedback_model->delete_user($userId);
                if ($returnData > 0) {
                    $message = set_response_message('success', 'Feedback deleted successfully', [], 0, REST_Controller::HTTP_OK);
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
