<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Complain {
	var $error = array();

	public function get_complain_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('complains');
		$complains_list = $CI->complains->get_complain_list($limit,$page);
		$i=$page;
		
		if(!empty($complains_list)){	
			foreach($complains_list as $k=>$v){$i++;
				$complains_list[$k]['sl']=$i;
				$complains_list[$k]['final_date']= date_numeric_format($v['created_at']);

				if($v['status'] == 0){
					$complains_list[$k]['sts_class']= "danger";
					$complains_list[$k]['sts_text']= "Not viewed";
				}elseif($v['status'] == 4){
					$complains_list[$k]['sts_class']= "warning";
					$complains_list[$k]['sts_text']= "Viewed";
				}elseif($v['status'] == 3){
					$complains_list[$k]['sts_class']= "primary";
					$complains_list[$k]['sts_text']= "Open";
				}elseif($v['status'] == 2){
					$complains_list[$k]['sts_class']= "info";
					$complains_list[$k]['sts_text']= "On Going";
				}				
				
				if($v['first_name'] == "" || $v['last_name'] == ""){
					$complains_list[$k]['complained_by']= $v['username'];
				}else{
					$complains_list[$k]['complained_by']= $v['first_name'] ." ". $v['last_name'];
				}

				// Complain details				
				if(strlen(strip_tags($v['complain_details'])) > 50){
					$complains_list[$k]['customer_query'] = substr(strip_tags($v['complain_details']), 0, 50) ." ...";
				}else{
					$complains_list[$k]['customer_query'] = $v['complain_details'];
				}

				//Estimate time 
				if($v['estimate_time'] > 0){
					$complains_list[$k]['mod_estimate_time'] = $v['estimate_time'] ." min";
				}else{
					$complains_list[$k]['mod_estimate_time'] = "";
				}

				//Notifications
				if($v['noc_notifications'] > 0){
					$complains_list[$k]['support_notifications'] = "<span class='label-default label label-danger' style='float:right;top:0;right:0;'>" . $v['noc_notifications'] . "</span> ";
				}else{
					$complains_list[$k]['support_notifications'] = "";
				}

				//Download 
				if($v['attached_file'] !=""){
					$complains_list[$k]['attachment'] = "<a class='btn btn-sm btn-success' href='". base_url() . "uploads/ticket_attachments/" . $v['attached_file'] ."' > <i class='glyphicon glyphicon-download-alt'> </i></a>";
				}else{
					$complains_list[$k]['attachment'] = "...";
				}				
				
			}
		}
		
		$data = array(
			'title' => 'Complain List',
			'complains_list' => $complains_list,
			'links' => $links
		);
		$complainList = $CI->parser->parse('admin/complain/index',$data,true);
		return $complainList;
	}
	
	public function get_details_view($id)
	{
		$CI =& get_instance();
		$CI->load->model('complains');
		$detail_data = $CI->complains->get_complain_data($id);
		
		if(!empty($detail_data)){	
			foreach($detail_data as $k=>$v){
				$detail_data[$k]['final_date']= date_numeric_format($v['created_at']);
				
				if($v['first_name'] == "" || $v['last_name'] == ""){
					$detail_data[$k]['complained_by']= $v['username'];
				}else{
					$detail_data[$k]['complained_by']= $v['first_name'] ." ". $v['last_name'];
				}
			}
		}
		
		$response_data = $CI->complains->get_response_data($id);

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

		$this->data['title'] = 'Details : Customer Complain';
		$this->data['detail_datas'] = $detail_data;
		$this->data['response_datas'] = $response_data;
		$html_view = $CI->parser->parse('admin/complain/detail_view',$this->data,true);
		return $html_view;
	}
	
	public function get_history_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('complains');
		$CI->load->model('customers');
		$complains_list = $CI->complains->get_history_list($limit,$page);
		$i=$page;
		
		if(!empty($complains_list)){	
			foreach($complains_list as $k=>$v){$i++;
				$complains_list[$k]['sl']=$i;
				$complains_list[$k]['final_date']= dateConvert($v['created_at']);
				
				//Complained By
				if($v['first_name'] == "" || $v['last_name'] == ""){
					$complains_list[$k]['complained_by']= $v['username'];
				}else{
					$complains_list[$k]['complained_by']= $v['first_name'] ." ". $v['last_name'];
				}
				
				//Received By
				$complains_list[$k]['done_by']= $v['noc_first_name'] ." ". $v['noc_last_name'];
				
				
				//Estimate time 
				if($v['estimate_time'] > 0){
					$complains_list[$k]['mod_estimate_time'] = $v['estimate_time'] ." min";
				}else{
					$complains_list[$k]['mod_estimate_time'] = "";
				}

				//Download 
				if($v['attached_file'] !=""){
					$complains_list[$k]['attachment'] = "<a class='btn btn-sm btn-success' href='". base_url() . "uploads/ticket_attachments/" . $v['attached_file'] ."' > <i class='glyphicon glyphicon-download-alt'> </i></a>";
				}else{
					$complains_list[$k]['attachment'] = "...";
				}				
			}
		}
		
		$data = array(
			'title' => 'Complain List',
			'complains_list' => $complains_list,
			'ticket_templates' => $CI->customers->get_ticketing_template_list(),
			'links' => $links
		);
		$complainList = $CI->parser->parse('admin/complain/complain_history',$data,true);
		return $complainList;
	}	
	
	public function get_response_view($id)
	{
		$CI =& get_instance();
		$CI->load->model('complains');
		$detail_data = $CI->complains->get_complain_data($id);
		$user_id = $CI->auth->get_user_id();

		if(!empty($detail_data)){
            $view_open_options = true;
			foreach($detail_data as $k=>$v){
				$detail_data[$k]['final_date']= date_numeric_format($v['created_at']);
				
				if($v['first_name'] == "" || $v['last_name'] == ""){
					$detail_data[$k]['complained_by']= $v['username'];
				}else{
					$detail_data[$k]['complained_by']= $v['first_name'] ." ". $v['last_name'];
				}
				//
				if($v['estimate_time_by_id'] ==  $CI->auth->get_user_id()){
					$this->data['view_response_form'] = true;
				} elseif($v['status'] == 2){
                    if($CI->auth->check_adv_permission("can_reply_ongoing_ticket") === true) {
                        $this->data['view_response_form'] = true;
                        $view_open_options = false;
                    }else{
                        $this->data['view_response_form'] = false;
                    }
				}else{
                    $this->data['view_response_form'] = false;
                }

				// Disable Support Notifications
				if ($v['estimate_time_by_id'] == $user_id) {					
					$notif_query = "UPDATE customer_complain SET noc_notifications = 0 WHERE id = '".$id."'";
					$CI->complains->update_client_notifications($notif_query);
				}
			}
		}
		
		$response_data = $CI->complains->get_response_data($id);

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
				
		if (isset($this->error['error_send_type'])) {
			$this->data['error_send_type'] = $this->error['error_send_type'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_send_type'] = '';
		}	
		
		$this->data['send_type_value'] = $CI->input->post('send_type');
		$this->data['response_details_value'] = $CI->input->post('response_details');
		$this->data['complain_id'] = $id;
		

		$this->data['title'] = 'Details : Customer Complain';
		$this->data['detail_datas'] = $detail_data;
		$this->data['response_datas'] = $response_data;
		$this->data['view_open_options'] = $view_open_options;
		$this->data['ticket_templates'] = "";//$CI->customers->get_ticketing_template_list();
		$this->data['action'] = base_url().'complain/response/'.$id;

		$html_view = $CI->parser->parse('admin/complain/details',$this->data,true);
		return $html_view;
	}
		
	public function validateForm()
	{	
		$CI =& get_instance();		
	
		if(isset($_POST['response_details'])){
			if(strlen($CI->input->post('response_details')) < 1){
				$this->error['error_response_details'] = "Response details is required";
			}
		} else {
			$this->error['error_response_details'] = "";
		}
		
		if(isset($_POST['send_type'])){
			if($CI->input->post('send_type') == ''){
				$this->error['error_send_type']="Please select send type !";
			}
		} else {
			$this->error['error_send_type']="";
		}
		
		if (!$this->error){
      		return true;
    	} else {
      		return false;
    	}
	}
}
