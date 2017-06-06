<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  
class emailmanagement_model extends CI_Model 
{
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
    
	public function client_view()
	{
		//$query = $this->db->query('select * from email where user_type = "client"');
		$query = $this->db->get_where("email",array('user_type' => 'client'));
		return $query;
	}
	
	public function worker_view()
	{
		//$query = $this->db->query('select * from email where user_type = "worker"');
		$query = $this->db->get_where("email",array('user_type' => 'worker'));
		return $query;

	}
	public function admin_view()
	{
		$query = $this->db->query('select * from email where user_type = "admin"');
		$query = $this->db->get_where("email",array('user_type' => 'admin'));
		return $query;

	}
	public function update1()
	{
		$csubject = $this->input->post("c_subject");
		$cbody = $this->input->post("c_body");
		$asubject = $this->input->post("a_subject");
		$abody = $this->input->post("a_body");
		$wsubject = $this->input->post("w_subject");
		$wbody = $this->input->post("w_body");
		$data = array
		(
           'subject' => $csubject,
           'body' => $cbody
        );

        $this->db->where('user_type', 'client');
        $this->db->update('email', $data);
		
		$data1 = array
		(
           'subject' => $asubject,
           'body' => $abody
        );

        $this->db->where('user_type', 'admin');
        $this->db->update('email', $data1);
        
        $data2 = array
        (
           'subject' => $wsubject,
           'body' => $wbody
        );

        $this->db->where('user_type', 'worker');
        return $this->db->update('email', $data2);
	}
	
	public function getvariables()
	{
		//$query = $this->db->query('select * from variables') or die(mysql_error());
		$query = $this->db->get('variables') or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();
	}

	public function Deletevariables($did)
	{
		//$this->load->library("database");
		//$query = $this->db->query('delete from variables where id = "'.$did.'"') or die(mysql_error());
		$query = $this->db->delete('variables', array('id' => $did)) or die(mysql_error()); 	
		if($query)
			return true;
		else
			return false;
	}
	
	public function edit_variables($sid)
	{	
		//$query = $this->db->query('select * from variables where id = "'.$sid.'"') or die(mysql_error());
		$query = $this->db->get_where("variables",array('id' => $sid)) or die(mysql_error());
		$result = $query->result();				  		   
		if($this->input->post('variable_valueanother') == $result[0]->variable_value )
		{
			$datsa=array
			(
				//'id' => $this->input->post(''),  
				'variable_name'=>$this->input->post('variable_name'),
				'variable_value'=>$this->input->post('variable_value')     
			);
		}
		else
		{
			$datsa=array
			(
				//'id' => $this->input->post(''),  
				'variable_name'=>$this->input->post('variable_name'),
				'variable_value'=>$this->input->post('variable_valueanother')       
			);
		}
		$this->db->where('id', $sid);
		$this->db->update('variables',$datsa);		 
	}
    
	public function addvariables()
	{		
		if($this->input->post('variable_valueanother'))
		{
			$datsa=array
			(
				//'id' => $this->input->post(''),  
				'variable_name'=>$this->input->post('variable_name'),
				'variable_value'=>$this->input->post('variable_valueanother')		       
			);
		}
		else
		{
		  	$datsa=array
		  	(
				//'id' => $this->input->post(''),  
				'variable_name'=>$this->input->post('variable_name'),
				'variable_value'=>$this->input->post('variable_value')		       
			);			
		} 
		$this->db->insert('variables',$datsa) ;		 
	}
	
	public function show_variables($sid)
	{		
		//$query = $this->db->query('select * from variables where id = "'.$sid.'"') or die(mysql_error());
		$query = $this->db->get_where("variables",array('id' => $sid)) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function show_title()
	{		
		//$query = $this->db->query('select variable_value from variables where variable_name = "site_title" ') or die(mysql_error());
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
		//$query = $this->db->query('select variable_value from variables where variable_name = "favicon" ') or die(mysql_error());
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
		//$query = $this->db->query('select variable_value from variables where variable_name = "logo" ') or die(mysql_error());
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
		//$query = $this->db->query('select variable_value from variables where variable_name = "site_name" ') or die(mysql_error());
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
		//$query = $this->db->query('select variable_value from variables where variable_name = "header_bar_color" ') or die(mysql_error());
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
		//$query = $this->db->query('select variable_value from variables where variable_name = "hyperlinks" ') or die(mysql_error());
		$this->db->select('variable_value');
		$query = $this->db->get_where('variables', array('variable_name' => 'hyperlinks')) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	
	
	
	
	
	
	
}
  
