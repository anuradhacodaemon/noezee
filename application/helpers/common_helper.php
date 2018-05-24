<?php
// This is a common helper which contains all the common functions.
// This function is used for developer options to print some variable
function show($data, $exit = 0){
	echo PHP_EOL . "<br />------------------------------------------------<br />";
	if (is_array($data) || is_object($data)) {
		echo PHP_EOL . "<pre>";
		print_r($data);
		echo "</pre>";
	}
	else {
		echo PHP_EOL . $data;
	}
	echo PHP_EOL . "<br />------------------------------------------------<br />";
	if ($exit == 1) {
		exit;
	}
}
/****
Response
{
status_code : 200/201/400/404,etc
status : success/fail
message :
data_count
data : []
}
**/
function api_response_code($status_code, $status, $message, $data_count, $data){
	$d = array();
	// This appends a new element to $d, in this case the value is another array
	$d[] = array(
		'status_code' => $status_code,
		'status' => $status,
		'message' => $message,
		'data_count' => $data_count,
		'data' => $data
	);
	$json = json_encode($d);
	return $json;
}
// Generating Random String
function randomString($type, $length)
{
	if ($type == 'numeric')
	$string = "0123456789";
	else if ($type == 'alphabet')
	$string = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";
	else
	$string = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789";
	if ($length == '')
	$length = 7;
	$return = array();
	$stringLength = strlen($string) - 1;
	for ($i = 0;
	$i < $length;
	$i++) {
	$n = rand(0, $stringLength);
	$return[] = $string[$n];
	}
	return implode($return);
}

/**
* This method used to set validation rules and validate form.
* @param rules to validate
* @return true - if form is valid, false - if form is invalid.
*   
* @exception 
* @see 
* @version 1.0
* @since 2017-02-16
*/
function validate($rules){
    $CI = & get_instance();
    $CI->form_validation->set_data($CI->post());
    foreach($rules as $rule){
        $CI->form_validation->set_rules($rule['field_name'], $rule['field_label'], $rule['field_rule'],$rule['field_error']);
    }
    $CI->form_validation->set_error_delimiters('', '');
    return $CI->form_validation->run();
}

/**
 * function used to preapare query to 
 * @package         CodeIgniter
 * @subpackage      Helpers
 * @category        Helper
 * @author          Shrikant Jadhav, Codaemon Softwares Pvt. Ltd.
 * @license         
 * @link            
 * @since 2017-02-20
 **/

function set_query($fields, $page, $limit, $filters, $likes, $orders)
{
	$CI = & get_instance();
	$CI->db->select($fields);
    if(!empty($filters))   
    foreach ($filters as $filterKey => $filterValue){
        $CI->db->where($filterKey,$filterValue);
    }
    if(!empty($likes))   
    foreach ($likes as $like){
        if(isset($like[2])){
            $CI->db->like($like[0],$like[1],$like[2]);
        } else {
            $CI->db->like($like[0],$like[1]);
        }
    }
    if(!empty($orders))  
    foreach($orders as $orderKey => $orderValue){
        $CI->db->order_by($orderKey, $orderValue);
    }
	$offset = 0;
	if (!$page) {
    	$page = 1;
    }
    if(!empty($limit)){
    	$offset = (($page-1)*$limit);
    	$CI->db->limit($limit, $offset);
    }
}
/**
 * function used to preapare query to 
 * @package         CodeIgniter
 * @subpackage      Helpers
 * @category        Helper
 * @author          Shrikant Jadhav, Codaemon Softwares Pvt. Ltd.
 * @license         
 * @link            
 * @since 2017-02-20
 **/
function set_response_message($status,$message,$data,$count, $status_code){

    return $message = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'data_count' => $count,
            'status_code' => $status_code
        ];

}

function set_response_onlymessage($status,$message,$count, $status_code){

    return $message = [
            'status' => $status,
            'message' => $message,
            
            'data_count' => $count,
            'status_code' => $status_code
        ];

}

