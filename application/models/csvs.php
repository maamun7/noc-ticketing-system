<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Csvs extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_suppliers()
	{
		$this->db->select('*');
		$this->db->from('suppliers');
		$this->db->where('status',1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function get_supplier_data($supplier_id)
	{
		$this->db->select('*');
		$this->db->from('suppliers');
		$this->db->where('supplier_id',$supplier_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function get_destination_list()
	{
		$this->db->select('*');
		$this->db->from('destinations');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function get_dest_rate_list($supplier_id,$destination_id)
	{
		$this->db->select('*');
		$this->db->from('destination_rates');
		$this->db->where(array('supplier_id'=>$supplier_id,'destination_id'=>$destination_id));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function insert_destination_rate($insert_data)
	{
		$this->db->insert('destination_rates',$insert_data);
		return true;
	}
	
	public function delete_destination_rate($supplier_id,$destination_id)
	{		
		$this->db->where(array('supplier_id'=>$supplier_id,'destination_id'=>$destination_id));
		$this->db->delete('destination_rates'); 
		return true;
	}
	
	public function delete_previous_rate($supplier_id,$prefix,$rates_type)
	{		
		$this->db->where(array('supplier_id'=>$supplier_id,'destination_prefix'=>$prefix,'rate_types'=>$rates_type));
		$this->db->delete('destination_rates'); 
		return true;
	}

}