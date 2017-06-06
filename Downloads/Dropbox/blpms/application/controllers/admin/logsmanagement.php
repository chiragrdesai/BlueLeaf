<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logsmanagement extends CI_Controller
{
	
    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/m_login','',TRUE);
		$this->load->model('admin/customization_model','',TRUE);
		$this->load->model('admin/logs_model','',TRUE);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library(array('form_validation','session','pagination'));
    }
    
    function index($msg=0) 
    {
		if($this->session->userdata('logged_in'))
        {
			if(!$this->input->post('username') && $this->uri->segment(4) != "page")
			{
				$this->session->unset_userdata('sel_username');		
			}
			if(!$this->input->post('selectdate') && $this->uri->segment(4) != "page")
			{
				$this->session->unset_userdata('sel_date');	
			}
			
		
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['user_type'] = $session_data['user_type'];
            $data['id'] = $session_data['id'];
            $data['title'] = "Logs Management";
            $data['icon'] = "glyphicon glyphicon-user";
            $data['filename'] = "logsmanagement";
            $data['addnew'] = "Add New Logs";
            $data['thfirst'] = "Action";
            $data['thsecond'] = "User";
            $data['ththird'] = "Timestamp";
            $data['selecteduser']="";
            $data['selecteddate']="";
            $data['colfirst'] = "action";
            $data['colsecond'] = "username";
            $data['colthird'] = "timestamp";
            
            $data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename(); 
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();
			$data['font_size'] = $this->customization_model->font_size();
			$data['site_font'] = $this->customization_model->site_font();
			
			$pagename="logsmanagement";	
			
			$data['check_user']=$this->logs_model->get_user();
				
			$userarr = array();
								
			foreach($data['check_user'] as $username)
			{
				$userarr[] = $username;
			}			
			$data['check_user'] = $userarr ;
			$return = array();

			if($this->input->post('username') != '0')
			{
				$this->session->set_userdata('sel_username', $this->input->post('username'));
				$id = $this->session->userdata('sel_username');
			}
			else
			{
				$id = $this->session->userdata('sel_username');				
			}
			
			if($this->input->post('selectdate') != '')
			{
				$this->session->set_userdata('sel_date', $this->input->post('selectdate'));
				$udate = $this->session->userdata('sel_date');
			}
			else
			{
				$udate = $this->session->userdata('sel_date');
			}
			$check_user=$this->logs_model->get_user();
			$username=$check_user[$id];
			
			$pagename="logsmanagement";	
			
			$data['dateid']=$udate;
			$date1=new DateTime($udate);	
			$id=$date1->format('Y/m/d');
			
			
			if(($this->input->post('username') != '0'|| $this->session->userdata('sel_username') != '0')&& (($this->input->post('selectdate') != "") || $this->session->userdata('sel_date') != ""))
			{
				$data['selecteddate'] = $udate;	
				$total_record = $this->customization_model->total_userrecord("logs",$username,$id);

			}else if($this->session->userdata('sel_username')!='0' || $this->input->post('username') !='0') 
			{			
				$total_record = $this->customization_model->total_userrecord("logs",$username,null);		
			
			}else if($this->input->post('selectdate') != '' || $this->session->userdata('sel_date')!='')
			{
				
				$data['selecteddate'] = $udate;
				$total_record = $this->customization_model->total_userrecord("logs",null,$id);
			}
			else
			{
				$total_record = $this->customization_model->total_userrecord("logs",null,null);
				
			}
            $adminid = $data['id']; 
           
            if($msg == 1)
				$data['error'] = 1;
          
			$data['all']=$this->custom_pagination($total_record,$pagename);
			$data['tablerow'] = $data['all']['tablerow'];

            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/leftsidebar', $data);            
            $this->load->view('admin/logslist', $data);
            $this->load->view('admin/footer', $data);
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
   		    $data['Delete_admin'] = $this->logs_model->getDeleteview($did); 
   		       		       		     
			if($data['Delete_admin'] == true)
			{
				 redirect('admin/logsmanagement/index/1', 'location');
			}
			else
			{
				redirect('admin/logsmanagement/index/0', 'location');
			}
		}
		else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }		 
	}
	
    /*Function created by Bhavna Dodiya for pagination 16/04/2016 */ 
	public function custom_pagination($total_record,$pagename)
	{
		$data['records_per_page'] = $this->customization_model->record_per_page("variables");
		if(isset($data['records_per_page']['records_per_page']) && $data['records_per_page']['records_per_page']!="")
		{
			$per_page=$data['records_per_page']['records_per_page'];
		}
		else
		{
			$per_page = $total_record;
		}
		$config = array();		
		$config["base_url"] = base_url()."admin/".$pagename."/index/page";
		$config["total_rows"] = $total_record;
		$config["per_page"] = $per_page;
		$config['use_page_numbers'] = true;
		$config['num_links'] = 6;
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
		$start = ($page-1)*$per_page;
		$id=$this->session->userdata('sel_username');
		$check_user=$this->logs_model->get_user();
		$username=$check_user[$id];
		if($this->session->userdata('sel_date') != "" )
			{
				
				$date1=new DateTime($this->session->userdata('sel_date'));	
				$id1=$date1->format('Y/m/d');
				//echo $id1;
			}
			
		if(($this->input->post('username') != '0' || $this->session->userdata('sel_username') != '0')&& (($this->input->post('selectdate') != "") || $this->session->userdata('sel_date') != ""))
		{
			$data['tablerow'] = $this->logs_model->getlogs($per_page,$start,$username,$id1);
		}else if($this->session->userdata('sel_username')!='0' || $this->input->post('username') != '0' )
		{
			
			$data['tablerow'] = $this->logs_model->getlogs($per_page,$start,$username,null);			
		}else if($this->input->post('selectdate') != '' || $this->session->userdata('sel_date')!=''){
			
			
			$data['tablerow']=$this->logs_model->getlogs($per_page,$start,null,$id1);
		}else
		{	
		
			$data['tablerow'] = $this->logs_model->getlogs($per_page,$start,null,null);
		}
		$data['pages'] = $this->pagination->create_links();
		return $data;
	}
    
  /*Function inserted by Gaurav Daxini 21/04/2016 */
	function multipledelete(){
		$checklist= $this->input->post('check_list'); 
		$data['delmulti']=$this->logs_model->getmultiDeleteview($checklist);
		
		if($data['delmulti'] == true)
			{
				 redirect('admin/logsmanagement/index/1', 'location');
			}
			else
			{
				redirect('admin/logsmanagement/index/0', 'location');
			}
		}
	
	}
	/* End of file c_home.php */
	/* Location: ./application/controllers/c_home.php */
