<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

/**
 * <h1>Change client password</h1>
 * The client password controller is used to send a mail with a link
 * like add/edit/delete/view/etc. Mainly function under this class return JSON string.
 * <p>
 * <b>Note:</b> This class may be improved to return result in different format like array.
 *
 * @author  Anuradha Chakraborti
 * @version 1.0
 * @see 
 * @since   2017-04-17
 */
class Clientpassword extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clientpassword_model');
    }

    public function index_post() {
        $email = $this->post('email');
        // $language = $this->post('language');

        try {
            $result = $this->clientpassword_model->checkUser($email); // register category Record

            if (!$result) {
                $message = set_response_message('fail', 'Invalid Email.', [], 0, REST_Controller::HTTP_OK);
            } else {
                $Link = $result->id . '&rand=' . rand(1, 10);
                $url = urlencode($Link);
                $sendlink = base_url() . "user/reseturl/" . $url;

                $mailsubjectforgot = 'Noezee reset password';
                $messageSend = $this->get_message($sendlink);

                //$messageSend = "Click This Link To Change Password . <a href='" . $sendlink . "'>click</a>";
                //$emailSend = sendEmail(ADMINEMAIL, ADMINNAME, $result->email, $mailsubjectforgot, $messageSend);

                /******** Below code for aws ses email************************/
                $this->load->library('email');
                $config['mailtype']     = "html";
                $config['useragent']    = 'Post Title';
                $config['protocol']     = 'smtp';
                $config['smtp_host']    = 'tls://email-smtp.us-east-1.amazonaws.com';
                $config['smtp_user']    = SMTP_USER;
                $config['smtp_pass']    = SMTP_PASS;
                $config['smtp_port']    = '465';
                $config['wordwrap']     = TRUE;
                //$config['newline']      = "\r\n"; 

                $this->email->initialize($config);

                $this->email->from(ADMINEMAIL, ADMINNAME);
                $this->email->to($result->email);
                $this->email->subject($mailsubjectforgot);
                $this->email->message($messageSend);
                $emailSend = $this->email->send();
                /*************************************************************/
                if ($emailSend) {
                    $result2 = $this->clientpassword_model->changeUrl($sendlink, $result->id);
                    $user_data1 = array('user_id' => $result->id,
                        "username" => $result->username,
                        "email" => $result->email);
                    $message = set_response_message('success', 'check your email to reset password.', $user_data1, 1, REST_Controller::HTTP_CREATED);
                } else {

                    $message = set_response_message('success', 'mail sent is  unsuccessfull.', $email, 0, REST_Controller::HTTP_CREATED);
                }
            }
        } catch (Exception $e) {
            $message = set_response_message('fail', $e->getMessage(), array(email), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
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
    <td class="etiqueta_titulo">Please click on the following button to be sent to the password reset page.</td>
  </tr>
  <tr>
    <td align="center">
        <form id="form_recovery_password" name="form_recovery_password" method="post" action="">
        <a href="' . $url . '" class="boton" target="_blank">Restore password</a>

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
