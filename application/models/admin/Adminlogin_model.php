<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Anuradha
 * Description: Login model class
 */

class AdminLogin_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('email');
    }

    public function validate($username, $password) {

        if ($username == ADMINUSERNAME && $password == ADMINPASSWORD) {
            $data = array(
                'ud' => ADMINUSERNAME
            );
            $this->session->set_userdata('userdata', $data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }

}

?>
