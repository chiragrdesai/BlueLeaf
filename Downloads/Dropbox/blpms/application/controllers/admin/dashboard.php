<?php /*if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
    function __construct() {
        parent::__construct();
		$this->load->model('admin/customization_model','',TRUE);
        $this->load->helper('url');
    }
 
    function index() {
        if($this->session->userdata('logged_in'))
        {
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['id'];
            $data['user_type'] = $session_data['user_type'];
            $data['title'] = "Dashboard";
			$data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename(); 
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/leftsidebar', $data);            
            $this->load->view('admin/dashboard', $data);
            $this->load->view('admin/footer', $data);
        } else {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }
    }
 
 
}
/* End of file c_home.php */
/* Location: ./application/controllers/c_home.php */
