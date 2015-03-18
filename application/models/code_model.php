<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this -> load -> database();
    }

    public function getcode($ctype, $ttype, $uid, $ip){
        $query = $this -> db -> get_where('code' . $ctype, array('type' => 1), 1);
        return $query -> result_array();
    }
}
