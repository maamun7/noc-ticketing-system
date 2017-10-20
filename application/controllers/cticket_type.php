<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cticket_type extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'ticket_type';
    }

	public function index()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('manage_ticket_template');
		$CI->load->library('ticket_type');
		$CI->load->model('ticket_types');
		
		$config = array();
		$config["base_url"] = base_url()."ticket_type/index";
		$config["total_rows"] = $this->ticket_types->count_ticket_type();	  
		$config["per_page"] = 25;
		$config["uri_segment"] = 3;	
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$limit = $config["per_page"];
	    $links = $this->pagination->create_links();
		
        $content = $CI->ticket_type->get_ticket_type_list_view($limit,$page,$links);
        $sub_menu = array(
			array('label'=> 'Manage Ticket Type', 'url' => 'ticket_type', 'class' =>'active'),
			array('label'=> 'New Ticket Type', 'url' => 'ticket_type/add')
		);
		$this->template->full_html_view($content,$sub_menu);
	}
	
	public function add()
	{			
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('add_ticket_template');
		$CI->load->library('ticket_type');
		$CI->load->model('ticket_types');
		
		if($this->ticket_type->validateForm()){
			$data=array(
				'id' 			=> Null,
				'details' 		=> $this->input->post('ticket_type'),
				'ordering' 		=> $this->input->post('ordering'),
				'created_by' 	=> $this->auth->get_user_id(),
				'created_at' 	=> current_bd_date_time(),
				'status' 		=> 1
			);

			$CI->ticket_types->insert($data);

			$this->session->set_userdata(array('message'=>"Ticket type successfully added !"));
			redirect(base_url('ticket_type'));
			exit;
				
		}else{
			$content = $CI->ticket_type->add_form();
			$sub_menu = array(
				array('label'=> 'Manage Ticket Type', 'url' => 'ticket_type'),
				array('label'=> 'New Ticket Type', 'url' => 'ticket_type/add','class' =>'active')
			);
			$this->template->full_html_view($content,$sub_menu);
		}
	}
	
	public function edit($ticket_type_id=null)
	{			
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('edit_ticket_template');
		$CI->load->library('ticket_type');
		$CI->load->model('ticket_types');
		if (!$ticket_type_id) {			
			$this->session->set_userdata(array('error_message'=>"Did not found ticket_type !"));
			redirect(base_url('ticket_type'));
			exit();
		}
		
		if($this->ticket_type->validateForm()){
			$ticket_type_id = $this->input->post('ticket_type_id');
			$data=array(
				'details' 		=> $this->input->post('ticket_type'),
				'ordering' 		=> $this->input->post('ordering'),
				'created_by' 	=> $this->auth->get_user_id(),
				'created_at' 	=> current_bd_date_time(),
			);

			$CI->ticket_types->update($data,$ticket_type_id);
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));
			redirect(base_url('ticket_type'));
		}else{
			$content = $CI->ticket_type->edit_form($ticket_type_id);
			$sub_menu = array(
				array('label'=> 'Manage Ticket Type', 'url' => 'ticket_type'),
				array('label'=> 'New Ticket Type', 'url' => 'ticket_type/add'),
				array('label'=> 'Edit Ticket Type', 'url' => 'ticket_type/edit/'.$ticket_type_id,'class' =>'active')
			);
			$this->template->full_html_view($content,$sub_menu);
		}
	}

	public function delete()
	{	
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('delete_ticket_template');
		$CI->load->model('ticket_types');
		$ticket_type_id =  $_POST['ticket_type_id'];
		$CI->ticket_types->do_delete($ticket_type_id);
		return true;	
	}	
		

}