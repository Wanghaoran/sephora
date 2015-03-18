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
            'q' => $this -> CI -> config -> item('questions')
        );

        $this->load->view('question', $data);
    }

    public function answer(){

        $q = $this->input->get('q');
        $question_arr = array(
            '1' => array(
                '1' => '答案1-1',
                '2' => '答案1-2',
                '3' => '答案1-3',
            ),
            '2' => array(
                '1' => '答案2-1',
                '2' => '答案2-2',
                '3' => '答案2-3',
            ),
            '3' => array(
                '1' => '答案3-1',
                '2' => '答案3-2',
                '3' => '答案3-3',
            ),
            '4' => array(
                '1' => '答案4-1',
                '2' => '答案4-2',
                '3' => '答案4-3',
            ),
            '5' => array(
                '1' => '答案5-1',
                '2' => '答案5-2',
                '3' => '答案5-3',
            ),
        );

        $data = array(
            'answer_arr' => $question_arr[$q],
            'q' => $q,
        );
        $this->load->view('answer',$data);
    }

    public function customquestion(){
        $this->load->view('customquestion');
    }

    public function creatquestion(){
        var_dump($_GET);
    }

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */