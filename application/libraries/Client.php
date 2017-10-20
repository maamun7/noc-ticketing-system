<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Client {
	
	public function get_edit_data($user_id)
	{
		$CI =& get_instance();
		$CI->load->model('clients');
		$edit_data = $CI->clients->retrieve_edit_data($user_id);
		$data = array();
		if(!empty($edit_data)){
		$role = $CI->clients->get_role_list();
		if(!empty($role)){
			foreach($role as $k=>$v){
				if($v['role_id'] == $edit_data[0]['role_id']){
					$role[$k]['selected'] = "selected='selected'";
				}else{
					$role[$k]['selected'] = "";
				}
			}
		}
		
		$data = array(
            'user_id' 		=> $edit_data[0]['user_id'],
            'user_type' 	=> $edit_data[0]['user_type'],
            'first_name' 	=> $edit_data[0]['first_name'],
            'last_name' 	=> $edit_data[0]['last_name'],
            'designition' 	=> $edit_data[0]['designition'],
            'address'		=> $edit_data[0]['address'],
            'email' 		=> $edit_data[0]['username'],
            'is_active' 	=> $edit_data[0]['is_active'],
            'can_login' 	=> $edit_data[0]['can_login'],
            'roles' 		=> $role
        );
		}
		$profile_data = $CI->parser->parse('client/client/edit',$data,true);
		return $profile_data;
	}
	
	public function edit_profile_form()
	{
		$CI =& get_instance();
		$CI->load->model('clients');
		$edit_data = $CI->clients->profile_edit_data();	
		$data = array(
			'first_name' => $edit_data[0]['first_name'],
			'last_name' => $edit_data[0]['last_name'],
			'user_name' => $edit_data[0]['username'],
			'address' => $edit_data[0]['address']
		);	
		$profile_data = $CI->parser->parse('client/client/edit_profile',$data,true);
		return $profile_data;
	}
}
?>