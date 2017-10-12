<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  
class Task_model extends CI_Model 
{
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
    
	public function gettask($id,$usertype)
	{
		//$this->load->library("database");
		if($usertype == 1)
		{
			//$query = $this->db->query('select tasklist.* ,admin.username as username,status.statusname as statusname from tasklist,admin,status where (tasklist.assignee = admin.id) and (tasklist.status_id = status.id)') or die(mysql_error());
			$query = $this->db->select('tasklist.*' ,'admin.username as username','status.statusname as statusname');
			$this->db->from($tab);
			$this->db->join('admin','tasklist.assignee = admin.id');
			$this->db->join('status','tasklist.status_id = status.id');
			$this->db->where('tasklist.status_id = status.id');
			$this->db->where('tasklist.assignee = admin.id');
			$this->db->where('tasklist.status_id = "1" || tasklist.status_id = "2"');	
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();
			
		}
		else if($usertype == 2)
		{
		
			$query = $this->db->query('select tasklist.*,status.statusname as statusname from tasklist,status where (tasklist.status_id = status.id) and (tasklist.task_id = "'.$id.'")') or die(mysql_error());
			
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();
	    }
	    else
	    {
			$query = $this->db->query('select tasklist.* ,admin.username as username,status.statusname as statusname from tasklist,admin,status where (tasklist.assignee = admin.id) and (tasklist.status_id = status.id) and (tasklist.assignee = "'.$id.'")') or die(mysql_error());
			
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();
			
		}
	}
	
	public function getstatusdefault($id,$usertype,$per_page,$start)
	{
		if($usertype == 1)
		{
			 $query = $this->db->query('select tasklist.* ,admin.username as username,status.statusname as statusname from tasklist,admin,status where (tasklist.assignee = admin.id) and (tasklist.status_id = status.id) and (tasklist.status_id = "1" || tasklist.status_id = "2" ) ORDER BY timestamp DESC LIMIT '.$start.','.$per_page) or die(mysql_error());
			
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();
		}
		else if($usertype == 2)
		{
			$query = $this->db->query('select tasklist.* ,admin.username as username,status.statusname as statusname from tasklist,admin,status where (tasklist.assignee = admin.id) and (tasklist.status_id = status.id) and (tasklist.task_id = "'.$id.'") and (tasklist.status_id = "1" || tasklist.status_id = "2") ORDER BY timestamp DESC LIMIT '.$start.','.$per_page) or die(mysql_error());
			
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();
	    }
	    else
	    {
			$query = $this->db->query('select tasklist.* ,admin.username as username,status.statusname as statusname from tasklist,admin,status where (tasklist.assignee = admin.id) and (tasklist.status_id = status.id) and (tasklist.assignee = "'.$id.'") and (tasklist.status_id = "1" || tasklist.status_id = "2") ORDER BY timestamp DESC LIMIT '.$start.','.$per_page) or die(mysql_error());
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();
		}		
	}  
	
	/*Function Updated by Bhavna Dodiya 15/04/2016 */ 
	public function getstatusval($id,$usertype,$per_page,$start)
	{
		//$this->load->library("database");
		if($usertype == 1)
		{
			$query = $this->db->query('select tasklist.* ,admin.username as username,status.statusname as statusname from tasklist,admin,status where (tasklist.assignee = admin.id) and (tasklist.status_id = status.id) and (tasklist.status_id = "'.$this->input->post('status').'") ORDER BY timestamp DESC LIMIT '.$start.','.$per_page) or die(mysql_error());
			
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();
			
		}
		else if($usertype == 2)
		{
		
			$query = $this->db->query('select tasklist.* ,admin.username as username,status.statusname as statusname from tasklist,admin,status where (tasklist.assignee = admin.id) and (tasklist.status_id = status.id) and (tasklist.task_id = "'.$id.'") and (tasklist.status_id = "'.$this->input->post('status').'")LIMIT '.$start.','.$per_page) or die(mysql_error());
			
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();
	    }
	    else
	    {
			$query = $this->db->query('select tasklist.* ,admin.username as username,status.statusname as statusname from tasklist,admin,status where (tasklist.assignee = admin.id) and (tasklist.status_id = status.id) and (tasklist.assignee = "'.$id.'") and (tasklist.status_id = "'.$this->input->post('status').'") ORDER BY timestamp DESC LIMIT '.$start.','.$per_page) or die(mysql_error());
			
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();
			
		}
	}
	
	public function getassignee($id,$per_page,$start)
	{
			$query = $this->db->query('select tasklist.* ,admin.username as username,status.statusname as statusname from tasklist,admin,status where (tasklist.assignee = admin.id) and (tasklist.status_id = status.id) and (tasklist.assignee = "'.$this->input->post('assign').'") ORDER BY timestamp DESC LIMIT '.$start.','.$per_page) or die(mysql_error());
			
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();			
	}
	
	public function getcombo($id,$user_type,$per_page,$start)
	{
			$query = $this->db->query('select tasklist.* ,admin.username as username,status.statusname as statusname from tasklist,admin,status where (tasklist.assignee = admin.id) and (tasklist.status_id = status.id) and (tasklist.assignee = "'.$this->input->post('assign').'") and (tasklist.status_id = "'.$this->input->post('status').'")ORDER BY timestamp DESC LIMIT '.$start.','.$per_page) or die(mysql_error());
			
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();			
	}
	
	public function assignee()
	{
			$query = $this->db->query('select username,admin.id as id from admin,user_role where (admin.id = user_role.user_id) and (user_role.user_type="3")') or die(mysql_error());
			
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();			
	}
	
	
	
	public function worker_email($sid)
	{
		
		
		$query = $this->db->query("select assignee from tasklist where id = $sid") or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			$id = $query->result();
		}
		foreach($id as $row)
		{
			$w_id = $row->assignee;
		}
		$query1 = $this->db->query("select username from admin where id = $w_id");
		if($query1->num_rows() > 0)
		{
			$wid = $query1->result();
			return $wid[0]->username;
		}
		
