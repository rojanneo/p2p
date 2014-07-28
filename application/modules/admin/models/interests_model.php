<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Interests_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getInterestsList()
	{
		$query = $this->db->get('ad_interest');
		return $query->result_array();
	}
	
	public function addInterest($interest_name)
	{
		$data = array('interestName'=>$interest_name);
		$this->db->insert('ad_interest',$data);
	}
	
	public function getInterestData($id)
	{
		$query = $this->db->get_where('ad_interest', array('id' => $id));
		return $query->result_array();
	}
	
	public function updateInterestData($id, $name)
	{
		$data = array('interestName'=>$name);
		$this->db->where('id',$id);
		$this->db->update('ad_interest', $data);
	}
	
	public function deleteInterest($id)
	{
		$this->db->delete('ad_interest', array('id' => $id)); 
	}
}