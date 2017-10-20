<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home {
	// Retrieve daily Report
	public function get_admin_home_data()
	{
		$CI =& get_instance();	
		$CI->load->model('complains');	
		$CI->load->model('qhistorys');	
		$CI->load->model('queries');	
		$CI->load->model('ticket_types');	
		$CI->load->model('users');	
		
		$data = array();
		$data['title'] = "Cellex Ticketing System !";
		$data['total_complain'] = $CI->complains->count_complain();
		$data['total_history'] = $CI->qhistorys->count_history();
		$data['total_query'] = $CI->queries->count_user_tickets();
		$data['total_ticket_type'] = $CI->ticket_types->count_ticket_type();
		$data['total_users'] = $CI->users->count_user();
		
		$reportList = $CI->parser->parse('admin/home',$data,true);
		return $reportList;
	}

	public function get_user_home_data()
	{
		$CI =& get_instance();	
		$CI->load->model('reports');	
		
		$data = array(
			'title' => 'Welcome to Cellex ticketing system.',
		);
		$reportList = $CI->parser->parse('client/home',$data,true);
		return $reportList;
	}
}
