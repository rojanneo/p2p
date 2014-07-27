<?php
class Login extends CI_Controller
{
public function __construct()
{
	parent::__construct();
	$this->load->model('login_model');
	$this->load->helper('url');
	$this->load->library('session');
	if($this->session->userdata('logged_in'))
	{
		redirect(config_item('base_url').'admin/dashboard');
	}
}

public function index()
{
	$this->load->view('header');
	if($this->session->flashdata('login_failed'))
	{
		//die('here');
		$data['login_failed'] = true;
		$this->load->view('login', $data);
	}
	else
	{
		//die('there');
		$this->load->view('login');
	}
	$this->load->view('footer');
}

public function loginPost()
{
	$username = $this->input->post('username');
	$password = $this->input->post('username');
	if(is_null($username) or is_null($password))
	{
		$this->session->set_flashdata('login_failed', true);
		redirect(config_item('base_url').'admin/login');
	}
	if(($this->login_model->aunthenticate($username, $password)))
	{
		$session_data = array(
                   'username'  => $username,
                   'logged_in' => TRUE
				   );
		$this->session->set_userdata($session_data);
		redirect(config_item('base_url').'admin/dashboard');
	}
	else
	{
		$this->session->set_flashdata('login_failed', true);
		redirect(config_item('base_url').'admin/login');
	}
}
}
?>