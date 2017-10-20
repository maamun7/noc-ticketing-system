<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Current_rates extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function count_current_rate($rate_type)
	{
		$this->db->select('destination_name,destination_prefix');
		$this->db->from('destination_rates');
		$this->db->group_by('destination_prefix');
		$this->db->order_by('destination_name','asc');
		$this->db->order_by('id','desc');		
		$this->db->where('rate_types',$rate_type);	
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function get_supplier_list()
	{
		$this->db->select('*');
		$this->db->from('suppliers');		
		$this->db->order_by('supplier_id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function get_current_rate_list($limit,$page,$rate_type)
	{
		$this->db->select('destination_name,destination_prefix');
		$this->db->from('destination_rates');
		$this->db->group_by('destination_prefix');
		$this->db->order_by('destination_name','asc');
		$this->db->order_by('id','desc');
		$this->db->where('rate_types',$rate_type);			
		$this->db->limit($limit, $page);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function get_prefix_wise_rate($prefix,$rate_type)
	{
		$this->db->select('destination_prefix,destination_name,call_rate,supplier_id,date_time');
		$this->db->from('destination_rates');	
		$this->db->order_by('date_time','asc');	
		$this->db->where('destination_prefix',$prefix);
		$this->db->where('rate_types',$rate_type);				
		$this->db->where('call_rate >',0);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function get_all_prefix_list($rate_type)
	{
		$this->db->select('destination_name,destination_prefix');
		$this->db->from('destination_rates');
		$this->db->group_by('destination_prefix');
		$this->db->order_by('destination_name','asc');
		$this->db->order_by('id','desc');
		$this->db->where('rate_types',$rate_type);	
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function get_last_prefix_rate($rate_type)
	{
		$sql = "a.date_time = (SELECT MAX(date_time) FROM destination_rates)";
		$this->db->select('a.destination_name,a.destination_prefix,MIN(a.call_rate) as call_rate,b.supplier_name');
		$this->db->from('destination_rates a');	
		$this->db->join('suppliers b','b.supplier_id = a.supplier_id');
		$this->db->order_by('a.destination_name','asc');		
		$this->db->group_by('a.destination_prefix');		
		$this->db->order_by('a.date_time','desc');		
		$this->db->where(array('a.rate_types'=>$rate_type,'a.call_rate >'=>0));		
		$this->db->where($sql, NULL, FALSE);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function get_search_list($rate_type,$prefix)
	{
		$this->db->select('destination_name,destination_prefix');
		$this->db->from('destination_rates');
		$this->db->group_by('destination_prefix');
		$this->db->order_by('destination_name','asc');
		$this->db->order_by('id','desc');
		$this->db->where('rate_types',$rate_type);	
		$this->db->like('destination_prefix',$prefix,'after');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function get_rate_edit_data($rate_id)
	{
		$this->db->select('*');
		$this->db->from('destination_rates');
		$this->db->where('id',$rate_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function update($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('destination_rates',$data); 
		return true;
	}
	
	public function get_search_by_destination($key_word=null)
	{
		if (!$key_word) {
			return false;	
		}
		$this->db->select('*');
		$this->db->from('destination_rates a');
		$this->db->join('suppliers b','b.supplier_id = a.supplier_id');
		$this->db->like('destination_name',$key_word,'both');
		$this->db->order_by('a.convertion_rate','asc');
		//$this->db->limit($limit, $page);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function get_search_by_prefix($key_word=null)
	{
		if (!$key_word) {
			return false;	
		}
		$this->db->select('*');
		$this->db->from('destination_rates a');
		$this->db->join('suppliers b','b.supplier_id = a.supplier_id');
		$this->db->like('destination_prefix',$key_word,'after');
		$this->db->order_by('a.convertion_rate','asc');
		//$this->db->limit($limit, $page);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function get_search_by_supplier($supplier_id,$start_date,$end_date)
	{
		$dateRange = "a.date_time BETWEEN '$start_date 00:00:00%' AND '$end_date 23:59:59%'";
		$this->db->select('*');
		$this->db->from('destination_rates a');
		$this->db->join('suppliers b','b.supplier_id = a.supplier_id');
		if($supplier_id!="") {
		$this->db->where('a.supplier_id',$supplier_id);	
		}
		if($start_date!="" AND $end_date!="") {
			$this->db->where($dateRange, NULL, FALSE); 
		}	
		$this->db->order_by('a.date_time','desc');
		//$this->db->limit($limit, $page);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function update_json()
	{
		$this->db->select('*');
		$this->db->from('destination_rates');
		$this->db->where('status',1);
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$json_product[] = array('label'=>$row->current_rate_name,'value'=>$row->current_rate_id);
		}
		$cache_file = $_SERVER['DOCUMENT_ROOT'].'/call_rate/my-assets/js/admin_js/json/current_rate.json';
		$productList = json_encode($json_product);
		file_put_contents($cache_file,$productList);
	}

	public function get_dest_rate_list($current_rate_id)
	{
		$this->db->select('a.dollar_rate,a.previous_rate,a.current_rate,b.destination_name');
		$this->db->from('destination_rates a');
		$this->db->join('destinations b','b.destination_id = a.destination_id');
		$this->db->where(array('a.current_rate_id'=>$current_rate_id));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
}