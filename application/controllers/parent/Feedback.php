<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feedback extends CI_Controller {

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
        $this->load->model('parent/feedback_model');
    }

    public function index() {

        $data = array();
        if (!isset($this->session->userdata['ud'])) {
            $data = array();
            $this->load->view('admin', $data);
        } else {



            if (isset($_GET['search'])) {
                $filterData['search'] = $_GET['search'];
                //$this->session->set_userdata('search', $_POST['search']);
            } else {
                $filterData['search'] = '';
            }
            if (isset($_GET['record_limit'])) {
                $config['per_page'] = $_GET['record_limit'];
                //$this->session->set_userdata('search', $_POST['search']);
            } else {
                $config['per_page'] = RECORD_LIMIT;
            }
            if (isset($_GET['sort_by'])) {
                $data['sort_by'] = $sortData['sort_by'] = $_GET['sort_by'];
            } else {
                $data['sort_by'] = $sortData['sort_by'] = '';
            }
            if (isset($_GET['sort_direction'])) {
                $data['sort_direction'] = $sortData['sort_direction'] = $_GET['sort_direction'];
            } else {
                $data['sort_direction'] = $sortData['sort_direction'] = '';
            }
            $last = $this->uri->total_segments();
            $record_num = $this->uri->segment($last);

            $config['base_url'] = BASE_URL . 'parent/feedback';

            $config['total_rows'] = $this->feedback_model->get_count_media($filterData);
            //$config['per_page'] = RECORD_LIMIT;
            $page = ($record_num) ? $record_num : 0;
            $config['reuse_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;
            if ($page > 0)
                $page = ($page - 1) * $config['per_page'];
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = 'Prev';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = 'Next';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
            $data["page_no"] = $page;
            $data["total_rows"] = $config['total_rows'];
            $data["record_limit"] = $config['per_page'];
            //$data['client'] = $this->media->get_client(0);
            //$data['project'] = $this->media->get_project(0);
            // $data['neighborhood'] = $this->media->get_neighborhood();
            $data["joblisting"] = $this->feedback_model->get_media('', $config["per_page"], $page, $filterData, $sortData);
            $data['header'] = $this->load->view('elements/header', $page, true);
            //$data['nav'] = $this->load->view('elements/navigation', $page, true);
            $data['layout_content'] = $this->load->view('pages/feedback', array_merge($data, $filterData), true);
            //footer content
            $data['footer'] = $this->load->view('elements/footer', $page, true);
            $this->load->view('layouts/default_template', $data);
        }
    }

    public function addfeedback() {

        $data = array();
        if (!isset($this->session->userdata['ud'])) {
            $data = array();
            $this->load->view('parent', $data);
        } else {


            $page = array();
            $data['header'] = $this->load->view('elements/header', $page, true);
            //$data['nav'] = $this->load->view('elements/navigation', $page, true);
            $data['layout_content'] = $this->load->view('pages/addfeedback', $data, true);
            //footer content
            $data['footer'] = $this->load->view('elements/footer', $page, true);
            $this->load->view('layouts/default_template', $data);
        }
    }

    public function add() {

        $data = array();
        if (!isset($this->session->userdata['ud'])) {
            $data = array();
            $this->load->view('parent', $data);
        } else {

             $this->feedback_model->addfeedback($this->input->post('content'));
            redirect('parent/feedback','refresh');
        }
    }
    
     public function email() {

        $data = array();
        if (!isset($this->session->userdata['ud'])) {
            $data = array();
            $this->load->view('parent', $data);
        } else {

           $sendlink=base_url(TRUE);
           $messageSend = $this->get_message($sendlink);
           $emailSend = sendEmail(ADMINEMAIL, ADMINNAME, $this->session->userdata['ud']['adminusername'], 'Link shared', $messageSend);
           redirect('parent/feedback/addfeedback','refresh');    
        }
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
    <td class="etiqueta_titulo">Following link is share with you.</td>
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
          <td><span class="notas_firma">www.neozee.com.mx</span></td>
        </tr>
        <tr>
          <td><strong><span class="notas_firma">Facebook:</span></strong></td>
          <td><span class="notas_firma">/neozee</span></td>
        </tr>
        <tr>
          <td><strong><span class="notas_firma">Twitter:</span></strong></td>
          <td><span class="notas_firma">@neozee</span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td class="notas_grises">This e-mail message may contain confidential or legally protected information and is intended solely for the intended recipient\'s use (s). Any unauthorized disclosure, dissemination, distribution, copying or taking any action based on the information contained herein is prohibited. Emails are not secure and can not be guaranteed to be error free as they can be intercepted, modified or contain viruses. Anyone who communicates with us by e-mail is deemed to have accepted these risks, 911 Mantenimiento is not responsible for any errors or omissions in this message and disclaims any liability for damages arising from the use of electronic mail. Any opinions and other statements contained in this message and any attachment are the sole responsibility of the author and do not necessarily represent those of the company.</td>
  </tr>
</table>
</body>
</html>';
        return $message;
    }
    

}

/* End of file home.php */
    /* Location: ./application/controllers/home.php */    