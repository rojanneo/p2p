<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('admin');
		if(!$this->session->userdata('logged_in'))
		{
			redirect(config_item('base_url').'admin/login');
		}
	}
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('footer');
	}
	
	public function logout()
	{
		$array_items = array('username' => '', 'logged_in' => '', 'role'=>'');
		$this->session->unset_userdata($array_items);
		redirect(config_item('base_url').'admin/login');
	}
}