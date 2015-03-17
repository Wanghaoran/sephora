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

    //csv reder
    public function csvreder(){
        $this->load->library('csvreader');

        $filePath = './data/BestiesMar50.csv';

        $data = array();
        $data = $this->csvreader->parse_file($filePath);

        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
    */

    public function sendcode(){
        $arr = array();
        $arr['msg'] = '200';
        $arr['num'] = 'testcode';
        $arr['cost'] = '20';
        echo json_encode($arr);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */