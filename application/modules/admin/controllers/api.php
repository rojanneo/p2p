<?php
/*
 * ApiKey = wISI1cX1CGGXhLLQtxqw9AnmN2QbosxlnWGFJ50xWZIKXexGfVFaNFRy3wjF07KS;
 * apiPassword =xI!@syLOek22;
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('api_model');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('admin');
		$role = $this->session->userdata('role');
		$rating = getRoleRating($role);
		//echo $rating;
		if($rating < 1)
		{
			redirect(config_item('base_url').'admin/dashboard');
		}
    }

    public function index() {
        //echo 'RCPG API';
		
		$apis = $this->api_model->getApiList();
		$data['apis'] = $apis;
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('api_list', $data);
		$this->load->view('footer');
    }
	
	public function add()
	{
		
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('add_api_key');
			$this->load->view('footer');
	}
	
	public function addPost()
	{
		$this->load->library('encrypt');
		$api_key = $this->input->post('api_key');
		$api_pass = $this->input->post('api_pass');
		$salt = $this->getSalt(4);
		$version = $this->input->post('api_version');
		$encryptedPass = $this->encrypt->sha1($salt.$api_pass.$salt);
		$this->api_model->save($api_key, $encryptedPass, $salt, $version);
		redirect(config_item('base_url').'admin/api/');
	}
	
	public function edit($api_id)
	{
		
			
			$api = $this->api_model->getApiData($api_id);
			$data['api'] = $api[0];
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('add_api_key',$data);
			$this->load->view('footer');
	}
	
	public function editPost()
	{
		$this->load->library('encrypt');
		$api_id = $this->input->post('api_id');
		$api_key = $this->input->post('api_key');
		$api_pass = $this->input->post('api_pass');
		$api_data = $this->api_model->getApiData($api_id);
		if($api_pass)
		{
			$salt = $this->getSalt(4);
			$encryptedPass = $this->encrypt->sha1($salt.$api_pass.$salt);
		}
		else
		{
			$salt = $api_data[0]['api_salt'];
			$encryptedPass = $api_data[0]['api_password'];
		}
		$version = $this->input->post('api_version');
		$this->api_model->updateApiData($api_id, $api_key, $encryptedPass, $salt, $version);
		redirect(config_item('base_url').'admin/api');
		//Update Code Here
	}
	
	public function delete($api_id)
	{
		$this->api_model->deleteApi($api_id);
		redirect(config_item('base_url').'admin/api');
	}

    public function code($id) {
        $data['code'] = array(
            '101' => 'Invalid API username or password.',
            '102' => 'API login sucessfull',
            '103' => 'Invalid email',
            '104' => 'Email address already exists',
            '105' => 'Please fill all the required field',
            '106' => 'Password must contain more than 6 words',
            '107' => 'A verification code has been sent to your email. Please input the verification code below.',
            '108' => 'Login failed!! Invalid email address or password.',
            '109' => 'Invalid verification code',
            '110' => 'Login Sucessful',
            '111' => 'Extracting Ringtone',
            '909' => 'Something went wrong.Please try again.'
        );
        return $data['code'][$id];
    }

    function createUser() {
        //checking apiKey and password
        $apiKey = 'wISI1cX1CGGXhLLQtxqw9AnmN2QbosxlnWGFJ50xWZIKXexGfVFaNFRy3wjF07KS'; //$this->input->post('apikey);
        $apiPassword = 'xI!@syLOek22'; //$this->input->post('apipassword);

        if ($this->api_model->checkApi($apiKey, $apiPassword) < 1):
            $data = array(
                'errorcode' => 101,
                'errormessage' => $this->code('101')
            );
            $data['error'] = 1;
            echo json_encode($data);
        else:
            $email = 'uchit@frenzyardg.com'; //$this->input->post('email');
            $password = 'hghgjh'; //$this->input->post('password');
            $validate = $this->validate($email, $password);
            if ($validate['error'] == 1):
                echo json_encode($validate);
            else:
                $salt = $this->salt(4);
                $activationCode = $this->activationCode(4);
                $inserted = $this->api_model->createUser($email, $password, $salt, $activationCode);
                if ($inserted):
                    $data = array(
                        'sucesscode' => 107,
                        'sucessmessage' => $this->code('107')
                    );
                    $data['error'] = 0;
                else:
                    $data = array(
                        'errorcode' => 909,
                        'errormessage' => $this->code('909')
                    );
                    $data['error'] = 1;
                endif;
                echo json_encode($data);
            endif;
        endif;
    }

    function validate($email, $password) {
        $error = 0;
        $data = array();
        if (empty($email) || empty($password)):
            $data = array(
                'errorcode' => 105,
                'errormessage' => $this->code('105')
            );
            $error = 1;
        else:
            if (!$this->validateEmail($email)):
                $data['email'] = array(
                    'errorcode' => 103,
                    'errormessage' => $this->code('103')
                );
                $error = 1;
            elseif ($this->checkEmail($email)):
                $data['email'] = array(
                    'errorcode' => 104,
                    'errormessage' => $this->code('104')
                );
                $error = 1;
            endif;
            if (!$this->validatePassword($password)):
                $data['password'] = array(
                    'errorcode' => 106,
                    'errormessage' => $this->code('106')
                );
                $error = 1;
            endif;
        endif;
        $data['error'] = $error;
        return $data;
    }

    function salt($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()/-+';
        $randomString = '';
        for ($i = 0; $i < $length; $i++):
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        endfor;
        echo $randomString;
    }
	function getSalt($length = 32)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~!@#$%^&*()/-+';
        $randomString = '';
        for ($i = 0; $i < $length; $i++):
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        endfor;
        return $randomString;
	}
    function activationCode($length) {
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++):
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        endfor;
        return $randomString;
    }

    function checkEmail($email) {
        $validate = false;
        if ($this->api_model->checkEmail($email) > 0):
            $validate = true;
        endif;
        return $validate;
    }

    function validateEmail($email) {
        $validate = true;
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            $validate = false;
        }
        return $validate;
    }

    function validatePassword($password) {
        $validate = false;
        if (strlen($password) >= 6):
            $validate = true;
        endif;
        return $validate;
    }

    function login() {
        //checking apiKey and password
        $apiKey = 'wISI1cX1CGGXhLLQtxqw9AnmN2QbosxlnWGFJ50xWZIKXexGfVFaNFRy3wjF07KS'; //$this->input->post('apikey);
        $apiPassword = 'xI!@syLOek22'; //$this->input->post('apipassword);

        if ($this->api_model->checkApi($apiKey, $apiPassword) < 1):
            $data = array(
                'errorcode' => 101,
                'errormessage' => $this->code('101')
            );
            $data['error'] = 1;
            echo json_encode($data);
        else:
            $email = 'uchit@frenzyardg.com'; //$this->input->post('email');
            $password = 'hghgjh'; //$this->input->post('password');
            $verification = $this->api_model->validate_login($email,$password);
            if(count($verification) > 0):
                $data = array(
                'sucessCode' => 110,
                'sucessmessage' => $this->code('110'),
                'userid'   => $verification->id,
                'email'    => $verification->emailAddress
                );
                $data['error'] = 0;
            echo json_encode($data);
                else:
                $data = array(
                'errorcode' => 108,
                'errormessage' => $this->code('108')
                );
            $data['error'] = 1;
            echo json_encode($data);
            endif;
        endif;
    }

    function get_downloadable_tone() {
        //checking apiKey and password
        $apiKey = 'wISI1cX1CGGXhLLQtxqw9AnmN2QbosxlnWGFJ50xWZIKXexGfVFaNFRy3wjF07KS'; //$this->input->post('apikey);
        $apiPassword = 'xI!@syLOek22'; //$this->input->post('apipassword);

        if ($this->api_model->checkApi($apiKey, $apiPassword) < 1):
            $data = array(
                'errorcode' => 101,
                'errormessage' => $this->code('101')
            );
            $data['error'] = 1;
            echo json_encode($data);
        else:
           $email = 'uchit@frenzyardg.com'; //$this->input->post('email');
            $password = 'hghgjh'; //$this->input->post('password');
            $verification = $this->api_model->validate_login($email,$password);
            if(count($verification) > 0):
                $data = array(
                'sucessCode' => 111,
                'sucessmessage' => $this->code('111'),
                'userid'   => $verification->id,
                'email'    => $verification->emailAddress,
                'tones'    => $this->api_model->get_tones()
                );
                $data['error'] = 0;
            echo json_encode($data);
                else:
                $data = array(
                'errorcode' => 108,
                'errormessage' => $this->code('108')
                );
            $data['error'] = 1;
            
            echo json_encode($data);
            endif;
        endif;
    }

    function get_downloadable_banner() {
        //checking apiKey and password
        $apiKey = 'wISI1cX1CGGXhLLQtxqw9AnmN2QbosxlnWGFJ50xWZIKXexGfVFaNFRy3wjF07KS'; //$this->input->post('apikey);
        $apiPassword = 'xI!@syLOek22'; //$this->input->post('apipassword);

        if ($this->api_model->checkApi($apiKey, $apiPassword) < 1):
            $data = array(
                'errorcode' => 101,
                'errormessage' => $this->code('101')
            );
            $data['error'] = 1;
            echo json_encode($data);
        else:

        endif;
    }

    function tone_count() {
        //checking apiKey and password
        $apiKey = 'wISI1cX1CGGXhLLQtxqw9AnmN2QbosxlnWGFJ50xWZIKXexGfVFaNFRy3wjF07KS'; //$this->input->post('apikey);
        $apiPassword = 'xI!@syLOek22'; //$this->input->post('apipassword);

        if ($this->api_model->checkApi($apiKey, $apiPassword) < 1):
            $data = array(
                'errorcode' => 101,
                'errormessage' => $this->code('101')
            );
            $data['error'] = 1;
            echo json_encode($data);
        else:

        endif;
    }

    function banner_count() {
        //checking apiKey and password
        $apiKey = 'wISI1cX1CGGXhLLQtxqw9AnmN2QbosxlnWGFJ50xWZIKXexGfVFaNFRy3wjF07KS'; //$this->input->post('apikey);
        $apiPassword = 'xI!@syLOek22'; //$this->input->post('apipassword);

        if ($this->api_model->checkApi($apiKey, $apiPassword) < 1):
            $data = array(
                'errorcode' => 101,
                'errormessage' => $this->code('101')
            );
            $data['error'] = 1;
            echo json_encode($data);
        else:

        endif;
    }
    function test(){
        $data = array('13-16','17-20','21-25','26-30','31-35','35-40');
        echo json_encode($data);
    }

}
