<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Qhistory {
	var $error = array();
	
	public function get_history_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('qhistorys');
		$qhistorys_list = $CI->qhistorys->get_history_list($limit,$page);
		$i=$page;
		
		if(!empty($qhistorys_list)){	
			foreach($qhistorys_list as $k=>$v){$i++;
				$qhistorys_list[$k]['sl']=$i;
				$qhistorys_list[$k]['final_date']= date_numeric_format($v['created_at']);
				
				//Complained By
				if($v['first_name'] == "" || $v['last_name'] == ""){
					$qhistorys_list[$k]['complained_by']= $v['username'];
				}else{
					$qhistorys_list[$k]['complained_by']= $v['first_name'] ." ". $v['last_name'];
				}
				
				//Done and Received By
                if ($v['done_by'] == $v['estimate_time_by_id']) {
                    $qhistorys_list[$k]['done_and_received']= "Received & Completed by: <br/> <b>".$v['recv_first_name'] ." ". $v['recv_last_name']."</b>";
                }elseif ($v['done_by'] == 0) {
                    $qhistorys_list[$k]['done_and_received']= "Received & Completed by: <br/> <b>".$v['recv_first_name'] ." ". $v['recv_last_name']."</b>";
                }else{
                    $qhistorys_list[$k]['done_and_received']= "Received by: <b>".$v['recv_first_name'] ." ". $v['recv_last_name']."</b> <br/> Completed by: <b>".$v['done_first_name'] ." ". $v['done_last_name']."</b>";
                }
				
				//Estimate time 
				if($v['estimate_time'] > 0){
					$qhistorys_list[$k]['mod_estimate_time'] = $v['estimate_time'] ." min";
				}else{
					$qhistorys_list[$k]['mod_estimate_time'] = "";
				}

				//Download 
				if($v['attached_file'] !=""){
					$qhistorys_list[$k]['attachment'] = "<a class='btn btn-sm btn-success' href='". base_url() . "uploads/ticket_attachments/" . $v['attached_file'] ."' > <i class='glyphicon glyphicon-download-alt'> </i></a>";
				}else{
					$qhistorys_list[$k]['attachment'] = "...";
				}
					
				// Complain details				
				if(strlen(strip_tags($v['complain_details'])) > 50){
					$qhistorys_list[$k]['customer_query'] = substr(strip_tags($v['complain_details']), 0, 50) ." ...";
				}else{
					$qhistorys_list[$k]['customer_query'] = $v['complain_details'];
				}
			}
		}
		
		$data = array(
			'title' => 'Complete complain list',
			'qhistorys_list' => $qhistorys_list,
			'ticket_templates' => $CI->qhistorys->get_ticketing_template_list(),
			'links' => $links
		);
		$qhistoryList = $CI->parser->parse('admin/qhistory/index',$data,true);
		return $qhistoryList;
	}	
	
	
	public function get_details_view($id)
	{
		$CI =& get_instance();
		$CI->load->model('qhistorys');
		$detail_data = $CI->qhistorys->get_complain_data($id);
		
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
		
		$response_data = $CI->qhistorys->get_response_data($id);

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
		$html_view = $CI->parser->parse('admin/qhistory/detail_view',$this->data,true);
		return $html_view;
	}
		
	public function get_search_history_list_view($start_date,$end_date,$ticket_type)
	{
		$CI =& get_instance();
		$CI->load->model('qhistorys');
		$qhistorys_list = $CI->qhistorys->get_search_history_list($start_date,$end_date,$ticket_type);
		$i=0;
		
		if(!empty($qhistorys_list)){	
			foreach($qhistorys_list as $k=>$v){$i++;
				$qhistorys_list[$k]['sl']=$i;
				$qhistorys_list[$k]['final_date']= dateConvert($v['created_at']);
				
				//Complained By
				if($v['first_name'] == "" || $v['last_name'] == ""){
					$qhistorys_list[$k]['complained_by']= $v['username'];
				}else{
					$qhistorys_list[$k]['complained_by']= $v['first_name'] ." ". $v['last_name'];
				}
				
				//Estimate time 
				if($v['estimate_time'] > 0){
					$qhistorys_list[$k]['mod_estimate_time'] = $v['estimate_time'] ." min";
				}else{
					$qhistorys_list[$k]['mod_estimate_time'] = "";
				}

				//Download 
				if($v['attached_file'] !=""){
					$qhistorys_list[$k]['attachment'] = "<a class='btn btn-sm btn-success' href='". base_url() . "uploads/ticket_attachments/" . $v['attached_file'] ."' > <i class='glyphicon glyphicon-download-alt'> </i></a>";
				}else{
					$qhistorys_list[$k]['attachment'] = "...";
				}

                //Done and Received By
                if ($v['done_by'] == $v['estimate_time_by_id']) {
                    $qhistorys_list[$k]['done_and_received']= "Received & Completed by: <br/> <b>".$v['recv_first_name'] ." ". $v['recv_last_name']."</b>";
                }elseif ($v['done_by'] == 0) {
                    $qhistorys_list[$k]['done_and_received']= "Received & Completed by: <br/> <b>".$v['recv_first_name'] ." ". $v['recv_last_name']."</b>";
                }else{
                    $qhistorys_list[$k]['done_and_received']= "Received by: <b>".$v['recv_first_name'] ." ". $v['recv_last_name']."</b> <br/> Completed by: <b>".$v['done_first_name'] ." ". $v['done_last_name']."</b>";
                }
					
				// Complain details				
				if(strlen(strip_tags($v['complain_details'])) > 50){
					$qhistorys_list[$k]['customer_query'] = substr(strip_tags($v['complain_details']), 0, 50) ." ...";
				}else{
					$qhistorys_list[$k]['customer_query'] = $v['complain_details'];
				}
			}
		}
		
		$data = array(
			'title' 			=> 'Complain List',
			'start_date' 		=> $start_date,
			'end_date' 			=> $end_date,
			'ticket_type' 		=> $ticket_type,
			'qhistorys_list' 	=> $qhistorys_list,
			'ticket_templates' 	=> $CI->qhistorys->get_ticketing_template_list()
		);
		$qhistoryList = $CI->parser->parse('admin/qhistory/index',$data,true);
		return $qhistoryList;
	}	
}
