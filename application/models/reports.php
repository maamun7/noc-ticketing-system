<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_supplier_list()
	{
		/*$this->db->select('supplier_id,supplier_name');
		$this->db->from('suppliers');		
		$this->db->order_by('supplier_id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;*/
	}


	public function get_last_updated_date_time($supplier_id)
	{
		$this->db->select('MAX(date_time) as last_update');
		$this->db->from('destination_rates');			
		$this->db->where('supplier_id',$supplier_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result[0]['last_update'];
		}
		return false;
	}

}