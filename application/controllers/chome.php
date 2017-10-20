<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chome extends CI_Controller {
	
	function __construct() {
      parent::__construct();
	  $this->template->current_menu = 'home';
    }
	
	public function index()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$CI->load->library('home');
		if (!$this->auth->is_logged())
		{
			$this->output->set_header("Location: ".base_url().'dashboard/login', TRUE, 302);
		}
		$this->auth->check_auth();
		$content = $this->home->get_user_home_data();
		$sub_menu = array();
		$this->template->customer_html_view($content,$sub_menu);
	}	
}