<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
{
	
    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/m_login','',TRUE);
		$this->load->model('admin/customization_model','',TRUE);
        $this->load->helper('url');
        $this->load->library(array('form_validation','session'));
		//$this->load->model('admin/profile',TRUE);
		       //     $this->load->library("database");
    }
    
    /*function index() 
    {
		if($this->session->userdata('logged_in'))
        {
            //$this->load->model('admin/profile',TRUE);
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['user_type'] = $session_data['user_type'];
            $data['id'] = $session_data['id'];
            $data['title'] = "Profile";
            $data['icon'] = "glyphicon glyphicon-eye-open";
            $data['filename'] = "profile";
            
            $data['thfirst'] = "Firstname";
            $data['thsecond'] = "Lastname";
            $data['ththird'] = "Username";
             $data['colfirst'] = "firstname";
            $data['colsecond'] = "lastname";
            $data['colthird'] = "username";
            $data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename(); 
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();

			$data['font_size'] = $this->customization_model->font_size();
			$data['site_font'] = $this->customization_model->site_font();
            
           // $data['edit'] = "show_admin";
             
           // $data['ide'] = $this->m_login->getProfile();
            $data['tablerow'] = $this->m_login->getprofile();
            
             if($msg == 1)
				{	$data['error'] = 1;	}
             
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/leftsidebar', $data);            
            $this->load->view('admin/profilechange', $data);
            $this->load->view('admin/footer', $data);
        } else {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }
    }*/
	
	function edit($msg=0)    
    {		  
		if($this->input->post())
		{
			$this->m_login->edit_profile();
		    redirect('admin/dashboard', 'refresh');	
		
	    }	
		 if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['id'];
            $data['user_type'] = $session_data['user_type'];
            $sid = $this->uri->segment(4);
			$data['sid'] = $this->uri->segment(4);  
			$data['title'] = "Edit Profile";
            $data['edit_profile'] = $this->m_login->show_profile($data['id']);  
            $data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename(); 
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();

			$data['font_size'] = $this->customization_model->font_size();
			$data['site_font'] = $this->customization_model->site_font();
              
             $data['companyname'] = array(
              'name'        => 'compname',
              'id'          => 'compname',
              'value'       => $data['edit_profile'][0]->companyname,
              'class'       => 'form-control',
              'placeholder' => 'Company Name'
            );
            
            $data['postaladdress'] = array(
              'name'        => 'postaddress',
              'id'          => 'manufact',
              'value'       => $data['edit_profile'][0]->postaladdress,
              'class'       => 'form-control',
              'placeholder' => 'Postal Address',
              'rows'        => '3' 
            );
            
            $data['phone'] = array(
              'name'        => 'phone',
              'id'          => 'phone',
              'value'       => $data['edit_profile'][0]->phone,
              'class'       => 'form-control',
              'placeholder' => 'Phone No.'
            );
            
            $data['industrytype'] = array(
              'name'        => 'indtype',
              'id'          => 'indtype',
              'value'       => $data['edit_profile'][0]->industry,
              'class'       => 'form-control',
              'placeholder' => 'Industry Type',
              
            ); 
            
            if($msg == 2)
				{	$data['error'] = 2;	}
				   
          $this->load->view('admin/header',$data);
          $this->load->view('admin/navbar',$data);
          $this->load->view('admin/leftsidebar',$data);            
          $this->load->view('admin/profilechange',$data);
          $this->load->view('admin/footer',$data);
		}
		else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }
	}
	
	/*Function created by Bhavna Dodiya to update Loged In User profile 14/04/2016 */ 
	public function update($sid)    
    {
		$data['edit_user']=$this->m_login->edit_admin($sid);
		//redirect('admin/usermanagement', 'refresh');
		if($data['edit_user'] == true)
			{
				 redirect('admin/profile/edit/2', 'location');
			}
			else
			{
				redirect('admin/profile/edit/0', 'location');
			}			
	}	
	   
  
}
