<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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

    public function register_user() {
        if (is_loggedin() == true) {
            $result = array();
            if ($this->input->post()) {
                $first_name = $this->input->post('first_name');
                $last_name = $this->input->post('last_name');
                $phone = $this->input->post('phone');
                $email = $this->input->post('email');
                $proof_type = $this->input->post('proof_type');
                $proof = $this->input->post('proof');
                if ($first_name == '') {
                    $result['error'] = 'Please Set An First Name';
                } elseif ($phone == '') {
                    $result['error'] = 'Please Set An Phone';
                } elseif ($email == '') {
                    $result['error'] = 'Please Set An Email';
                } elseif ($proof_type == '') {
                    $result['error'] = 'Please Set An Proof Type';
                } elseif ($proof == '') {
                    $result['error'] = 'Please Set An Proof';
                }
                $user_id = $this->generate_user_id();
                $password = rand(1000,9999);
                $MemberData = array(
                    'user_id' => $user_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'phone' => $phone,
                    'email' => $email,
                    'proof_type' => $proof_type,
                    'proof' => $proof,
                    'password' => $password,
                    'sponser_id' => $this->session->userdata['user_info']['user_id'],
                );
                $res = $this->member_model->create('tbl_users', $MemberData);
                if ($res == FALSE) {
                    $result['error'] = 'Error while Submitting Generating User Please try again';
                } else {
                    send_sms($phone, 'Dear '.$first_name .' New Joining Added Successfully UserId ' . $user_id . ' Password ' . $password);
                    $result['error'] = "New Joining Created Successfully";
                }
            } else {
                $result['error'] = '';
            }
            $this->load->view('header');
            $this->load->view('User/register_user',$result);
            $this->load->view('footer');
        } else {
            redirect('/Member/Login');
        }
    }
    public function profile(){
        if (is_loggedin() == true) {
            $result = array();
            $result['user'] = userdetails();
            $this->load->view('header');
            $this->load->view('User/profile',$result);
            $this->load->view('footer');
        } else {
            redirect('/Member/Login');
        }
    }
    public function generate_user_id() {
       return $user_id = 'IF'.rand(10000,99999);
        $transaction_id = $this->member_model->getData('tbl_users', array('user_id' => $user_id), 'id');
        if (count($transaction_id)) {
            return $this->generate_user_id();
        }else{
            return $user_id;
        }
    }

    public function email() {
        send_sms('7710562000', 'this is test msg');
        die('here');
        $this->load->library('email');

        $this->email->from('info@internationalfashiontraffic.com', 'IFFT');
        $this->email->to('349kuldeep@gmail.com');
//        $this->email->cc('another@another-example.com');
//        $this->email->bcc('them@their-example.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        if (!$this->email->send()) {
            echo 'Not send';
        }
    }

}
