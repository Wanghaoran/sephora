<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this -> load -> database();
    }

    public function getcode($ctype, $ttype, $uid, $ip){


    }
}
