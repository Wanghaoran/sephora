<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function _remap($method, $params = array()){

        //check authorization
        if(!$this->session->userdata('sephora_wechat_id')){
            $this->load->helper('url');
            /*
            if($method == 'usercenter'){
                redirect('welcome/oauth2_authorize?q=usercenter');
            }else{
                redirect('welcome/oauth2_authorize?q=question');

            }
            */
            redirect('welcome/oauth2_authorize?q=question');

        }

        if (method_exists($this, $method))
        {
            return call_user_func_array(array($this, $method), $params);
        }
        show_404();
    }

    public function question(){

        $data = array(
            'q' => $this -> config -> item('questions'),
        );

        $this->load->view('question', $data);
    }

    public function answer(){

        $q = $this->input->get('q');

        $question_arr = array(
            1 => array(
                'question' => '姐最满意自己哪一部分？',
                'answer' => array(
                    1 => '前凸后翘',
                    2 => '颜值爆表',
                    3 => '姐哪儿都美',
                ),
            ),
            2 => array(
                'question' => '哪种男生是姐的菜？',
                'answer' => array(
                    1 => '大叔',
                    2 => '小鲜肉',
                    3 => '都到我碗里来',
                ),
            ),
            3 => array(
                'question' => '姐是什么Cup？',
                'answer' => array(
                    1 => '一马平川',
                    2 => '普普通通B/C罩',
                    3 => '大又不是我的错，怪我咯',
                ),
            ),
            4 => array(
                'question' => '我在朋友圈是什么卦？',
                'answer' => array(
                    1 => '吃吃吃，深夜报复社会',
                    2 => '旅行感悟，文艺青年',
                    3 => '闺蜜聚会美照，绿茶就是我！',
                ),
            ),
            5 => array(
                'question' => '该不该看男人手机？',
                'answer' => array(
                    1 => '天性不可压，看呀！！',
                    2 => '懒得看',
                    3 => '无所谓，姐就是随性',
                ),
            ),
        );


        $data = array(
            'answer_arr' => $question_arr[$q]['answer'],
            'question' => $question_arr[$q]['question'],
            'q' => $q,
        );
        $this->load->view('answer',$data);
    }

    public function customquestion(){
        $this->load->view('customquestion');
    }

    public function creatquestion(){


        $question_arr = array(
            1 => array(
                'question' => '姐最满意自己哪一部分？',
                'answer' => array(
                    1 => '前凸后翘',
                    2 => '颜值爆表',
                    3 => '姐哪儿都美',
                ),
            ),
            2 => array(
                'question' => '哪种男生是姐的菜？',
                'answer' => array(
                    1 => '大叔',
                    2 => '小鲜肉',
                    3 => '都到我碗里来',
                ),
            ),
            3 => array(
                'question' => '姐是什么Cup？',
                'answer' => array(
                    1 => '一马平川',
                    2 => '普普通通B/C罩',
                    3 => '大又不是我的错，怪我咯',
                ),
            ),
            4 => array(
                'question' => '我在朋友圈是什么卦？',
                'answer' => array(
                    1 => '吃吃吃，深夜报复社会',
                    2 => '旅行感悟，文艺青年',
                    3 => '闺蜜聚会美照，绿茶就是我！',
                ),
            ),
            5 => array(
                'question' => '该不该看男人手机？',
                'answer' => array(
                    1 => '天性不可压，看呀！！',
                    2 => '懒得看',
                    3 => '无所谓，姐就是随性',
                ),
            ),
        );


        $this -> load -> model('question_model');
        if(!empty($_POST)){
            //customquestion
            $uid = $this->session->userdata('sephora_wechat_id');
            $q = $this->input->post('ques');
            $a1 = $this->input->post('ans1');
            $a2 = $this->input->post('ans2');
            $a3 = $this->input->post('ans3');
            $true = $this->input->post('trueanswer');
        }else{
            $uid = $this->session->userdata('sephora_wechat_id');
            $q = $question_arr[$this->input->get('q')]['question'];
            $a1 = $question_arr[$this->input->get('q')]['answer'][1];
            $a2 = $question_arr[$this->input->get('q')]['answer'][2];
            $a3 = $question_arr[$this->input->get('q')]['answer'][3];
            $true = $this->input->get('a');
        }
        $qid = $this -> question_model -> insertquestion($uid, $q, $a1, $a2, $a3, $true);
        if(!$qid){
            die('<h1>Creat Question Fail!</h1>');
        }


        //get wechat access_token
        $this -> load -> model('wechattoken_model');
        $token_arr = $this -> wechattoken_model -> gettoken();
        if(!$token_arr){
            $token = $this -> wechattoken_model -> querytoken();
        }else{
            $token = $token_arr[0]['value'];
        }

        if(!$token){
            die('<h1>Get Token Fail!</h1>');
        }

        //get wechat ticket
        $ticket_arr = $this -> wechattoken_model -> getticket();
        if(!$ticket_arr){
            $ticket = $this -> wechattoken_model -> queryticket($token);
        }else{
            $ticket = $ticket_arr[0]['value'];
        }

        if(!$ticket){
            die('<h1>Get Ticket Fail!</h1>');
        }

        //signature
        $timestamp = time();
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $wxnonceStr = "sephora";
        $wxticket = $ticket;
        $wx_str = 'jsapi_ticket=' . $wxticket . '&noncestr=' . $wxnonceStr . '&timestamp=' . $timestamp . '&url=' . $url;
        $wxSha1 = sha1($wx_str);
        $data = array(
            'timestamp' => $timestamp,
            'nonceStr' => $wxnonceStr,
            'signature' => $wxSha1,
            'qid' => $qid,
            'q' => $q,
        );
        $this->load->view('creatquestion', $data);
    }

    public function startgift($qid){
        $data = array(
            'qid' => $qid,
        );
        $this->load->view('startgift', $data);

    }

    public function endquestion($qid){
        $this->load->helper('url');

        //check question type
        $this -> load -> model('question_model');
        $qtype = $this -> question_model -> gettype($qid);
        if($qtype != 1){
            redirect('user/usercenter');
        }

        //get 30code
        $this -> load -> model('code_model');
        $uid = $this->session->userdata('sephora_wechat_id');
        $ip = $this->input->ip_address();
        $ttype = 30;
        $code = $this -> code_model -> getcode($ttype, 2, $uid, $qid, $ip);

        if(!$code){
            //again
            $code = $this -> code_model -> getcode($ttype, 2, $uid, $qid, $ip);
        }

        if(!$code){
            redirect('user/usercenter');
        }

        //update question type
        $this -> question_model -> updatetype($qid);

        $data = array(
            'ttype' => $ttype,
            'code' => $code,
            'q' => $qid,
        );

        $this->load->view('endquestion', $data);

    }




}

/* End of file user.php */
/* Location: ./application/controllers/user.php */