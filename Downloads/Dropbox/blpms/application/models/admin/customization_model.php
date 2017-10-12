<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  
class customization_model extends CI_Model
{
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
    
	function getvariables()
	{
		$query = $this->db->get('variables');
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();
	}
	
	function Deletevariables($did)
	{
		
		$query = $this->db->delete('variables', array('id' => $did)) or die(mysql_error()); 	
		if($query)
			{ return true; }
		else
			{ return false; }
	}
	
	public function edit_variables($sid)
	{	
		
		$query = $this->db->get_where('variables', array('id' => $sid)) or die(mysql_error());
		$result = $query->result();				  		   
		if($this->input->post('variable_valueanother') == $result[0]->variable_value )
		{
			$datsa=array
			(  
				'variable_name'=>$this->input->post('variable_name'),
				'variable_value'=>$this->input->post('variable_value')	       
			);
		   
		}
		else
		{
			$datsa=array
			(  
				'variable_name'=>$this->input->post('variable_name'),
				'variable_value'=>$this->input->post('variable_valueanother')	       
			);
		}
		$this->db->where('id', $sid);
		$this->db->update('variables',$datsa);
		$font_name = $this->input->post("site_font");
		$this->db->set('variable_value', "'".$font_name."'", FALSE);
		$this->db->where('id', $sid);
		$this->db->update('variables');

		$font_size_value = $this->input->post('variable_valueanother1');	       
		$this->db->set('variable_value', "'".$font_size_value."'", FALSE);
		$this->db->where('variable_name', 'font_size');
		$this->db->update('variables');	 
	}
   
	public function addvariables()
	{		
		if($this->input->post('variable_valueanother'))
		{
			$datsa=array
			(  
				'variable_name'=>$this->input->post('variable_name'),
				'variable_value'=>$this->input->post('variable_valueanother')		       
			);
		}
		else
		{
		  	$datsa=array
		  	(  
				'variable_name'=>$this->input->post('variable_name'),
				'variable_value'=>$this->input->post('variable_value')		       
			);			
		} 
		$this->db->insert('variables',$datsa) ;		 
	}
	
	public function show_variables($sid)
	{		
		$query = $this->db->get_where('variables', array('id' => $sid)) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function show_title()
	{		
		$this->db->select('variable_value');
		$query = $this->db->get_where('variables', array('variable_name' => 'site_title')) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function show_favicon()
	{		
		
		$this->db->select('variable_value');
		$query = $this->db->get_where('variables', array('variable_name' => 'favicon')) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function show_logo()
	{		
		$this->db->select('variable_value');
		$query = $this->db->get_where('variables', array('variable_name' => 'logo')) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function show_sitename()
	{		
		$this->db->select('variable_value');
		$query = $this->db->get_where('variables', array('variable_name' => 'site_name')) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function show_header_bar_color()
	{		
		
		$this->db->select('variable_value');
		$query = $this->db->get_where('variables', array('variable_name' => 'header_bar_color')) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function show_hyperlinks()
	{		
		
		$this->db->select('variable_value');
		$query = $this->db->get_where('variables', array('variable_name' => 'hyperlinks')) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function font_size()
	{
		$this->db->select('variable_value');
		$query = $this->db->get_where('variables', array('variable_name' => 'font_size')) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	
	}
	
	public function font_size_id()
	{
		
		$this->db->select('id');
		$query = $this->db->get_where('variables', array('variable_name' => 'font_size')) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	
	}
	
	public function site_font()
	{
		
		$this->db->select('variable_value');
		$query = $this->db->get_where('variables', array('variable_name' => 'site_font')) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	
	}
	
	/*Function created by Bhavna Dodiya to fetch all the records of Variables table 13/04/2016 */ 
	public function get_variables_data() 
	{
		$result=array();
		$r = $this->db->get('variables')->result();
		foreach($r as $value)
		{
			$result[$value->variable_name]= $value->variable_value;
		}
		return $result;
	}
	
	/*Function created by Bhavna Dodiya to update records of Variables table 13/04/2016 */ 
	public function update_variables_data($data) 
	{
		foreach($data as $key => $value)
		{
			$this->db->set('variable_value', "'".$value."'", FALSE);
			$this->db->where('variable_name', $key);
			$this->db->update('variables');
		}
	}
	
	/*Function created by Bhavna Dodiya to count records in admin table 15/04/2016 */ 
	public function total_record($tab,$user_type = null,$id = null) 
	{
		if($user_type == null)
		{
			return $this->db->count_all($tab);
		}
		else
		{	
			$this->db->select("tasklist.*");
			$this->db->where('tasklist.status_id = status.id');
			$this->db->where('tasklist.assignee = admin.id');
			if($this->input->post('assign') AND $this->input->post('status'))
			{
				$this->db->where('tasklist.status_id = '.$this->input->post("status"));	
				$this->db->where('tasklist.assignee = '.$this->input->post("assign"));	
			}	
			else if($this->input->post('status'))
			{
				$this->db->where('tasklist.status_id = '.$this->input->post("status"));	
			}
			else if($this->input->post('assign'))
			{
				$this->db->where('tasklist.assignee = '.$this->input->post("assign"));
			}
			else
			{
				$this->db->where('tasklist.status_id = "1" || tasklist.status_id = "2"');
			}
			if($user_type == 2)
			{	
				$this->db->where('tasklist.task_id = "'.$id.'"');	
			}
			if($user_type !=1 AND $user_type !=2)
			{
				$this->db->where('tasklist.assignee = "'.$id.'"');
			}
			$this->db->from($tab);
			$this->db->join('admin','tasklist.assignee = admin.id');
			$this->db->join('status','tasklist.status_id = status.id');
			return $this->db->count_all_results();
		}
	}
	
	

	/*Function created by Bhavna Dodiya to get record per page from variable table 15/04/2016 */ 
	public function record_per_page($tab) 
	{
		$result=array();
		$r = $this->db->get('variables')->result();
		foreach($r as $value)
		{
			if($value->variable_name == 'records_per_page')
			{
				$result['records_per_page']= $value->variable_value;
			}
		}
		return $result;
	}

	/*Function created by Gaurav Daxini to get user record  per page from variable table 21/04/2016 */ 
	public function total_userrecord($tab,$username,$selectdate) 
	{
		$this->db->select("*");
		
		if($username!=null && $selectdate!=null)
		{
			
			$this->db->where('username = "'.$username.'"');
			$this->db->where('DATE(timestamp) = "'.$selectdate.'"');	
			
		}else
		if($username!=null)
		{
			$this->db->where('username = "'.$username.'"');
			
		}else
		if($selectdate!=null)
		{
			$this->db->where('DATE(timestamp) = "'.$selectdate.'"');
		}else
		{
			
		}
		$this->db->from('logs');
		return $this->db->count_all_results();
			
	}
}
