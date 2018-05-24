<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class File extends REST_Controller {

    /**
      @Name File Controller
      Description:  Class represents controller for File module REST API CALL
      Operations : uploadFile
      @Author : Anuradha Chakraborti
      For Codaemon Softwares Pvt. Ltd.
      For project - neoZee
      @params
      @return
      @since    25-10-2017
      @createdDate 25-10-2017

      @link : http://localhost/neozee/api/v1/(var)/image/uploadpic
      @link : http://localhost/neozee/api/v1/(var)/image/uploadpic
      @link : http://localhost/neozee/api/v1/(type)/uploadfile
     *
     */
    public function __construct() {
        // Construct the parent class
        parent::__construct();
    }
	
    public function uploadFile_post() {
		/** echo 'dd';
       echo $image = $this->post('file');
		die;
$this->load->helper(array('form', 'url'));		
$config['upload_path']          = './upload/category/';
$config['allowed_types']        = 'gif|jpg|png/mp4';
$config['max_size']             = 8000;
//$config['max_width']            = 1024;
//$config['max_height']           = 768;

$this->load->library('upload', $config);
if ( ! $this->upload->do_upload('file_name'))
{
$error = array('error' => $this->upload->display_errors());
$message = set_response_message('error', "error", array($error), 0, REST_Controller::HTTP_BAD_REQUEST);
}
else
{
$data = array('upload_data' => $this->upload->data());
$message = set_response_message('success', "File Upload Successfull", array($fileData), 1, REST_Controller::HTTP_OK);
}

        $this->set_response($message, $message['status_code']); **/
		$ext = pathinfo($this->post('file'), PATHINFO_EXTENSION);

		$content = file_get_contents($this->post('file'));
//Store in the filesystem.
		$name="./upload/category/".uniqid().".".$ext."";
$fp = fopen($name, "w");
if(fwrite($fp, $content))
{
	$message = set_response_message('success', "File Upload Successfull", array($name), 1, REST_Controller::HTTP_OK);


}
		else {
			$message = set_response_message('error', "File Upload unSuccessfull", [], 0, REST_Controller::HTTP_BAD_REQUEST);

		}
	$this->set_response($message, $message['status_code']); 
		fclose($fp);
    }  
	 public function resizeImage_post() {
        if($this->post('image') != ''){
            $type = $this->uri->segment(3);
            //Set Validation rules defined in fileupload_rules
            switch ($type) {
                case "category":
                    $resizeConfig = $this->config->item('category_resize_rules');
                    break;
                default:
                    $rules = array();
                    break;
            }
            $resizeConfig['source_image'] = $resizeConfig['source_image'].$this->post('image');
            $resizeConfig['new_image'] = $resizeConfig['new_image'].$this->post('image');
            $this->load->library('image_lib');
            $this->image_lib->clear();
            $this->image_lib->initialize($resizeConfig); //Initialize LIbrary
            if ($this->image_lib->resize()) {//Resize
                    $this->image_lib->clear();
                    chmod($resizeConfig['new_image'], 0777); //Change Permission
                    $message = set_response_message('success', "Image Resize Successfull", array('source_image' => ltrim($resizeConfig['source_image'],'.'), 'resize_image' => ltrim($resizeConfig['new_image'],'.')), 1, REST_Controller::HTTP_OK);
            }
            else {
                    $message = set_response_message('error', "Image Resize Failed", [], 0, REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        else {
            $message = set_response_message('error', "Invalid Image", [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }
    
	
	
 public function uploadCamerapic_post() {
        $type = $this->uri->segment(3);
        //Set Validation rules defined in fileupload_rules  https://www.browserling.com/tools/file-to-base64
        switch ($type) {
            case "client":
                $rules = $this->config->item('client_profile_rules');
                break;
            case "technician":
                $rules = $this->config->item('technician_profile_rules');
                break;
            case "category":
                $rules = $this->config->item('category_rules');
                break;
            case "job":
                $rules = $this->config->item('job_complete_file_rules');
                break;
            default:
                $rules = array();
                break;
        }
        $imageString = $this->post('file');
        $imageArr = explode(';base64,', $imageString);
	$data = str_replace(' ', '+', array_pop($imageArr));
	$data = base64_decode($data); // Decode image using base64_decode
	$f = finfo_open();
	$mime_type = finfo_buffer($f, $data, FILEINFO_MIME_TYPE); //Get Image Type
	list($mime, $ext) = explode('/', $mime_type);//Get Image Extension
	finfo_close($f);
        sleep(1);
        $fileName = time() . '.'.$ext;
        $filePath = $rules['upload_path'];
        $file = $filePath . $fileName; //Now you can put this image data to your desired file using file_put_contents function like below:
        if (file_put_contents($file, $data)) {
            chmod($file, 0777); //change permission
            $fileData['file_name'] = $fileName;
            $fileData['relative_path'] = ltrim($filePath,".");
            $fileData['full_path'] = ltrim($file,".");
            $fileData['image_type'] = $ext;
            if($type=='category'){// Resize category Image
                $resizeConfig = $this->config->item('category_resize_rules');
                $resizeConfig['source_image'] = $resizeConfig['source_image'].$fileName;
                $resizeConfig['new_image'] = $resizeConfig['new_image'].$fileName;
                $this->load->library('image_lib');
                $this->image_lib->clear();
                $this->image_lib->initialize($resizeConfig); //Initialize LIbrary
                if ($this->image_lib->resize()) {//Resize
                    $this->image_lib->clear();
                    chmod($resizeConfig['new_image'], 0777); //Change Permission
                    $fileData['resize_image'] = ltrim($resizeConfig['new_image'],'.');                    
                }
            }
            $message = set_response_message('success', "File Upload Successfull", array($fileData), 1, REST_Controller::HTTP_OK);
        }
        else {
            $message = set_response_message('fail', "File Upload Failed", [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
        }
        $this->set_response($message, $message['status_code']);
    }

}
