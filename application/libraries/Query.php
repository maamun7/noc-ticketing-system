<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Query {
	var $error = array();
	
	public function get_ticket_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('queries');
		$ticket_list = $CI->queries->get_ticket_list($limit,$page);

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
				if(strlen(strip_tags($v['complain_details'])) > 80){
					$ticket_list[$k]['customer_query'] = substr(strip_tags($v['complain_details']), 0, 80) ." ...";
				}else{
					$ticket_list[$k]['customer_query'] = $v['complain_details'];
				}	
				
				//Estimate time 
				if($v['estimate_time'] > 0){
					$ticket_list[$k]['mod_estimate_time'] = $v['estimate_time'] ." min";
				}else{
					$ticket_list[$k]['mod_estimate_time'] = "";
				}

				//Done and Received By
                if ($v['done_by'] == $v['estimate_time_by_id']) {
                    $ticket_list[$k]['done_and_received']= "Received & Completed by: ".$v['recv_first_name'] ." ". $v['recv_last_name'];
                }elseif ($v['done_by'] == 0) {
                    $ticket_list[$k]['done_and_received']= "Received & Completed by: ".$v['recv_first_name'] ." ". $v['recv_last_name'];
                }else{
                    $ticket_list[$k]['done_and_received']= "Received by: ".$v['recv_first_name'] ." ". $v['recv_last_name'].", Completed by: ".$v['done_first_name'] ." ". $v['done_last_name'];
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
		$complainList = $CI->parser->parse('admin/ticket/index',$data,true);
		return $complainList;
	}	
	
	public function get_new_ticket_view()
	{
		$CI =& get_instance();
		$CI->load->model('queries');
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

		$this->data['title'] = 'Customer complain';
		$this->data['ticket_templates'] = $CI->queries->get_ticketing_template_list();
		$this->data['action'] = base_url().'query/new_ticket';		
		$html_view = $CI->parser->parse('admin/ticket/new_ticket',$this->data,true);
		return $html_view;
	}	
	
	public function get_edit_ticket_view($ticket_id)
	{
		$CI =& get_instance();
		$CI->load->model('queries');
		$user_id = $CI->auth->get_user_id();
		
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
		$this->data['previous_attached'] = "";
		$edit_data = $CI->queries->get_tickets_details_data($ticket_id,$user_id);
		if(!empty($edit_data )){
			if($edit_data[0]['status'] != 0){
				$CI->session->set_userdata(array('error_message'=>"Edit time already exceed!"));
				redirect(base_url('query'));
				exit();
			}
			$this->data['ticket_id'] = $ticket_id;
			$this->data['ticket_type_value'] = $edit_data[0]['ticket_type_id'];
			$this->data['customer_query_value'] = $edit_data[0]['complain_details'];
			$this->data['previous_attached'] = $edit_data[0]['attached_file'];
		}

		if(isset($_POST['ticket_type'])){
			$this->data['ticket_type_value'] = $CI->input->post('ticket_type');
		}

		if(isset($_POST['customer_query'])){
			$this->data['customer_query_value'] = $CI->input->post('customer_query');
		}
		
		$this->data['title'] = 'Customer complain';
		$this->data['ticket_templates'] = $CI->queries->get_ticketing_template_list();
		$this->data['action'] = base_url().'query/edit_ticket/'.$ticket_id;		
		$html_view = $CI->parser->parse('admin/ticket/edit_ticket',$this->data,true);
		return $html_view;
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
				$this->error['error_customer_query']="Query is required";
			} elseif(strlen($CI->input->post('customer_query'))<5 || strlen($CI->input->post('customer_query'))>15000){
				$this->error['error_customer_query']="Query must be between 5 to 15000 characters";
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
	
	public function get_ticket_response_view($id)
	{
		$CI =& get_instance();
		$CI->load->model('queries');
		$user_id = $CI->auth->get_user_id();
		$detail_data = $CI->queries->get_tickets_details_data($id,$user_id);
		
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
				$CI->queries->update_client_notifications($notif_query);

			}
		} else {			
			$CI->session->set_userdata(array('error_message'=>"Bad Request !"));
			redirect(base_url('query'));
			exit();
		}
		
		$response_data = $CI->queries->get_response_data($id);

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
		$this->data['action'] = base_url().'query/response/'.$id;	
		$html_view = $CI->parser->parse('admin/ticket/response_details',$this->data,true);
		return $html_view;
	}
		
	public function validateTicketResponseForm()
	{	
		$CI =& get_instance();

		if(isset($_POST['response_details'])){
			if(strlen($CI->input->post('response_details'))==''){
				$this->error['error_response_details']="Response details is required";
			} elseif(strlen($CI->input->post('response_details'))<5 || strlen($CI->input->post('response_details'))>10000){
				$this->error['error_response_details']="Response details must be between 5 to 10000 characters";
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
