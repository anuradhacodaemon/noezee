<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Anuradha
 * Description: Confirm model class
 */

class Confirmurl_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

    public function changeUrl($userId) {
        $data['status'] = "1";
        $this->db->where('id', $userId);
        $this->db->update(USERS, $data);
        return $this->db->affected_rows();
    }

    public function checkUrl($userId) {
        $this->db->select('id');
        $this->db->like('id', $userId);
        $query = $this->db->get(USERS);
        //$this->db->last_query();
        $count = $query->num_rows();
        if ($count > 0) {
            $result = $query->result();
            return $result;
        }
        return false;
    }

}

?>
