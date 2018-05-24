<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Forgot extends CI_Controller {

    /**
      @Name Category Controller
      Description:  Class represents controller for dispatcher login
      Operations : login,logout ,dashboard
      @Author : Anuradha Chakraborti
      For Codaemon Softwares Pvt. Ltd.
      For project - Neozee
      @params
      @return
      @since    6-3-2017
      @createdDate 6-3-2017
      @link : http:xyz.com/dispatcher/
     *
     */
    public function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->library('pagination');
        //$this->load->model('parent/feedback_model');
    }

    public function index() {
        $data = array();

        $page = array();
        //$data['header'] = $this->load->view('elements/header', $page, true);
        //$data['nav'] = $this->load->view('elements/navigation', $page, true);
        $data['layout_content'] = $this->load->view('pages/forgot', $data, true);
        //footer content
        //$data['footer'] = $this->load->view('elements/footer', $page, true);
        $this->load->view('layouts/default_template', $data);
    }

    public function mailsent() {
        $email = $this->input->post('email');

        $this->load->model('clientpassword_model');

        try {
            $result = $this->clientpassword_model->checkUser($email); // register category Record
            //print_r($result);
            if (!$result) {

                $error = 'Invalid email';
                $this->session->set_flashdata('item', array('message' => '<font color=red>' . $error . '</font>', 'class' => 'success'));

                redirect('parent/forgot', 'refresh');
            } else {
                $Link = $result->id . '&rand=' . rand(1, 10);
                $url = urlencode($Link);
                $sendlink = base_url() . "user/reseturl/" . $url;

                $mailsubjectforgot = 'noeZee reset password';
                $messageSend = $this->get_message($sendlink);

                //$messageSend = "Click This Link To Change Password . <a href='" . $sendlink . "'>click</a>";
                //$emailSend = sendEmail(ADMINEMAIL, ADMINNAME, $result->email, $mailsubjectforgot, $messageSend);
                
                /**************************Below is aws ses email code***********************/
                    /******** Below code for aws ses email************************/
                    $this->load->library('email');
                    $config['mailtype']     = "html";
                    $config['useragent']    = 'Post Title';
                    $config['protocol']     = 'smtp';
                    $config['smtp_host']    = 'tls://email-smtp.us-east-1.amazonaws.com';
                    $config['smtp_user']    = 'AKIAIF7NXGSEH3XTHZNA';
                    $config['smtp_pass']    = 'AnjAzWpq79iQHDkUid2nDmNG70p4SMpKZV1JT0QZhcWU';
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

                    $error = 'check your email to reset password';
                    $this->session->set_flashdata('item', array('message' => '<font color=red>' . $error . '</font>', 'class' => 'success'));

                    redirect('parent/forgot', 'refresh');
                } else {

                    $error = 'mail sent is  unsuccessfull';
                    $this->session->set_flashdata('item', array('message' => '<font color=red>' . $error . '</font>', 'class' => 'success'));

                    redirect('parent/forgot', 'refresh');
                }
            }
        } catch (Exception $e) {
            //$message = set_response_message('fail', $e->getMessage(), array(email), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }

        //$this->set_response($message, $message['status_code']);
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

/* End of file home.php */
    /* Location: ./application/controllers/home.php */    