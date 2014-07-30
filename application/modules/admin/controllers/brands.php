<?php

class Brands extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('admin');
		$this->load->model('brands_model');
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
		$data['brands'] = $this->brands_model->getBrandsList();
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('brands_list', $data);
		$this->load->view('footer');
	}
	
	public function add()
	{
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('add_brands');
		$this->load->view('footer');
	}
	
	public function addPost($edit = 0)
	{
		$brand_name = $this->input->post('brand_name');
		$brand_des = $this->input->post('brand_des');
		$brand_categories = $this->input->post('brand_category');
		$brand_status = $this->input->post('brand_status');
		if($edit == 0)
			$this->brands_model->addBrand($brand_name, $brand_des, $brand_categories, $brand_status);
		else if($edit == 1)
		{
			$id = $this->input->post('brand_id');
			$this->brands_model->updateBrandData($id, $brand_name, $brand_des, $brand_categories,$brand_status);
		}
		redirect(config_item('base_url').'admin/brands');
	}
	
	public function edit($id)
	{
		$brand = $this->brands_model->getBrandData($id);
		$data['brand'] = $brand[0];
		$this->load->view('header');
		$this->load->view('menu');
		$this->load->view('add_brands', $data);
		$this->load->view('footer');
	}
	
	public function delete($id)
	{
		$this->brands_model->deleteBrand($id);
		redirect(config_item('base_url').'admin/brands');
	}
}