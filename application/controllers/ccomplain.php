<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ccomplain extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'complain';
    }
	
	public function index()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('manage_complain');
		$CI->load->library('complain');
		$CI->load->model('complains');
		
		$config = array();
		$config["base_url"] = base_url()."complain/index";
		$config["total_rows"] = $this->complains->count_complain();
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
		
        $content = $CI->complain->get_complain_list_view($limit,$page,$links);
        $sub_menu = array();
		$this->template->full_html_view($content,$sub_menu);
	}

	public function response($id=null)
	{			
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('complain_response');
		$CI->load->model('complains');
		$CI->load->library('complain');
		
		if (!$id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select complain !"));
			redirect(base_url('complain'));
			exit();
		}
		
		if($this->complain->validateForm()){
			$data = array(
				'id' 					=> Null,
				'complain_id' 			=> $this->input->post('complain_id'),
				'response_by_id' 		=> $this->auth->get_user_id(),
				'message' 				=> html_entity_decode($this->input->post('response_details',TRUE),ENT_QUOTES,'utf-8'),
				'response_at' 			=> current_bd_date_time(),
			);
			$this->complains->insert_response($data);
			
			//Update status 
			$status = $this->input->post('send_type');
            if ($status == 1) {
                $sts_data = array('done_by' =>$this->auth->get_user_id(),'done_at' =>current_bd_date_time(),'status' => $status);
            }else{
		    	$sts_data = array('status' => $status);
            }
			$this->complains->update_estimate_time($sts_data,$id);

			// Add notifications from support to client					
			$notif_query = "UPDATE customer_complain SET client_notifications = client_notifications + 1 WHERE id = '".$id."'";
			$this->complains->update_client_notifications($notif_query);		
			
			//Re-direct
			$this->session->set_userdata(array('message'=> "Successfully added your response !"));
			redirect(base_url('ccomplain'));
			exit;
			
		}else{         
			$content = $CI->complain->get_response_view($id);
			$sub_menu = array();
			$this->template->full_html_view($content,$sub_menu);	
		}
	}

	public function details($id=null)
	{			
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('complain_response');
		$CI->load->model('complains');
		$CI->load->library('complain');
		
		if (!$id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select complain !"));
			redirect(base_url('complain'));
			exit();
		}  
		
		$content = $CI->complain->get_details_view($id);
		$sub_menu = array();
		$this->template->full_html_view($content,$sub_menu);	
	}
	
	// Given estimate time
	public function receive($id=null)
	{			
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('given_estimate_time');
		$CI->load->model('complains');
		$CI->load->library('complain');
		if (!$id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select complain !"));
			redirect(base_url('complain'));
			exit();
		}  		
		$user_id = $CI->auth->get_user_id();
		$detail_data = $this->complains->get_estimate_details($id);

		if(isset($_POST['estimate_time']) && $_POST['estimate_time'] != ""){	
			$data = array(
				'estimate_time' 			=> $this->input->post('estimate_time'),
				'estimate_time_by_id' 		=> $this->auth->get_user_id(),
				'given_estimate_time_at' 	=> current_bd_date_time(),
				'status' 					=> 4
			);			
			$this->complains->update_estimate_time($data,$id);
			
			$this->session->set_userdata(array('message'=> "Successfully added your response time !"));
			redirect(base_url('complain'));
			exit;
		}	
		
		if(isset($_POST['estimate_time']) && $_POST['estimate_time'] == ""){	
			$this->session->set_userdata(array('message'=> "You didn't provide estimate time !"));
			redirect(base_url('complain'));
			exit;
		}

		if ($detail_data[0]['estimate_time'] > 0) {
			if ($detail_data[0]['estimate_time_by_id'] == $user_id) {
				$data = array(
					'action' 		=> base_url()."complain/receive/".$id,
					'estimate_time' => $detail_data[0]['estimate_time'],
				);
				$CI->load->view("admin/complain/response_modal",$data);	
			}else{
				$data = array(
					'timed_by' => $detail_data[0]['first_name'] ." ".$detail_data[0]['last_name'],
				);
				$CI->load->view("admin/complain/response_modal_view_mode",$data);	
			}
			
		} else {
			$data = array(
				'action' 		=> base_url()."complain/receive/".$id,
				'estimate_time' => "",
			);
			$CI->load->view("admin/complain/response_modal",$data);	
		}
	}	
}