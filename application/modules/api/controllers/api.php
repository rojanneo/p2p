<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('api_model');
    }

    public function index() {
        $apiKey = xxs_clean($this->input->post('apikey'));
        $apiPassword = xxs_clean($this->input->post('apiVersion'));
        $version = xxs_clean($this->input->post('version'));
        $task = xxs_clean($this->input->post('task'));

        if ($this->api_model->checkApi($apiKey, $apiPassword, $version)):
            $this->$task($this->input->post());
        else:
            echo json_encode(array('code' => '101', 'msg' => $this->code('101')));
        endif;
    }

    function code($id) {

        $data['code'] = array(
            '101' => 'Invalid API Key and Password',
        );

        return $data['code'][$id];
    }

    function register($data) {
        
    }

    function randomNumber($length) {
        
    }

    function generateUsername() {
        
    }

    function login($data) {
        
    }

    function getUserinfo($data) {
        
    }

    function download() {
        
    }

}
