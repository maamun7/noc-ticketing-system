<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer {		
	var $error = array();
	public function complain_view()
	{
		$CI =& get_instance();		
		$CI->load->model('customers');
		
		if (isset($this->error['error_customer_email'])) {
			$this->data['error_customer_email'] = $this->error['error_customer_email'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_customer_email'] = '';
		}
		
		if (isset($this->error['error_complain_type'])) {
			$this->data['error_complain_type'] = $this->error['error_complain_type'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_complain_type'] = '';
		}		
		
		if (isset($this->error['error_customer_query'])) {
			$this->data['error_customer_query'] = $this->error['error_customer_query'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_customer_query'] = '';
		}
		
		$this->data['customer_email_value'] = $CI->input->post('customer_email');
		$this->data['complain_type_value'] = $CI->input->post('complain_type');
		$this->data['customer_query_value'] = $CI->input->post('customer_query');

		$this->data['title'] = 'Customer complain';
		$this->data['ticket_templates'] = $CI->customers->get_ticketing_template_list();
		$this->data['action'] = base_url().'customer/complain';
		$html_view = $CI->parser->parse('client/customer/complain_form',$this->data,true);
		return $html_view;
	}
	
	public function validateForm()
	{	
		$CI =& get_instance();
		if(isset($_POST['customer_email'])){
			if(strlen($CI->input->post('customer_email'))==''){
				$this->error['error_customer_email']="Customer email is required";
			} elseif(filter_var($CI->input->post('customer_email'), FILTER_VALIDATE_EMAIL) === false){
				$this->error['error_customer_email']= $CI->input->post('customer_email')."isn't valid'";
			}
		} else {
			$this->error['error_customer_email']="";
		}

		if(isset($_POST['complain_type'])){
			if(strlen($CI->input->post('complain_type'))==''){
				$this->error['error_complain_type']="Please choose a complain type";
			}
		} else {
			$this->error['error_complain_type']="";
		}
	
		if(isset($_POST['customer_query'])){
			if(strlen($CI->input->post('customer_query'))==''){
				$this->error['error_customer_query']="Supplier name is required";
			} elseif(strlen($CI->input->post('customer_query'))<20 || strlen($CI->input->post('customer_query'))>500){
				$this->error['error_customer_query']="Supplier name must be between 20 to 500 characters";
			}
		} else {
			$this->error['error_customer_query']="";
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
	
	public function send_password_to_client($email_id = false,$password)
	{	
		$CI =& get_instance();

		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$this->email->initialize($config);

		if ($email_id) {
			$this->email->from("Cellex Support Team");
			$email_subject="Cellex Limited";

			$full_message  ="Dear Concern,<br/>";
			$full_message .="Greetings from Cellex Limited.<br/>";
			$full_message .="The status of your quarry / complain is: <br/>";
			$full_message .="<strong>Ticket Number: “".$password."”</strong> [ Please keep the Ticket Number for further uses ]<br/>";
			$full_message .="<strong>Estimated Time Required :  “". $password ."”  Minutes</strong><br/>";
			$full_message .="Phone: <strong>(+88) 01790 33 22 00</strong><br/>";
			$full_message .="Skype ID: <strong>cellex_noc</strong><br/>";
			$full_message .="<a href='www.cellexltd.com' target='_blank'>www.cellexltd.com </a>";

			$this->email->to($email_id);
			$this->email->subject($email_subject);
			$this->email->message($full_message); 
			$this->email->send(); 
		}
	}
	
	public function send_ticketno_to_client($email_id = false,$password)
	{	
		$CI =& get_instance();

		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$this->email->initialize($config);

		if ($email_id) {
			$this->email->from("Cellex Support Team");
			$email_subject="Cellex Limited";

			$full_message  ="Dear Concern,<br/>";
			$full_message .="Greetings from Cellex Limited.<br/>";
			$full_message .="The status of your quarry / complain is: <br/>";
			$full_message .="<strong>Ticket Number: “".$password."”</strong> [ Please keep the Ticket Number for further uses ]<br/>";
			$full_message .="<strong>Estimated Time Required :  “". $password ."”  Minutes</strong><br/>";
			$full_message .="Phone: <strong>(+88) 01790 33 22 00</strong><br/>";
			$full_message .="Skype ID: <strong>cellex_noc</strong><br/>";
			$full_message .="<a href='www.cellexltd.com' target='_blank'>www.cellexltd.com </a>";

			$this->email->to($email_id);
			$this->email->subject($email_subject);
			$this->email->message($full_message); 
			$this->email->send(); 
		}
	}
}

