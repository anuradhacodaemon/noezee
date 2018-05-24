<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*     * Add Media* */

    public function add_media($categoryData) {
        $this->db->insert(MEDIA, $categoryData);
        
        //echo $this->db->last_query();die;
        checkForError();
        $id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return $id;
        } else {
            return false;
        }
    }
    
     public function add_log($categoryData) {
        $this->db->insert('neo_media_log', $categoryData);
        checkForError();
        $id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            return $id;
        } else {
            return false;
        }
    }
    
    public function check_log($name,$device_id){
        
        $this->db->from('neo_media_log' );
        $this->db->where('file_name',$name);
        $this->db->where('device_id',$device_id);
        $result = $this->db->get();
        //echo $this->db->last_query();
       // echo '<br>';
        checkForError();

        return $result->num_rows();
    }
    
     public function update_log($name,$device_id){
        $userData['uploadstatus']="1";
        
        $this->db->where('file_name',$name);
        $this->db->where('device_id',$device_id);
        $this->db->update('neo_media_log', $userData);
        //echo $this->db->last_query();
        checkForError();
        return $this->db->affected_rows();
        
    }
    

    public function update_file($id, $userData) {
        $this->db->where("id", $id);
        $this->db->update(MEDIA, $userData);
        //echo $this->db->last_query();die;
        checkForError();
        return $this->db->affected_rows();
    }

    public function get_user($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {
        // $filters['status'] = '1'; // display active record
        //set_query($fields, $page, $limit, $filters, $likes, $orders);
        //$this->db->select(' neo_media.*');
        //$this->db->from('neo_media');
        //$this->db->join(USERSDEVICE .' as address', 'address.device_id = neo_media.device_id', 'inner');
        //$this->db->where($filters);
        // print_r($filters);die;
        $sql = " SELECT distinct `m`.*  FROM `neo_media` as m  INNER JOIN `neo_device` as `d` ON `d`.`device_id` = `m`.`device_id` WHERE   d.user_id=m.user_id and m.status=1 ";
        if ($filters['neo_media.user_id'] > 0 && $filters['parent_device_id'] != '' && $filters['child_device_id'] != '')
            $sql .= " and `d`.`parent_device_id` = '" . $filters['parent_device_id'] . "' and `m`.`device_id` = '" . $filters['child_device_id'] . "'  and `m`.`user_id` = " . $filters['neo_media.user_id'];
        else if ($filters['neo_media.user_id'] > 0 && $filters['child_device_id'] != '')
            $sql .= " and `m`.`device_id` = '" . $filters['child_device_id'] . "'  and `m`.`user_id` = " . $filters['neo_media.user_id'];
        else if ($filters['neo_media.user_id'] > 0 && $filters['parent_device_id'] != '')
            $sql .= " and `d`.`parent_device_id` = '" . $filters['parent_device_id'] . "'   and `m`.`user_id` = " . $filters['neo_media.user_id'];

        else if ($filters['neo_media.user_id'] > 0)
            $sql .= " and `m`.`user_id` = " . $filters['neo_media.user_id'];


        $result = $this->db->query($sql);

        checkForError();
        //echo $this->db->last_query();

        return $result->result_array();
    }

    public function get_user12($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {
        // $filters['status'] = '1'; // display active record
        //set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->select('neo_media.*,address.user_type');

        $this->db->from('neo_media');
        $this->db->join(USERSDEVICE . ' as address', 'address.device_id = neo_media.device_id', 'inner');
        $this->db->where($filters);

        $result = $this->db->get();

        checkForError();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_user_count($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {
        // $filters['status'] = '1'; // display active record
        //set_query($fields, $page, $limit, $filters, $likes, $orders);
        // $this->db->select('neo_media.*,address.user_type');
        //$this->db->from('neo_media');
        //$this->db->join(USERSDEVICE .' as address', 'address.device_id = neo_media.device_id', 'inner');
        //$this->db->where($filters);
        //$result = $this->db->get();
        $sql = " SELECT distinct `m`.*  FROM `neo_media` as m  INNER JOIN `neo_device` as `d` ON `d`.`device_id` = `m`.`device_id` WHERE   d.user_id=m.user_id and m.status=1";
        if ($filters['neo_media.user_id'] > 0 && $filters['parent_device_id'] != '' && $filters['child_device_id'] != '')
            $sql .= " and `d`.`parent_device_id` = '" . $filters['parent_device_id'] . "' and `m`.`device_id` = '" . $filters['child_device_id'] . "'  and `m`.`user_id` = " . $filters['neo_media.user_id'];
        else if ($filters['neo_media.user_id'] > 0 && $filters['child_device_id'] != '')
            $sql .= " and `m`.`device_id` = '" . $filters['child_device_id'] . "'  and `m`.`user_id` = " . $filters['neo_media.user_id'];
        else if ($filters['neo_media.user_id'] > 0 && $filters['parent_device_id'] != '')
            $sql .= " and `d`.`parent_device_id` = '" . $filters['parent_device_id'] . "'   and `m`.`user_id` = " . $filters['neo_media.user_id'];

        else if ($filters['neo_media.user_id'] > 0)
            $sql .= " and `m`.`user_id` = " . $filters['neo_media.user_id'];

        $result = $this->db->query($sql);
        $num = $result->num_rows();
        checkForError();
        //echo $this->db->last_query();
        return $num;
    }

    public function get_userfavorite($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {
        $filters['status'] = '1'; // display active record
        $filters['user_type'] = 'C';
        //set_query($fields, $page, $limit, $filters, $likes, $orders);
        //$this->db->select(' neo_media.*');
        $this->db->from(USERSDEVICE . ' as d');
        $this->db->where($filters);
        // print_r($filters);die;
        $result = $this->db->get();
        checkForError();
        //echo $this->db->last_query();
        return $result->result_array();
    }
    public function get_userfavorite1($offset, $limit, $userid) {
        //$filters['status'] = '1'; // display active record
        $filters['user_type'] = 'C';
        //set_query($fields, $page, $limit, $filters, $likes, $orders);
        //$this->db->select(' neo_media.*');
        $this->db->from(USERSDEVICE . ' as d');
        $this->db->where($filters);
        $this->db->limit($limit, $offset);
        // print_r($filters);die;
        $result = $this->db->get();
        checkForError();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_userfavorite_count($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {
        //$filters['status'] = '1'; // display active record
        $filters['user_type'] = 'C';
        //set_query($fields, $page, $limit, $filters, $likes, $orders);
        //$this->db->select(' neo_media.*');
        $this->db->from(USERSDEVICE . ' as d');
        $this->db->where($filters);

        $result = $this->db->get();
        $num = $result->num_rows();
        checkForError();
        //echo $this->db->last_query();
        return $num;
    }

    public function get_favoritelist($userid, $childid) {
        $filters['child_id'] = $childid; // display active record
        $filters['f.user_id'] = $userid; // display active record
        $filters['f.status'] = '1';
        $this->db->from(FAVORITE . ' as f');
        $this->db->join(MEDIA . ' as m', 'm.id = f.media_id', 'inner');

        $this->db->where($filters);
        $result = $this->db->get();
       // echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_user_count12($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {
        // $filters['status'] = '1'; // display active record
        //set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->select('neo_media.*,address.user_type');

        $this->db->from(MEDIA);
        $this->db->join(USERSDEVICE . ' as address', 'address.device_id = neo_media.device_id', 'inner');
        $this->db->where($filters);

        $result = $this->db->get();
        $num = $result->num_rows();
        checkForError();
        //echo $this->db->last_query();
        return $num;
    }

    public function get_device_parent($userid) {
        $this->db->select('device_id');
        $this->db->from(USERSDEVICE);
        $this->db->where('user_id', $userid);
        $this->db->where('user_type', 'P');
        $result = $this->db->get();
        checkForError();
        return $result->result_array();
    }

    public function get_device_child($userid) {
        $this->db->select('device_id');
        $this->db->from(USERSDEVICE);
        $this->db->where('user_id', $userid);
        $this->db->where('user_type', 'C');
        $result = $this->db->get();
        checkForError();
        return $result->result_array();
    }

    public function get_favorite($mediaid, $childid) {
        $this->db->select('fav_id');
        $this->db->from(FAVORITE);
        $this->db->where('media_id', $mediaid);
        $this->db->where('child_id', $childid);
        $result = $this->db->get();
        $num = $result->num_rows();
        checkForError();
        //echo $this->db->last_query();
        return $num;
    }

    /*     * Add Category* */

    public function delete_media($id, $mediaid) {
        $userData['status'] = '0';
        $this->db->where("user_id", $id);
        $this->db->where("id", $mediaid);
        $this->db->update(MEDIA, $userData);
        checkForError();
       return $this->db->affected_rows();
    }
    public function delete_mediafav($id, $mediaid) {
        
        
        $this->db->select('fav_id');
        $this->db->from(FAVORITE);
        $this->db->where('media_id', $mediaid);
        $this->db->where("user_id", $id);
        $result = $this->db->get();
        $num = $result->num_rows();
        if($num>0)
        {
        $userData['status'] = '0';
        $this->db->where("user_id", $id);
        $this->db->where("media_id", $mediaid);
        $this->db->update(FAVORITE, $userData);
        }
          return $this->db->affected_rows();
    }
    
    public function delete_favorite($id) {
        $mediaData['status'] = '0';
        $this->db->where("fav_id", $id);
        $this->db->update(FAVORITE, $mediaData);
        checkForError();
        return $this->db->affected_rows();
    }


}

?>
