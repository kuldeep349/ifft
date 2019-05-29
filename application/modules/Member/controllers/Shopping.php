<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shopping extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('encryption');
        $this->load->model(array('member_model'));
        $this->load->helper(array('member'));
    }

    public function index() {
        if (is_loggedin() == true) {
            $this->load->view('header');
            $this->load->view('sample');
            $this->load->view('footer');
        } else {
            redirect('/Member/Login');
        }
    }

    public function products() {
        if (is_loggedin() == true) {
            $result['products'] = $this->member_model->getData('tbl_products', array(), '*');
            $this->load->view('header');
            $this->load->view('Shopping/product_list',$result);
            $this->load->view('footer');
        } else {
            redirect('/Member/Login');
        }
    }

}
