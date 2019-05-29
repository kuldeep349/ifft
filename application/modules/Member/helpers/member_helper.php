<?php

if (!function_exists('pr')) {

    function pr($array, $die = false) {
        echo'<pre>';
        print_r($array);
        echo'</pre>';
        if ($die)
            die();
    }

}

if (!function_exists('encrypt')) {

    function encrypt($id) {
        $salt = '$2a$07$R.gJb2U2N.FmZ4hPp1y2CN$';
        return $hashed_password = crypt($id, $salt);
    }

}
if (!function_exists('validate_password')) {

    function validate_password($id) {
        $salt = '$2a$07$R.gJb2U2N.FmZ4hPp1y2CN$';
        echo $hashed_password = crypt($id, $salt);
        if (hash_equals($hashed_password, crypt($id, $hashed_password))) {
            return true;
        } else {
            return false;
        }
    }

}
if (!function_exists('is_loggedin')) {

    function is_loggedin() {
        if (isset($_SESSION['user_id']) && $_SESSION['logged_in'] === true) {
            return true;
        } else {
            return false;
        }
    }

}
//if (!function_exists('is_admin')) {
//    function is_admin() {
//        $userdetails = userdetails();
//        if ($userdetails['role'] === 'A')
//            return true;
//        else
//            return false;
//    }
//}
if (!function_exists('userdetails')) {

    function userdetails() {
        $ci = & get_instance();
        $ci->load->model('member_model');
        $userdetails = $ci->member_model->get_user_obj($_SESSION['user_id']);
        return $userdetails;
    }

}

function send_sms($phone, $msg) {
    $key = "303f2b8d83XX";
    $userkey = "gniweb2";
    $senderid = "FIFTYF";
    $baseurl = "sms.gniwebsolutions.com/submitsms.jsp?";

    $msg = "$msg";
    $msg = urlencode($msg);

    $url = $baseurl . 'user=' . $userkey . '&&key=' . $key . '&&mobile=' . $phone . '&&senderid=' . $senderid . '&&message=' . $msg . '&&accusage=1';
    curl_get_contents($url);
}

function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    // print_r($data);die;
    return $data;
}
