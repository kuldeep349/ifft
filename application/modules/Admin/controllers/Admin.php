<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $config['encryption_key'] = 'kuldeep';
        $this->load->library('encryption');
        $this->load->model(array('user_model'));
        $this->load->helper(array('admin'));
    }

    public function index() {
        if (is_loggedin() == true && is_admin() == TRUE) {
            $this->load->view('header');
            $this->load->view('sample');
            $this->load->view('footer');
        } else {
            redirect('/Admin/Login');
        }
    }

    public function login() {

        if (is_loggedin() === true && is_admin() == TRUE) {
            redirect('/Admin');
        } else {
            $response['error'] = 'no error';
            $response = array();
            if ($this->input->post()) {
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                if ($this->form_validation->run() === false) {
                    $response['error'] = 'Please fill proper email/password';
                    $response['success'] = 0;
                } else {
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    if ($this->user_model->check_login($email, $password) == TRUE) {
                        $userinfo = $this->user_model->check_login($email, $password);
                        $_SESSION['user_id'] = $userinfo['id'];
                        $_SESSION['logged_in'] = (bool) true;
                        $response['user_info'] = $userinfo;
                        $_SESSION['user_info'] = $userinfo;
//                        $this->session->userdata = $userinfo;
//                        $this->session->userdata['logged_in'] = (bool) true;
                        redirect('/Admin');
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
            redirect('/Admin/login');
        } else {
            redirect('/Admin/login');
        }
    }

}
