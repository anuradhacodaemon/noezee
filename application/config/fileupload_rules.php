<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * <h1>File Upload Validation Rules </h1>
 * The validation configuration file is created to set all File Upload validation rules from this file itself.
 *
 * @author  Subhadip Mondal
 * @version 1.0
 * @see 
 * @since   2017-02-27
 */
//Client Profile Image Rule
$config['client_profile_rules']['upload_path'] = './upload/client/';
$config['client_profile_rules']['allowed_types'] = 'gif|jpg|png';
$config['client_profile_rules']['max_size']     = '2024';
//Technician Profile Image Rule
$config['technician_profile_rules']['upload_path'] = './upload/technician/';
$config['technician_profile_rules']['allowed_types'] = 'gif|jpg|png|pdf';
$config['technician_profile_rules']['max_size']     = '4024';
//Category Image Rule
$config['category_rules']['upload_path'] = './upload/category/';
$config['category_rules']['allowed_types'] = 'gif|jpg|png';
$config['category_rules']['max_size']     = '2024';
//Category Resize rule
$config['category_resize_rules']['image_library'] = 'gd2';
$config['category_resize_rules']['source_image']       = './upload/category/';
$config['category_resize_rules']['new_image']       = './upload/category_thumb/';
$config['category_resize_rules']['create_thumb'] = FALSE;
$config['category_resize_rules']['maintain_ratio'] = TRUE;
$config['category_resize_rules']['width']         = 300;
$config['category_resize_rules']['height']       = 250;
//job complete Image Rule
$config['job_complete_file_rules']['upload_path'] = './upload/job/';
$config['job_complete_file_rules']['allowed_types'] = 'gif|jpg|png|pdf';
$config['job_complete_file_rules']['max_size']     = '2024';
?>