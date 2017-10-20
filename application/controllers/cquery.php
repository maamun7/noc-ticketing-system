<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cquery extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'ticket';
    }
	
	public function index()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('manage_ticket');
		$this->load->library('query');
		$this->load->model('queries');
		$this->template->current_menu = 'ticket';
		
		$config = array();
		$config["base_url"] = base_url()."query/index";
		$config["total_rows"] = $this->queries->count_user_tickets();	  
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
		
        $content = $CI->query->get_ticket_list_view($limit,$page,$links);
        $sub_menu = array(
			array('label'=> 'Manage Ticket ', 'url' => 'query','class' =>'active'),
			array('label'=> 'New Ticket', 'url' => 'query/new_ticket'),
		);
		
		$this->template->full_html_view($content,$sub_menu);
	}
	
	public function new_ticket()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('new_ticket');
		$this->load->library('query');
		$CI->load->model('queries');
		$this->template->current_menu = 'ticket';
		if($this->query->validateTicketForm()){
			$ticket_data = array();
			$max_ticket_no = $CI->queries->get_last_ticket_no();
			$ticket_number = generate_ticket_no($max_ticket_no);
			$file = $_FILES['userfile']['name'];
			
			//Attachment
			if($file!='')
			{
				//$key_str = key_generator($length=5);		
				//$img_name = $key_str.'-'.time();
				$config['upload_path'] = './uploads/ticket_attachments/';	
				$config['allowed_types'] = '*';
				$config['max_size']	= '20480';
				//$config['file_name']= $img_name;
				$this->load->library('upload',$config);	
				
				if (!$this->upload->do_upload()){
					$error = $this->upload->display_errors();
					$this->session->set_userdata(array('error_message'=>$error));
					redirect(base_url('query/new_ticket'));
				} else {
					$data = $this->upload->data();		
					$file_name = $data['file_name'];
					$attached_path = $data['file_path'];
					
					$ticket_data['attached_file'] = $file_name;
					$ticket_data['attached_path'] = $attached_path;					
				}
			}
			$ticket_data['id'] 					= Null;
			$ticket_data['user_id'] 			= $this->auth->get_user_id();
			$ticket_data['ticket_type_id']		= $this->input->post('complain_type',TRUE);
			$ticket_data['complain_details'] 	= html_entity_decode($this->input->post('customer_query',TRUE),ENT_QUOTES,'utf-8');
			$ticket_data['ticket_number'] 		= $ticket_number;
			$ticket_data['created_at'] 			= current_bd_date_time();
			$ticket_data['status'] 				= 0;

			$this->queries->insert_query($ticket_data);	

			//Re-direct
			$this->session->set_userdata(array('message'=> "Successfully send your query !"));
			redirect(base_url('query'));
			exit;			
		}else{
			$content = $this->query->get_new_ticket_view();		
			$sub_menu = array(
				array('label'=> 'Manage Ticket ', 'url' => 'query'),
				array('label'=> 'New Ticket', 'url' => 'query/new_ticket','class' =>'active')
			);
			$this->template->full_html_view($content,$sub_menu);
		}
	}
	
	public function edit_ticket($ticket_id = false)
	{			
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('edit_ticket');
		$this->load->library('query');
		$CI->load->model('queries');

		if (!$ticket_id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select ticket !"));
			redirect(base_url('query'));
			exit();
		}
		
		if($this->query->validateTicketForm()){
			//$ticket_type_id = $ticket_id;
			
			$ticket_data = array();
			$file = $_FILES['userfile']['name'];
			
			if($file!='')
			{
				$config['upload_path'] = './uploads/ticket_attachments/';	
				$config['allowed_types'] = '*';
				$config['max_size']	= '1024';
				//$config['file_name']= $img_name;
				
				$this->load->library('upload',$config);	
				
				if (!$this->upload->do_upload()){
					$error = $this->upload->display_errors();
					$this->session->set_userdata(array('error_message'=>$error));
					$redirect_url = 'query/edit_ticket/'.$ticket_id;
					redirect(base_url($redirect_url));
				} else {
					//Delete previous file
					$this->queries->delete_attachment($ticket_id);
					
					$data = $this->upload->data();		
					$file_name = $data['file_name'];
					$attached_path = $data['file_path'];
					
					$ticket_data['attached_file'] = $file_name;
					$ticket_data['attached_path'] = $attached_path;					
				}
			}

			$ticket_data['ticket_type_id']		= $this->input->post('complain_type',TRUE);
			$ticket_data['complain_details'] 	= html_entity_decode($this->input->post('customer_query',TRUE),ENT_QUOTES,'utf-8');
			$ticket_data['edited_at'] 			= current_bd_date_time();
			$ticket_data['status'] 				= 0;

			$this->queries->update_query($ticket_data,$ticket_id);	

			//Re-direct
			$this->session->set_userdata(array('message'=> "Successfully updated your query !"));
			redirect(base_url('query'));
			exit;	
		}else{
			$content = $this->query->get_edit_ticket_view($ticket_id);
			$sub_menu = array(
				array('label'=> 'Manage Ticket ', 'url' => 'query'),
				array('label'=> 'New Ticket', 'url' => 'query/new_ticket'),
				array('label'=> 'Edit Ticket', 'url' => 'query/edit_ticket/'.$ticket_id,'class' =>'active')
			);
			$this->template->full_html_view($content,$sub_menu);
		}
	}

	public function response($id=null)
	{			
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('manage_ticket');
		$this->load->model('queries');;
		$this->load->library('query');
		$this->template->current_menu = 'ticket';
		
		if (!$id) {			
			$this->session->set_userdata(array('error_message'=>"Bad Request !"));
			redirect(base_url('query'));
			exit();
		} 

		if($this->query->validateTicketResponseForm()){		
			$data = array(
				'id' 				=> Null,
				'complain_id' 		=> $id,
				'response_by_id' 	=> $this->auth->get_user_id(),
				'message' 			=> html_entity_decode($this->input->post('response_details',TRUE),ENT_QUOTES,'utf-8'),
				'response_at' 		=> current_bd_date_time()
			);

			$this->queries->insert_response($data);			
			
			// Add notifications from support to client		
			$notif_query = "UPDATE customer_complain SET noc_notifications = noc_notifications + 1 WHERE id = '".$id."'";
			$this->queries->update_client_notifications($notif_query);	

			//Re-direct
			$this->session->set_userdata(array('message'=> "Successfully added your response !"));
			redirect(base_url('query'));
			exit;
			
		}else{ 
			$content = $this->query->get_ticket_response_view($id);				
			$sub_menu = array(
				array('label'=> 'Manage Ticket ', 'url' => 'query'),
				array('label'=> 'New Ticket', 'url' => 'query/new_ticket'),
				array('label'=> 'Ticket Details', 'url' => 'query/response/'.$id,'class' =>'active')
			);	
			$this->template->full_html_view($content,$sub_menu);
		}	
	}
	
}