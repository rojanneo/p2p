<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Brands_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getBrandsList()
	{
		$query = $this->db->get('ad_brand_info');
		return $query->result_array();
	}
	
	public function addBrand($brand_name, $desc, $cat, $status)
	{
		$data = array('brandName'=>$brand_name,'brandDes'=>$desc, 'brandCategories'=>$cat, 'status'=>$status);
		$this->db->insert('ad_brand_info',$data);
	}
	
	public function getBrandData($id)
	{
		$query = $this->db->get_where('ad_brand_info', array('id' => $id));
		return $query->result_array();
	}
	
	public function updateBrandData($id, $name, $desc, $cat, $status)
	{
		$data = array('brandName'=>$name,'brandDes'=>$desc, 'brandCategories'=>$cat, 'status'=>$status);
		$this->db->where('id',$id);
		$this->db->update('ad_brand_info', $data);
	}
	
	public function deleteBrand($id)
	{
		$this->db->delete('ad_brand_info', array('id' => $id)); 
	}
}