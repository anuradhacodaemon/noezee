<?php

/**  user model for technician client user * */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feedback_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /** This function used to read user for all available filters * */
    public function get_user($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {
        $filters['status'] = '1'; // display active record
        set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->from(FEEDBACK);
        $result = $this->db->get();
        checkForError();
        
        return $result->result_array();
    }
    
   
     

    public function addfeedback($userData) {

        $this->db->insert(FEEDBACK, $userData);
        checkForError();
        $id = $this->db->insert_id();
        return $id ;
    }

    public function update_user($id, $userData) {
        $this->db->where("user_id", $id);
        $this->db->update(FEEDBACK, $userData);
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
        $this->db->update(FEEDBACK, $userData);
        checkForError();
        return $this->db->affected_rows();
    }

    
    /** user list * */
}
?>

