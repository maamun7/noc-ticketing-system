<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cqhistory extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'qhistory';
    }
	
	public function index()
	{		
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('manage_qhistory');
		$CI->load->library('qhistory');
		$CI->load->model('qhistorys');
		$this->template->current_menu = 'history';
		
		$config = array();
		$config["base_url"] = base_url()."qhistory/index";
		$config["total_rows"] = $this->qhistorys->count_history();	 
		$config["per_page"] = 50;
		$config["uri_segment"] = 3;			
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '← Previous';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Next →';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a heref="">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$limit = $config["per_page"];
	    $links = $this->pagination->create_links();
		
        $content = $CI->qhistory->get_history_list_view($limit,$page,$links);
        $sub_menu = array();
		$this->template->full_html_view($content,$sub_menu);
	}	

	public function details($id=null)
	{			
		$CI =& get_instance();
		$this->auth->check_auth();
		//$this->auth->check_permission('do_response');
		$this->template->current_menu = 'history';
		$CI->load->library('qhistory');		
		
		if (!$id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select complain !"));
			redirect(base_url('complain'));
			exit();
		}  
		
		$content = $CI->qhistory->get_details_view($id);
		$sub_menu = array();
		$this->template->full_html_view($content,$sub_menu);	
	}

	public function search()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('manage_qhistory');
		$CI->load->library('qhistory');
		$CI->load->model('qhistorys');
		$this->template->current_menu = 'history';		
		
		$start_date = $this->input->post('from_date');		
		$end_date = $this->input->post('to_date');	
		$ticket_type = $this->input->post('ticket_type');	

		/*
		if($start_date=="" || $end_date=="" || $phone_number=="" ){
			$this->session->set_userdata(array('error_message'=>"Empty Field Doesn't Support!"));
			redirect(base_url('invoice/index'));
		}
		*/
        $content = $CI->qhistory->get_search_history_list_view($start_date,$end_date,$ticket_type);
        $sub_menu = array();
		$this->template->full_html_view($content,$sub_menu);
	}		
}