<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

/**
 * <h1>User!</h1>
 * The User controller is used to perform all user related operations
 * like add/edit/delete/view/etc. Mainly function under this class return JSON string.
 * <p>
 * <b>Note:</b> This class may be improved to return result in different format like array.
 *
 * @author  Anuradha Chakraborti
 * @version 1.0
 * @see
 * @since   2017-1-18
 */
class Test extends REST_Controller {

    public function __construct() {
        parent::__construct();
        
    }

    public function Index_post() {
    	
		$this->load->library('email');
        $config['mailtype']     = "text";
        $config['useragent']    = 'Post Title';
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'tls://email-smtp.us-east-1.amazonaws.com';
        $config['smtp_user']    = 'AKIAIF7NXGSEH3XTHZNA';
        $config['smtp_pass']    = 'AnjAzWpq79iQHDkUid2nDmNG70p4SMpKZV1JT0QZhcWU';
        $config['smtp_port']    = '465';
        $config['wordwrap']     = TRUE;
        //$config['newline']      = "\r\n"; 

        $this->email->initialize($config);

        $this->email->from('subhadip.mondal@codaemonsoftwares.com', 'Neozee');
        $this->email->to('anu@yopmail.com');
        $this->email->subject('Email From Neozee');
		$this->email->message('Email From Neozee');


        if($this->email->send()){
        	$message = set_response_message('success', "mail successfully.", $this->email->print_debugger(array('headers')), 1, REST_Controller::HTTP_OK);
			$this->set_response($message, 200);
        }else{
        	$message = set_response_message('fail', "mail not sent", $this->email->print_debugger(array('headers')), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
    	$this->set_response($message, 500);
        }
                    
           
    	
    }

   


}
