<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admincustomization_new extends CI_Controller
{
    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/customization_model','',TRUE);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library(array('form_validation','session'));
		//$this->load->model('admin/profile',TRUE);
		//$this->load->library("database");
    }
    
    function index($msg=0) 
    {
		if($this->session->userdata('logged_in'))
        {
            if(isset($_POST['update']))
            {
				/*$this->form_validation->set_rules('admin_email','Admin Email','required|valid_email');
				$this->form_validation->set_rules('sender_email_address','Sender Email Address','required|valid_email');
				$this->form_validation->set_rules('smtp_port','SMTP Port','required|numeric');
				$this->form_validation->set_rules('header_bar_color','Header Bar Color','required|regex_match[/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/]');
				$this->form_validation->set_rules('hyperlinks','Hyperlink color','required|regex_match[/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/]');
				
				$this->form_validation->set_rules('hyperlinks',
                                  'Hyperlink color', 
                                   array('required','regex_match[/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/]'));
				//set message for all required field
				$this->form_validation->set_message('required','Select %s!');
				if($this->form_validation->run() == FALSE)
				{
					$msg = 2;
				}
				else
				{*/
					$input_data=array(
					'site_name' => $this->input->post('site_name'),
					'font_size' => $this->input->post('font_size'),
					'site_font' => $this->input->post('site_font'),
					'admin_email' => $this->input->post('admin_email'),
					'hyperlinks' => $this->input->post('hyperlinks'),
					'logo' => $this->input->post('logo'),
					'site_title' => $this->input->post('site_title'),
					'favicon' => $this->input->post('favicon'),
					'header_bar_color' => $this->input->post('header_bar_color'),
					'smtp_server' => $this->input->post('smtp_server'),
					'smtp_port' => $this->input->post('smtp_port'),
					'sender_email_address' => $this->input->post('sender_email_address'),
					'records_per_page' => $this->input->post('records_per_page')
					);
					//print_r($input_data);
					$this->customization_model->update_variables_data($input_data);
					$msg = 1;	
			}

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
			//$data['ththird'] = "Username";
            $data['colfirst'] = "variable_name";
            $data['colsecond'] = "variable_value";
			//$data['colthird'] = "username";
			//$data['edit'] = "show_admin";
            //$adminid = $data['id']; 
			//$data['ide'] = $this->m_login->getProfile();
            $data['showtitle'] = $this->customization_model->show_title();
            $data['showfavicon'] = $this->customization_model->show_favicon();
            $data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename();
            $data['showheadercolor'] = $this->customization_model->show_header_bar_color();
            $data['font_size'] = $this->customization_model->font_size();
            $data['site_font'] = $this->customization_model->site_font();
            $data['tablerow'] = $this->customization_model->getvariables();
            $data['variable_data'] = $this->customization_model->get_variables_data();
            
			if($msg == 1)
			{
				$data['error'] = 1;
			}
			if($msg == 2)
			{
				$data['error'] = 2;
			}
			$this->load->view('admin/header', $data);
			$this->load->view('admin/navbar', $data);
			$this->load->view('admin/leftsidebar', $data);            
			$this->load->view('admin/admin_customization', $data);
			$this->load->view('admin/footer', $data);
        } 
        else 
        {
			//If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }
    } 
}
