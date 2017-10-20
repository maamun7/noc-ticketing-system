<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Creport extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  
	  $this->template->current_menu = 'report';
    }

	public function index()
	{	
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('reports');
		$CI->load->library('lreport');
		
        $content = $CI->lreport->total_purchase_amount();
        $sub_menu = array(
				array('label'=> 'Purchase Report', 'url' => 'creport','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}

	//todays_purchase_report
	public function todays_purchase_report()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('todays_purchase_report');
		$CI->load->library('lreport');
		$content = $CI->lreport->todays_purchase_report();
		$sub_menu = array(
			array('label'=> 'Stock Report', 'url' => 'creport'),
			array('label'=> 'Sales Report ', 'url' => 'creport/todays_sales_report'),
			array('label'=> 'Purchase Report ', 'url' => 'creport/todays_purchase_report','class' =>'active'),
			array('label'=> 'Sales Report (Product Wise) ', 'url' => 'creport/product_sales_reports_date_wise')
		);
		$this->template->full_admin_html_view($content,$sub_menu);
	}

	public function search_report_by_date()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('reports');
		$CI->load->library('lreport');
		$start_date = $this->input->post('from_date');		
		$end_date = $this->input->post('to_date');	
		if($start_date=="" || $end_date=="" ){
			$this->session->set_userdata(array('error_message'=>"Select from and to date!"));
			redirect(base_url('creport'));
		} 
        $content = $CI->lreport->date_wise_purchase_amount($start_date,$end_date);
		$sub_menu = array(
				array('label'=> 'Purchase Report', 'url' => 'creport','class' =>'active')
			);
		$this->template->full_admin_html_view($content,$sub_menu);
	}
}