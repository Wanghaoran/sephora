<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questionuser_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this -> load -> database();
    }

    public function insertinfo($qid, $uid, $type, $code){
        $data = array(
            'qid' => $qid,
            'uid' => $uid,
            'type' => $type,
            'code' => $code,
            'time' => time(),
        );

        $this -> db -> insert('questionuser', $data);
        return $this->db->insert_id();
    }

    public function checkuser($qid, $uid){
        $query = $this -> db -> get_where('questionuser', array('qid' => $qid, 'uid' => $uid), 1);
        return $query -> result_array();
    }

}
