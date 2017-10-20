<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class customers extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_ticketing_template_list()
	{
		$this->db->select('id,details');
		$this->db->from('ticket_type');		
		$this->db->where('status',1);		
		$this->db->order_by('ordering','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function insert_basic_info($basic_data)
	{
		$this->db->insert('users',$basic_data);
        return $this->db->insert_id();
	}
	
	public function insert_login_info($login_data)
	{
		$this->db->insert('user_login',$login_data);
		return true;
	}
	
	public function email_exist($email)
	{
		$this->db->select('username');
		$this->db->from('user_login');		
		$this->db->where('username',$email);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return true;	
		}
		return false;
	}
	
	public function get_last_ticket_no()
	{
		$this->db->select_max('ticket_number');
		$this->db->from('customer_complain');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row->ticket_number;
		}
		return false;
	}
	
	public function insert_query($data)
	{
		$this->db->insert('customer_complain',$data);
		return true;
	}
}