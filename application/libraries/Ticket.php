<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ticket {
	var $error = array();
	public function get_ticket_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('tickets');
		$ticket_list = $CI->tickets->get_ticket_list($limit,$page);
		$i=$page;
		
		if(!empty($ticket_list)){	
			foreach($ticket_list as $k=>$v){$i++;
				$ticket_list[$k]['sl']=$i;
				$ticket_list[$k]['final_date']= date_numeric_format($v['created_at']);

				if($v['status'] == 0){
					$ticket_list[$k]['sts_class']= "danger";
					$ticket_list[$k]['sts_text']= "Not viewed";
				}elseif($v['status'] == 4){
					$ticket_list[$k]['sts_class']= "warning";
					$ticket_list[$k]['sts_text']= "Viewed";
				}elseif($v['status'] == 3){
					$ticket_list[$k]['sts_class']= "primary";
					$ticket_list[$k]['sts_text']= "Open";
				}elseif($v['status'] == 2){
					$ticket_list[$k]['sts_class']= "info";
					$ticket_list[$k]['sts_text']= "On Going";
				}elseif($v['status'] == 1){
					$ticket_list[$k]['sts_class']= "success";
					$ticket_list[$k]['sts_text']= "Done";
				}				

				// Complain details				
				if(strlen($v['complain_details']) > 80){
					$ticket_list[$k]['customer_query'] = substr($v['complain_details'], 0, 80) ." ...";
				}else{
					$ticket_list[$k]['customer_query'] = $v['complain_details'];
				}	
				
				//Estimate time 
				if($v['estimate_time'] > 0){
					$ticket_list[$k]['mod_estimate_time'] = $v['estimate_time'] ." min";
				}else{
					$ticket_list[$k]['mod_estimate_time'] = "";
				}

				// View and reply
				if($v['status'] == 3){
					$can_reply = true;
					$ticket_list[$k]['access_status']= "View & Reply";
				} else {
					$ticket_list[$k]['access_status']= "View";
				}

				//Notifications
				if($v['client_notifications'] > 0){
					$ticket_list[$k]['user_notifications'] = "<span class='label-default label label-danger' style='float:right;top:0;right:0;'>" . $v['client_notifications'] . "</span>";
				}else{
					$ticket_list[$k]['user_notifications'] = "";
				}

				//Download 
				if($v['attached_file'] !=""){
					$ticket_list[$k]['attachment'] = "<a class='btn btn-sm btn-success' href='". base_url() . "uploads/ticket_attachments/" . $v['attached_file'] ."' > <i class='glyphicon glyphicon-download-alt'> </i></a>";
				}else{
					$ticket_list[$k]['attachment'] = "...";
				}
				
			}
		}
		
		$data = array(
			'title' => 'Complain List',
			'ticket_lists' => $ticket_list,
			'links' => $links
		);
		$ticketList = $CI->parser->parse('client/ticket/index',$data,true);
		return $ticketList;
	}

		
	public function validateTicketForm()
	{	
		$CI =& get_instance();

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
			} elseif(strlen($CI->input->post('customer_query'))<10 || strlen($CI->input->post('customer_query'))>500){
				$this->error['error_customer_query']="Supplier name must be between 10 to 500 characters";
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

	
	public function get_new_ticket_view()
	{
		$CI =& get_instance();
		$CI->load->model('tickets');
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
		
		$this->data['complain_type_value'] = $CI->input->post('complain_type');
		$this->data['customer_query_value'] = $CI->input->post('customer_query');

		$this->data['title'] = 'Query form';
		$this->data['ticket_templates'] = $CI->tickets->get_ticketing_template_list();
		$this->data['action'] = base_url().'ticket/new_ticket';		
		$html_view = $CI->parser->parse('client/ticket/new_ticket',$this->data,true);
		return $html_view;
	}


	public function get_ticket_response_view($id)
	{
		$CI =& get_instance();
		$CI->load->model('tickets');
		$user_id = $CI->auth->get_user_id();
		$detail_data = $CI->tickets->get_tickets_details_data($id,$user_id);
		
		if(!empty($detail_data)){	
			foreach($detail_data as $k=>$v){
				$detail_data[$k]['final_date']= date_numeric_format($v['created_at']);
				//Get complained by id
				$complained_id = $v['user_id'];

				//Setting complained by name
				if($v['first_name'] == "" || $v['last_name'] == ""){
					$detail_data[$k]['complained_by']= $v['username'];
				}else{
					$detail_data[$k]['complained_by']= $v['first_name'] ." ". $v['last_name'];
				}

				// View and reply
				$can_reply = false;
				if($v['status'] == 3){
					$can_reply = true;
				}				

				// Disable client notifications
				$notif_query = "UPDATE customer_complain SET client_notifications = 0 WHERE id = '".$id."'";
				$CI->tickets->update_client_notifications($notif_query);

			}
		} else {			
			$CI->session->set_userdata(array('error_message'=>"Bad Request !"));
			redirect(base_url('ticket'));
			exit();
		}
		
		$response_data = $CI->tickets->get_response_data($id);

		if(!empty($response_data)){	
			foreach($response_data as $i =>$va){
				$response_data[$i]['final_date']= date_numeric_format($va['response_at']);
				
				if($va['first_name'] == "" || $va['last_name'] == ""){
					$response_data[$i]['responsed_by']= $va['username'];
				}else{
					$response_data[$i]['responsed_by']= $va['first_name'] ." ". $va['last_name'];
				}			

			}
		}	

		if (isset($this->error['error_response_details'])) {
			$this->data['error_response_details'] = $this->error['error_response_details'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_response_details'] = '';
		}
		
		$this->data['response_details_value'] = $CI->input->post('response_details');	

		$this->data['title'] = 'Details : Response details';
		$this->data['can_reply'] = $can_reply;
		$this->data['detail_datas'] = $detail_data;
		$this->data['response_datas'] = $response_data;
		$this->data['action'] = base_url().'ticket/view_details/'.$id;	
		$html_view = $CI->parser->parse('admin/ticket/response_details',$this->data,true);
		return $html_view;
	}
		
		
	public function validateTicketResponseForm()
	{	
		$CI =& get_instance();

		if(isset($_POST['response_details'])){
			if(strlen($CI->input->post('response_details'))==''){
				$this->error['error_response_details']="Response details is required";
			} elseif(strlen($CI->input->post('response_details'))<5 || strlen($CI->input->post('response_details'))>500){
				$this->error['error_response_details']="Response details must be between 5 to 500 characters";
			}
		} else {
			$this->error['error_response_details']="";
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
}
