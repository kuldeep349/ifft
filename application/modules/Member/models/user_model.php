<?php

class Member_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_user($id) {
        $this->db->select('*');
        $query = $this->db->get_where('tbl_users', array('id' => $id));
        return $query->row_array();
    }

    public function get_user_obj($id) {
        $this->db->select('*');
        $query = $this->db->get_where('tbl_users', array('id' => $id));
        return $query->row_object();
    }

    public function create($table,$data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function getData($table,$where,$select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        return $query->result_array();
    }

}
