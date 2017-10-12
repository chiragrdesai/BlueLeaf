<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emailmanagement extends CI_Controller
{
	
    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/m_login','',TRUE);
		$this->load->model('admin/customization_model','',TRUE);
        $this->load->helper('url');
        $this->load->model('admin/emailmanagement_model','',TRUE);
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
            $data['title'] = "Email Management";
            $data['icon'] = "glyphicon glyphicon-user";
            $data['filename'] = "emailmanagement";
           
            
            $data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename(); 
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();
			$data['font_size'] = $this->customization_model->font_size();
			$data['site_font'] = $this->customization_model->site_font();
			$data['client'] = $this->emailmanagement_model->client_view();
			$data['worker'] = $this->emailmanagement_model->worker_view();
			$data['admin'] = $this->emailmanagement_model->admin_view();
			

           // $data['edit'] = "show_admin";
            $adminid = $data['id']; 
           // $data['ide'] = $this->m_login->getProfile();
            //$data['tablerow'] = $this->m_login->getAdmin($adminid);
            $total_record = $this->customization_model->total_record("admin");
            $data['tablerow'] = $this->m_login->getAdmin($adminid,$total_record,0);
            
            if($msg == 1)
				$data['error'] = 1;
             
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/leftsidebar', $data);            
            $this->load->view('admin/emailbody', $data);
            $this->load->view('admin/footer', $data);
        } else {
       
            redirect('admin/c_login', 'refresh');
        }
    }
    function update()
    {
		    $data['client'] = $this->emailmanagement_model->client_view();
			$data['worker'] = $this->emailmanagement_model->worker_view();
			$data['admin'] = $this->emailmanagement_model->admin_view();
			
		   if($this->input->post())
		   {
				$this->emailmanagement_model->update1();
					redirect('admin/emailmanagement/index/1', 'refresh');
		   }
		
		if($this->session->userdata('logged_in'))
        {
            //$this->load->model('admin/profile',TRUE);
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['user_type'] = $session_data['user_type'];
            $data['id'] = $session_data['id'];
            $data['title'] = "Email Management";
            $data['icon'] = "glyphicon glyphicon-user";
            $data['filename'] = "emailmanagement";
           
            
            $data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename(); 
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();
            

           // $data['edit'] = "show_admin";
            $adminid = $data['id']; 
           // $data['ide'] = $this->m_login->getProfile();
            //$data['tablerow'] = $this->m_login->getAdmin($adminid);
            $total_record = $this->customization_model->total_record("admin");
            $data['tablerow'] = $this->m_login->getAdmin($adminid,$total_record,0);
            
             
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/leftsidebar', $data);            
            $this->load->view('admin/emailbody', $data);
            $this->load->view('admin/footer', $data);
        } else {
       
            redirect('admin/c_login', 'refresh');
        }
	}

  
}

