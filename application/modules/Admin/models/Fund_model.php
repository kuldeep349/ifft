<?php

class Fund_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getData($table, $where, $select) {
        $this->db->select($select);
        $query = $this->db->get_where($table, $where);
        return $query->result_array();
    }
    public function update($table ,$where, $data) {
        $this->db->where($where);
        return $this->db->update($table, $data);
    }
    public function create($table,$data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
}
