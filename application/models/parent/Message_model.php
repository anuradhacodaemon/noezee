<?php

/**  user model for technician client user * */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /** This function used to read user for all available filters * */
    public function get_message($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {
        $filters['status'] = '1'; // display active record
        set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->from(MESSAGE);
        $result = $this->db->get();
        checkForError();

        return $result->result_array();
    }

    public function get_user($userId = 0) {
        $this->db->select('email');
        $this->db->from(USERS);
        $this->db->where('id', $userId);
        $result = $this->db->get();
        checkForError();

        return $result->result_array();
    }

    public function get_senderdate($offset, $limit, $filterData) {
        $this->db->select('currentdate');
        $this->db->from(MESSAGE);
        $this->db->where('user_id', $this->session->userdata['ud']['adminid']);
        //$this->db->where('received_child_id', $device_id);
        $this->db->where($filterData);
        $this->db->limit($limit, $offset);
        $this->db->group_by('currentdate');
        $this->db->order_by('currentdate', 'asc');
$this->db->order_by('currenttime', 'asc');
        $result = $this->db->get();
        //echo $this->db->last_query();
        checkForError();

        return $result->result_array();
    }

    public function get_senderdate_count($device_id,$filters) {
        $this->db->select('currentdate');
        $this->db->from(MESSAGE);
        $this->db->where('user_id', $this->session->userdata['ud']['adminid']);
        $this->db->where('received_child_id', $device_id);
        $this->db->where($filters);
        $this->db->group_by('currentdate');
        $result = $this->db->get();
        //echo $this->db->last_query();
        checkForError();

        return $result->num_rows();
    }

    public function get_devicemsg_count($filters) {

        $this->db->select('currentdate');
        $this->db->from(MESSAGE);
        $this->db->where('user_id', $this->session->userdata['ud']['adminid']);
        $this->db->where('received_child_id', $filters);
        $this->db->group_by('currentdate');
        $result = $this->db->get();
        //echo $this->db->last_query();
        checkForError();

        return $result->num_rows();
    }

    public function get_sendermessage($userId = 0, $date, $device_id, $received_user_address) {
        $this->db->select('m.content,m.currenttime,m.received_user_address,m.msg_type');
        $this->db->from(MESSAGE . ' as m');
        $this->db->join(USERS . ' as u', 'u.id = m.user_id', 'inner');
        $this->db->where('user_id', $userId);
        $this->db->where('received_child_id', $device_id);
        $this->db->where('received_user_address', $received_user_address);
        $this->db->where('currentdate', $date);
        $this->db->order_by('currenttime', 'asc');
        
        $result = $this->db->get();
        
        //echo $this->db->last_query();
        checkForError();

        return $result->result_array();
    }

    public function get_receviedlist($userId = 0) {
        $this->db->select('currentdate');
        $this->db->from(MESSAGE);
        $this->db->where('user_id', $this->session->userdata['ud']['adminid']);
        $this->db->group_by('currentdate');
        $result = $this->db->get();
        checkForError();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_receviedlist_count($userId = 0) {
        $this->db->select('currentdate');
        $this->db->from(MESSAGE);
        $this->db->where('user_id', $this->session->userdata['ud']['adminid']);
        $this->db->group_by('currentdate');
        $result = $this->db->get();
        checkForError();
        //echo $this->db->last_query();
        return $result->num_rows();
    }

    public function get_receviedmessage($userId = 0, $date) {
        $this->db->select('m.content,m.currenttime,u.email,m.received_user_address');
        $this->db->from(MESSAGE . ' as m');
        $this->db->join(USERS . ' as u', 'u.id = m.user_id', 'inner');
        $this->db->where('user_id', $userId);
        //$this->db->or_where('sent_user_address', $userId);
        $this->db->where('currentdate', $date);
        //$this->db->group_by('currentdate');

        $result = $this->db->get();
        //echo $this->db->last_query();
        checkForError();

        return $result->result_array();
    }

    public function get_senderlist($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {
        $filters['m.status'] = '1'; // display active record
        //$filters['u.user_type'] = 'C'; // display active record
        //print_r($filters);
        // set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->select(' DISTINCT(m.received_child_id) as received_child_id,u.device_name');
        $this->db->from(MESSAGE . ' as m');
        $this->db->join(USERSDEVICE . ' as u', 'u.device_id = m.received_child_id', 'inner');
        $this->db->where('u.user_id', $this->session->userdata['ud']['adminid']);
        $this->db->group_by('received_child_id');
        $result = $this->db->get();
        // echo $this->db->last_query();
        checkForError();

        return $result->result_array();
    }

    public function get_senders($offset, $limit, $filterData) {
        $filters['m.status'] = '1'; // display active record
        //print_r($filters);
        // set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->select(' DISTINCT(m.received_user_address) as received_user_address');
        $this->db->from(MESSAGE . ' as m');
        $this->db->join(USERS . ' as u', 'u.id = m.user_id', 'inner');
        $this->db->where('m.user_id', $this->session->userdata['ud']['adminid']);
        $this->db->where($filterData);
        //$this->db->group_by('received_user_address');
        //$this->db->order_by('currentdate','desc');
        $this->db->order_by('currenttime','desc');
        $this->db->limit($limit, $offset);
        $result = $this->db->get();
       // echo $this->db->last_query();
        checkForError();

        return $result->result_array();
    }

    public function get_receviedaddress($msg_id = 0) {
        $this->db->select('received_user_address');
        $this->db->from(MESSAGE);
        $this->db->where('msg_id', $msg_id);
        $result = $this->db->get();

        return $result->result_array();
    }
    
    public function get_msg_id($received_user_address = 0) {
        $this->db->select('msg_id');
        $this->db->from(MESSAGE);
        $this->db->where('received_user_address', $received_user_address);
        $result = $this->db->get();

        return $result->result_array();
    }


    public function get_senders_count($filters = array()) {
       $filters['m.status'] = '1'; // display active record
        //print_r($filters);
        // set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->select(' DISTINCT(m.received_user_address) as received_user_address');
        $this->db->from(MESSAGE . ' as m');
        $this->db->join(USERS . ' as u', 'u.id = m.user_id', 'inner');
        $this->db->where('m.user_id', $this->session->userdata['ud']['adminid']);
        $this->db->where($filters);
        //$this->db->group_by('received_user_address');
        //$this->db->order_by('currentdate','desc');
        $this->db->order_by('currenttime','desc');
        $result = $this->db->get();
        //echo $this->db->last_query();
        checkForError();

        return $result->num_rows();
    }

    public function get_senderlist_count($filters = array()) {
        $filters['m.status'] = '1'; // display active record
        //print_r($filters);
        // set_query($fields, $page, $limit, $filters, $likes, $orders);
        // set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->select(' DISTINCT(m.received_child_id) as received_child_id,u.device_name');
        $this->db->from(MESSAGE . ' as m');
        $this->db->join(USERSDEVICE . ' as u', 'u.device_id = m.received_child_id', 'inner');
        $this->db->where('u.user_id', $this->session->userdata['ud']['adminid']);
        $this->db->group_by('received_child_id');
        $result = $this->db->get();
        //echo $this->db->last_query();
        checkForError();

        return $result->num_rows();
    }

    function _insert_on_duplicate_update_batch($table, $keys, $values) {
        foreach ($keys as $key)
            $update_fields[] = $key . '=VALUES(' . $key . ')';

        return "INSERT INTO " . $table . " (" . implode(', ', $keys) . ") VALUES " . implode(', ', $values) . " ON DUPLICATE KEY UPDATE " . implode(', ', $update_fields);
    }

    public function addfeedback($userData) {

        $update_fields[] = "sent_user_address = values(sent_user_address )"
        ;

        $sql = "INSERT INTO " . MESSAGE . " ( `sent_user_address`, `received_user_address`, `user_id`, `received_child_id`, `content`, `msg_type`,  `recevied_date`, `currentdate`, `currenttime`,  `status`) VALUES ";
        $sql .= $userData;
        $sql .= " ON DUPLICATE KEY UPDATE " . implode(', ', $update_fields);

//echo $sql= "INSERT INTO ".MESSAGE." (".implode(', ', $keys).") VALUES ".implode(', ', $values)." ON DUPLICATE KEY UPDATE ".implode(', ', $update_fields);
        // echo $sql;

        $this->db->query($sql);
        checkForError();
        $id = $this->db->insert_id();
        return $id;
        //$this->db->insert_batch(MESSAGE, $userData);
        //checkForError();
        //echo $this->db->last_query();
        //  $id = $this->db->insert_id();
        // return $id;
    }

    public function update_user($id, $userData) {
        $this->db->where("user_id", $id);
        $this->db->update(MESSAGE, $userData);
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
        $this->db->update(MESSAGE, $userData);
        checkForError();
        return $this->db->affected_rows();
    }

    /** user list * */
}
?>

