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
            $result['error'] = '';
            if ($this->input->post()) {
                $amount = 8263;
                $deposit_date = $this->input->post('deposit_date');
                $payment_method = $this->input->post('payment_method');
                $description = $this->input->post('description');
                if ($amount == '') {
                    $result['error'] = 'Invalid Amount';
                } elseif ($deposit_date == '') {
                    $result['error'] = 'Invalid Deposit Date';
                } elseif ($payment_method == '') {
                    $result['error'] = 'Invalid Payment Method';
                } elseif ($description == '') {
                    $result['error'] = 'Description could not be empty';
                } else {
                    $ext = explode('.', basename($_FILES['userfile']['name']));
                    $file_extension = end($ext);
                    $new_image_name = 'IMG_' . time() . '.' . $file_extension;
                    $config['upload_path'] = './uploads/';
                    $config['file_name'] = $new_image_name;
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4';
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('userfile')) {
                        echo $result['error'] = $this->upload->display_errors();
                        pr($_FILES['userfile']['name']);
                    } else {

                        $upload_data = $this->upload->data();
                        $data = array(
                            'user_id' => $this->session->userdata['user_info']['user_id'],
                            'amount' => $amount,
                            'deposit_date' => $deposit_date,
                            'payment_method' => $payment_method,
                            'description' => $description,
                            'image' => $new_image_name
                        );
                        $res = $this->post_model->create('tbl_payment_request', $data);
                        $response['error'] = "image Uploaded successfully";
                    }
                }
            }
            $this->load->view('header');
            $this->load->view('Fund/fund', $result);
            $this->load->view('footer');
        } else {
            redirect('/Member/Login');
        }
    }

}
