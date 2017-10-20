<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cticket extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'ticket';
    }
	public function index()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->echeck_user_permission();
		$CI->load->library('ticket');
		$CI->load->model('tickets');
		$this->template->current_menu = 'ticket';		
		$config = array();
		$config["base_url"] = base_url()."ticket/index";
		$config["total_rows"] = $this->tickets->count_ticket();	  
		$config["per_page"] = 30;
		$config["uri_segment"] = 3;	
		$config['full_tag_open'] = '<div id="pagination">';
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$limit = $config["per_page"];
	    $links = $this->pagination->create_links();
		
        $content = $CI->ticket->get_ticket_list_view($limit,$page,$links);
        $sub_menu = array(
			array('label'=> 'Manage Ticket ', 'url' => 'ticket','class' =>'active'),
			array('label'=> 'New Ticket', 'url' => 'ticket/new_ticket')
		);
		$this->template->customer_html_view($content,$sub_menu);
	}	
	
	public function new_ticket()
	{
		$CI =& get_instance();
		$this->auth->check_auth();		
		$this->auth->echeck_user_permission();
		$CI->load->library('ticket');
		$CI->load->model('tickets');
		if($this->ticket->validateTicketForm()){
			$ticket_data = array();
			$max_ticket_no = $CI->tickets->get_last_ticket_no();
			$ticket_number = generate_ticket_no($max_ticket_no);
			$file = $_FILES['userfile']['name'];
			
			//Attachment
			if($file!='')
			{
				//$key_str = key_generator($length=5);		
				//$img_name = $key_str.'-'.time();
				$config['upload_path'] = './uploads/ticket_attachments/';	
				$config['allowed_types'] = 'gif|jpg|png|jpeg|docx|pdf|zip|xlsx';
				$config['max_size']	= '1024';
				//$config['file_name']= $img_name;
				$this->load->library('upload',$config);	
				
				if (!$this->upload->do_upload()){
					$error = $this->upload->display_errors();
					$this->session->set_userdata(array('error_message'=>$error));
					redirect(base_url('ticket/new_ticket'));
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
			$ticket_data['complain_details'] 	= $this->input->post('customer_query',TRUE);
			$ticket_data['ticket_number'] 		= $ticket_number;
			$ticket_data['created_at'] 			= current_bd_date_time();
			$ticket_data['status'] 				= 0;

			$this->tickets->insert_query($ticket_data);	

			//Re-direct
			$this->session->set_userdata(array('message'=> "Successfully send your query !"));
			redirect(base_url('ticket'));
			exit;			
		}else{
			$content = $this->ticket->get_new_ticket_view();		
			$sub_menu = array(
				array('label'=> 'Manage Ticket ', 'url' => 'ticket'),
				array('label'=> 'New Ticket', 'url' => 'ticket/new_ticket','class' =>'active')
			);
			$this->template->customer_html_view($content,$sub_menu);
		}
	}	

	public function view_details($id=null)
	{			
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->echeck_user_permission();
		$CI->load->model('tickets');
		$CI->load->library('ticket');
		
		if (!$id) {			
			$this->session->set_userdata(array('error_message'=>"Bad Request !"));
			redirect(base_url('ticket'));
			exit();
		} 

		if($this->ticket->validateTicketResponseForm()){		
			$data = array(
				'id' 				=> Null,
				'complain_id' 		=> $id,
				'response_by_id' 	=> $this->auth->get_user_id(),
				'message' 			=> $this->input->post('response_details'),
				'response_at' 		=> current_bd_date_time()
			);

			$this->tickets->insert_response($data);			
			
			// Add notifications from support to client		
			$notif_query = "UPDATE customer_complain SET noc_notifications = noc_notifications + 1 WHERE id = '".$id."'";
			$this->tickets->update_client_notifications($notif_query);	

			//Re-direct
			$this->session->set_userdata(array('message'=> "Successfully added your response !"));
			redirect(base_url('ticket'));
			exit;
			
		}else{ 
			$content = $this->ticket->get_ticket_response_view($id);				
			$sub_menu = array(
				array('label'=> 'Manage Ticket ', 'url' => 'ticket'),
				array('label'=> 'New Ticket', 'url' => 'ticket/new_ticket'),
				array('label'=> 'Ticket Details', 'url' => 'ticket/view_details/'.$id,'class' =>'active')
			);	
			$this->template->customer_html_view($content,$sub_menu);
		}	
	}

}