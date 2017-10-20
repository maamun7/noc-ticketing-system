<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cdashboard extends CI_Controller {

	function __construct() {
      parent::__construct();
	  $this->template->current_menu = 'home';
    }

	public function index()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('manage_home');
		$CI->load->library('home');
		if (!$this->auth->is_logged())
		{
			$this->output->set_header("Location: ".base_url().'dashboard/login', TRUE, 302);
		}
		$this->auth->check_auth();
		$content = $this->home->get_admin_home_data();
		$sub_menu = array();
		$this->template->full_html_view($content,$sub_menu);
	}

	public function login()
	{
		$CI =& get_instance();
		$CI->load->library('dashboard');

		if ($this->auth->is_logged() )
		{
			if($this->auth->get_user_type() == 2){
				$this->output->set_header("Location: ".base_url().'dashboard', TRUE, 302);
			}elseif($this->auth->get_user_type() == 1){
				$this->output->set_header("Location: ".base_url().'home', TRUE, 302);
			}
		}
		$content = $this->dashboard->get_login_view();
		$sub_menu = array();
		$this->template->full_html_view($content,$sub_menu);
	}

	//* Valid User Check..
	public function do_login()
	{
		$error = '';
		//$user_type = $this->input->post('user_type');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if ( $username == '' || $password == '' || $this->auth->login($username, $password) === FALSE )
		{
			$error = 'Wrong user name or password';
		}
		if ( $error != '' )
		{
			$this->session->set_userdata(array('error_message'=>$error));
			$this->output->set_header("Location: ".base_url().'dashboard/login', TRUE, 302);
		}else{
			if($this->auth->get_user_type() == 2){
				$this->output->set_header("Location: ".base_url().'dashboard', TRUE, 302);
			}elseif($this->auth->get_user_type() == 1){
				$this->output->set_header("Location: ".base_url().'home', TRUE, 302);
			}
        }
	}
	public function logout()
	{
		if ($this->auth->logout())
		$this->output->set_header("Location: ".base_url().'dashboard/login', TRUE, 302);
	}
	//Edit Profile
	public function edit_profile()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('edit_profile');
		$CI->load->library('user');
		$content = $CI->user->edit_profile_form();
		$this->template->full_html_view($content);
	}
	//Update Profile
	public function update_profile()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('edit_profile');
		$CI->load->model('users');
		$this->users->profile_update();
		$this->session->set_userdata(array('message'=>"Successfully Updated !"));
		redirect(base_url('dashboard'));
	}
	//Change Pass
	public function change_password_form()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('change_password');
		$content = $CI->parser->parse('admin/user/change_password',array('title'=>"Change Password"),true);
		$this->template->full_html_view($content);
	}
	//Update Profile
	public function change_password()
	{
		$CI =& get_instance();
		$this->auth->check_auth();
		$this->auth->check_permission('change_password');
		$CI->load->model('users');

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
		}else if($CI->users->change_password($email,$old_password,$new_password) === FALSE ){
			$error = "You are not authorized person";
		}
		if ( $error != '' )
		{
			$this->session->set_userdata(array('error_message'=>$error));
			$this->output->set_header("Location: ".base_url().'dashboard/change_password_form', TRUE, 302);
		}else{
			$this->session->set_userdata(array('message'=>"Successfully Changed Password"));
			$this->output->set_header("Location: ".base_url().'dashboard', TRUE, 302);
        }
	}
}