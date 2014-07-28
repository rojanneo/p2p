<?php

/*
 * Author : Uchit Shrestha
 * Copyrite frenzYard Company.INC
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function checkEmail($email) {
        return $this->db->get_where('user', array('emailAddress' => $email))->num_rows();
    }

    function checkApi($apiKey, $apiPassword) {
        $salt = 'frenzApiForP2P';
        $password = sha1($salt . $apiPassword . $salt);
        return $this->db->get_where('ad_api_info', array('api_key' => $apiKey, 'api_password' => $password))->num_rows();
    }

    function createUser($email, $password, $salt, $activationCode) {
        $data = array(
            'emailAddress' => $email,
            'password' => sha1($salt . $password . $salt),
            'salt' => $salt,
            'activation_code' => $activationCode
        );
        $insert = $this->db->insert('user', $data);
        if ($insert):
            return true;
        else:
            return false;
        endif;
    }
    function validate_login($email,$password){
        $salt = $this->get_salt($email);
        $data = array(
            'emailAddress' => $email,
            'password' => sha1($salt . $password . $salt),
        );
        return $this->db->get_where('user',$data)->row();
    }
    function get_salt($email){
       return $this->db->select('salt')->get_where('user',array('emailAddress'=>$email))->row()->salt;
    }
    function get_tones(){
        return $this->db->select('*')
                        ->join('tone_ref','tone_ref.tone_id = ringtone.tone_id','INNER')
                        ->join('brand','brand.brand_id = tone_ref.brand_id','INNER')
                        ->get('ringtone')->result();
    }
	
	function save($api_key, $encryptedPass, $salt, $version)
	{
		$data = array('api_key'=>$api_key, 'api_password'=>$encryptedPass, 'api_salt'=>$salt, 'versionName'=>$version);
		//var_dump($data);die;
		$this->db->insert('ad_api_info',$data);
		

	}
	
	function getApiList()
	{
		$query = $this->db->get('ad_api_info');
		return $query->result_array();
	}

}
