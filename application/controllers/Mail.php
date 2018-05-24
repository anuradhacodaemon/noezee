<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mail extends CI_Controller {

    /**
      @Name Category Controller
      Description:  Class represents controller for client login
      Operations : login,logout ,dashboard
      @Author : Anuradha Chakraborti
      For Codaemon Softwares Pvt. Ltd.
      For project - Technician Search
      @params
      @return
      @since    6-3-2017
      @createdDate 6-3-2017
      @link : http:xyz.com/client/
     *
     */
    public function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('clientpassword_model');
    }

    /**
     * This method used to login for client depends username and password entere.
     * @param username and password in form.
     * @return login id for client if true.
     * @url /client/
     * @exception 
     * @see 
     */
    public function index() {

        $config = Array(
            'protocol' => 'sendmail',
            'smtp_host' => 'Smtp.gmail.com',
            'smtp_port' => 25,
            'smtp_user' => 'codaemon123',
            'smtp_pass' => 'codaemon1234',
            'smtp_timeout' => '4',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );

        $this->load->library('email', $config);

        $this->email->set_newline("\r\n");
        //$this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        //$this->email->set_header('Content-type', 'text/html');
        $this->email->from(ADMINEMAIL, 'neoZee');
        //$this->email->from('anuradha.chakraborti@gmail.com', $this->session->userdata['userdata']['ud']);
        $this->email->to('anuradha.chakraborti@codaemonsoftwares.com');
        $this->email->subject("Update your contact information");
        $url='ccc';
        $this->email->message('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	background-image: url(bar.png);
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
          <input name="button_recovery_password" type="submit" class="boton" id="button_recovery_password" value="Restore password" />
        </form>
    </td>
  </tr>
  <tr>
    <td class="notas_rojas">If the above button does not work, please copy and paste the following text in the address bar of your internet browser to access the same page.</td>
  </tr>
  <tr>
    <td align="center">'.$url.'</td>
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
          <td rowspan="3" align="center"><img src="logo50x50.png" width="50" height="50" /></td>
          <td><strong><span class="notas_firma"> Website:</span></strong></td>
          <td><span class="notas_firma">www.911mantenimiento.com.mx</span></td>
        </tr>
        <tr>
          <td><strong><span class="notas_firma">Facebook:</span></strong></td>
          <td><span class="notas_firma">/911mantenimiento</span></td>
        </tr>
        <tr>
          <td><strong><span class="notas_firma">Twitter:</span></strong></td>
          <td><span class="notas_firma">@911mantenimiento</span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td class="notas_grises">This e-mail message may contain confidential or legally protected information and is intended solely for the intended recipient\'s use (s). Any unauthorized disclosure, dissemination, distribution, copying or taking any action based on the information contained herein is prohibited. Emails are not secure and can not be guaranteed to be error free as they can be intercepted, modified or contain viruses. Anyone who communicates with us by e-mail is deemed to have accepted these risks, 911 Mantenimiento is not responsible for any errors or omissions in this message and disclaims any liability for damages arising from the use of electronic mail. Any opinions and other statements contained in this message and any attachment are the sole responsibility of the author and do not necessarily represent those of the company.</td>
  </tr>
</table>
</body>
</html>');

        $this->email->send();
        $this->email->print_debugger();
       /* $to = 'anuradha.chakraborti@codaemonsoftwares.com';
        $subject = 'the subject';
        $message = 'hello';
        $headers = 'From: anuradha.chakraborti@gmail.com' . "\r\n" .
                'Reply-To: anuradha.chakraborti@gmail.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

        if(mail($to, $subject, $message, $headers))
                echo 'mail sent';
            else  echo error_message;  
          
            print_r(error_get_last());*/
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */