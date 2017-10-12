<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class Statistics {
	public function log_activity() {
		// We need an instance of CI as we will be using some CI classes
		
			$CI =& get_instance();

			// Start off with the session stuff we know
			$data = array();
			$session_data = $CI->session->userdata('logged_in');
		if(isset($session_data['username']))
		{
			 $data['username'] = $session_data['username'];
			 $data['user_type'] = $session_data['user_type'];
			 			/* $query = $CI->db->query('select MAX(id) As id from admin') or die(mysql_error());
			 $query1 = $query->result(); */
			 $id = $CI->uri->segment(4);
			 
			 $query2 = $CI->db->query('SELECT user_types.user_type,admin.id as id1,admin.* FROM admin,user_role,user_types  WHERE (user_role.user_id = admin.id) and (user_role.user_type = user_types.id) and(admin.id = "'.$id.'" )') or die(mysql_error());
			 $query3= $query2->result();
			 
			 $query4 = $CI->db->query('select * from tasklist where id = "'.$id.'" ') or die(mysql_error());
			 $query5 = $query4->result();
			 
            date_default_timezone_set("Asia/Kolkata");
			// Next up, we want to know what page we're on, use the router class
			$data['section'] = $CI->router->class;
			$data['action'] = $CI->router->method;
        	// Lastly, we need to know when this is happening
			$data['timestamp'] = date("Y/m/d h:i:sa");

			// We don't need it, but we'll log the URI just in case
		//	$data['uri'] = uri_string();
          
			  if( ($data['section'] == 'usermanagement'))
			 {			// And write it to the database
				if($data['action'] == 'delete')
				{
				
					$data1 = array(
						'username' => $data['username']  ,
						'action' => 'User '.$query3[0]->username.' of type '.$query3[0]->user_type.'  was '.$CI->router->method.'d',
						'timestamp' => $data['timestamp']
									);
					
					$CI->db->insert('logs', $data1);
				}
				
				if($data['action'] == 'update')
				{
					
					$data1 = array(
						'username' => $data['username']  ,
						'action' => 'User <a href="'.base_url().'admin/usermanagement/edit/'.$query3[0]->id1.'">'.$query3[0]->username.'</a> of type '.$query3[0]->user_type.'  was '.$CI->router->method.'d',
						'timestamp' => $data['timestamp']
									);
					
					$CI->db->insert('logs', $data1);
										
				}
				
				if($data['action'] == 'insert')
				{
					$query6 = $CI->db->query('select * from user_types where id = "'.$CI->input->post('user_type').'" ') or die(mysql_error());
					$query7 = $query6->result();
					
					
					
					$data1 = array(
						'username' => $data['username']  ,
						'action' => 'User <a href="'.base_url().'admin/usermanagement/edit/'.$CI->input->post('hidden_id').'">'.$CI->input->post('username').'</a> of type '.$query7[0]->user_type.' was '.$CI->router->method.'ed ',
						'timestamp' => $data['timestamp']
									);
					
					$CI->db->insert('logs', $data1);
										
				}
				
			 }   
			else if($data['section'] == 'taskmanagement') 
			{
			   	if($data['action'] == 'delete')
				{
				
					$data1 = array(
						'username' => $data['username']  ,
						'action' => 'Task '.$query5[0]->application.' was '.$CI->router->method.'d',
						'timestamp' => $data['timestamp']
									);
					
					$CI->db->insert('logs', $data1);
				}
				
				if($data['action'] == 'update')
				{
					
					$data1 = array(
						'username' => $data['username']  ,
						'action' => 'Task <a href="'.base_url().'admin/taskmanagement/edit/'.$query5[0]->id.'">'.$query5[0]->application.'</a> was '.$CI->router->method.'d',
						'timestamp' => $data['timestamp']
									);
					
					$CI->db->insert('logs', $data1);
										
				}
				
				if($data['action'] == 'insert')
				{
					
					$data1 = array(
						'username' => $data['username']  ,
						'action' => 'Task <a href="'.base_url().'admin/taskmanagement/edit/'.$CI->input->post('hidden_id').'">'.$CI->input->post('appsname').'</a> was '.$CI->router->method.'ed',
						'timestamp' => $data['timestamp']
									);
					
					$CI->db->insert('logs', $data1);
										
				}
							 
			}	  
            			
	    }
	    
	}
}

