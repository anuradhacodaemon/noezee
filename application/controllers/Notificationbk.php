<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Notification extends CI_Controller {

    private static $channelName = "joashp";

    // Change the above three vriables as per your app.
    public function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('notification_model');
    }

    
     public function index() {
       echo  'hi';
       
        $msg_payload = array(
                'mtitle' => 'hello',
                'mdesc' => 'hello',
                'msubtitle' => '',
            );
        
     $data = $this->notification_model->get_child();
 foreach ($data as $k => $v) {
                        if ($data[$k]['device_os'] == 'android')
                            $result = $this->send($msg_payload, $data[$k]['device_token']);
                        //if ($data[$k]['device_os'] == 'ios')
                           // $result = $this->isend($msg_payload, $data[$k]['device_id'], 'parent');
                    }

        
    }
    public function parent_post() {

        $is_valid = validate($this->config->item('android_rules'));
        if ($is_valid) {
            $mTitle = $this->post('mtitle');
            $mDesc = $this->post('mdesc');
            $msubtitle = $this->post('msubtitle');
            $msg_payload = array(
                'mtitle' => $mTitle,
                'mdesc' => $mDesc,
                'msubtitle' => $msubtitle
            );
            try {
                $data = $this->notification_model->get_parent($this->post('user_id'));
               // print_r($data);
                
                 echo $result = $this->send($msg_payload, 'eowyJFEau-0:APA91bHztgt_h_r24H3CJij_07VVFDLMH1aPSMmUNQlr1QrzwY5UgwT8u1TONG_p_pfTyHr5BKOHfjAg4WSF53hWwkU8A2kVgxdPgZKQxt-M3ADHs2hQzIJtog89fKv2VMhpFpVV0nHl');
die;
                if ($data) {
                    foreach ($data as $k => $v) {
                        if ($data[$k]['device_os'] == 'android')
                            $result = $this->send($msg_payload, $data[$k]['device_id']);
                        //if ($data[$k]['device_os'] == 'ios')
                           // $result = $this->isend($msg_payload, $data[$k]['device_id'], 'parent');
                    }
                }
                else {
                    $message = set_response_message('fail', 'Internal server error while sending notification.', $data, 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
                if ($result) {
                    $message = set_response_message('success', 'notification sent successfully.', $result, 1, REST_Controller::HTTP_CREATED);
                } else {
                    $message = set_response_message('fail', 'Internal server error while sending notification.', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), array($msg_payload), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $message = set_response_message('fail', validation_errors(), [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function client_post($id = '') {

        $is_valid = validate($this->config->item('android_rules'));
        if ($is_valid) {
            $mTitle = $this->post('mtitle');
            $mDesc = $this->post('mdesc');
            $msubtitle = $this->post('msubtitle');
            $msg_payload = array(
                'mtitle' => $mTitle,
                'mdesc' => $mDesc,
                'msubtitle' => $msubtitle
            );

            try {
                $data = $this->notification_model->get_client($id);
                       // $result = $this->send($msg_payload, $data[0]['device_token']);
//die;
                if ($data) {
                    if ($data[0]['device_os'] == 'android')
                        $result = $this->send($msg_payload, $data[0]['device_token']);
                    if ($data[0]['device_os'] == 'ios')
                        $result = $this->isend($msg_payload, $data[0]['device_token'], 'client');
                }
                else {
                    $message = set_response_message('fail', 'Internal server error while sending notification.', $data, 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }

                if ($result) {
                    $message = set_response_message('success', 'notification sent successfully.', $result, 1, REST_Controller::HTTP_CREATED);
                } else {
                    $message = set_response_message('fail', 'Internal server error while sending notification.', [], 0, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
                }
            } catch (Exception $e) {
                $message = set_response_message('fail', $e->getMessage(), array($msg_payload), 1, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $message = set_response_message('fail', validation_errors(), [], 0, REST_Controller::HTTP_BAD_REQUEST);
        }
        $this->set_response($message, $message['status_code']);
    }

    public function send($data, $reg_id) {

        $url = 'https://fcm.googleapis.com/fcm/send';
        $message = array(
            'title' => $data['mtitle'],
            'message' => $data['mdesc'],
            'subtitle' => $data['msubtitle'],
            'tickerText' => '',
            'msgcnt' => 1,
            'vibrate' => 1
        );

        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $fields = array(
            'to' => $reg_id,
            'data' => $message,
        );


        return $this->useCurl($url, $headers, json_encode($fields));
    }

    // Sends Push notification for iOS users
    public function isend($data, $devicetoken, $by) {

        $deviceToken = $devicetoken;

        $ctx = stream_context_create();
        // ck.pem is your certificate file

        if ($by == 'parent') {
            $path = CERT_FILE_PATH . PMFILE1;
            $passpharse = PASSPHARSE2;
        }
        /* $path = BASE_URL . 'public/' . PMFILE1;
          $passpharse = PASSPHARSE1;
         */
        stream_context_set_option($ctx, 'ssl', 'local_cert', $path);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passpharse);
        //    stream_context_set_option($ctx, 'ssl', 'verify_peer', true);
        //    stream_context_set_option($ctx, 'ssl', 'cafile', 'public/entrust_root_certification_authority.pem');
        // Open a connection to the APNS server
        $fp = stream_socket_client(
                IOS_PUSH_URL, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            return 'Failed to connect:' . $err . $errstr . PHP_EOL;

        // Create the payload body
        $body['aps'] = array(
            'alert' => array(
                'title' => $data['mtitle'],
                'body' => $data['mdesc'],
                'subtitle' => $data['msubtitle']
            ),
            'sound' => 'default'
        );

        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        // Close the connection to the server
        fclose($fp);

        if (!$result)
            return 'Message not delivered' . PHP_EOL;
        else
            return 'Message successfully delivered' . PHP_EOL;
    }

    // Curl 
    private function useCurl($url, $headers, $fields = null) {
        // Open connection
        $ch = curl_init();
        if ($url) {
            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            if ($fields) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            }

            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }
            //print_r($result );
            // Close connection
            curl_close($ch);

            return $result;
        }
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */