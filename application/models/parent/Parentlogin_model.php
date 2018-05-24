<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Anuradha
 * Description: Login model class
 */

class ParentLogin_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

    public function validate($username, $password) {

        $this->db->like('email' , ''.$username.'' ,'both');
        $this->db->where('user_password', md5($password));
        $this->db->where('status', 1);
        // Run the query
        $query = $this->db->get(USERS);
        // Let's check if there are any results
        //echo $this->db->last_query();die;
        $count = $query->num_rows();
        if ($count > 0) {
            // If there is a user, then create session data
            $row = $query->row();
            
            $data = array(
                'adminid' => $row->id,
                'adminusername' => $row->email,
                'adminvalidated' => true
            );
           
            
            $this->session->set_userdata('ud', $data);

            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }

   
}

?>
