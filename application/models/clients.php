<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class clients extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function profile_edit_data()
	{
		$user_id = $this->session->userdata('user_id');
		$this->db->select('a.*,b.username');
		$this->db->from('users a');
		$this->db->join('user_login b','b.user_id = a.user_id');
		$this->db->where('a.user_id',$user_id);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	//Update Profile
	public function profile_update()
	{
		$user_id = $this->session->userdata('user_id');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$address = $this->input->post('address');
		
		$this->db->set('first_name',$first_name);
		$this->db->set('last_name',$last_name);
		$this->db->set('address',$address);
		$this->db->where('user_id', $user_id);
		$this->db->update('users');
	}
	//Change Password
	public function change_password($email,$old_password,$new_password)
	{
		$user_name = md5("matroak".$new_password);
		$password = md5("matroak".$old_password);
        $this->db->where(array('username'=>$email,'password'=>$password,'is_active'=>1,'can_login'=>1));
		$query = $this->db->get('user_login');
		$result =  $query->result_array();
		
		if (count($result) == 1)
		{	
			$this->db->set('password',$user_name);
			$this->db->where('password',$password);
			$this->db->where('username',$email);
			$this->db->update('user_login');
			return true;
		}
		return false;
	}
}