<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_login extends CI_Controller {
	 function __construct() 
	{
        parent::__construct();
		$this->load->model('admin/m_login','',TRUE);
		$this->load->model('admin/customization_model','',TRUE);
        //load session and connect to database
			if (!$this->input->post('remember_me')) {
                $this->session->sess_expiration = 7200;
                $this->session->sess_expire_on_close = TRUE;
            }
                        
    }
    	
    function index() 
    {
        $this->load->helper(array('form','html'));       
        $data['title'] = "Admin Login";
        $data['page_title'] = "Admin Login";
        $data['showtitle'] = $this->customization_model->show_title();
		$data['showfavicon'] = $this->customization_model->show_favicon();
		$data['showlogo'] = $this->customization_model->show_logo();
		$data['showsitename'] = $this->customization_model->show_sitename();
		$data['font_size'] = $this->customization_model->font_size();
		$data['site_font'] = $this->customization_model->site_font();
        $this->load->view('admin/header',$data);
        $this->load->view('admin/login_form',$data);
    }
}
/* End of file c_login.php */
/* Location: ./application/controllers/c_login.php */
