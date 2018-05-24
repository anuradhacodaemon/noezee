<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

/**
 * <h1>Favorite!</h1>
 * The Favorite controller is used to perform all media related operations
 * like add/edit/delete/view/etc. Mainly function under this class return JSON string.
 * <p>
 * <b>Note:</b> This class may be improved to return result in different format like array.
 *
 * @author  Anuradha Chakraborti
 * @version 1.0
 * @see
 * @since   2017-12-17
 */
class Favorite extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('favorite_model');
    }

    public function index_get($mediaId = 0) {

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

            if ($mediaId) {
                $filter['media_id'] = $mediaId;
                $media_data = $this->favorite_model->get_media($fields, $page = null, 1, $filter);
            } else if ($this->get("filter") || $this->get("order")) {
                $this->load->library("query_generator");
                if ($this->get("filter"))
                    $this->query_generator->setfilters($this->get("filter"));
                if ($this->get("order"))
                    $this->query_generator->setOrder($this->get("order"));
                $filters = $this->query_generator->getFilter();
                
                $media_data = $this->favorite_model->get_media($fields, $page, $limit, $filters, $this->query_generator->getLike(), $this->query_generator->getOrder()
                );
            } else {
                $media_data = $this->favorite_model->get_media($fields, $page, $limit);
            }
            if (isset($filters) && (array_key_exists('media_password', $filters) && array_key_exists('medianame', $filters)) && (empty($filters['medianame']) || empty($filters['media_password']))) {
                $message = set_response_message('fail', 'Please Fill All Mandatory Fields', [], 0, REST_Controller::HTTP_BAD_REQUEST);
            } else if (!empty($media_data)) {

                if ($this->get('user_id') ) {
                    $filter['user_id'] = $this->get('user_id');
                    
                    $media_data = $this->favorite_model->get_media($fields, $page = null, 1, $filter);
                    if (!empty($media_data)) {
                        $message = set_response_message('success', "Favorite media found successfully.", $media_data, count($media_data), REST_Controller::HTTP_OK);
                    } else {
                        $message = set_response_message('fail', 'No media found', $media_data, count($media_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    }
                } else {


                    $message = set_response_message('success', "User found successfully.", $media_data, count($media_data), REST_Controller::HTTP_OK);
                }
            } else {
                $message = set_response_message('fail', 'No media found', $media_data, count($media_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), $media_data, count($media_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function index_post() {
        $is_valid = validate($this->config->item('favorite_insert_rules'));
        if ($is_valid) {
            foreach ($this->post() as $key => $value) {
                $mediaData[$key] = $value;
            }

            $mediaData['created_date'] = date("Y-m-d H:i:s");
            $mediaData['status'] = 1;

            try {
                $mediaId = $this->favorite_model->register_media($mediaData); // register technician Record
                if ($mediaId > 0) {


                    $filter['fav_id'] = $mediaId;
                    $fields = '';
                    $media_data2 = $this->favorite_model->get_media($fields, $page = null, 1, $filter);

                    $message = set_response_message('success', 'Favorite media added successfully.', $media_data2[0], count($media_data2), REST_Controller::HTTP_CREATED);
                } else {
                    $message = set_response_message('fail', 'Internal server error while adding media.', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), array($mediaData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $message = set_response_message('fail', validation_errors(), [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function index_put() {
        foreach ($this->put() as $key => $value) {
            $mediaData[$key] = $value;
        }
        $mediaId=$mediaData['fav_id'];
        unset($mediaData['fav_id']);
        try {
            $update = $this->favorite_model->update_media($mediaId, $mediaData); // update client Record
            if ($update) {
                $filter['media_id'] = $mediaId;
                $mediaRecord = $this->favorite_model->get_media('*', $page = null, 1, $filter);
                $message = set_response_message('success', "Favorite media updated successfull", $mediaRecord, count($mediaRecord), REST_Controller::HTTP_OK);
            } else {
                $message = set_response_message('fail', "Internal server error while updating media", [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), array($mediaData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function index_delete($mediaId) {

        if ($mediaId <= 0 || $mediaId == '') {
            $message = set_response_message('fail', "Bad Request", [], 0, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            try {
                $returnData = $this->favorite_model->delete_media($mediaId);
                if ($returnData > 0) {
                    $message = set_response_message('success', 'Favorite media deleted successfully', [], 0, REST_Controller::HTTP_OK);
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
