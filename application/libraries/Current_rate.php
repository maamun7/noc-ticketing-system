<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Current_rate {
	var $pre_value;

	private function add_color($all_rates)
	{
		$CI =& get_instance();
		asort($all_rates);
		$colors=array("009900","FFA500","0099FF","009999","00CCCC","CCFF33","80B480","99C399","B2D2B2","CCE1CC","E6F0E6","FF0000");
		$i=0;
		foreach($all_rates as $id=>$vals){
			if($vals['rate']==""){
				$all_rates[$id]['color']="";
				$all_rates[$id]['level']="";
			}else{
				if($this->pre_value == $vals['rate']){
					if($i !=0){ $i = $i-1; }
				}
				$all_rates[$id]['color']=$colors[$i];
				$all_rates[$id]['level']=$i+1;
				$this->pre_value = $vals['rate'];
				$i++;
			}		
		}
		ksort($all_rates);
		return $all_rates;
	}

	private function get_lower_rate($all_rates)
	{
		$CI =& get_instance();
		asort($all_rates);
		foreach($all_rates as $id=>$vals){
			if($vals['rate'] !=""){
				$new_rate[]=$vals['rate'];
			}		
		}
		return min($new_rate);
	}

	public function get_list_view($limit,$page,$links,$rate_type)
	{
		$CI =& get_instance();
		$CI->load->model('current_rates');
		$final_lists = array();
		$supplier_list = $CI->current_rates->get_supplier_list();
		$final_lists = $CI->current_rates->get_current_rate_list($limit,$page,$rate_type);
	
		$j=0; $i=$page;
		if (! empty($final_lists)) {
			foreach($final_lists as $key=>$value){$i++;
				$final_lists[$key]['sl']=$i;			
				$rates = $CI->current_rates->get_prefix_wise_rate($value['destination_prefix'],$rate_type);
				
				$alla_rate = array();
				if(! empty($rates)){
					foreach($rates as $k=>$v){
						foreach($supplier_list as $index=>$val){			
							if($v['supplier_id']==$val['supplier_id']){
								$alla_rate[$val['supplier_id']] =array('rate'=>$v['call_rate'],'date'=>date_numeric_format($v['date_time']));
							}				
						}
					}
				}

				foreach($supplier_list as $id=>$parts){			
					if(! array_key_exists($parts['supplier_id'], $alla_rate)){	
						$alla_rate[$parts['supplier_id']] =array('rate'=>"");
					}				
				}
				$final_lists[$key]['rates']=$this->add_color($alla_rate);
			}
		}

		$title="";
		$view_page="";
		switch ($rate_type) {
			case '1':
				$title="Premier Rate List";
				$view_page="current_rate/premium";
			break;
			case '2':
				$title="Standard Rate List";
				$view_page="current_rate/standard";
			break;
			case '3':
				$title="Special Rate List";
				$view_page="current_rate/special";
			break;
		}

		$data = array(
			'title' => $title,
			'supplier_lists' => $supplier_list,
			'rates_lists' => $final_lists,
			'limit' => $limit,
			'page' => $page,
			'links' => $links
		);
		$current_rateList = $CI->parser->parse($view_page,$data,true);
		return $current_rateList;
	}

	public function get_export_csv_data($limit,$page,$rate_type)
	{
		$CI =& get_instance();
		$CI->load->model('current_rates');
		$final_lists = array();
		$supplier_list = $CI->current_rates->get_supplier_list();
		$final_lists = $CI->current_rates->get_current_rate_list($limit,$page,$rate_type);
	
		$j=0; $i=$page;
		if (! empty($final_lists)) {
			foreach($final_lists as $key=>$value){$i++;
				$final_lists[$key]['sl']=$i;			
				$rates = $CI->current_rates->get_prefix_wise_rate($value['destination_prefix'],$rate_type);
				
				$alla_rate = array();
				foreach($rates as $k=>$v){
					foreach($supplier_list as $index=>$val){			
						if($v['supplier_id']==$val['supplier_id']){
							//$only_rate[]=$v['call_rate'];
							$alla_rate[$val['supplier_id']] =array('rate'=>$v['call_rate'],'supplier_name'=>$val['supplier_name']);
						}				
					}
				}
				//Get heighst value
				$heighst_value = max($alla_rate);
				//sorting array higher to lower 
				rsort($alla_rate);
				//remove highest value
				array_shift($alla_rate);

				$s_names = array();
				if (! empty($alla_rate)) {
					foreach($alla_rate as $indx=>$valu){		
						$s_names[] =$valu['supplier_name'];
										
					}
				}

				$otrs_s_names = implode("/",$s_names);

				$final_lists[$key]['rate']=$heighst_value['rate'];
				$final_lists[$key]['supplier_name']=$heighst_value['supplier_name'];
				$final_lists[$key]['otrs_sup_names']=$otrs_s_names;
			}
		}
		$arrayName = array(				
			array('Sl No','Destination Prefix','Destination Name','Buy Rate','Sale Rate','Supplier Name','Others Supplier'),
		);

		if(! empty($rates)){
			foreach($final_lists as $key=>$value){				

				$sell_rate = $value['rate'] + ($value['rate']*1)/100;
				$rates =array($value['sl'],$value['destination_prefix'],$value['destination_name'],$value['rate'],$sell_rate,$value['supplier_name'],$value['otrs_sup_names']);
				array_push($arrayName, $rates);
			}
		}
		return $arrayName;
	}


	public function get_search_by_destination_view($destnation_name)
	{
		$CI =& get_instance();
		$CI->load->model('current_rates');
		$destination_rates_list = $CI->current_rates->get_search_by_destination($destnation_name);
		$i=0;
		if(!empty($destination_rates_list)){	
			foreach($destination_rates_list as $k=>$v){$i++;
			   $destination_rates_list[$k]['sl']=$i;
			   $sales_rates=($v['call_rate']*10)/100;
			   $sales_rates=$v['call_rate']+$sales_rates;
			   $destination_rates_list[$k]['sales_rates']=$sales_rates;
			   $destination_rates_list[$k]['sales_rate_in_taka']=$v['dollar_rate']*$sales_rates;
			   $destination_rates_list[$k]['final_date'] = date_numeric_format($destination_rates_list[$k]['date_time']);
			}
		}
		$data = array(
				'title' => 'Search Result List',
				'destination_search_list' => $destination_rates_list
			);
		$current_rateList = $CI->parser->parse('current_rate/search_list',$data,true);
		return $current_rateList;
	}

	
	public function search_by_prefix_view($prefix,$rate_type)
	{		
		$CI =& get_instance();
		$CI->load->model('current_rates');
		$final_lists = array();
		$supplier_list = $CI->current_rates->get_supplier_list();
		$final_lists = $CI->current_rates->get_search_list($rate_type,$prefix);

		$j=0; $i=0;
		if (! empty($final_lists)) {
			foreach($final_lists as $key=>$value){$i++;
				$final_lists[$key]['sl']=$i;			
				$rates = $CI->current_rates->get_prefix_wise_rate($value['destination_prefix'],$rate_type);
				
				$alla_rate = array();
				foreach($rates as $k=>$v){
					foreach($supplier_list as $index=>$val){			
						if($v['supplier_id']==$val['supplier_id']){
							$alla_rate[$val['supplier_id']] =array('rate'=>$v['call_rate'],'date'=>date_numeric_format($v['date_time']));
						}				
					}
				}

				foreach($supplier_list as $id=>$parts){			
					if(! array_key_exists($parts['supplier_id'], $alla_rate)){	
						$alla_rate[$parts['supplier_id']] =array('rate'=>"");
					}				
				}
				$final_lists[$key]['rates']=$this->add_color($alla_rate);
			}
		}

		$title="";
		$page="";
		switch ($rate_type) {
			case '1':
				$title="Premier Search Rate";
				$page="current_rate/premium";
			break;
			case '2':
				$title="Standard Search Rate";
				$page="current_rate/standard";
			break;
			case '3':
				$title="Special Search Rate";
				$page="current_rate/special";
			break;
		}

		$data = array(
			'title' => $title,
			'supplier_lists' => $supplier_list,
			'rates_lists' => $final_lists,
			'search' => ""
		);
		$current_rateList = $CI->parser->parse($page,$data,true);
		return $current_rateList;
	}

	
	public function get_search_by_supplier_view($supplier_id,$start_date,$end_date)
	{
		$CI =& get_instance();
		$CI->load->model('current_rates');
		$destination_rates_list = $CI->current_rates->get_search_by_supplier($supplier_id,$start_date,$end_date);
		$i=0;
		if(!empty($destination_rates_list)){	
			foreach($destination_rates_list as $k=>$v){$i++;
			   $destination_rates_list[$k]['sl']=$i;
			   $sales_rates=($v['call_rate']*10)/100;
			   $sales_rates=$v['call_rate']+$sales_rates;
			   $destination_rates_list[$k]['sales_rates']=$sales_rates;
			   $destination_rates_list[$k]['sales_rate_in_taka']=$v['dollar_rate']*$sales_rates;
			   $destination_rates_list[$k]['final_date'] = date_numeric_format($destination_rates_list[$k]['date_time']);
			}
		}
		$data = array(
				'title' => 'Search Result',
				'destination_search_list' => $destination_rates_list
			);
		$current_rateList = $CI->parser->parse('current_rate/search_list',$data,true);
		return $current_rateList;
	}


	public function current_rate_search_item($current_rate_id)
	{
		$CI =& get_instance();
		$CI->load->model('current_rates');
		$current_rates_list = $CI->current_rates->current_rate_search_item($current_rate_id);
		$i=0;
		foreach($current_rates_list as $k=>$v){$i++;
           $current_rates_list[$k]['sl']=$i;
		   $sales_rates=($v['call_rate']*10)/100;
		   $sales_rates=$v['call_rate']+$sales_rates;
		   $current_rates_list[$k]['sales_rates']=$sales_rates;
		   $current_rates_list[$k]['sales_rate_in_taka']=$v['dollar_rate']*$sales_rates;
		}
		$data = array(
				'title' => 'current_rates Search Items',
				'current_rates_list' => $current_rates_list
			);
		$current_rateList = $CI->parser->parse('current_rate/current_rate',$data,true);
		return $current_rateList;
	}

}
