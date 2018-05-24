<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Anuradha
 * Description: Login model class
 */

class Clientpassword_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

    public function validate($username, $password) {

        $this->db->where("(email = '$username' )");
        $this->db->where('user_password', md5($password));

        // Run the query
        $query = $this->db->get(USERS);
        // Let's check if there are any results

        $count = $query->num_rows();
        if ($count > 0) {
            // If there is a user, then create session data
            $row = $query->row();
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }

    public function checkUser($email) {
        $this->db->where('email', $email);
        // Run the query
        $query = $this->db->get(USERS);

        // Let's check if there are any results
        $count = $query->num_rows();
       //echo $this->db->last_query();
        if ($count > 0) {

            $result = $query->row();
            return $result;
        }
        // If the previous process did not return a row
        // then return false.
        return false;
    }

    public function changePassword($password, $userId) {

        $data['user_password'] = $password;
        $this->db->where('id', $userId);
        $this->db->update(USERS, $data);
       
        return $this->db->affected_rows();
    }

    public function changeUrl($url, $userId) {
        $data['reset_url'] = $url;
        $this->db->where('id', $userId);
        $this->db->update(USERS, $data);
        return $this->db->affected_rows();
    }
    
    public function checkUrl( $userId) {
         $this->db->select('reset_url');
         $this->db->like('reset_url', $userId);
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