function set_response_message_media($status,$userID,$parentID,$childID,$message,$data,$count, $status_code){

    return $message = [
            'status' => $status,
            'message' => $message,
            'userID' => $userID,
            'parentID' => $parentID,
             'childID' => $childID,
            'data' => $data,
            'data_count' => $count,
            'status_code' => $status_code
        ];

}
function set_response_message_fmedia($status,$userID,$parentID,$message,$data,$count, $status_code){

    return $message = [
            'status' => $status,
            'message' => $message,
            'userID' => $userID,
            'parentID' => $parentID,
            
            'mediadata' => $data,
            'data_count' => $count,
            'status_code' => $status_code
        ];

}
function set_response_message_device($status,$message,$data,$child,$count, $status_code){

    return $message = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'childs' => $child,
            'data_count' => $count,
            'status_code' => $status_code
        ];

}

function set_response_message_twilio($status,$message,$data,$count,$error_code, $status_code){

    return $message = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'error_code' => $error_code,
            'data_count' => $count,
            'status_code' => $status_code
        ];

}
/**
 * function used to check if there is any database error occured or not. 
 * @package         CodeIgniter
 * @subpackage      Helpers
 * @category        Helper
 * @author          Shrikant Jadhav, Codaemon Softwares Pvt. Ltd.
 * @license         
 * @link            
 * @since 2017-02-27
 **/
function checkForError(){
	$CI = & get_instance();
	$error = $CI->db->error();     
	if ($error['code'])
        throw new Exception($error['message'],$error['code']);
}
/**
 * function used to send Email
 * @package         CodeIgniter
 * @subpackage      Helpers
 * @category        Helper
 * @author          Subhadip Mondal, Codaemon Softwares Pvt. Ltd.
 * @license         
 * @link            
 * @since 2017-03-15
 **/
function sendEmail($fromEmail='', $fromName='', $toEmail='', $subject='', $message=''){
     $config = array();
                $config['useragent']           = "CodeIgniter";
                $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
                $config['protocol']            = "smtp";
                $config['smtp_host']           = "localhost";
                $config['smtp_port']           = "25";
                $config['mailtype'] = 'html';
                $config['charset']  = 'utf-8';
                $config['newline']  = "\r\n";
                $config['wordwrap'] = TRUE;

               
	$CI = & get_instance();
         $CI->load->library('email');
         $CI->email->initialize($config);
        //$email_setting  = array('mailtype'=>'html');
        //$CI->email->initialize($email_setting);
        //$CI->email->set_mailtype("html");
        ////$CI->email->set_header('MIME-Version', '1.0; charset=utf-8');
        //$CI->email->set_header('Content-type', 'text/html'); 
	$CI->email->from($fromEmail, $fromName);
        $CI->email->to($toEmail);
        $CI->email->subject($subject);
        $CI->email->message($message);
        return $CI->email->send();
        
}
/**
 * function used to Encrypt Url
 * @package         CodeIgniter
 * @subpackage      Helpers
 * @category        Helper
 * @author          Subhadip Mondal, Codaemon Softwares Pvt. Ltd.
 * @license         
 * @link            
 * @since 2017-03-15
 **/
 function encode_url($string, $url_safe=TRUE)
{   
    $CI =& get_instance();
    $ret = $CI->encrypt->encode($string, ENCRYPTKEY);
    if ($url_safe) {
        $ret = strtr($ret, array('+' => '.', '=' => '-', '/' => '~'));
    }

    return $ret;
}
/**
 * function used to Decrypt Url
 * @package         CodeIgniter
 * @subpackage      Helpers
 * @category        Helper
 * @author          Subhadip Mondal, Codaemon Softwares Pvt. Ltd.
 * @license         
 * @link            
 * @since 2017-03-15
 **/
function decode_url($string)
{
     
    $CI =& get_instance();
    $string = strtr(
            $string,
            array(
                '.' => '+',
                '-' => '=',
                '~' => '/'
            )
        );

    return $CI->encrypt->decode($string, ENCRYPTKEY);
}


