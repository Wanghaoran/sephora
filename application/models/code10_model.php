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
        $this -> db -> insert('code30', $data);
        return $this->db->insert_id();
    }


    /*
    //查询用户是否存在 openid
    public function queryhave($openID){
        $query = $this -> db -> get_where('user', array('openid' => $openID), 1);
        return $query -> result_array();
    }

    //查询用户是否存在 id
    public function queryhave2($id){
        $query = $this -> db -> get_where('user', array('id' => $id), 1);
        return $query -> result_array();
    }

    //创建用户资料
    public function insertuser($openid, $nickname, $sex, $language, $city, $province, $country, $headimgurl){
        $data = array(
            'openid' => $openid,
            'nickname' => $nickname,
            'sex' => $sex,
            'language' => $language,
            'city' => $city,
            'province' => $province,
            'country' => $country,
            'headimgurl' => $headimgurl,
            'addtime' => date('Y-m-d H:i:s'),
        );

        $this -> db -> insert('user', $data);

        return $this->db->insert_id();
    }

    //获取总人数
    public function gettotal(){
        $now = $this->db->count_all_results('user');
        return $now;
    }



    public function getallhotel()
    {

        $this -> db -> where('show', 1);
        $query = $this -> db -> get('hotel');
        return $query -> result_array();
    }

    public function gethotelbynum()
    {

        $this->db->order_by("num", "DESC");
        $this->db->limit(3);
        $query = $this -> db -> get('hotel');
        return $query -> result_array();
    }

    public function gethotelbylimit($page)
    {
        $start = $page * 9 - 9;
        $this->db->limit(9, $start);
        $query = $this -> db -> get('hotel');
        return $query -> result_array();
    }

    public function addnum($cid, $step = 1){

        $query = $this -> db -> get_where('hotel', array('id' => $cid), 1);
        $result = $query -> row_array();
        $data = array(
            'num' => $result['num'] + $step,
        );
        $this -> db -> where('id', $cid);
        return $this -> db -> update('hotel', $data);
    }

    public function get_hotel($id)
    {
        $query = $this -> db -> get_where('hotel', array('id' => $id), 1);
        return $query -> row_array();
    }

    //获得酒店数量
    public function gettotalnum(){
        $now = $this->db->count_all_results('hotel');
        return $now;
    }

    //获得所有酒店按投票数排序
    public function getallhotelbynum(){
        $this->db->order_by("num", "DESC");
        $query = $this -> db -> get('hotel');
        return $query -> result_array();
    }
    */
}
