<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cclient extends CI_Controller {
	
	function __construct() {
		parent::__construct();	  
		$this->template->current_menu = '';
    }
	
	//Edit Profile
	public function edit_profile()
	{	
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->echeck_user_permission();
		$CI->load->library('client');
		$content = $CI->client->edit_profile_form();
		$this->template->customer_html_view($content);
	}
	
	//Update Profile
	public function update_profile()
	{	
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->echeck_user_permission();
		$CI->load->model('clients');
		$this->clients->profile_update();
		$this->session->set_userdata(array('message'=>"Successfully Updated !"));
		redirect(base_url('home'));
	}
	//Change Pass 
	public function change_password_form()
	{	
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->echeck_user_permission();
		$content = $CI->parser->parse('client/client/change_password',array('title'=>"Change Password"),true);
		$this->template->customer_html_view($content);
	}
	//Update Profile
	public function change_password()
	{	
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->echeck_user_permission();
		$CI->load->model('clients'); 
		
		$error = '';
		$email = $this->input->post('email');
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		
		if ( $email == '' || $old_password == '' || $new_password == '')
		{
			$error = "Blank field doesn't accept";
		}else if($email != $this->session->userdata('user_name')){
			$error = "You put wrong email address";
		}else if(strlen($new_password)<6 ){
			$error = "New Password At least 6 Characters";
		}else if($new_password != $repassword ){
			$error = "Password and Re-password doesn't Match";
		}else if($CI->clients->change_password($email,$old_password,$new_password) === FALSE ){
			$error = "You are not authorized person";
		}
		if ( $error != '' )
		{
			$this->session->set_userdata(array('error_message'=>$error));
			$this->output->set_header("Location: ".base_url().'client/change_password_form', TRUE, 302);
		}else{
			$this->session->set_userdata(array('message'=>"Successfully Changed Password"));
			$this->output->set_header("Location: ".base_url().'home', TRUE, 302);
        }
	}
}