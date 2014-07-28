<?php

class Interests extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('admin');
		$this->load->model('interests_model');
		$this->load->helper('form');
		$role = $this->session->userdata('role');
		$rating = getRoleRating($role);
		//echo $rating;
		if($rating < 0)
		{
			redirect(config_item('base_url').'admin/dashboard');
		}
	}
	
	public function index()
	{
		$data['interests'] = $this->interests_model->getInterestsList();
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('interest_list', $data);
		$this->load->view('footer');
	}
	
	public function add()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('add_interest');
		$this->load->view('footer');
	}
	
	public function addPost($edit = 0)
	{
		$interest_name = $this->input->post('interest_name');
		if($edit == 0)
			$this->interests_model->addInterest($interest_name);
		else if($edit == 1)
		{
			$id = $this->input->post('interest_id');
			$this->interests_model->updateInterestData($id, $interest_name);
		}
		redirect(config_item('base_url').'admin/interests');
	}
	
	public function edit($id)
	{
		$interest = $this->interests_model->getInterestData($id);
		$data['interest'] = $interest[0];
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('add_interest', $data);
		$this->load->view('footer');
	}
	
	public function delete($id)
	{
		$this->interests_model->deleteInterest($id);
		redirect(config_item('base_url').'admin/interests');
	}
}