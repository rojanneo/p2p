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
    }

    public function index() {
        echo 'RCPG API';
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
