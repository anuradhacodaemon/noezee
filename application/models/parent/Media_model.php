<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Media_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_media($id = 0, $limit, $start, $filterData, $sortData = "") {

        $this->db->select('d.created_date as date,d.device_name as device_name,d.device_id as device_id');
        $this->db->from(USERSDEVICE . ' as d');
        //$this->db->join(USERS . ' as address', 'address.id = m.user_id', 'left');
        // $this->db->join(MEDIA . ' as m', 'd.device_id = m.device_id', 'inner');
        $this->db->where('d.user_id', $this->session->userdata['ud']['adminid']);
        //$this->db->where('d.status', '1');
        $this->db->where('d.user_type', 'C');
        if (!is_array($sortData) || ($sortData['sort_by'] == "" && $sortData['sort_direction'] == ""))
            $this->db->order_by('d.device_name', 'desc');
        else
            $this->db->order_by($sortData['sort_by'], $sortData['sort_direction']);


        $this->db->limit($limit, $start);
        $result = $this->db->get();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_count_media($filterData = array()) {

        $this->db->from(USERSDEVICE . ' as d');
        //$this->db->join(MEDIA . ' as m', 'd.device_id = m.device_id', 'inner');
        //$this->db->join(USERS . ' as address', 'address.id = m.user_id', 'left');
        //$this->db->join(MEDIA . ' as d', 'd.device_id = m.device_id', 'left');
        $this->db->where('d.user_id', $this->session->userdata['ud']['adminid']);
        //$this->db->where('d.status', '1');
        $this->db->where('d.user_type', 'C');
        $result = $this->db->get();
       // echo $result->num_rows();
        return $result->num_rows();
    }

    public function get_mediadevice($offset, $limit, $filterData) {
        $filter['media.device_id'] = $filterData['device_id'];
        $filter['media.status'] = "1";
        $this->db->select('media.*,media.add_date as date,address.email,media.id as id,media.status as status');
        $this->db->from('neo_media' . ' as media');
        $this->db->join(USERS . ' as address', 'address.id = media.user_id', 'left');
        //$this->db->join(USERSDEVICE . ' as d', 'd.device_id = media.device_id', 'left');

        $this->db->where('media.user_id', $this->session->userdata['ud']['adminid']);
        $this->db->where($filter);
        
        $this->db->limit($limit, $offset);
        $this->db->order_by('media.add_date', 'desc');
        $result = $this->db->get();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_count_mediadevice($filterData = array()) {
        $filter['media.device_id'] = $filterData['device_id'];
        $filter['media.status'] = "1";
        $this->db->from('neo_media' . ' as media');
        $this->db->join(USERS . ' as address', 'address.id = media.user_id', 'left');
        // $this->db->join(USERSDEVICE . ' as d', 'd.device_id = media.device_id', 'left');

        $this->db->where('media.user_id', $this->session->userdata['ud']['adminid']);
        $this->db->where($filter);

        $result = $this->db->get();

        return $result->num_rows();
    }

    public function get_devicemedia($userid) {
        $this->db->from(MEDIA . ' as media');
        $this->db->where('device_id', $userid);
        $this->db->where('media.user_id', $this->session->userdata['ud']['adminid']);
        //$this->db->where('media.status', '1');
        $where = "(`media`.`type` LIKE '%jpg%' OR ";
        $where .= " `media`.`type` LIKE '%jpeg%' OR ";
        $where .= " `media`.`type` LIKE '%gif%' OR ";
        $where .= " `media`.`type` LIKE '%png%' OR  ";
        $where .= " `media`.`type` LIKE '%bmp%' ) ";
        $this->db->where($where);
        $this->db->limit(10, 0);
        $result = $this->db->get();
       // echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_mediadetails($mediaId = 0) {
        $this->db->from('neo_media' . ' as media');
        //$this->db->join(STOREDETAILS . ' as address', 'address.store_id = media.token', 'left');
        $this->db->where('media.id', $mediaId);
        $result = $this->db->get();

        return $result->result_array();
    }

    public function get_device_name($device_id = 0) {
        $this->db->from(USERSDEVICE . ' as d');
        //$this->db->join(STOREDETAILS . ' as address', 'address.store_id = media.token', 'left');
        $this->db->where('d.device_id', $device_id);
        $this->db->where('d.user_id', $this->session->userdata['ud']['adminid']);
        $result = $this->db->get();

        return $result->result_array();
    }

    public function edit_media($mediaid, $apk, $apk_path, $status) {
        $userData['apk'] = $apk;
        $userData['apk_path'] = $apk_path;
        $userData['confirm_status'] = $status;
        $this->db->where("store_id", $mediaid);
        $this->db->update(STOREDETAILS, $userData);
        return $mediaid;
    }

    public function inactive_category($Id) {
        $fileData['status'] = '0';
        $this->db->where('id', $Id);
        $this->db->update(MEDIA, $fileData);
        //echo $this->db->last_query();
        // die;
        return $this->db->affected_rows();
    }

    public function active_category($Id) {
        $fileData['status'] = '1';
        $this->db->where('id', $Id);
        $this->db->update(MEDIA, $fileData);
        // echo $this->db->last_query();
        // die;
        return $this->db->affected_rows();
    }

    public function addfavorite($media_id, $child_id) {
        $filter['media_id'] = $media_id;
        $filter['child_id'] = $child_id;
        $this->db->from(FAVORITE);
        $this->db->where($filter);
        $result = $this->db->get();
        //echo $this->db->last_query();
        $num = $result->num_rows();
        if ($num == 0) {
            $filter['created_date'] = date('Y-m-d h:i:s');
            $filter['user_id'] = $this->session->userdata['ud']['adminid'];
            $this->db->insert(FAVORITE, $filter);
            $id = $this->db->insert_id();
            return $id;
        } else {
            $fileData['status'] = '1';
            $filter['user_id'] = $this->session->userdata['ud']['adminid'];
            $filter['media_id'] = $media_id;
            $filter['child_id'] = $child_id;
            $this->db->where($filter);
            $this->db->update(FAVORITE, $fileData);
            // echo $this->db->last_query();
            // die;
            return $this->db->affected_rows();
        }
    }

    public function get_favorite($media_id) {
        $filter['media_id'] = $media_id;
        $filter['status'] = '1';
        $this->db->from(FAVORITE);
        $this->db->where($filter);
        $result = $this->db->get();
        return $num = $result->num_rows();
    }

    public function removefavorite($media_id, $child_id) {
        $filter['media_id'] = $media_id;
        $filter['child_id'] = $child_id;
        $this->db->from(FAVORITE);
        $this->db->where($filter);
        $result = $this->db->get();
        echo $this->db->last_query();
        $num = $result->num_rows();
        if ($num > 0) {
            $fileData['status'] = '0';
            $filter['user_id'] = $this->session->userdata['ud']['adminid'];
            $this->db->where($filter);
            $this->db->update(FAVORITE, $fileData);
            // echo $this->db->last_query();
            // die;
            return $this->db->affected_rows();
        }
    }

}
?>

