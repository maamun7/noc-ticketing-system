<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ticket_type {
	var $error = array();
	public function get_ticket_type_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('ticket_types');
		$ticket_types_list = $CI->ticket_types->get_ticket_type_list($limit,$page);
		$i=$page;
		if(!empty($ticket_types_list)){	
			foreach($ticket_types_list as $k=>$v){$i++;
			   $ticket_types_list[$k]['sl']=$i;
			}
		}
		$data = array(
				'title' => 'Ticket type list',
				'ticket_types_list' => $ticket_types_list,
				'links' => $links
			);
		$ticket_typeList = $CI->parser->parse('admin/ticket_type/index',$data,true);
		return $ticket_typeList;
	}

	public function add_form()
	{
		$CI =& get_instance();
		$this->data['error_warning'] = "";
		if (isset($this->error['error_ticket_type'])) {
			$this->data['error_ticket_type'] = $this->error['error_ticket_type'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_ticket_type'] = '';
		}
		
		$this->data['ticket_type_value'] = $CI->input->post('ticket_type');
		$this->data['ordering_value'] = $CI->input->post('ordering');

		$this->data['title'] = 'New Ticket Type';
		$this->data['action'] = base_url().'cticket_type/add';
		$html_view = $CI->parser->parse('admin/ticket_type/add',$this->data,true);
		return $html_view;
	}

	public function edit_form($ticket_type_id)
	{
		$CI =& get_instance();
		$CI->load->model('ticket_types');
		$this->data['error_warning'] = "";
		if (isset($this->error['error_ticket_type'])) {
			$this->data['error_ticket_type'] = $this->error['error_ticket_type'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_ticket_type'] = '';
		}

		$edit_data = $CI->ticket_types->get_edit_data($ticket_type_id);
		if(!empty($edit_data )){
			$this->data['ticket_type_id'] = $ticket_type_id;
			$this->data['ticket_type_value'] = $edit_data[0]['details'];
			$this->data['ordering_value'] = $edit_data[0]['ordering'];

		}

		if(isset($_POST['ticket_type'])){
			$this->data['ticket_type_value'] = $CI->input->post('ticket_type');
		}

		if(isset($_POST['ordering'])){
			$this->data['ordering_value'] = $CI->input->post('ordering');
		}

		$this->data['title'] = 'Edit Supplier';
		$this->data['action'] = base_url().'ticket_type/edit/'.$ticket_type_id;
		$html_view = $CI->parser->parse('admin/ticket_type/edit',$this->data,true);
		return $html_view;
	}

	public function validateForm()
	{	
		$CI =& get_instance();

		if(isset($_POST['ticket_type'])){
			if(strlen($CI->input->post('ticket_type'))==''){
				$this->error['error_ticket_type']="Ticket type is required";
			} 
		} else {
			$this->error['error_ticket_type']="";
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
}
