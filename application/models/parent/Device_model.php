<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Device_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_media($id = 0, $limit, $start, $filterData, $sortData = "") {

        $this->db->select('media.*,media.created_date as date,address.email,media.id as id');
        $this->db->from(USERSDEVICE . ' as media');
        $this->db->join(USERS . ' as address', 'address.id = media.user_id', 'left');
        $this->db->where('user_type', 'p');
        $this->db->where('media.user_id', $this->session->userdata['ud']['adminid']);
        if (!is_array($sortData) || ($sortData['sort_by'] == "" && $sortData['sort_direction'] == ""))
            $this->db->order_by('media.created_date', 'desc');
        else
            $this->db->order_by($sortData['sort_by'], $sortData['sort_direction']);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_count_media($filterData = array()) {

        $this->db->from(USERSDEVICE . ' as media');
        $this->db->join(USERS . ' as address', 'address.id = media.user_id', 'left');
        $this->db->where('user_type', 'p');
        $this->db->where('media.user_id', $this->session->userdata['ud']['adminid']);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function get_mediadetails($offset, $limit, $userid) {

        $this->db->select('media.*,media.created_date as date,address.email');
        $this->db->from(USERSDEVICE . ' as media');
        $this->db->join(USERS . ' as address', 'address.id = media.user_id', 'inner');
        $this->db->where('user_type', 'c');
        $this->db->where('user_id', $userid);
        $this->db->limit($limit, $offset);
        $result = $this->db->get();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_devicedetail_count($userid) {
        $this->db->from(USERSDEVICE . ' as media');
        $this->db->join(USERS . ' as address', 'address.id = media.user_id', 'inner');
        $this->db->where('user_type', 'c');
        $this->db->where('user_id', $userid);
        $result = $this->db->get();
        return $result->num_rows();
    }

    public function get_devicemediadetails($offset, $limit, $userid, $type) {
        echo $type;
        $this->db->from(MEDIA . ' as media');
        if ($type == 'm') {
            $where = "(`media`.`type` LIKE '%jpg%' OR ";
            $where .= " `media`.`type` LIKE '%jpeg%' OR ";
            $where .= " `media`.`type` LIKE '%gif%' OR ";
            $where .= " `media`.`type` LIKE '%png%' OR  ";
            $where .= " `media`.`type` LIKE '%bmp%' ) ";
            $this->db->where($where);
        }
        if ($type == 'v') {

            $where = "(`media`.`type` LIKE '%mp4%' OR ";
            $where .= " `media`.`type` LIKE '%3gp%' OR ";
            $where .= " `media`.`type` LIKE '%mkv%' OR ";
            $where .= " `media`.`type` LIKE '%webp%' OR  ";
            $where .= " `media`.`type` LIKE '%webm%' ) ";
            $this->db->where($where);
        }
        $this->db->where('device_id', $userid);
         $this->db->where('status', "1");
        $this->db->limit($limit, $offset);
        $result = $this->db->get();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_devicemediadetail_count($userid, $type) {
        $this->db->from(MEDIA . ' as media');
        if ($type == 'm') {
            $where = "(`media`.`type` LIKE '%jpg%' OR ";
            $where .= " `media`.`type` LIKE '%jpeg%' OR ";
            $where .= " `media`.`type` LIKE '%gif%' OR ";
            $where .= " `media`.`type` LIKE '%png%' OR  ";
            $where .= " `media`.`type` LIKE '%bmp%' ) ";
            $this->db->where($where);
        }
        if ($type == 'v') {

            $where = "(`media`.`type` LIKE '%mp4%' OR ";
            $where .= " `media`.`type` LIKE '%3gp%' OR ";
            $where .= " `media`.`type` LIKE '%mkv%' OR ";
            $where .= " `media`.`type` LIKE '%webp%' OR  ";
            $where .= " `media`.`type` LIKE '%webm%' ) ";
            $this->db->where($where);
        }
        $this->db->where('device_id', $userid);
        $this->db->where('status', "1");
        $result = $this->db->get();

        return $result->num_rows();
    }

    public function get_devicefavorite($limit, $start, $userid) {
        $this->db->from(FAVORITE . ' as f');
        $this->db->join(MEDIA . ' as m', 'm.id = f.media_id', 'inner');

        $this->db->where('child_id', $userid);
        $this->db->limit($start, $limit);
        $result = $this->db->get();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_devicefavorite_count($userid) {
        $this->db->from(FAVORITE . ' as f');
        $this->db->join(MEDIA . ' as m', 'm.id = f.media_id', 'inner');
        $this->db->where('child_id', $userid);
        $result = $this->db->get();

        return $result->num_rows();
    }

    public function get_device_name($device_id = 0) {
        $this->db->from(USERSDEVICE . ' as d');
        //$this->db->join(STOREDETAILS . ' as address', 'address.store_id = media.token', 'left');
        $this->db->where('d.device_id', $device_id);
        $this->db->where('d.user_id', $this->session->userdata['ud']['adminid']);
        $result = $this->db->get();

        return $result->result_array();
    }
     public function get_favorite($media_id) {
        $filter['media_id'] = $media_id;
         $filter['status'] = '1';
        $this->db->from(FAVORITE);
        $this->db->where($filter);
        $result = $this->db->get();
        return $num = $result->num_rows();
    }

}
?>

