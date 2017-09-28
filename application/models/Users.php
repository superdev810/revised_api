<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model
{

    /**
     * @vars
     */
    private $_db;


    /**
     * Constructor
     */

    function debug($obj){
        $fp = fopen('/tmp/deubg.txt', 'a');
        fputs($fp, print_r($obj, true)."\n");
        fclose($fp);
    }

    function __construct()
    {
        parent::__construct();
        $this->load->database();

        // define primary table
        $this->_db = 'users';
    }

    function getUser($account){
        $sql_query = "SELECT name, email, code FROM {$this->_db} WHERE email = '".$account['email']."' and password = '".md5($account['password'])."'";

        $query = $this->db->query($sql_query);
        $this->debug($query);
        $result = $query->result();
        $this->debug($result);
        $arr = array();

        if (count($result) != 0){
            $arr["email"]=$result[0]->email;
            $arr["name"]=$result[0]->name;
            $arr["code"]=$result[0]->code;
            $arr['status'] = 200;
        } else{
            $arr['status'] = 400;
        }
        return $arr;
    }

    function register($request){

        $sql = "
                INSERT INTO {$this->_db} (
                    name,
                    password,
                    email,
                    code
                ) VALUES (
                    '".$request['name']."',
                    '".md5($request['password'])."',
                    '".$request['email']."',
                    ".$request['code']."
                )
            ";

            $query = $this->db->query($sql);
            $arr = array();
            if ($query)
            {
                $id = $this->db->insert_id();
                $arr['status'] = 200;
                $arr['user_id'] = $id;
                return $arr;
            }

            $error = $this->db->error();
            $this->debug($error);
            // If an error occurred, $error will now have 'code' and 'message' keys...
            if (isset($error['message'])) {
                $arr['status'] = 400;
                $arr['msg'] = $error['message'];
                return $arr;
            }

            //return $err;
    }
}