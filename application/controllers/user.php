<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    public function _remap($method, $params = array()){

        //check authorization
        if(!$this->session->userdata('sephora_wechat_id')){
            $this->load->helper('url');
            redirect('welcome/oauth2_authorize');
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

        $data = array(
            'answer_arr' => $this -> config -> item('questions')[$q]['answer'],
            'q' => $q,
        );
        $this->load->view('answer',$data);
    }

    public function customquestion(){
        $this->load->view('customquestion');
    }

    public function creatquestion(){
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
            $q = $this -> config -> item('questions')[$this->input->get('q')]['question'];
            $a1 = $this -> config -> item('questions')[$this->input->get('q')]['answer'][1];
            $a2 = $this -> config -> item('questions')[$this->input->get('q')]['answer'][2];
            $a3 = $this -> config -> item('questions')[$this->input->get('q')]['answer'][3];
            $true = $this->input->get('a');

        }
        $qid = $this -> question_model -> insertquestion($uid, $q, $a1, $a2, $a3, $true);
        if(!$qid){
            die('<h1>Creat Question Fail!</h1>');
        }

        $this->load->view('answer');


    }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */