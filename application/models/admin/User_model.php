<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_media($id = 0, $limit, $start, $filterData, $sortData = "") {

        $this->db->select('*,media.created_date as date');
        $this->db->from(USERS . ' as media');
        //$this->db->join(USERS . ' as address', 'address.id = media.user_id', 'inner');

        if (!is_array($sortData) || ($sortData['sort_by'] == "" && $sortData['sort_direction'] == ""))
            $this->db->order_by('media.created_date', 'desc');
        else
            $this->db->order_by($sortData['sort_by'], $sortData['sort_direction']);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        //echo $this->db->last_query();
        return $result->result_array();
    }

    public function get_count_media($filterData = array()) {

        $this->db->from(USERS . ' as media');
        //$this->db->join(USERS . ' as address', 'address.id = media.user_id', 'inner');

        $result = $this->db->get();
        return $result->num_rows();
    }

}
?>

