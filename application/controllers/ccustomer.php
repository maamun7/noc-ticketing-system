<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ccustomer extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->template->current_menu = 'home';	  
		$this->load->library('customer');
		$this->load->model('customers');
    }
	
	public function complain()
	{	
		$CI =& get_instance();
		if($this->customer->validateForm()){
			//if is not logged in create new user by provided email
			$email = $this->input->post('customer_email');
			$password = key_generator(8);
			$user_type = 1;
			
			if(!$this->auth->is_logged()){
				if(!$this->customers->email_exist($email)){					
					$basic_data = array(
						'user_id' 	=> Null,
						'status' 	=> 1
					);				
					$user_id = $this->customers->insert_basic_info($basic_data);
					$login_data = array(
						'user_id' 		=> $user_id,
						'username' 		=> $email,
						'password' 		=> md5("matroak".$password),
						'user_type' 	=> $user_type,
						'is_active' 	=> 1,
						'can_login' 	=> 1
					);				
					$this->customers->insert_login_info($login_data);
				}else{
					// Already exist this email AC-No : 1540202500968001
				}
				
				//Send mail to customer with password
			//	$this->customer->send_password_to_client($email,$password);
				
				//Generate Sessions
				$this->auth->manually_generate_session($user_id,$email,$user_type);			   
			}
			
			//Create complain query/Ticket
			
			$max_ticket_no = $CI->customers->get_last_ticket_no();
			$ticket_number = generate_ticket_no($max_ticket_no);
		
			$data = array(
				'id' 					=> Null,
				'user_id' 				=> $this->auth->get_user_id(),
				'ticket_type_id' 		=> $this->input->post('complain_type'),
				'complain_details' 		=> $this->input->post('customer_query'),
				'ticket_number' 		=> $ticket_number,
				'created_at' 			=> current_bd_date_time(),
				'status' 				=> 0
			);
			$this->customers->insert_query($data);
			
			//Send mail to customer with ticket number
				//	$this->customer->send_ticketno_to_client($email,$password);
			
			//Re-direct
			$this->session->set_userdata(array('message'=>" Please check your mail to get password  !"));
			redirect(base_url('home'));
			exit;
			
		}else{
			$content = $this->customer->complain_view();
			$sub_menu = array();
			$this->template->customer_html_view($content,$sub_menu);
		}
	}
	
}