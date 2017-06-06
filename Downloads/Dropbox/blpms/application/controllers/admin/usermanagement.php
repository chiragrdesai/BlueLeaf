<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usermanagement extends CI_Controller
{
	
    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/m_login','',TRUE);
		$this->load->model('admin/customization_model','',TRUE);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library(array('form_validation','session'));
        $this->load->library('pagination');
		//$this->load->model('admin/profile',TRUE);
		//$this->load->library("database");
    }
    
    function index($msg=0) 
    {
		if($this->session->userdata('logged_in'))
        {
            //$this->load->model('admin/profile',TRUE);
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['user_type'] = $session_data['user_type'];
            $data['id'] = $session_data['id'];
            $data['title'] = "User Management";
            $data['icon'] = "glyphicon glyphicon-user";
            $data['filename'] = "usermanagement";
            $data['addnew'] = "Add New";
            $data['thfirst'] = "Username";
            $data['thsecond'] = "Firstname";
            $data['ththird'] = "Lastname";
            $data['thfourth'] = "User Type";
            $data['thfifth'] = "Action";
            $data['colfirst'] = "username";
            $data['colsecond'] = "firstname";
            $data['colthird'] = "lastname";
            $data['colfourth'] = "user_type";
            $data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename(); 
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();
			$data['font_size'] = $this->customization_model->font_size();
			$data['site_font'] = $this->customization_model->site_font();
			
			$total_record = $this->customization_model->total_record("admin");
			$pagename="usermanagement";	
			
			//$data['edit'] = "show_admin";
            $adminid = $data['id']; 
			//$data['ide'] = $this->m_login->getProfile();
            //$data['tablerow'] = $this->m_login->getAdmin($adminid);
            
            if($msg == 1)
				{	$data['error'] = 1;	}
			if($msg == 2)
				{	$data['error'] = 2;	}
			if($msg == 3)
				{	$data['error'] = 3;	}
            
			$data['all']=$this->custom_pagination($adminid,$total_record,$pagename);
			
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/leftsidebar', $data);            
            $this->load->view('admin/userlist', $data);
            $this->load->view('admin/footer', $data);
        } 
        else 
        {
			//If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }
    }
  
    function views($aid)    
    {		  
		 if($this->session->userdata('logged_in'))
        { 
			$session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['id'];
            $data['user_type'] = $session_data['user_type'];
            $sid = $this->uri->segment(4);
			$data['sid'] = $this->uri->segment(4);  
			$data['title'] = "View Admin";			
            $data['edit_admin'] = $this->m_login->show_admin($sid);  
			$data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename(); 
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();
			$data['font_size'] = $this->customization_model->font_size();
			$data['site_font'] = $this->customization_model->site_font();
			
			$data['edittypes'] = $this->m_login->viewusertype($sid);  

            $types = array();
            foreach($data['edittypes'] as $data['edittype'])
            {     
			  $types[$data['edittype']->user3] = $data['edittype']->user1;					
			}
            $data['user'] = $types ;
            
            $data['companyname'] = $data['edit_admin'][0]->companyname ;
            
            $data['postaladdress'] = $data['edit_admin'][0]->postaladdress ;
             
            $data['phone'] = $data['edit_admin'][0]->phone ;
            
            $data['industrytype'] = $data['edit_admin'][0]->industry ;
             
          
		  $this->load->view('admin/header',$data);
		  $this->load->view('admin/navbar',$data);
		  $this->load->view('admin/leftsidebar',$data);            
		  $this->load->view('admin/viewuser',$data);
          
			$this->load->view('admin/footer',$data);
		}
		else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }		 
	}
	
	function delete($did)    
    {		  
		if($this->session->userdata('logged_in'))
        { 
			$session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['id'];
			$data['did'] = $this->uri->segment(4);  
			$data['title'] = "View Admin";
			$did = $this->uri->segment(4);			
   		    $data['Delete_admin'] = $this->m_login->getDeleteview($did); 
   		       		       		     
			if($data['Delete_admin'] == true)
			{
				 redirect('admin/usermanagement/index/3', 'location');
			}
			else
			{
				redirect('admin/usermanagement/index/0', 'location');
			}
		}
		else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }		 
	}
	/*Function inserted by Gaurav Daxini 20/04/2016 */
	function multipledelete(){
		$checklist= $this->input->post('check_list'); 
		$data['delmulti']=$this->m_login->getmultiple_delete($checklist);
		
		if($data['delmulti'] == true)
			{
				 redirect('admin/usermanagement/index/3', 'location');
			}
			else
			{
				redirect('admin/usermanagement/index/0', 'location');
			}
	}
	function edit($sid)    
    {		  
			
		 if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['id'];
            $data['user_type'] = $session_data['user_type'];
            $sid = $this->uri->segment(4);
			$data['sid'] = $this->uri->segment(4);  
			$data['title'] = "Edit Admin";			
            $data['edit_admin'] = $this->m_login->show_admin($sid);  
			$data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename(); 
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();

			$data['font_size'] = $this->customization_model->font_size();
			$data['site_font'] = $this->customization_model->site_font();
			
			$data['edittypes'] = $this->m_login->editusertype($sid);  
			
            $types = array();
            foreach($data['edittypes'] as $data['edittype'])
            {     
			  $types[$data['edittype']->user3] = $data['edittype']->user1;					
			}
            $data['user'] = $types ;
            
            $data['companyname'] = array(
              'name'        => 'compname',
              'id'          => 'compname',
              'value'       => $data['edit_admin'][0]->companyname,
              'class'       => 'form-control',
              'placeholder' => 'Company Name'
            );
            
            $data['postaladdress'] = array(
              'name'        => 'postaddress',
              'id'          => 'manufact',
              'value'       => $data['edit_admin'][0]->postaladdress,
              'class'       => 'form-control',
              'placeholder' => 'Postal Address',
              'rows'        => '3' 
            );
            
            $data['phone'] = array(
              'name'        => 'phone',
              'id'          => 'phone',
              'value'       => $data['edit_admin'][0]->phone,
              'class'       => 'form-control',
              'placeholder' => 'Phone No.'
            );
            
            $data['industrytype'] = array(
              'name'        => 'indtype',
              'id'          => 'indtype',
              'value'       => $data['edit_admin'][0]->industry,
              'class'       => 'form-control',
              'placeholder' => 'Industry Type',
              
            );
            
          
		  $this->load->view('admin/header',$data);
		  $this->load->view('admin/navbar',$data);
		  $this->load->view('admin/leftsidebar',$data);            
		  $this->load->view('admin/adminchange',$data);
          $this->load->view('admin/footer',$data);
		}
		else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }
	}
	
	function update($sid)    
    {
		$data['edit_user']=$this->m_login->edit_admin($sid);
		//redirect('admin/usermanagement', 'refresh');
		if($data['edit_user'] == true)
			{
				 redirect('admin/usermanagement/index/2', 'location');
			}
			else
			{
				redirect('admin/usermanagement/index/0', 'location');
			}			
	}	
	
	function add()    
    {	
		
		if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['id'];
            $data['user_type'] = $session_data['user_type'];
            $data['usertypes'] = $this->m_login->getusertype();
            //print_r($data['user_type']);
            //print_r($data['usertypes']);
           // exit;
			//$data['adid'] = $this->uri->segment(4);  
			$data['title'] = "Add New User";
			$data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();

			$data['font_size'] = $this->customization_model->font_size();
			$data['site_font'] = $this->customization_model->site_font();
						
            $data['showsitename'] = $this->customization_model->show_sitename();
            $types = array();
            $types[0] = 'Select Usertype';
            foreach($data['usertypes'] as $data['usertype'])
            {     
			 $types[$data['usertype']->id] = $data['usertype']->user_type ;					
			}
            $data['user'] = $types ;
           
            $data['companyname'] = array(
              'name'        => 'compname',
              'id'          => 'compname',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Company Name',
              'readonly'  => 'true'
            );
            
            $data['postaladdress'] = array(
              'name'        => 'postaddress',
              'id'          => 'manufact',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Postal Address',
              'rows'        => '3',
              'readonly'  => 'true' 
            );
            
            $data['phone'] = array(
              'name'        => 'phone',
              'id'          => 'phone',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Phone No.',
              'readonly'  => 'true'
            );
            
            $data['industrytype'] = array(
              'name'        => 'indtype',
              'id'          => 'indtype',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Industry Type',
              'readonly'  => 'true'
            );
            
          $this->load->view('admin/header',$data);
          $this->load->view('admin/navbar',$data);
          $this->load->view('admin/leftsidebar',$data);                      
          $this->load->view('admin/adminchange',$data); 
		  $this->load->view('admin/footer',$data);
		}
		else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }
	}
	
	function insert()
	{
		$data['add_user']=$this->m_login->getadd();
		//$data['adduser'] = $this->m_login->addusertype();
		//redirect('admin/usermanagement', 'refresh');
		if($data['add_user'] == true)
			{
				 redirect('admin/usermanagement/index/1', 'location');
			}
			else
			{
				redirect('admin/usermanagement/index/0', 'location');
			}	
		
	}
	
	
	function checkadduser()
	{
		$query1 = $this->db->query('select * from admin where username = "'.$this->input->post('username').'" ') or die(mysql_error());		
		//echo 'select * from admin where username = "'.$this->input->post('username').'" ';
		if($query1->num_rows() == 0)
		{			
			echo '0';	
		}
		else		    
		{
			echo '1';
		}	    		
	}
	
	function checkedituser()
	{
		//echo 'select * from admin where username = "'.$this->input->post('username').'" AND id != "'.$this->input->post('id').'" ';
		$query1 = $this->db->query('select * from admin where username = "'.$this->input->post('username').'" AND id != "'.$this->input->post('id').'" ') or die(mysql_error());
		
		//echo 'Coint:'.$query1->num_rows();	exit;
		if($query1->num_rows() == 0)
		    {			
				echo '0';	
		    }
		    else		    
		    {
				echo '1';
			}
		    
		
	}
	
	function getaddval()
	{
		 	
	   //	$data['address'] = substr($this->input->post('address'), strpos($this->input->post('address'), "@") + 1);
				
		$query1 = $this->db->query('select * from admin where username LIKE "%'.$this->uri->segment(4).'%" ') or die(mysql_error());
		
		$result1 = $query1->result();
		
			foreach ($result1 as $result)
			{
				
			}			
		if(count($result) == 1)
		{	
			//return $result->username ;
			print_r(json_encode($result));
			exit;
		}	
	/*	if($query1->num_rows() == 0)
		{			
			echo '0';	
		}
		else		    
		{
			echo '1';
		}
	
	*/	    
	
	}
	
	/*Function created by Bhavna Dodiya for pagination 16/04/2016 */ 
	public function custom_pagination($adminid,$total_record,$pagename)
	{
		$data['records_per_page'] = $this->customization_model->record_per_page("variables");
		if(isset($data['records_per_page']['records_per_page']) && $data['records_per_page']['records_per_page']!="")
		{
			$per_page=$data['records_per_page']['records_per_page'];
		}
		else
		{
			$per_page=$total_record;
		}	
		$config = array();
		$config["base_url"] = base_url()."admin/".$pagename."/index/page";
		$config["total_rows"] = $total_record;
		$config["per_page"] = $per_page;
		$config['use_page_numbers'] = true;
		$config['num_links'] = 2;
		$config['uri_segment'] = '5';
		$config['first_link'] = "";
		$config['last_link'] = "";
		$config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] = '</ul>';
		$config['cur_tag_open'] = "<li class=\"active\"><a>";
		$config['cur_tag_close'] = "</a></li>";
		$config['num_tag_open'] = "<li>";
		$config['num_tag_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_close'] = "</li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tag_close'] = "</li>";
 		$config['prev_link'] = 'Previous';	
		$config['next_link'] = 'Next';
		$this->pagination->initialize($config);
		$l=$this->uri->segment(5);
		if($l)
			{	$page = $l;	}
		else
			{	$page = 1;	}
		$start= ($page-1)*$per_page;
		$data['tablerow'] = $this->m_login->getAdmin($adminid,$per_page,$start);
		$data['pages'] = $this->pagination->create_links();
		return $data;
	}
}
/* End of file c_home.php */
/* Location: ./application/controllers/c_home.php */
