<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  
class M_login extends CI_Model {
 
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
 
    function login($username, $password) 
    {
        //create query to connect user login database
    /*    $this->db->select(admin.id);
        $this->db->select('username,password,user_type');
        $this->db->from('admin');
        $this->db->from('user_role');
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
      //  $this->db->where('user_type', $usertype);
        $this->db->limit(1);
         
        //get query and processing
        $query = $this->db->get();
       */ 
        $query = $this->db->query('select admin.id as admins,username,password,user_type from admin,user_role where username="'.$username.'" and password ="'.MD5($password).'" and user_id = admin.id ') or die(mysql_error());
		//$query = $this->db->select('admin.id as admins','username','password','user_type');
        
        
        if($query->num_rows() == 1) { 
            return $query->result(); //if data is true
        } else {
            return false; //if data is wrong
        }
    }
    
    function getprofile()
	{
		//$this->load->library("database");
		
		$query = $this->db->query('select * from admin where id = 1 ') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();
	}
	
	public function edit_profile()
	{				  
		  
		   
		   if($this->input->post('cpassword') != '')
		   {
			   $editdata = array(
			   'firstname'=>$this->input->post('firstname'),
		       'lastname'=>$this->input->post('lastname'),
		     //  'email'=>$this->input->post('email'),
		       'companyname'=>$this->input->post('compname'),
		     'postaladdress'=>$this->input->post('postaddress'),
		     'phone'=>$this->input->post('phone'),
		     'industry'=>$this->input->post('indtype'),
		    'username' => $this->input->post('username'), 
		       'username' => $this->input->post('username'), 
			   'password' => md5($this->input->post('cpassword'))
			   );
		   }
		   else
		   {
			 $editdata = array(   
		    'firstname'=>$this->input->post('firstname'),
		    'lastname'=>$this->input->post('lastname'),
		  //   'email'=>$this->input->post('email'),
		    'companyname'=>$this->input->post('compname'),
		     'postaladdress'=>$this->input->post('postaddress'),
		     'phone'=>$this->input->post('phone'),
		     'industry'=>$this->input->post('indtype'),
		    'username' => $this->input->post('username'), 
		    'username' => $this->input->post('username') 
		   );
			   
		   }
		  
		  $this->db->where('id', 1);
		  
		  return $this->db->update('admin',$editdata);		 
	}
	
	public function show_profile($id)
	{		
		
	   $query = $this->db->query('select * from admin where id = "'.$id.'" ') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
    
   
	/*Function Updated by Bhavna Dodiya 15/04/2016 */ 
	function getAdmin($adminid,$per_page,$start)
	{
		//$this->load->library("database");
		
		$query = $this->db->query('SELECT user_types.user_type,admin.* FROM admin,user_role,user_types  WHERE (user_role.user_id = admin.id) and (user_role.user_type = user_types.id) and(admin.id != "'.$adminid.'" ) ORDER BY created DESC LIMIT '.$start.','.$per_page) or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();
	}
	
	function getAdminview($aid)
	{
		//$this->load->library("database");
		
		$query = $this->db->query('select * from admin where id = "'.$aid.'"') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();
	}
	
	function getDeleteview($did)
	{
		//$this->load->library("database");
		
		$query = $this->db->query('delete from admin  where id = "'.$did.'"') or die(mysql_error());	
		$query1 = $this->db->query('delete from user_role  where user_id = "'.$did.'"') or die(mysql_error());	
		if($query && $query1)
			return true;
		else
			return false;
	}
	/*Function inserted by Gaurav Daxini 20/04/2016 */
	function getmultiple_delete($checklist)
	{
		$checklist=(array) $checklist;
		foreach($checklist as $id)
		{
		$query = $this->db->query('delete from admin  where id = "'.$id.'"') or die(mysql_error());	
		
	}
	if($query)
			return true;
		else
			return false;
		}
	public function getadd()
	{		
		
		  $datsa=array(
		    'id' => $this->input->post('hidden_id'),  
		    'firstname'=>$this->input->post('firstname'),
		    'lastname'=>$this->input->post('lastname'),
		    'companyname'=>$this->input->post('compname'),
		    'postaladdress'=>$this->input->post('postaddress'),
		    'phone'=>$this->input->post('phone'),
		    'industry'=>$this->input->post('indtype'),
		    'username' => $this->input->post('username'), 
			'password'=>md5($this->input->post('password')),
			'created'=>date("Y-m-d h:i:s")   
		   );
		  
		  //echo $this->input->post('user_type'); exit;
		  
		  $this->db->insert('admin',$datsa) ;
		//  echo $this->db->insert_id();
		  
		// $query3 = $this->db->query('select id from admin where username = "'.$this->input->post('username').'"') or die(mysql_error());
		
		//alert($query3);
		//$ids = mysql_fetch_object($query3);
		
	      $adduser=array(
		    'user_id'=>$this->db->insert_id(),
		    'user_type'=>$this->input->post('user_type')
		   );   
		   		  
		  return $this->db->insert('user_role',$adduser) ;		 
	}
	
	public function edit_admin($sid)
	{				  
		  
		   
		   if($this->input->post('cpassword') != '')
		   {
			   $editdata = array(
			   'firstname'=>$this->input->post('firstname'),
		       'lastname'=>$this->input->post('lastname'),
		       'companyname'=>$this->input->post('compname'),
				'postaladdress'=>$this->input->post('postaddress'),
				'phone'=>$this->input->post('phone'),
				'industry'=>$this->input->post('indtype'),
		       'username' => $this->input->post('username'), 
			   'password' => md5($this->input->post('cpassword')), 
			   );
		   }
		   else
		   {
			 $editdata = array(   
		    'firstname'=>$this->input->post('firstname'),
		    'lastname'=>$this->input->post('lastname'),
		     'companyname'=>$this->input->post('compname'),
		     'postaladdress'=>$this->input->post('postaddress'),
		     'phone'=>$this->input->post('phone'),
		     'industry'=>$this->input->post('indtype'),
			'username' => $this->input->post('username'),    
		   );
			   
		   }
		  
		  $this->db->where('id', $sid);
		  
		 return $this->db->update('admin',$editdata);	
		  
		   $edituser=array(
		    'user_id'=>$sid,
		    'user_type'=>$this->input->post('user_type')
		   );   
		   		  
		   $this->db->where('user_id', $sid);
		  
		  return $this->db->update('user_role',$edituser);	
		  
		  	 
	}
	
	public function show_admin($sid)
	{		
		
	   $query = $this->db->query('select * from admin where id = "'.$sid.'"') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function getusertype()
	{		
	   $query = $this->db->query('select * from user_types') or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function editusertype($sid)
	{		
	   $query = $this->db->query('select user_types.user_type as user1,user_role.user_type as user2,user_types.id as user3,user_types.*,user_role.* from user_types,user_role where user_id = "'.$sid.'"') or die(mysql_error());
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}
	
	public function viewusertype($sid)
	{		
	   $query = $this->db->query('select user_types.user_type as user1,user_role.user_type as user2,user_types.id as user3,user_types.*,user_role.* from user_types,user_role where user_id = "'.$sid.'" and (user_role.user_type = user_types.id) ') or die(mysql_error());
		
		if($query->num_rows() > 0)
		{
			return $query->result();
		}
		return array();	 
	}	
}
  
