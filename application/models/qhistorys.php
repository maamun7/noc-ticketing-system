<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Qhistorys extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function count_history()
	{	
		$this->db->select('id');
		$this->db->from('customer_complain');
		$this->db->where("status",1);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function get_history_list($limit,$page)
	{
		$this->db->select('a.*,b.details,c.first_name,c.last_name,d.username,f.first_name as recv_first_name,f.last_name as recv_last_name,g.first_name as done_first_name,f.last_name as done_last_name');
		$this->db->from('customer_complain a');
		$this->db->join('ticket_type b','b.id = a.ticket_type_id');
		$this->db->join('users c','a.user_id = c.user_id');
		$this->db->join('user_login d','c.user_id = d.user_id');
		$this->db->join('users f','a.estimate_time_by_id = f.user_id',"left");
		$this->db->join('users g','a.done_by = g.user_id',"left");
		$this->db->where("a.status",1);
		$this->db->order_by("a.id",'desc');
		$this->db->limit($limit, $page);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
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
	
	public function get_complain_data($id)
	{
		$this->db->select('a.*,b.details,c.first_name,c.last_name,d.username');
		$this->db->from('customer_complain a');
		$this->db->join('ticket_type b','b.id = a.ticket_type_id');
		$this->db->join('users c','a.user_id = c.user_id');
		$this->db->join('user_login d','c.user_id = d.user_id');
		$this->db->order_by("a.id",'desc');
		$this->db->where('a.id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}		
	
	public function get_response_data($id)
	{
		$this->db->select('a.*,b.first_name,b.last_name,c.username');
		$this->db->from('complain_response a');
		$this->db->join('users b','b.user_id = a.response_by_id');
		$this->db->join('user_login c','c.user_id = a.response_by_id');
		$this->db->order_by('a.id','asc');
		$this->db->where('a.complain_id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}	

	public function get_search_history_list($start_date,$end_date,$ticket_type)
	{
		$date_range = "a.created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'";

        $this->db->select('a.*,b.details,c.first_name,c.last_name,d.username,f.first_name as recv_first_name,f.last_name as recv_last_name,g.first_name as done_first_name,f.last_name as done_last_name');
        $this->db->from('customer_complain a');
		$this->db->join('ticket_type b','b.id = a.ticket_type_id');
		$this->db->join('users c','a.user_id = c.user_id');
		$this->db->join('user_login d','c.user_id = d.user_id');
		$this->db->join('users f','a.estimate_time_by_id = f.user_id',"left");
        $this->db->join('users g','a.done_by = g.user_id',"left");
		$this->db->where("a.status",1);	

		if($ticket_type != ""){		
			$this->db->where('b.id',$ticket_type); 	
		}
		
		if($start_date != "" && $end_date != "" ){				
			$this->db->where($date_range, NULL, FALSE); 	
		}
		$this->db->order_by("a.id",'desc');		
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
}