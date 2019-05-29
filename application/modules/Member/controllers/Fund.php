<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('encryption');
        $this->load->model(array('member_model'));
        $this->load->helper(array('member'));
    }

    public function index() {
        if (is_loggedin() == true) {
            $result = array();
            if ($this->input->post()) {
//                pr($this->input->post(),true);
                $amount = $this->input->post('amount');
                $deposit_date = $this->input->post('deposit_date');
                $payment_method = $this->input->post('payment_method');
                $description = $this->input->post('description');
                $transaction_id = $this->input->post('transaction_id');
                if ($amount == '') {
                    $result['error'] = 'Invalid Amount';
                } elseif ($payment_method == '') {
                    $result['error'] = 'Invalid Payment Method';
                } elseif ($description == '') {
                    $result['error'] = 'Description could not be empty';
                } elseif ($transaction_id == '') {
                    $result['error'] = 'Transaction could not be empty';
                } else {
                    $data = array(
                        'user_id' => $this->session->userdata['user_info']['user_id'],
                        'amount' => $amount,
                        //'deposit_date' => $deposit_date,
                        'payment_method' => $payment_method,
                        'description' => $description,
                        'transaction_id' => $transaction_id,
                    );
                    $transaction_id = $this->member_model->getData('tbl_payment_request', array('transaction_id' => $transaction_id), '*');
                    if (count($transaction_id)) {
                        $result['error'] = "This Transaction ID is Already Used";
                    } else {
                        $res = $this->member_model->create('tbl_payment_request', $data);
                        if ($res == FALSE) {
                            $result['error'] = 'Error while Submitting Request Please try again';
                        } else {
                            $result['error'] = "Payment Request Submitted successfully";
                        }
                    }
                }
            } else {
                $result['error'] = '';
            }
            $this->load->view('header');
            $this->load->view('Fund/fund', $result);
            $this->load->view('footer');
        } else {
            redirect('/Member/Login');
        }
    }

    public function Transctions() {

        if (is_loggedin() == true) {
            $result['transactions'] = $this->member_model->getData('tbl_payment_request', array('user_id' => $this->session->userdata['user_info']['user_id']), '*');
            $this->load->view('header');
            $this->load->view('Fund/history', $result);
            $this->load->view('footer');
        } else {
            redirect('/Member/Login');
        }
    }

}
