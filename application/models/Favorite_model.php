<?php

/**  media model for technician client media * */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Favorite_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /** This function used to read media for all available filters * */
    public function get_media($fields, $page = null, $limit = 10, $filters = array(), $likes = array(), $orders = array()) {
        $filters['status'] = '1'; // display active record
        set_query($fields, $page, $limit, $filters, $likes, $orders);
        $this->db->from(FAVORITE);
        $result = $this->db->get();
        checkForError();
        //echo $this->db->last_query();
        return $result->result_array();
    }
    
   
     

    public function register_media($mediaData) {

        $this->db->insert(FAVORITE, $mediaData);
        checkForError();
        $id = $this->db->insert_id();
        return $id ;
    }

    public function update_media($id, $mediaData) {
        $this->db->where("fav_id", $id);
        $this->db->update(FAVORITE, $mediaData);
        //echo $this->db->last_query();die;
        checkForError();
        return $this->db->affected_rows();
    }

    public function delete_media($id) {
        $mediaData['status'] = '0';
        $this->db->where("fav_id", $id);
        $this->db->update(FAVORITE, $mediaData);
        checkForError();
        return $this->db->affected_rows();
    }

    public function register_mediadevice($mediaData) {

        $this->db->insert(FAVORITE, $mediaData);
        checkForError();
        $id = $this->db->insert_id();
        if ($id > 0) {
            return $id;
        } else {
            return false;
        }
    }

    /** media list * */
}
?>

