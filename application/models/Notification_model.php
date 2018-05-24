<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /** get aceptance for client * */
    public function get_parent($Id) {
        $filters['user_id'] = $Id;
        $filters['user_type'] = 'P';
        $this->db->select('device_token,device_os,device_name,device_id,user_id');
        $this->db->from(USERSDEVICE);
        $this->db->where($filters);
        $result = $this->db->get();
        //echo $this->db->last_query();
        $clientArr = $result->result_array();
        return $clientArr;
    }
    public function get_parent_push($Id) {
        $filters['user_id'] = $Id;
        $filters['user_type'] = 'P';
        $this->db->select('device_token,device_os,device_name,device_id,user_id');
        $this->db->from(USERSDEVICE);
        $this->db->where($filters);
        $result = $this->db->get();
        //echo $this->db->last_query();
        $clientArr = $result->result_array();
        return $clientArr;
    }

    public function get_child() {

        $filters['user_type'] = 'C';

        $this->db->select('device_token,device_os,device_id,user_id,id,device_name');
        $this->db->from(USERSDEVICE);
        $this->db->where($filters);
        $where = "device_token!=''";
        $this->db->where($where);
        $result = $this->db->get();
        echo $this->db->last_query();
        $clientArr = $result->result_array();
        return $clientArr;
    }

    public function get_notificationchild() {


        $this->db->distinct('user_id,child_id,device_name');
        $this->db->from('neo_push');
        $this->db->like('created_date', date('Y-m-d'), 'both');
        $where = " sent = '0'";
        $this->db->where($where);
        $this->db->order_by('user_id','asc');
        $result = $this->db->get();
        $clientArr = $result->result_array();
        return $clientArr;
    }
    
     public function get_anotificationchild($user_id) {

        $filters['user_id']=$user_id;
        $this->db->distinct('user_id,child_id,device_name');
        $this->db->from('neo_push');
        $this->db->like('created_date', date('Y-m-d'), 'both');
        $this->db->where($filters);
        $result = $this->db->get();
        $clientArr = $result->result_array();
        return $clientArr;
    }

    public function get_allchildbk() {

        //$filters['user_type']='C';
        //$filters['m.add_date']=date('Y-m-d');
        $this->db->select('u.user_id,u.device_id,u.device_token,u.device_os,count(m.id) as num');
        $this->db->from(USERSDEVICE . ' as u');
        $this->db->join(MEDIA . ' as m', 'm.device_id = u.device_id', 'inner');
        $this->db->like('m.add_date', date('Y-m-d'), 'both');
        //$this->db->where($filters);
        $this->db->group_by('u.device_id');
        $result = $this->db->get();
        //echo $this->db->last_query();
        $clientArr = $result->result_array();
        return $clientArr;
    }

    public function get_allchild() {

        $sql = "select distinct U.device_id, U.user_id, D.device_token, D.device_os, U.userCount as num from (select user_id, device_id, count(user_id) as userCount from neo_media where add_date like '%" . date('Y-m-d') . "%' group by user_id,device_id) as U inner join neo_device as D on U.device_id = D.device_id and U.user_id = D.user_id";
        $result = $this->db->query($sql);
        //echo $this->db->last_query();
        $clientArr = $result->result_array();
        return $clientArr;
    }
    
    public function get_achild($user_id) {

        $sql = "select distinct U.device_id,D.device_name, U.user_id, D.device_token, D.device_os, U.userCount as num from (select user_id, device_id, count(user_id) as userCount from neo_media where add_date like '%" . date('Y-m-d') . "%' group by user_id,device_id) as U inner join neo_device as D on U.device_id = D.device_id and U.user_id = D.user_id";
        $sql.=" where push=1 and D.user_type='C' and  U.user_id = ".$user_id;
        $result = $this->db->query($sql);
        //echo $this->db->last_query();
        $clientArr = $result->result_array();
        return $clientArr;
    }

    public function push_user($userData) {
        $this->db->select('id');
        $this->db->from('neo_push');
        $this->db->where($userData);

        $result = $this->db->get();
        $clientArr = $result->num_rows();
        if ($clientArr == 0) {
            $this->db->insert('neo_push', $userData);

            $id = $this->db->insert_id();

            return $id;
        }
    }

    public function update_device($device_id) {
        $userData['push'] = "0";
        $userData['status'] = "0";
        $this->db->where('user_type', 'C');
        $this->db->where('device_id', $device_id);
        $this->db->update(USERSDEVICE, $userData);
        return $this->db->affected_rows();
    }

    public function update_device1($id) {
        $userData['push'] = "0";
        $userData['status'] = "0";
        $this->db->where('user_type', 'C');
        $this->db->where('id', $id);
        $this->db->update(USERSDEVICE, $userData);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function delete_push($user_id, $device_id) {
        $userData['sent'] = "1";
        $this->db->where('user_id', $user_id);
        $this->db->where('child_id', $device_id);
        $this->db->update('neo_push',$userData);
        // echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    public function get_pushdevice($user_id,$device_id) {


        $this->db->select('device_name');
        //$this->db->where('user_id', $user_id);
        $this->db->where('child_id', $device_id);
        $this->db->from('neo_push');
        $result = $this->db->get();
        echo $this->db->last_query();
        $clientArr = $result->result_array();
        return $clientArr;
    }
}

?>