<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Template {
	var $current_menu = 'home';
	// View Message
	function message_html()
	{
		$CI =& get_instance();
		$CI->load->library('parser');
		
		$message = '';
		$message_class = '';
		$html = '';
		
		if ( $CI->session->userdata('message') != '' )
		{
			$message = $CI->session->userdata('message');
			$message_class = 'alert-success';
		}
		
		if ( $CI->session->userdata('error_message') != '' )
		{
			$message = $CI->session->userdata('error_message');
			$message_class = 'alert-danger';
		}else if ( $CI->session->userdata('warning_message') != '' )
		{
			$message = $CI->session->userdata('warning_message');
			$message_class = 'alert-warning';
		}

		$data = array(
			'message' => $message,
			'message_class' => $message_class
		);

		if ( $message != '' )
			$html = $CI->parser->parse('admin/include/message',$data,true);

		$CI->session->unset_userdata('message');
		$CI->session->unset_userdata('error_message');

		return $html;
	}
	//Admin Html View....
	public function full_html_view($content,$sub_menu=''){	
		$CI =& get_instance();
		$message = $this->message_html();
		$logged_info='';
		$menu_template = 'admin/include/top_menu';
			
		$menu_data = array(
			'top_menu_items' => false
		);
		$top_menu = $CI->parser->parse($menu_template,$menu_data,true);

		$logo = "";
			
		if ($CI->auth->is_logged())
		{	
			$logo = "<img src='".base_url()."assets/img/logo.png'/ height='51' width='180'>";	
			// parse menu
			$menu_data = array(
				'active' => $this->current_menu,
				'top_menu_items' => true
			);			
			$top_menu = $CI->parser->parse($menu_template,$menu_data,true);
						
			$logged_data_page = 'admin/include/loggedin_info';
			$log_info = array(
				'email' => $CI->session->userdata('user_name'),
				'logout' => base_url().'dashboard/logout'
			); 
			$logged_info = $CI->parser->parse($logged_data_page,$log_info,true);
		}
		
		//Sub Menu
		if ( $sub_menu != '' )
		{
			// insert empty text to non assigned elments
			foreach($sub_menu as $k=>$sub){
				if(!isset($sub['title']))$sub_menu[$k]['title']='';
				if(!isset($sub['class']))$sub_menu[$k]['class']='';
			}
			$sub_menu = $CI->parser->parse('admin/include/sub_menu', array('sub_menu'=>$sub_menu), true);
		}
		
		$data = array (
			'logindata' 	=> $logged_info,
			'mainmenu' 		=> $top_menu,
			'logo' 			=> $logo,
			'sub_menu' 		=> $sub_menu,
			'content' 		=> $content,
			'msg_content' 	=> $message
		);
		$content = $CI->parser->parse('admin/template',$data);
	}
	
	//Admin Html View....
	public function customer_html_view($content,$sub_menu=''){	
		$CI =& get_instance();
		$message = $this->message_html();
		$logged_info='';
		$menu_template = 'client/include/top_menu';
			
		$menu_data = array(
			'top_menu_items' => false
		);
		$top_menu = $CI->parser->parse($menu_template,$menu_data,true);
			
		$logo = "";

		if ($CI->auth->is_logged())
		{	
			$logo = "<img src='".base_url()."assets/img/logo.png'/>";	
			// parse menu
			$menu_data = array(
				'active' => $this->current_menu,
				'top_menu_items' => true
			);			
			$top_menu = $CI->parser->parse($menu_template,$menu_data,true);
						
			$logged_data_page = 'client/include/loggedin_info';
			$log_info = array(
				'email' => $CI->session->userdata('user_name'),
				'logout' => base_url().'dashboard/logout'
			); 
			$logged_info = $CI->parser->parse($logged_data_page,$log_info,true);
		}
		
		//Sub Menu
		if ( $sub_menu != '' )
		{
			// insert empty text to non assigned elments
			foreach($sub_menu as $k=>$sub){
				if(!isset($sub['title']))$sub_menu[$k]['title']='';
				if(!isset($sub['class']))$sub_menu[$k]['class']='';
			}
			$sub_menu = $CI->parser->parse('client/include/sub_menu', array('sub_menu'=>$sub_menu), true);
		}
		
		$data = array (
			'logindata' 	=> $logged_info,
			'logo' 			=> $logo,
			'mainmenu' 		=> $top_menu,
			'sub_menu' 		=> $sub_menu,
			'content' 		=> $content,
			'msg_content' 	=> $message
		);
		$content = $CI->parser->parse('client/template',$data);
	}	
	
}