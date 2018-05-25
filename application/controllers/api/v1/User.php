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
class User extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function Login_post($userId = 0) {

        $fields = "*";
        if ($this->get("fields")) {
            $fields = $this->get("fields");
        }
        if ($this->get('page')) {
            $page = $this->get('page');
        } else {
            $page = '';
        }
        if ($this->get('limit')) {
            $limit = $this->get('limit');
        } else {
            $limit = '';
        }
        try {

            if ($userId) {
                $filter['id'] = $userId;
                $user_data = $this->user_model->get_user($fields, $page = null, 1, $filter);
            } else if ($this->get("filter") || $this->get("order")) {
                $this->load->library("query_generator");
                if ($this->get("filter"))
                    $this->query_generator->setfilters($this->get("filter"));
                if ($this->get("order"))
                    $this->query_generator->setOrder($this->get("order"));
                $filters = $this->query_generator->getFilter();
                if (array_key_exists('user_password', $filters)) {//checking for password
                    $filters['user_password'] = md5($filters['user_password']);
                }
                $user_data = $this->user_model->get_user($fields, $page, $limit, $filters, $this->query_generator->getLike(), $this->query_generator->getOrder()
                );
            } else {
                $user_data = $this->user_model->get_user($fields, $page, $limit);
            }
            if (isset($filters) && (array_key_exists('user_password', $filters) && array_key_exists('username', $filters)) && (empty($filters['username']) || empty($filters['user_password']))) {
                $message = set_response_message('fail', 'Please Fill All Mandatory Fields', [], 0, REST_Controller::HTTP_BAD_REQUEST);
            } else if ($this->post('email') && $this->post('user_password')) {

                $filter['email'] = $this->post('email');
                $filter['user_password'] = md5($this->post('user_password'));
                //$filter['deviceToken'] = $this->post('deviceToken');

                $user_data2 = $this->user_model->get_user($fields, $page = null, 1, $filter);
                if (!empty($user_data2)) {


                    $userData['device_id'] = $this->post('device_id');
                    $userData['deviceToken'] = $this->post('deviceToken');
                    $userData['appVersion'] = $this->post('appVersion');
                    $userData['osVersion'] = $this->post('osVersion');
                    $userData['push'] = "1";
                    try {

                        $userId = $this->user_model->update_loginuser($user_data2[0]['id'], $userData); // register technician Record
                        if (!empty($user_data2)) {
                            $user_data1 = array('user_id' => $user_data2[0]['id'],
                                "username" => $user_data2[0]['username'],
                                "email" => $user_data2[0]['email']);
                            $num = $this->user_model->get_user_logindevice($user_data2[0]['id'], $user_data2[0]['deviceToken']);
                            if ($num >= 1)
                                $message = set_response_message('success', "logged In from this device already", $user_data1, 1, REST_Controller::HTTP_OK);
                            else
                                $message = set_response_message('success', "User found successfully.", $user_data1, 1, REST_Controller::HTTP_OK);
                        } else {
                            $message = set_response_message('fail', 'Internal server error while login as user.', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                        }
                    } catch (Exception $e) {
                        $message = set_response_message('fail', $e->getMessage(), array($userData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                    }
                } else {
                    $message = set_response_message('fail', 'No user found', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }


                /* } */
            } else {
                $message = set_response_message('fail', 'No user found', $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function signup_post() {
        $is_valid = validate($this->config->item('user_insert_rules'));
        if ($is_valid) {
            foreach ($this->post() as $key => $value) {
                $userData[$key] = $value;
            }

            $userData['created_date'] = date("Y-m-d H:i:s");
            $userData['status'] = "1";  // should be 0 but time being made active due to email delay.

            $userData['user_password'] = md5($userData['user_password']);
            unset($userData['confirm_password']);

            try {
                $userId = $this->user_model->register_user($userData); // register technician Record
                if ($userId > 0) {


                    $filter['id'] = $userId;
                    $fields = '';
                    $user_data2 = $this->user_model->get_user1($fields, $page = null, 1, $filter);

                    $user_data1 = array('user_id' => $userId,
                        "username" => $user_data2[0]['username'],
                        "email" => $user_data2[0]['email']);
                    $Link = $userId . '&rand=' . rand(1, 10);
                    $url = urlencode($Link);
                    $sendlink = base_url() . "confirmurl/" . $url;

                    $mailsubjectforgot = 'Noezee confirm account';
                    $messageSend = $this->get_message($sendlink);

                    //$messageSend = "Click This Link To Change Password . <a href='" . $sendlink . "'>click</a>";
                    //$emailSend = sendEmail(ADMINEMAIL, ADMINNAME, $user_data2[0]['email'], $mailsubjectforgot, $messageSend);
                    /*                     * ************************Below is aws ses email code********************** */
                    /*                     * ****** Below code for aws ses email*********************** */
                    $this->load->library('email');
                    $config['mailtype'] = "html";
                    $config['useragent'] = 'Post Title';
                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'tls://email-smtp.us-east-1.amazonaws.com';
                    $config['smtp_user'] = SMTP_USER;
                    $config['smtp_pass'] = SMTP_PASS;
                    $config['smtp_port'] = '465';
                    $config['wordwrap'] = TRUE;
                    //$config['newline']      = "\r\n"; 

                    $this->email->initialize($config);

                    $this->email->from(ADMINEMAIL, ADMINNAME);
                    $this->email->to($user_data2[0]['email']);
                    $this->email->subject($mailsubjectforgot);
                    $this->email->message($messageSend);
                    $emailSend = $this->email->send();
                    /*                     * ********************************************************** */
                    /*                     * ******************************************************************* */
                    $message = set_response_message('success', 'Check your e-mail to confirm your sign-up', $user_data1, count($user_data2), REST_Controller::HTTP_CREATED);
                } else {
                    $message = set_response_message('fail', 'Internal server error while adding user.', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), array($userData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $message = set_response_message('fail', validation_errors(), [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function email_check($str) {
        $num_row = $this->user_model->get_user_email($str);
        if ($num_row >= 1) {
            $this->form_validation->set_message('email_check', 'The email already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function index_put($userId = 0) {
        foreach ($this->put() as $key => $value) {
            $userData[$key] = $value;
        }
        if ($userData['user_password'] == '') {
            $userData['user_password'] = $userData['hidden_password'];
        } else {
            $userData['user_password'] = md5($userData['user_password']);
        }
        unset($userData['hidden_password']);
        try {
            $update = $this->user_model->update_user($userId, $userData); // update client Record
            if ($update) {
                $filter['id'] = $userId;
                $userRecord = $this->user_model->get_user('*', $page = null, 1, $filter);
                $message = set_response_message('success', "Dispatcher updated successfull", $userRecord, count($userRecord), REST_Controller::HTTP_OK);
            } else {
                $message = set_response_message('fail', "Internal server error while updating user", [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), array($userData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function index_delete($userId) {

        if ($userId <= 0 || $userId == '') {
            $message = set_response_message('fail', "Bad Request", [], 0, REST_Controller::HTTP_BAD_REQUEST);
        } else {
            try {
                $returnData = $this->user_model->delete_user($userId);
                if ($returnData > 0) {
                    $message = set_response_message('success', 'user deleted successfully', [], 0, REST_Controller::HTTP_OK);
                } else {
                    $message = set_response_message('fail', 'Internal server error while deleting user', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
            $this->set_response($message, $message['status_code']);
        }
    }

    public function userdevice_post() {
        $is_valid = validate($this->config->item('user_device_rules'));
        if ($is_valid) {
            foreach ($this->post() as $key => $value) {
                $userData[$key] = $value;
            }

            $userData['created_date'] = date("Y-m-d H:i:s");
            $userData['status'] = 1;
            $userData['push'] = 1;
            //$userData['userid'] = $this->post('user_id');
            try {
                $userId = $this->user_model->register_userdevice($userData); // register technician Record
                if ($userId != '') {
                    //$userData['userid'] = $this->post('user_id');
                    //$userData = array($userData);
                    if ($this->post('user_type') == 'p' || $this->post('user_type') == 'P') {
                        $user = 'parent';
                    } else
                        $user = 'child';
                    $filter['user_id'] = $this->post('user_id');
                    $filter['user_type'] = 'P';
                    $user_data1 = '';
                    if ($this->post('user_type') == 'P' || $this->post('user_type') == 'p') {
                        $userRecord = $this->user_model->get_device1('*', $page = null, 1, $filter);
                        foreach ($userRecord as $k => $v) {
                            $user_data1[] = array(
                                "isActive" => $userRecord[$k]['push'],
                                "user_id" => $userRecord[$k]['user_id'],
                                "device_id" => $userRecord[$k]['device_id'],
                                "device_name" => $userRecord[$k]['device_name']);
                        }
                    }
                    if ($user_data1 == '')
                        $user_data1 = [];
                    //$userData= array_merge($userData,$array); 
                    $message = set_response_message_device('success', 'User device added successfully as ' . $user . '', (object) $userData, $user_data1, 1, REST_Controller::HTTP_CREATED);
                } else {
                    $message = set_response_message('fail', 'Internal server error while adding user.', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), array($userData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $message = set_response_message('fail', validation_errors(), [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function userdevice_get($userId) {
        $fields = "*";
        if ($this->get("fields")) {
            $fields = $this->get("fields");
        }
        if ($this->get('page')) {
            $page = $this->get('page');
        } else {
            $page = '';
        }
        if ($this->get('limit')) {
            $limit = $this->get('limit');
        } else {
            $limit = '';
        }
        try {

            if ($userId) {
                $filter['userid'] = $userId;
                $user_data = $this->user_model->get_device($fields, $page = null, 1, $filter);
            } else if ($this->get("filter") || $this->get("order")) {
                $this->load->library("query_generator");

                if ($this->get("filter"))
                    $this->query_generator->setfilters($this->get("filter"));
                if ($this->get("order"))
                    $this->query_generator->setOrder($this->get("order"));
                $filters = $this->query_generator->getFilter();
                if (array_key_exists('user_password', $filters)) {//checking for password
                    $filters['user_password'] = md5($filters['user_password']);
                }
                $user_data = $this->user_model->get_device($fields, $page, $limit, $filters, $this->query_generator->getLike(), $this->query_generator->getOrder()
                );
            } else {
                $user_data = $this->user_model->get_device($fields, $page, $limit);
            }
            if (isset($filters) && (array_key_exists('user_password', $filters) && array_key_exists('username', $filters)) && (empty($filters['username']) || empty($filters['user_password']))) {
                $message = set_response_message('fail', 'Please Fill All Mandatory Fields', [], 0, REST_Controller::HTTP_BAD_REQUEST);
            } else if (!empty($user_data)) {

                if ($filters['user_password']) {


                    $user_data1 = array('id' => $user_data[0]['id'],
                        "username" => $user_data[0]['username'],
                        "email" => $user_data[0]['email'],
                        "device_id" => $user_data[0]['device_id']);
                    $message = set_response_message('success', "User found successfully.", $user_data1, count($user_data), REST_Controller::HTTP_OK);
                } else {
                    $message = set_response_message('success', "User found successfully.", $user_data, count($user_data), REST_Controller::HTTP_OK);
                }
            } else {
                $message = set_response_message('fail', 'No user found', $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), $user_data, count($user_data), REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function Logout_post() {


        $is_valid = validate($this->config->item('user_logout_rules'));
        if ($is_valid) {
            foreach ($this->post() as $key => $value) {
                $userData[$key] = $value;
            }
            try {
                $userId = $this->user_model->logout_userdevice($this->post('user_id'), $this->post('device_id')); // register technician Record
                //die;
                if ($userId != '') {


                    $message = set_response_message('success', 'User logout successfully  ', (object) $userData, 1, REST_Controller::HTTP_OK);
                } else {
                    $message = set_response_message('fail', 'Already Logout', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), array($userData), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $message = set_response_message('fail', validation_errors(), [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function get_message($url) {
        $image = base_url() . 'public/logo50x50.png';
        $image1 = base_url() . 'public/bar.png';
        $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/styles.css" 	rel="stylesheet"	type="text/css" />
<style>
.marco_tabla {
	border-radius: 5px;
	border-top-width: thin;
	border-right-width: thin;
	border-bottom-width: thick;
	border-left-width: thin;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #CCC;
	border-right-color: #CCC;
	border-bottom-color: #333;
	border-left-color: #CCC;
	padding: 5px;
	margin-top: 20px;
}
.etiqueta_titulo {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 1em;
	color: #333;
	padding: 0.2em;
	text-align: left;
}
.boton {
	-moz-box-shadow: 0px 1px 0px 0px #fff6af;
	-webkit-box-shadow: 0px 1px 0px 0px #fff6af;
	box-shadow: 0px 1px 0px 0px #fff6af;
	background-color:#ffec64;
	-moz-border-radius:.3em;
	-webkit-border-radius:.3em;
	border-radius:.3em;
	border:1px solid #ffaa22;
	display:inline-block;
	cursor:pointer;
	color:#333333;
	font-family:Arial;
	font-size:1.4em;
	font-weight:bold;
	padding: .5em;
	text-decoration:none;
	text-shadow:0px 1px 0px #ffee66;
}
.boton:hover {
	background-color:#ffab23;
}
.notas_rojas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 0.8em;
	color: #C00;
}
.notas_grises {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 0.8em;
	color: #999999;
}
.notas_firma {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 0.8em;
	color: #333333;
}
.barra_inferior{
	background-image: url(' . $image1 . ');
	background-repeat:repeat-x;
}
</style>
</head>
<body>
<table width="100%" class="marco_tabla">
  <tr>
    <td class="etiqueta_titulo">Please click on the following button to be sent to the confirm your account.</td>
  </tr>
  <tr>
    <td align="center">
        <form id="form_recovery_password" name="form_recovery_password" method="post" action="">
        <a href="' . $url . '" class="boton" target="_blank">confirm your account</a>

</form>
    </td>
  </tr>
  <tr>
    <td class="notas_rojas">If the above button does not work, please copy and paste the following text in the address bar of your internet browser to access the same page.</td>
  </tr>
  <tr>
    <td align="center">' . $url . '</td>
  </tr>
  <tr>
    <td class="notas_grises">If you believe that you have received this message by mistake, please reach us through the contact details that appear in the signature of this email.</td>
  </tr>
  <tr>
    <td class="barra_inferior">&nbsp;</td>
  </tr>
  <tr>
    <td><table width="35%" align="left">
        <tr>
          <td rowspan="3" align="center"><img src="' . $image . '" width="50" height="50" /></td>
          <td><strong><span class="notas_firma"> Website:</span></strong></td>
          <td><span class="notas_firma">www.noezee.com.mx</span></td>
        </tr>
        <tr>
          <td><strong><span class="notas_firma">Facebook:</span></strong></td>
          <td><span class="notas_firma">/noezee</span></td>
        </tr>
        <tr>
          <td><strong><span class="notas_firma">Twitter:</span></strong></td>
          <td><span class="notas_firma">@noezee</span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td class="notas_grises">This e-mail message may contain confidential or legally protected information and is intended solely for the intended recipient\'s use (s). Any unauthorized disclosure, dissemination, distribution, copying or taking any action based on the information contained herein is prohibited. Emails are not secure and can not be guaranteed to be error free as they can be intercepted, modified or contain viruses. Anyone who communicates with us by e-mail is deemed to have accepted these risks, noezee is not responsible for any errors or omissions in this message and disclaims any liability for damages arising from the use of electronic mail. Any opinions and other statements contained in this message and any attachment are the sole responsibility of the author and do not necessarily represent those of the company.</td>
  </tr>
</table>
</body>
</html>';
        return $message;
    }

}
