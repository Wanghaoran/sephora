<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
        echo 'wechat_index';
    }

    //weibo index
    public function weibo_index(){
        echo 'weibo_index';
        dump($_POST);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */