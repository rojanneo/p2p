<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Incentive_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getIncentivesList()
	{
		$query = $this->db->get('ad_incentive_method');
		return $query->result_array();
	}
	
	public function addIncentive($incentive_name, $incentive_des)
	{
		$data = array('incentive_name'=>$incentive_name, 'incentive_des'=>$incentive_des);
		$this->db->insert('ad_incentive_method',$data);
	}
	
	public function getIncentiveData($id)
	{
		$query = $this->db->get_where('ad_incentive_method', array('id' => $id));
		return $query->result_array();
	}
	
	public function updateIncentiveData($id, $name, $des)
	{
		$data = array('incentive_name'=>$name,'incentive_des'=>$des);
		$this->db->where('id',$id);
		$this->db->update('ad_incentive_method', $data);
	}
	
	public function deleteIncentive($id)
	{
		$this->db->delete('ad_incentive_method', array('id' => $id)); 
	}
}