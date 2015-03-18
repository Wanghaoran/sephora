<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class question_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this -> load -> database();
    }

    public function insertquestion($uid, $q, $a1, $a2, $a3, $true){
        $data = array(
            'uid' => $uid,
            'q' => $q,
            'a1' => $a1,
            'a2' => $a2,
            'a3' => $a3,
            'true' => $true,
            'addtime' => time(),
        );

        $this -> db -> insert('question', $data);

        return $this->db->insert_id();
    }


}
