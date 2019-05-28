<?php
class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    public function check_login($email, $password) {
        $this->db->select('id,email,password,name,role');
        $query = $this->db->get_where('tbl_admin', array('email' => $email, 'password' => $password));
        $res = $query->row_array();
//        echo $this->db->last_query();
        return $res;
    }
    public function get_user($id){
        $this->db->select('*');
        $query = $this->db->get_where('tbl_admin',array('id' => $id));
        return $query->row_array();
    }
}