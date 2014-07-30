<?php

class Login_model extends CI_Model
{
public function __construct()
{
	parent::__construct();
	$this->load->library('encrypt');
}

public function checkLogin()
{
	$this->load->view('header');
	$this->load->view('login');
	$this->load->view('footer');
}

public function aunthenticate($username, $password)
{

	$encryptedPassword = $this->encrypt->sha1($password);
	$query = $this->db->get_where('ad_admin_user', array('admin_username'=>$username, 'admin_password'=>$encryptedPassword));
	return $query->result_array();
}
}