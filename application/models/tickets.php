<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tickets extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function count_ticket()
	{
		$user_id =  $this->auth->get_user_id();		
		$this->db->where("user_id",$user_id);
		return $this->db->count_all("customer_complain");
	}
		
	public function get_ticket_list($limit,$page)
	{
		$user_id =  $this->auth->get_user_id();
		
		$this->db->select('a.*,b.details,c.first_name,c.last_name,d.username,f.first_name as noc_first_name,f.last_name as noc_last_name');
		$this->db->from('customer_complain a');
		$this->db->join('ticket_type b','b.id = a.ticket_type_id');
		$this->db->join('users c','a.user_id = c.user_id');
		$this->db->join('user_login d','c.user_id = d.user_id');
		$this->db->join('users f','a.estimate_time_by_id = f.user_id',"left");
		$this->db->where("a.user_id",$user_id);
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
	
	public function get_tickets_details_data($id,$user_id)
	{
		$this->db->select('a.*,b.details,c.first_name,c.last_name,d.username');
		$this->db->from('customer_complain a');
		$this->db->join('ticket_type b','b.id = a.ticket_type_id');
		$this->db->join('users c','a.user_id = c.user_id');
		$this->db->join('user_login d','c.user_id = d.user_id');
		$this->db->order_by("a.id",'desc');
		$this->db->where(array('a.id'=>$id,'a.user_id'=>$user_id));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function insert_response($data)
	{
		$this->db->insert('complain_response',$data);
		return true;
	}
	
	public function update_client_notifications($notif_query)
	{	
		$this->db->query($notif_query);
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
}