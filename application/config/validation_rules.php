<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * <h1>Validation Rules </h1>
 * The validation configuration file is created to set all validation rules from this file itself.
 *
 * @author  Shrikant Jadhav
 * @version 1.0
 * @see 
 * @since   2017-02-16
 */
// Dispatcher rules start here 
// 'array element 0 - is field actual name. 1 - is the label of the field. 2 - is a rules to apply on the field '

$config['user_insert_rules'][] = array(
    "field_name" => 'user_password',
    "field_label" => ' Password',
    "field_rule" => 'trim|required',
    "field_error" => array()
);
$config['user_insert_rules'][] = array(
    "field_name" => 'confirm_password',
    "field_label" => 'confirm Password',
    "field_rule" => 'trim|required|matches[user_password]',
    "field_error" => array()
);


$config['user_insert_rules'][] = array(
    "field_name" => 'email',
    "field_label" => 'email',
    'field_rule' => 'trim|required|callback_email_check|valid_email',
    'field_error' => array(
        'required' => '%s Is Required.',
        'is_unique' => '%s Is Already Taken.',
        'valid_email' => '%s must be valid. For example, johndoe@example.com'
    )
);
// dispatcher rules end here

$config['user_device_rules'][] = array(
    "field_name" => 'device_id',
    "field_label" => 'Device Id is requried',
    "field_rule" => 'trim|required',
   'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['user_device_rules'][] = array(
    "field_name" => 'user_type',
    "field_label" => 'User Type Parent or Child',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);

$config['user_device_rules'][] = array(
    "field_name" => 'device_token',
    "field_label" => 'device token is required',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['user_device_rules'][] = array(
    "field_name" => 'device_os',
    "field_label" => 'device os is required',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);

$config['favorite_insert_rules'][] = array(
    "field_name" => 'media_id',
    "field_label" => 'Media Id',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['favorite_insert_rules'][] = array(
    "field_name" => 'user_id',
    "field_label" => 'User Id',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);

$config['feedback_insert_rules'][] = array(
    "field_name" => 'user_id',
    "field_label" => 'User Id',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);

$config['feedback_insert_rules'][] = array(
    "field_name" => 'content',
    "field_label" => 'content',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);


$config['message_insert_rules'][] = array(
    "field_name" => 'sent_user_address',
    "field_label" => 'Sent User address',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);

$config['message_insert_rules'][] = array(
    "field_name" => 'received_user_address',
    "field_label" => 'Received User address',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['message_insert_rules'][] = array(
    "field_name" => 'content',
    "field_label" => 'content',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['message_insert_rules'][] = array(
    "field_name" => 'recevied_date',
    "field_label" => 'recevied date',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['message_insert_rules'][] = array(
    "field_name" => 'date_sent',
    "field_label" => 'date sent',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['message_insert_rules'][] = array(
    "field_name" => 'received_parent_id',
    "field_label" => 'received parent id',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);

$config['log_insert_rules'][] = array(
    "field_name" => 'device_id',
    "field_label" => 'device id',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);

$config['log_insert_rules'][] = array(
    "field_name" => 'event_name',
    "field_label" => 'Event id',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['log_insert_rules'][] = array(
    "field_name" => 'model_name',
    "field_label" => 'model name',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['log_insert_rules'][] = array(
    "field_name" => 'version_name',
    "field_label" => 'version name',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);


$config['log_insert_rules'][] = array(
    "field_name" => 'file_name',
    "field_label" => 'file name',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['log_insert_rules'][] = array(
    "field_name" => 'user_id',
    "field_label" => 'user id',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['log_insert_rules'][] = array(
    "field_name" => 'device_manufacture',
    "field_label" => 'device manufacture',
    "field_rule" => 'trim|required',
    'field_error' => array(
        'required' => '%s Is Required.'
    )
);
$config['android_rules'][] = array(
    'field_name' => 'mtitle',
    'field_label' => 'Title',
    'field_rule' => 'required|trim',
    'field_error' => array(
        'required' => '%s Is Required Field.',
    )
);

$config['android_rules'][] = array(
    'field_name' => 'mdesc',
    'field_label' => 'Description',
    'field_rule' => 'required|trim',
    'field_error' => array(
        'required' => '%s Is Required Field.',
    )
);

$config['android_rules'][] = array(
    'field_name' => 'user_id',
    'field_label' => 'user id',
    'field_rule' => 'required|trim',
    'field_error' => array(
        'required' => '%s Is Required Field.',
    )
);


$config['ios_rules'][] = array(
    'field_name' => 'mtitle',
    'field_label' => 'Title',
    'field_rule' => 'required|trim',
    'field_error' => array(
        'required' => '%s Is Required Field.',
    )
);

$config['ios_rules'][] = array(
    'field_name' => 'mdesc',
    'field_label' => 'Description',
    'field_rule' => 'required|trim',
    'field_error' => array(
        'required' => '%s Is Required Field.',
    )
);

$config['ios_rules'][] = array(
    'field_name' => 'user_id',
    'field_label' => 'user id',
    'field_rule' => 'required|trim',
    'field_error' => array(
        'required' => '%s Is Required Field.',
    )
);

$config['user_logout_rules'][] = array(
    'field_name' => 'user_id',
    'field_label' => 'user id',
    'field_rule' => 'required|trim',
    'field_error' => array(
        'required' => '%s Is Required Field.',
    )
);

$config['user_logout_rules'][] = array(
    'field_name' => 'device_id',
    'field_label' => 'device id',
    'field_rule' => 'required|trim',
    'field_error' => array(
        'required' => '%s Is Required Field.',
    )
);

//Job Image rule end here
?>