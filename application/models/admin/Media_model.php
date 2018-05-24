<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Media_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_media($id = 0, $limit, $start, $filterData, $sortData = "") {

        $this->db->select('*,media.add_date as date,address.email');
        $this->db->from('neo_media' . ' as media');
       $this->db->join(USERS . ' as address', 'address.id = media.user_id', 'inner');

        if (!is_array($sortData) || ($sortData['sort_by'] == "" && $sortData['sort_direction'] == ""))
            $this->db->order_by('media.add_date', 'desc');
        else
            $this->db->order_by($sortData['sort_by'], $sortData['sort_direction']);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_count_media($filterData = array()) {

        $this->db->from('neo_media'. ' as media');
               $this->db->join(USERS . ' as address', 'address.id = media.user_id', 'inner');

        $result = $this->db->get();
        return $result->num_rows();
    }
 
    
     public function get_mediadetails($mediaId = 0) {
        $this->db->from('neo_media' . ' as media');
        //$this->db->join(STOREDETAILS . ' as address', 'address.store_id = media.token', 'left');
        $this->db->where('media.id', $mediaId);
        $result = $this->db->get();
     
        return $result->result_array();
    }
    
 public function edit_media($mediaid, $apk,$apk_path,$status) {
        $userData['apk'] = $apk;
        $userData['apk_path'] = $apk_path;
        $userData['confirm_status'] = $status;
        $this->db->where("store_id", $mediaid);
        $this->db->update(STOREDETAILS, $userData);
        return $mediaid;
    }

    

}
?>

