<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		if(!$this->session->userdata('logged_in'))
		{
			redirect(config_item('base_url').'admin/login');
		}
	}
	
	public function index()
	{
		echo 'Dashboard';
		echo '<a href="'.config_item("base_url")."admin/dashboard/logout".'">Logout</a>';
	}
	
	public function logout()
	{
		$array_items = array('username' => '', 'logged_in' => '');
		$this->session->unset_userdata($array_items);
		redirect(config_item('base_url').'admin/login');
	}
}