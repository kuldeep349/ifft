<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

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

    public function login() {

        if (is_loggedin() === true) {
            redirect('/Member');
        } else {
            $response = array();
            $response['error'] = '';
            if ($this->input->post()) {
                $this->form_validation->set_rules('user_id', 'Text', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                if ($this->form_validation->run() === false) {
                    $response['error'] = 'Please fill proper email/password';
                    $response['success'] = 0;
                } else {
                    $user_id = $this->input->post('user_id');
                    $password = $this->input->post('password');
                    if ($this->member_model->check_login($user_id, $password) == TRUE) {
                        $userinfo = $this->member_model->check_login($user_id, $password);
                        $_SESSION['user_id'] = $userinfo['id'];
                        $_SESSION['logged_in'] = (bool) true;
                        $response['user_info'] = $userinfo;
                        $_SESSION['user_info'] = $userinfo;
//                        $this->session->userdata = $userinfo;
//                        $this->session->userdata['logged_in'] = (bool) true;
                        redirect('/Member');
                        exit();
                    } else {
                        $response['success'] = 0;
                        $response['error'] = 'Incorrect Email/Password';
                    }
                }
            }
            $this->load->view('login', $response);
        }
    }

    public function Logout() {
        if (is_loggedin() === true) {
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
            redirect('/Member/login');
        } else {
            redirect('/Member/login');
        }
    }

}
