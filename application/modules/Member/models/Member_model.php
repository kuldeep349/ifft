<?php

class Member_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function check_login($user_id, $password) {
        $this->db->select('id,email,password,user_id');
        $query = $this->db->get_where('tbl_users', array('user_id' => $user_id, 'password' => $password));
        $res = $query->row_array();
//        echo $this->db->last_query();
        return $res;
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

}
