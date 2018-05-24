<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Favorite_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_media($id = 0, $limit, $offset, $filterData, $sortData = "") {


        $sql = "SELECT  distinct `m`.*, `m`.`add_date` as `date`, `m`.`id` as `id`, `f`.`status` as `status`
FROM `neo_favorite` as `f`
INNER JOIN `neo_media` as `m` ON `m`.`id` = `f`.`media_id`
INNER JOIN `neo_user` as `address` ON `address`.`id` = `f`.`user_id`
WHERE `f`.`status` = '1'";
 $sql .= "  and child_id= '".$filterData['device_id']."'";
        $sql .= " ORDER BY `m`.`add_date` DESC";
        $sql .= " limit " . $limit . ", " . $offset . "";

        $query = $this->db->query($sql);

        /*   $this->db->distinct('m.*,m.add_date as date,m.id as id,f.status as status');
          $this->db->from(FAVORITE . ' as f');
          $this->db->join(MEDIA . ' as m', 'm.id = f.media_id', 'inner');
          $this->db->join(USERS . ' as address', 'address.id = f.user_id', 'inner');
          $this->db->where('f.status',"1");
          if (!is_array($sortData) || ($sortData['sort_by'] == "" && $sortData['sort_direction'] == ""))
          $this->db->order_by('m.add_date', 'desc');
          else
          $this->db->order_by($sortData['sort_by'], $sortData['sort_direction']);
          if ($limit > 0)
          $limit = $limit - RECORD_LIMIT;
          $this->db->limit($start, $limit);
          $result = $this->db->get(); */
        // echo $this->db->last_query();
        return $query->result_array();
    }

    public function get_count_media($filterData = array()) {

        //$this->db->from(FAVORITE . ' as media');
        //$this->db->join(USERS . ' as address', 'address.id = media.user_id', 'inner');
        //$this->db->join(MEDIA . ' as m', 'm.id = media.media_id', 'inner');
        //$this->db->where('media.status', "1");
        //$result = $this->db->get();
        $sql = "SELECT  distinct `m`.*, `m`.`add_date` as `date`, `m`.`id` as `id`, `f`.`status` as `status`
FROM `neo_favorite` as `f`
INNER JOIN `neo_media` as `m` ON `m`.`id` = `f`.`media_id`
INNER JOIN `neo_user` as `address` ON `address`.`id` = `f`.`user_id`
WHERE `f`.`status` = '1'";
 $sql .= "  and child_id= '".$filterData['device_id']."'";
        $sql .= " ORDER BY `m`.`add_date` DESC";



        $query = $this->db->query($sql);
        return $query->num_rows();
    }

}
?>

