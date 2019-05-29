<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fund extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('fund_model'));
        $this->load->helper(array('admin'));
    }

    public function Transactions() {
        if (is_loggedin() == true && is_admin() == TRUE) {
            $result = array();
            $result['transactions'] = $this->fund_model->getData('tbl_payment_request', array(), '*');
            $this->load->view('header');
            $this->load->view('Fund/transactions', $result);
            $this->load->view('footer');
        } else {
            redirect('/Admin/Login');
        }
    }

    public function update_request() {
        if (is_loggedin() == true && is_admin() == TRUE) {
            $response = array();
            $response['success'] = 0;
            $request_id = $this->input->post('request_id');
            $transaction = $this->fund_model->getData('tbl_payment_request', array('id' => $request_id), '*');
            if (count($transaction)) {
                if ($transaction[0]['status'] != 1) {
                    if ($this->input->post('action') == 'Approve') {
                        $res = $this->fund_model->update('tbl_payment_request', array('id' => $request_id), array('status' => 1));
                        if ($res == true) {
                            $response['success'] = 1;
                            $response['message'] = 'This Transaction Updated Successfully';
                            $data = array(
                                'user_id' => $transaction[0]['user_id'],
                                'amount' => $transaction[0]['amount'],
                                'type' => 'main',
                                'description' => 'This Amount Sent By Admin',
                            );
                            $res = $this->fund_model->create('tbl_wallet',$data);
                        }
                    } else {
                        $res = $this->fund_model->update('tbl_payment_request', array('id' => $request_id), array('status' => 2, 'remark' => $this->input->post('remark')));
                        $response['success'] = 1;
                        $response['message'] = 'This Transaction Updated Successfully';
                    }
                } else {
                    $response['message'] = 'This Transaction Already Approved';
                }
            } else {
                $response['message'] = 'Invalid Request ID';
            }
            echo json_encode($response);
        } else {
            redirect('/Admin/Login');
        }
    }

}
