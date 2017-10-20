<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Destinations extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function count_destination()
	{
		return $this->db->count_all("destinations");
	}
	
	public function get_destination_list($limit,$page)
	{
		$this->db->select('*');
		$this->db->from('destinations');
		$this->db->limit($limit, $page);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function insert($data)
	{
		$this->db->insert('destinations',$data);
		return true;
	}
	
	public function get_edit_data($destination_id)
	{
		$this->db->select('*');
		$this->db->from('destinations');
		$this->db->where('destination_id',$destination_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function update($data,$destination_id)
	{
		$this->db->where('destination_id',$destination_id);
		$this->db->update('destinations',$data); 
		return true;
	}
	
	public function do_delete($destination_id)
	{
		$this->db->where('destination_id',$destination_id);
		$this->db->delete('destinations'); 

		$this->db->where('destination_id',$destination_id);
		$this->db->delete('destination_rates');
		return true;
	}
	
	public function get_search_items($key_word)
	{
		$this->db->select('*');
		$this->db->from('destinations');
		$this->db->like('destination_name',$key_word,'both');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
}