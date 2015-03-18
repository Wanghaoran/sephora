<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Code10_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this -> load -> database();
    }

    public function insertcode($code){
        $data = array(
            'code' => $code,
        );
        $this -> db -> insert('code50', $data);
        return $this->db->insert_id();
    }
}