		return array();
		  
	}
	public function get_statusname_from_id($status_id)
	{
		$query = $this->db->query("select * from status where id = $status_id") or die(mysql_error());
		if($query->num_rows() > 0)
		{
			$status_name = $query->result();
			return $status_name[0]->statusname;
		}
		return array();
	
	}
	public function status1($sid)
	{
		$query = $this->db->query("select status_id from tasklist where id = $sid") or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			$status1 =  $query->result();
		
			foreach($status1 as $row)
			{
				$status_id = $row->status_id;
			}
			$query1 = $this->db->query("select statusname from status where id = $status_id");
			if($query1->num_rows() > 0)
			{
				$status = $query1->result();
				return $status[0]->statusname;
			}
		}
		return array();
	}
	public function task_name($sid)
	{
		$query = $this->db->query("select application from tasklist where id = $sid") or die(mysql_error());
			
		if($query->num_rows() > 0)
		{
			$task_name  =  $query->result();
			return $task_name[0]->application;
		}
	}
	public function admin_message()
	{

		  $query = $this->db->query("select subject,body from email where id = 1") or die(mysql_error());
		 
		  if($query->num_rows() > 0)
			{
				 return $query->result();
			}
			return array();
	}
	public function client_message()
	{

		  $query = $this->db->query("select subject,body from email where id = 2") or die(mysql_error());
		 
		  if($query->num_rows() > 0)
			{
				 return $query->result();
			}
			return array();
	}
	public function worker_message()
	{

		  $query = $this->db->query("select subject,body from email where id = 3") or die(mysql_error());
		 
		  if($query->num_rows() > 0)
			{
				 return $query->result();
			}
			return array();
	}
	public function admin()
	{
		$query = $this->db->query("select * from variables where variable_name = 'admin_email'") or die(mysql_error());
		 
		  if($query->num_rows() > 0)
			{
				$admin_email = $query->result();				
				return $admin_email[0]->variable_value;
			}
			return array();
	}
	/*public function admin1()
	{
		$query = $this->db->query("select username from admin ") or die(mysql_error());
		 
		  if($query->num_rows() > 0)
			{
				 return $query->result();
			}
			return array();
	}*/
	
	public function client_email($sid)
	{
		$query = $this->db->query("select task_id from tasklist where id = $sid") or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			$task_id =  $query->result();
		
			foreach($task_id as $row)
			{
				$task_id1 = $row->task_id;
			}
	 
			$query1 = $this->db->query("select username from admin where id = $task_id1");
			if($query1->num_rows() > 0)
			{
				$client_email = $query1->result();
				$client_email[0]->username;
			}
		}
		return array();
		 
	}
	public function statuses()
	{
			$query = $this->db->query('select * from status') or die(mysql_error());
			
			if($query->num_rows() > 0)
			{
				return $query->result();
			}
			return array();			
	}
	public function getadd($uploads,$id,$user_type)
	{	
		
		  $datsa1=array(
		    'id'=>$this->input->post('hidden_id'),
			'task_id'=>$id,
		    'application'=>$this->input->post('appsname'),
		    'manufacturer'=>$this->input->post('manufact'),
		    'version'=>$this->input->post('version'),
		    'install'=>$this->input->post('install'),
		     'attachments'=>$uploads,
		    'aname'=>$this->input->post('aname'),
		    'aphone'=>$this->input->post('aphone'),
		    'aemail'=>$this->input->post('aemail'),
		    'tname'=>$this->input->post('tname'),
		    'tphone'=>$this->input->post('tphone'),
		    'temail'=>$this->input->post('temail'),
		    'business'=>$this->input->post('bg'),
		     'database'=>$this->input->post('database'),
		     'assignee'=> $this->input->post('assign'),
		     'timestamp'=> $this->input->post('timestamp'),
		     'lastupdated' => $this->input->post('lastupdate')
		     ); 
		     if($user_type != 2) {
		    $datsa2=array('status_id'=> $this->input->post('status'));  
		     } 
		     else 
		     { $datsa2=array('status_id'=> '2'); }   
		     
		   $result = array_merge($datsa1,$datsa2);
		  		  
		  return $this->db->insert('tasklist',$result);
		 
		 
	}
	
	public function getalladd($id,$user_type)
	{	
		
		  $datsa1=array(
		    'id'=>$this->input->post('hidden_id'),
			'task_id'=>$id,
		    'application'=>$this->input->post('appsname'),
		    'manufacturer'=>$this->input->post('manufact'),
		    'version'=>$this->input->post('version'),
		    'install'=>$this->input->post('install'),
		    'aname'=>$this->input->post('aname'),
		    'aphone'=>$this->input->post('aphone'),
		    'aemail'=>$this->input->post('aemail'),
		    'tname'=>$this->input->post('tname'),
		    'tphone'=>$this->input->post('tphone'),
		    'temail'=>$this->input->post('temail'),
		    'business'=>$this->input->post('bg'),
		     'database'=>$this->input->post('database'),
		     'assignee'=> $this->input->post('assign'),
		     'timestamp'=> $this->input->post('timestamp'),
		     'lastupdated' => $this->input->post('lastupdate'),
		     'subject'=> $this->input->post('subject'),
		     'body' => $this->input->post('body') 
		   );		  
		    if($user_type != 2) {
		    $datsa2=array('status_id'=> $this->input->post('status'));  
		     } 
		     else 
		     { $datsa2=array('status_id'=> '2'); }  
		     
		     $result = array_merge($datsa1,$datsa2);
		     
		  return $this->db->insert('tasklist',$result) ;
		 
		 
	}
		
	public function taskdelete($did)
	{
		
		$query = $this->db->query('delete from tasklist where id = "'.$did.'"') or die(mysql_error());	
		if($query)
			return true;
		else
			return false;
	}
	/*Function inserted by Gaurav Daxini 21/04/2016 */
	public function taskmultidelete($checklist){
		$checklist=(array) $checklist;
		foreach($checklist as $id)
		{
		$query = $this->db->query('delete from tasklist  where id = "'.$id.'"') or die(mysql_error());	
		
	}
		if($query)
			return true;
		else
			return false;
	}
	
	public function Deleteimg($did,$dimg)
	{
		//echo $did; echo $dimg;
		
		
		$query1 = $this->db->query('select attachments from tasklist where id = "'.$did.'"') or die(mysql_error());	
		
		if ($query1->num_rows() > 0)
		
		{
			$result	= $query1->result();
			$object1 = $result[0]->attachments;        
			$object2 = explode(',',$object1);
			      
			if(($key = array_search($dimg, $object2)) !== false) {
				unset($object2[$key]);
			}
		//	print_r($object2);
			
			$updated_values = implode(',',$object2);
			$query2 = $this->db->query('update tasklist SET attachments = "'.$updated_values.'" WHERE id= "'.$did.'"') or die(mysql_error());
			
			$path_file = base_url('upload/'.$dimg.'');
			
			
			if($query2)
			{
				
				return true;
			}					
			else
			{
				 
				return false;
			}
	  } 
	}

	public function edit_task($sid,$uploads)
	{				  		   
		  
		   $editdata = array(		
		    'application'=>$this->input->post('appsname'),
		    'manufacturer'=>$this->input->post('manufact'),
		    'version'=>$this->input->post('version'),
		    'install'=>$this->input->post('install'),
		     'attachments'=>$uploads,
		    'aname'=>$this->input->post('aname'),
		    'aphone'=>$this->input->post('aphone'),
		    'aemail'=>$this->input->post('aemail'),
		    'tname'=>$this->input->post('tname'),
		    'tphone'=>$this->input->post('tphone'),
		    'temail'=>$this->input->post('temail'),
		    'business'=>$this->input->post('bg'),
		     'database'=>$this->input->post('database'),
		     'assignee'=> $this->input->post('assign'),
		     'status_id'=> $this->input->post('status'),
		     'timestamp'=> $this->input->post('timestamp'),
		     'lastupdated' => $this->input->post('lastupdate')    
		   );
		  
		  $this->db->where('id', $sid);
		  
		  return $this->db->update('tasklist',$editdata);		 
	}
	
	public function edit_status($sid)
	{				  		   
		  
		   $editdata = array(		
		     'status_id'=> $this->input->post('status')    
		   );
		  
		  $this->db->where('id', $sid);
		  
		  $this->db->update('tasklist',$editdata);		 
	}
	
	
	public function show_task($sid)
	{		
		
	   $query = $this->db->query('select * from tasklist where id = "'.$sid.'"') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function editassignee($sid)
	{		
		
	   $query = $this->db->query('select admin.username as username,tasklist.* from admin,tasklist where tasklist.id = "'.$sid.'" and tasklist.assignee = admin.id') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function editstatus($sid)
	{		
		
	   $query = $this->db->query('select status.*,tasklist.*,status.id as id from status,tasklist where tasklist.id = "'.$sid.'" and tasklist.status_id = status.id') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	public function edit_name($sid)
	{		
 
		 
		  $image_data = $this->upload->data();

		  $image_name = $image_data['file_name'];

		  //$name = $this->input->post('addnote');	  		   
		  //$abc = $this->db->query("update tasklist set addnote='".$name."'  WHERE id=$sid;");

		  $data = $this->db->query("UPDATE tasklist SET attachments = CONCAT(attachments,'".$image_name."',',')WHERE id = $sid;");
	
	}
	public function worker_addnote($sid)
	{
		  $name = $this->input->post('addnote');	  		   
		  $workernote = $this->db->query("update tasklist set addnote='".$name."'  WHERE id=$sid;");
	}
	
	
	public function show_title()
	{		
		
	   $query = $this->db->query('select variable_value from variables where variable_name = "site_title" ') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function show_favicon()
	{		
		
	   $query = $this->db->query('select variable_value from variables where variable_name = "favicon" ') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function show_logo()
	{		
		
	   $query = $this->db->query('select variable_value from variables where variable_name = "logo" ') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function show_sitename()
	{		
		
	   $query = $this->db->query('select variable_value from variables where variable_name = "site_name" ') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function all_email_template()
	{

		  $query = $this->db->query("select * from email") or die(mysql_error());
		 
		  if($query->num_rows() > 0)
			{
				 return $query->result();
			}
			return array();
	}
	public function user_firstname($user_id)
	{
		$query1 = $this->db->query("select firstname from admin where id = $user_id");
		if($query1->num_rows() > 0)
		{
			$user_firstname = $query1->result();
			return $user_firstname[0]->firstname;
			
		}
		return array();		 
	}
	public function worker_note($sid)
	{
		$query = $this->db->query("select addnote from tasklist where id = $sid ") or die(mysql_error());
		 
		  if($query->num_rows() > 0)
			{
				$w_note = $query->result();				
				return $w_note[0]->addnote;
			}
			
			return array();
	}
	public function addnote($sid)
	{
		$query = $this->db->query("select task_id from tasklist where id = $sid");
		
		if($query->num_rows() > 0)
		{
			$a_note = $query->result();				
			$user_id = $a_note[0]->task_id;
		}
		
		$addnote = $this->input->post("addnote");
		$timestamp = $this->input->post('timestamp');
		$insertquery = $this->db->query("insert into notes(task_id,note,user_id,timestamp)values($sid,'".$addnote."',$user_id,'".$timestamp."')");

		
	}
	public function getnote($sid)
	{
		
		$query= $this->db->query("select * from notes where task_id = $sid ORDER BY timestamp DESC");
		return  $query; 	
	}
	public function getusername($sid)
	{

		$query = $this->db->query("select * from notes where task_id = $sid") or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			$task_id =  $query->result();
		
			foreach($task_id as $row)
			{
				$task_id1 = $row->user_id;
			}
	 
			$query1 = $this->db->query("select username from admin where id = $task_id1");
			return $query1;
		}
		return array();
		
		
		
	}
	
	
	
	
	
	
}
  
