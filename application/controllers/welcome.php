<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


    /*
	public function index()
	{
        //route
        $this->load->helper('url');
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false){
            redirect('welcome/wechat_index');
        }else{
            redirect('welcome/weibo_index');
        }
	}

    //wechat index
    public function wechat_index(){
        $this->load->helper('url');
        if(empty($_GET['code'])){
            $token_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx949efd128cd9bf73&redirect_uri=' . urlencode('http://sephora.cnhtk.cn/wechat') . '&response_type=code&scope=snsapi_userinfo&state=index#wechat_redirect';
            redirect($token_url);
        }else{
            var_dump($_GET);
        }
    }

    //weibo index
    public function weibo_index(){
        var_dump($_POST);
    }

    */


    public function wechat_index(){
        $this->load->view('wechat_index');
    }

    public function terms(){
        $this->load->view('terms');
    }

    public function question(){

        //check authorization
        if(!$this->session->userdata('sephora_wechat_id')){
            $this->load->helper('url');
            redirect('welcome/oauth2_authorize');
        }

        $this->load->view('question');
    }

    public function oauth2_authorize(){
        $this->load->helper('url');
        if(empty($_GET['code'])){
            $token_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx949efd128cd9bf73&redirect_uri=' . urlencode('http://sephora.cnhtk.cn/index.php/welcome/oauth2_authorize') . '&response_type=code&scope=snsapi_userinfo&state=question#wechat_redirect';
            redirect($token_url);
        }

        //get token
        $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx949efd128cd9bf73&secret=f5b75c8db05e107944f144b6eff2b304&code=' . $_GET['code'] . '&grant_type=authorization_code';
        $result_json = file_get_contents($token_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure1!' .  $result_arr['errmsg'] . '</h1>');
        }

        //get user info
        $info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $result_arr['access_token'] . '&openid=' . $result_arr['openid'] . '&lang=zh_CN';
        $result_json = file_get_contents($info_url);
        $result_arr = json_decode($result_json, true);
        if(!empty($result_arr['errcode'])){
            die('<h1>Authorization failure2!' .  $result_arr['errmsg'] . '</h1>');
        }

        //select user
        $this -> load -> model('wechatuser_model');
        if($query_result = $this -> wechatuser_model -> queryhave($result_arr['openid'])){
            //write session
            $this->session->set_userdata('sephora_wechat_id', $query_result[0]['id']);
        }else{
            //create user
            if(!$insert_id = $this -> wechatuser_model -> insertuser($result_arr['openid'], $result_arr['nickname'], $result_arr['sex'], $result_arr['language'], $result_arr['city'], $result_arr['province'], $result_arr['country'], $result_arr['headimgurl'])){
                die('<h1>Authorization failure3! Insert User Error</h1>');
            }else{
                //write session
                $this->session->set_userdata('sephora_wechat_id', $insert_id);
            }
        }

        redirect('welcome/' . $_GET['state']);


    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */