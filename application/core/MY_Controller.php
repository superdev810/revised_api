<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: superdev
 * Date: 9/28/2017
 * Time: 11:11 AM
 */
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function debug($obj){
        $fp = fopen('deubg.txt', 'a');
        fputs($fp, print_r($obj, true)."\n");
        fclose($fp);
    }
}