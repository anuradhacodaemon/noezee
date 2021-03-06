<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    private static $channelName = "joashp";
    private static $passphrase = 'joashp';

    // Change the above three vriables as per your app.
    public function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('notification_model');
    }

    public function index() {
        $fcmFields = array();
        $fcmMsg = array(
            'body' => 'hello',
            'title' => 'hello',
            'sound' => "default",
            'color' => "#203E78",
            'type' => 'c'
        );



        $data = $this->notification_model->get_child();

        foreach ($data as $k => $v) {
            if ($data[$k]['device_token'] != '')
            // $result = $this->send($msg_payload, $data[$k]['device_token']);
                $fcmFields = array(
                    'to' => $data[$k]['device_token'],
                    'priority' => 'high',
                    'data' => $fcmMsg
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
            $error = json_decode($result);
            //echo '<pre>';
            // print_r($error);
            //print_r($error->results[0]->error);
            if (isset($error->results[0]->error) == 'NotRegistered') {
                $userData = array('child_id' => $data[$k]['device_id'], 'user_id' => $data[$k]['user_id'], 'error' => 'NotRegistered', 'device_token' => $data[$k]['device_token'], 'device_os' => $data[$k]['device_os'], 'adevice_id' => $data[$k]['id'], 'device_name' => $data[$k]['device_name'], "add_date1" => date('Y-m-d'));
                $data2 = $this->notification_model->push_user($userData);
                //$data3 = $this->notification_model->update_device($data[$k]['device_id']);
                $data3 = $this->notification_model->update_device1($data[$k]['id']);
                /** $data2 = $this->notification_model->get_parent($data[$k]['user_id']);

                  foreach ($data2 as $k2 => $v2) {

                  if ($data2[$k2]['device_os'] == 'android'){
                  echo 'hi';
                  //print_r($data2);
                  echo $result = $this->send($fcmMsg1, $data2[$k2]['device_token']);
                  }
                  if ($data2[$k2]['device_os'] == 'ios'){
                  $result = $this->isend($msg_payload, $data2[$k2]['device_token']);
                  }
                  }

                 * */
            }
        }
    }

    public function uniqueAssocArray($array, $uniqueKey) {
        if (!is_array($array)) {
            return array();
        }
        $uniqueKeys = array();
        foreach ($array as $key => $item) {
            if (!in_array($item[$uniqueKey], $uniqueKeys)) {
                $uniqueKeys[$item[$uniqueKey]] = $item;
            }
        }
        return $uniqueKeys;
    }

    public function parentnotification() {


        $msg_payload = array(
            'mtitle' => 'App Uninstall',
            'mdesc' => ' Your child has uninstalled noeZee app',
            'msubtitle' => ' Your child has uninstalled noeZee app',
        );
        try {
            // echo '<pre>';
            $a = array();
            $data = $this->notification_model->get_notificationchild();
            foreach ($data as $k => $v) {
                $b[] = $data[$k]['user_id'];

                $a[] = array('device_name' => $data[$k]['device_name'], 'user_id' => $data[$k]['user_id'], 'device_id' => $data[$k]['child_id']);
            }
            //$a =  array_map("unserialize", array_unique(array_map("serialize", $a)));



           



            $c = 0;
            if ($data) {
                 $b = array_unique($b);
                echo '<pre>';
                foreach ($data as $k1 => $v1) {

                    $fcmMsg = array(
                        'body' => 'App Uninstall-' . $v1['device_name'],
                        'title' => 'Your child has uninstalled noeZee app',
                        'sound' => "default",
                        'color' => "#203E78",
                        'type' => 'P'
                    );
                    //print_r($fcmMsg );
                    if (count($b) > $c) {
                        if (in_array($v1['user_id'], $b)) {
                            $c++;
                            
                            $data2 = $this->notification_model->get_parent_push($v1['user_id']);
                            //echo '<pre>'.$v1['user_id'];
                            //print_r($data2);
                            foreach ($data2 as $k2 => $v2) {
                                
                               if (($data2[$k2]['device_os'] == 'Android' || $data2[$k2]['device_os'] == 'android' ) && $data2[$k2]['device_os'] != '') {
                                   
                                   //echo $data2[$k2]['device_token'];
                                   //echo '##########';
                                   
                              echo $result = $this->send($fcmMsg, $data2[$k2]['device_token'], $v1['device_name']);
 
                                   
                               } 
                               if (isset($data2[$k2]['device_os']) == 'ios') {
                          echo $result = $this->isend($msg_payload, $data2[$k2]['device_token'], $v1['device_name']);

                          } 
                                
                            } 
                            
                            
                        }
                    } else {
                        break;
                    }

                    //$data1 = $this->notification_model->get_parent_push($y);
                }

               // die;


                //foreach ($a as $y) {
                    //$data1 = $this->notification_model->get_parent_push($y);

                    //foreach ($data1 as $k1 => $v1) {




                        //$data2 = $this->notification_model->get_anotificationchild($y);
                        // foreach ($data2 as $k2 => $v2) {
                        // $b[]=array('device_name'=>$data2[$k2]['device_name'],'device_os'=>$data1[$k1]['device_os'],'device_token'=>$data1[$k1]['device_token']);
                        /**
                          if (isset($data1[$k1]['device_os']) && $data1[$k1]['device_token'] != '') {
                          if (($data1[$k1]['device_os'] == 'Android' || $data1[$k1]['device_os'] == 'android' ) && $data1[$k1]['device_os'] != '') {

                          $fcmMsg = array(
                          'body' => 'App Uninstall-' . $data2[$k2]['device_name'],
                          'title' => 'Your child has uninstalled noeZee app',
                          'sound' => "default",
                          'color' => "#203E78",
                          'type' => 'P'
                          );
                          //echo $data1[$k1]['device_token'];
                          echo '############'.$data2[$k1]['device_id'];
                          echo $result = $this->send($fcmMsg, $data1[$k1]['device_token'], $data2[$k2]['device_name']);
                          }   if (isset($data1[$k1]['device_os']) == 'ios') {
                          //echo $result = $this->isend($msg_payload, $data1[$k1]['device_token'], $data2[$k2]['device_name']);

                          }
                          } * */
                        //}
                    //}
               // }
                // echo '<pre>';
                // print_r($b);
                // die;
                if (isset($result)) {
                    $data = $this->notification_model->get_notificationchild();
                    //echo '<pre>';
                    //print_r($data);
                    foreach ($data as $k => $v) {
                        $data3 = $this->notification_model->update_device1($data[$k]['child_id']);
                        $this->notification_model->delete_push($data[$k]['user_id'], $data[$k]['child_id']);
                    }
                }
            } else {
                $message = "no notification sent";
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
    }
    
    public function parentnotification1() {
        
        
        $msg_payload = array(
            'mtitle' => 'App Uninstall',
            'mdesc' => ' Your child has uninstalled noeZee app',
            'msubtitle' => ' Your child has uninstalled noeZee app',
        );
        try {
            // echo '<pre>';
            
            $data = $this->notification_model->get_notificationchild();
           
            foreach ($data as $k => $v) {
                $fcmMsg = array(
                        'body' => 'App Uninstall-' . $v['device_name'],
                        'title' => 'Your child has uninstalled noeZee app',
                        'sound' => "default",
                        'color' => "#203E78",
                        'type' => 'P'
                    );

                $user_id = $data[$k]['user_id'];                
                $data2 = $this->notification_model->get_parent_push($user_id);
                foreach ($data2 as $k2 => $v2) {
                if (($data2[$k2]['device_os'] == 'Android' || $data2[$k2]['device_os'] == 'android' ) && $data2[$k2]['device_os'] != '') {
                                   
                                   //echo $data2[$k2]['device_token'];
                                   //echo '##########';
                                   
                              echo $result = $this->send($fcmMsg, $data2[$k2]['device_token'], $v['device_name']);
 
                                   
                               } 
                               if (isset($data2[$k2]['device_os']) == 'ios') {
                          echo $result = $this->isend($msg_payload, $data2[$k2]['device_token'], $v['device_name']);

                          } 
                
                }
                $data3 = $this->notification_model->update_device1($data[$k]['child_id']);
               $this->notification_model->delete_push($data[$k]['user_id'], $data[$k]['child_id']);
                
            }  
           } catch (Exception $e) {
            $message = $e->getMessage();
        }
        
    }

    public function parentmedianotification() {


        $msg_payload = array(
            'mtitle' => 'Media Upload',
            'mdesc' => 'Your child has uploaded media',
            'msubtitle' => 'child app information',
        );
        try {
            // echo '<pre>';
            $a = array();
            $data = $this->notification_model->get_allchild();
            foreach ($data as $k => $v) {

                if ($data[$k]['num'] > 0) {
                    $a[] = $data[$k]['user_id'];
                }
            }
            $a = array_unique($a);

            print_r($a);
            //die;
            if ($data) {
                foreach ($a as $y) {
                    $data1 = $this->notification_model->get_parent($y);
                    foreach ($data1 as $k1 => $v1) {


                        $data2 = $this->notification_model->get_achild($y);
                        foreach ($data2 as $k2 => $v2) {
                            if (isset($data1[$k1]['device_os']) == 'android' || isset($data1[$k1]['device_os']) == 'Android') {

                                $fcmMsg = array(
                                    'body' => 'Media Upload-' . $data2[$k2]['device_name'],
                                    'title' => 'Your child has uploaded media',
                                    'sound' => "default",
                                    'color' => "#203E78",
                                    'type' => 'P'
                                );
                                echo $result = $this->send($fcmMsg, $data1[$k1]['device_token'], $data2[$k2]['device_name']);
                            }
                            if (isset($data1[$k1]['device_os']) == 'ios') {

                                //echo $data[$k1]['device_token'];
                                // echo '--------';
                                $result = $this->isend($msg_payload, $data1[$k1]['device_token'], $data2[$k2]['device_name']);
                            }
                        }
                    }
                }
            } else {
                $message = "no notification sent";
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
        }
    }

    public function send($fcmMsg, $reg_id, $device_name) {

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
    public function isend($data, $devicetoken, $device_name) {

        $deviceToken = $devicetoken;
        $ctx = stream_context_create();
        // ck.pem is your certificate file
        stream_context_set_option($ctx, 'ssl', 'local_cert', '/var/www/html/neozee/public/pushcert-prod.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', self::$passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        // Create the payload body
        $body['aps'] = array(
            'alert' => array(
                'title' => $data['mtitle'] . '-' . $device_name,
                'body' => $data['mdesc']
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

    // Curl 
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
