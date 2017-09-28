<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: superdev
 * Date: 9/28/2017
 * Time: 11:14 AM
 */
class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users');
    }

    function index(){
        echo 'fffffffffffff';
    }

    public function login(){
        header('Content-Type: application/json');

        $json = $this->input->get();
//        $success_msg = array(
//            "status"=>"success"
//        );
//        $error_msg = array(
//            "status"=>"error"
//        );
        echo json_encode($this->users->getUser($json), JSON_PRETTY_PRINT);

    }

    public function register(){
        header('Content-Type: application/json');

        $json = $this->input->get();
        $success_msg = array(
            "status"=>"success"
        );
        $error_msg = array(
            "status"=>"error"
        );
        echo json_encode($this->users->register($json), JSON_PRETTY_PRINT);
        return;
    }
}