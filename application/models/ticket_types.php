<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ticket_types extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function count_ticket_type()
	{
		return $this->db->count_all("ticket_type");
	}
	
	public function get_ticket_type_list($limit,$page)
	{
		$this->db->select('*');
		$this->db->from('ticket_type');
		$this->db->limit($limit, $page);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function insert($data)
	{
		$this->db->insert('ticket_type',$data);
		return true;
	}
	
	public function get_edit_data($id)
	{
		$this->db->select('*');
		$this->db->from('ticket_type');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function update($data,$id)
	{		
		$this->db->where('id',$id);
		$this->db->update('ticket_type',$data);
		return true;
	}

	public function do_delete($ticket_type_id)
	{
		$this->db->where('id',$ticket_type_id);
		$this->db->delete('ticket_type'); 
		return true;
	}
}