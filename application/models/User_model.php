<?php

/**  user model for technician client user * */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /** This function used to read user for all available filters * */
    public function get_user($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {
        $filters['status'] = '1'; // display active record
        set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->from(USERS);
        $result = $this->db->get();
        checkForError();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_user1($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {

        set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->from(USERS);
        $result = $this->db->get();
        checkForError();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_device($fields, $page = null, $limit = 0, $filters = array(), $likes = array(), $orders = array()) {
        $filters['status'] = '1'; // display active record
        //set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->from(USERSDEVICE);
        $result = $this->db->get();
        // echo $this->db->last_query();
        checkForError();

        return $result->result_array();
    }

    public function get_device1($fields, $page = null, $limit = 0, $filters = array(), $likes = array(), $orders = array()) {
       // $filters['push'] = '1'; // display active record
        //set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->distinct();
        $this->db->select('push,user_id,device_id,device_name,device_token');
        $this->db->from(USERSDEVICE);
        $this->db->where('user_type', 'C');
        $this->db->where('user_id', $filters['user_id']);
        $result = $this->db->get();
        // echo $this->db->last_query();
        checkForError();

        return $result->result_array();
    }

    public function register_user($userData) {

        $this->db->insert(USERS, $userData);
        checkForError();
        $id = $this->db->insert_id();
        return $id;
    }

    public function update_user($id, $userData) {
        $this->db->where("user_id", $id);
        $this->db->update(USERS, $userData);
        checkForError();
        $id = $this->db->affected_rows();
        if ($id) {
            return $id;
        } else {
            return false;
        }
    }

    public function update_loginuser($id, $userData) {
        $this->db->where("id", $id);
        $this->db->update(USERS, $userData);
        checkForError();
        $id = $this->db->affected_rows();
        if ($id) {
            return $id;
        } else {
            return false;
        }
    }

    public function delete_user($id) {
        $userData['status'] = '0';
        $this->db->where("user_id", $id);
        $this->db->update(USERS, $userData);
        checkForError();
        return $this->db->affected_rows();
    }

    public function register_userdevice($userData) {



        $this->db->from(USERSDEVICE);
        $this->db->like('device_id', $userData['device_id'], 'both');
        $this->db->where('user_id', $userData['user_id']);
          $this->db->where('user_type', $userData['user_type']);
        $result = $this->db->get();
        $num = $result->num_rows();
        if ($num == 0) {
            $this->db->insert(USERSDEVICE, $userData);
            //echo $this->db->last_query();
            checkForError();
            $id = $this->db->insert_id();
            if ($id > 0) {
                return $id;
            } else {
                return false;
            }
        } else {
            // update

            $this->db->like('device_id', $userData['device_id'], 'both');
            $this->db->where("user_id", $userData['user_id']);
            $this->db->where('user_type', $userData['user_type']);
            $this->db->update(USERSDEVICE, $userData);
            //echo $this->db->last_query();
            checkForError();
            return $this->db->affected_rows();
        }
    }

    public function get_user_email($str) {

        $this->db->select('email');

        $this->db->from(USERS);
        $this->db->like('email', $str, 'both');

        $result = $this->db->get();
        $num = $result->num_rows();
        checkForError();
        //echo $this->db->last_query();
        return $num;
    }

    public function get_user_logindevice($id, $deviceToken) {

        $this->db->select('id');

        $this->db->from(USERS);
        $this->db->where('id', $id);
        $this->db->where('deviceToken', $deviceToken);

        $result = $this->db->get();
        $num = $result->num_rows();
        checkForError();
        //echo $this->db->last_query();
        return $num;
    }

    /** user list * */
    
    public function logout_userdevice($user_id, $device_id) {
        $userData['device_token']='';
        $this->db->where("user_type", 'P');
        $this->db->where("user_id", $user_id);
        $this->db->where("device_id", $device_id);
        $this->db->update(USERSDEVICE, $userData);
        checkForError();
        $id = $this->db->affected_rows();
        if ($id) {
            return $id;
        } else {
            return false;
        }
    }
}
?>

