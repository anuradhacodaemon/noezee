<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Notification extends REST_Controller {

    private static $channelName = "joashp";
    private static $passphrase = 'joashp';
    // Change the above three vriables as per your app.
    public function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('notification_model');
    }

    public function parent_post() {

        $is_valid = validate($this->config->item('android_rules'));
        if ($is_valid) {
            $mTitle = $this->post('mtitle');
            $mDesc = $this->post('mdesc');
            $msubtitle = $this->post('msubtitle');
            $fcmMsg = array(
                'body' => $mDesc,
                'title' => $mTitle,
                'sound' => "default",
                'color' => "#203E78"
            );
             $msg_payload = array(
                'mtitle' => $mTitle,
                'mdesc' => $mDesc,
                'msubtitle' => $msubtitle,
            );
            try {
                
                $data = $this->notification_model->get_parent($this->post('user_id'));
                
                
                
                if (!empty($data)) {
                    foreach ($data as $k => $v) {
                        if ($data[$k]['device_os'] == 'android')
                            $result = $this->send($fcmMsg, $data[$k]['device_token']);
                        if ($data[$k]['device_os'] == 'ios')
                         $result = $this->isend($msg_payload, $data[$k]['device_token']);
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

 

    public function send($fcmMsg, $reg_id) {

        $fcmFields = array(
            'to' => $reg_id,
            'priority' => 'high',
            'notification' => $fcmMsg
        );

        $headers = array(
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    // Sends Push notification for iOS users
    public function isend($data, $devicetoken) {

       $deviceToken = $devicetoken;

		$ctx = stream_context_create();
		// ck.pem is your certificate file
		stream_context_set_option($ctx, 'ssl', 'local_cert', '/var/www/html/neozee/public/noezee-pushcert.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', self::$passphrase);

		// Open a connection to the APNS server
		$fp = stream_socket_client(
			'ssl://gateway.sandbox.push.apple.com:2195', $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

		if (!$fp)
			exit("Failed to connect: $err $errstr" . PHP_EOL);

		// Create the payload body
		$body['aps'] = array(
			'alert' => array(
			    'title' => $data['mtitle'],
                'body' => $data['mdesc'],
			 ),
			'sound' => 'default'
		);

		// Encode the payload as JSON
		$payload = json_encode($body);

		// Build the binary notification
		$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

		// Send it to the server
		echo $result = fwrite($fp, $msg, strlen($msg));
		
		// Close the connection to the server
		fclose($fp);

		if (!$result)
			return 'Message not delivered' . PHP_EOL;
		else
			return 'Message successfully delivered' . PHP_EOL;
    }

 

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */