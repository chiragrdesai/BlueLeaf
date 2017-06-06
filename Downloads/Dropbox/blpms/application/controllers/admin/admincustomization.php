<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admincustomization extends CI_Controller
{
	
    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/customization_model','',TRUE);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library(array('form_validation','session'));
		//$this->load->model('admin/profile',TRUE);
		       //     $this->load->library("database");
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
            $data['title'] = "Admin Customization";
            $data['icon'] = "glyphicon glyphicon-globe";
            $data['filename'] = "admincustomization";
            $data['addnew'] = "Add New";
            $data['thfirst'] = "Variable Name";
            $data['thsecond'] = "Variable value";
           // $data['ththird'] = "Username";
             $data['colfirst'] = "variable_name";
            $data['colsecond'] = "variable_value";
          //  $data['colthird'] = "username";
           // $data['edit'] = "show_admin";
            //$adminid = $data['id']; 
           // $data['ide'] = $this->m_login->getProfile();
            $data['showtitle'] = $this->customization_model->show_title();
            $data['showfavicon'] = $this->customization_model->show_favicon();
            $data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename();
            $data['showheadercolor'] = $this->customization_model->show_header_bar_color();
            $data['font_size'] = $this->customization_model->font_size();
            $data['site_font'] = $this->customization_model->site_font();
            $data['tablerow'] = $this->customization_model->getvariables();
            
            if($msg == 1)
				$data['error'] = 1;
             
             
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/leftsidebar', $data);            
            $this->load->view('admin/list', $data);
            $this->load->view('admin/footer', $data);
        } else {
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
   		    $data['Delete_variables'] = $this->customization_model->Deletevariables($did); 
   		       		       		     
			if($data['Delete_variables'] == true)
			{
				 redirect('admin/admincustomization/index/1', 'location');
			}
			else
			{
				redirect('admin/admincustomization/index/0', 'location');
			}
		}
		else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }		 
	}
	
	function edit($sid)    
    {		  
		if($this->input->post())
		{
			

			$this->customization_model->edit_variables($sid);
			
		    redirect('admin/admincustomization', 'refresh');	
		
	    }	
		 if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['user_type'] = $session_data['user_type'];
            $data['id'] = $session_data['id'];
            $sid = $this->uri->segment(4);
			$data['sid'] = $this->uri->segment(4);  
			$data['title'] = "Edit Admin Customization";
			$data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
			$data['showsitename'] = $this->customization_model->show_sitename();
            $data['edit_variables'] = $this->customization_model->show_variables($sid); 
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();
			$data['font_size_id'] = $this->customization_model->font_size_id();	
			$data['site_font'] = $this->customization_model->site_font();
 			$data['font_size'] = $this->customization_model->font_size();		
			$data['options'] = array(
			  $data['edit_variables'][0]->variable_name  => $data['edit_variables'][0]->variable_name
			);	 									
			                     
          $this->load->view('admin/header',$data);
          $this->load->view('admin/navbar',$data);
          $this->load->view('admin/leftsidebar',$data);            
          $this->load->view('admin/admincustomchange',$data);
          
			$this->load->view('admin/footer',$data);
		}
		else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }
	}
	
	
	
	function add()    
    {	
		if($this->input->post())
		{
			$this->customization_model->addvariables();
		redirect('admin/admincustomization', 'refresh');	
		
	    }	
		if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['id'];
            $data['user_type'] = $session_data['user_type'];
            $data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();
			$data['site_font'] = $this->customization_model->site_font();
 			$data['font_size'] = $this->customization_model->font_size();
            $data['variables'] = $this->customization_model->getvariables();
            $data['showsitename'] = $this->customization_model->show_sitename();
            
			//$data['adid'] = $this->uri->segment(4);  
			$data['title'] = "Add New Admin";
			 								   							   
			$data['options'] = array(
			  '0' => 'select variable',
			  'site_name'  => 'site_name',
			  'site_title'    => 'site_title',
			  'logo'   => 'logo',
			  'favicon' => 'favicon',
			  'header_bar_color' => 'header_bar_color',
			  'hyperlinks' => 'hyperlinks'			  
			);
			foreach($data['variables'] as $variable)
			{
				$already_exist = $variable->variable_name;
				if(($key = array_search($already_exist, $data['options'])) !== false) {
					unset($data['options'][$key]);
				}
			} 	
          $this->load->view('admin/header',$data);
          $this->load->view('admin/navbar',$data);
          $this->load->view('admin/leftsidebar',$data);                      
          $this->load->view('admin/admincustomchange',$data); 
		  $this->load->view('admin/footer',$data);
		}
		else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }
	}
	 
}
/* End of file c_home.php */
/* Location: ./application/controllers/c_home.php */
