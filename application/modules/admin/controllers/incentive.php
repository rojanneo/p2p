<?php

class Incentive extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('admin');
		$this->load->model('incentive_model');
		$this->load->helper('form');
		$role = $this->session->userdata('role');
		$rating = getRoleRating($role);
		//echo $rating;
		if($rating < 1)
		{
			redirect(config_item('base_url').'admin/dashboard');
		}
	}
	
	public function index()
	{
		$data['incentives'] = $this->incentive_model->getIncentivesList();
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('incentive_list', $data);
		$this->load->view('footer');
	}
	
	public function add()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('add_incentive');
		$this->load->view('footer');
	}
	
	public function addPost($edit = 0)
	{
		$incentive_name = $this->input->post('incentive_name');
		$incentive_des = $this->input->post('incentive_des');
		if($edit == 0)
			$this->incentive_model->addIncentive($incentive_name, $incentive_des);
		else if($edit == 1)
		{
			$id = $this->input->post('incentive_id');
			$this->incentive_model->updateincentiveData($id, $incentive_name, incentive_des);
		}
		redirect(config_item('base_url').'admin/incentive');
	}
	
	public function edit($id)
	{
		$incentive = $this->incentive_model->getIncentiveData($id);
		$data['incentive'] = $incentive[0];
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('add_incentive', $data);
		$this->load->view('footer');
	}
	
	public function delete($id)
	{
		$this->incentive_model->deleteIncentive($id);
		redirect(config_item('base_url').'admin/incentive');
	}
}