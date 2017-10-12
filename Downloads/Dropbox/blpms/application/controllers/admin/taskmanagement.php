<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taskmanagement extends CI_Controller
{
	
    function __construct() 
    {
        parent::__construct();
        $this->load->model('admin/m_login','',TRUE);
		$this->load->model('admin/customization_model','',TRUE);
		$this->load->model('admin/task_model','',TRUE);
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library(array('form_validation','session','pagination'));
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
            $data['title'] = "Task Management";
            $data['icon'] = "glyphicon glyphicon-check";
            $data['filename'] = "taskmanagement";
            $data['addnew'] = "Add New";
            $data['thfirst'] = "Request ID";
            $data['thsecond'] = "Application";
            $data['ththird'] = "Manufacturer";
            $data['thfourth'] = "Version";
            $data['thfifth'] = "Company name";
            $data['thsixth'] = "Request Date";
            if($data['user_type'] != 2)
            {
				$data['thseventh'] = "Engineer";
            }
            $data['theighth'] = "Status";
            
            $data['colfirst'] = "id"; 
            $data['colsecond'] = "application";
            $data['colthird'] = "manufacturer";
            $data['colfourth'] = "version";
            $data['colfifth'] = "install";
            $data['colsixth'] = "timestamp";
            if($data['user_type'] != 2)
            {
				$data['colseventh'] = "username";
			}	
            $data['coleighth'] = "statusname";
           
            $data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();
            $data['showsitename'] = $this->customization_model->show_sitename(); 
            $data['font_size'] = $this->customization_model->font_size();
            $data['statuses'] = $this->task_model->statuses();
			$data['assignee'] = $this->task_model->assignee();
			$data['site_font'] = $this->customization_model->site_font();
			
			$id=$data['id'];
            $user_type=$data['user_type'];
           
			$total_record = $this->customization_model->total_record("tasklist",$data['user_type'],$id);
			//echo $total_record;
			$pagename="taskmanagement";	
           
			$statusarr = array();
						
			foreach($data['statuses'] as $status)
			{
				$statusarr[$status->id] = $status->statusname ;
			}	
			
				
			$data['statuses'] = $statusarr ;
			
			$data['selectedstatus']	= '0';	
			$return = array();
			$return[0] = 'Select Packaging Engineer';							
			foreach($data['assignee'] as $assign)
			{
				$return[$assign->id] = $assign->username ;
			}	
			
				
			$data['assignee'] = $return ;	
			$data['selectedassignee']	= '0';	
			//$data['tablerow'] = $this->task_model->gettask($data['id'],$data['user_type']);
            //$data['tablerow'] = $this->task_model->getstatusdefault($data['id'],$data['user_type']);
            
            $data['all']=$this->custom_pagination($id,$user_type,$total_record,$pagename);
            $data['tablerow'] = $data['all']['tablerow'];
            if($msg == 1)
				{	$data['error'] = 1;	}
			if($msg == 2)
				{	$data['error'] = 2;	}
			if($msg == 3)
				{	$data['error'] = 3;	}
             
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/leftsidebar', $data);            
            $this->load->view('admin/tasklist', $data);
            $this->load->view('admin/footer', $data);
        } 
         else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }
    }
  
    function views($sid)    
    {		  
		$this->load->helper('form');
		
		if($this->input->post())
		{	
				   	
			$config = array();
			$config['file_name'] = $_FILES['uploadimages']['name'];
			$config['upload_path'] = './upload/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '100';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';
			$config['max_filename'] = '100';
			$this->load->library('upload', $config);				

			if ($this->upload->do_upload('uploadimages')) {
				$this->upload->data();                       
			} else {
				 $this->upload->display_errors('<div class="alert alert-error">', '</div>');                
			}
 
		    $this->task_model->worker_addnote($sid);
			$this->task_model->edit_status($sid);
			$this->task_model->edit_name($sid);
			$this->send_mail($sid);
			redirect('admin/taskmanagement', 'refresh');		
	    }
		 if($this->session->userdata('logged_in'))
        {
			$session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['id'];
            $data['user_type'] = $session_data['user_type'];
            $sid = $this->uri->segment(4);
			$data['sid'] = $this->uri->segment(4);  
			$data['title'] = "View Task";			
            $data['edit_task'] = $this->task_model->show_task($sid);  
             $data['editassignee'] = $this->task_model->editassignee($sid);
            $data['site_font'] = $this->customization_model->site_font();
			$data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();			
            $data['showsitename'] = $this->customization_model->show_sitename();
			$data['assignee'] = $this->task_model->assignee();
			 $data['statuses'] = $this->task_model->statuses();
			$data['editstatus'] = $this->task_model->editstatus($sid);
			$data['font_size'] = $this->customization_model->font_size();
         
         if(isset($data['edit_task'][0]->id))
         {
		 $data['applicationname'] = $data['edit_task'][0]->application ;         
         $data['manufacturer'] = $data['edit_task'][0]->manufacturer ;
            
            $data['version'] = $data['edit_task'][0]->version ;
            
            $data['install'] = $data['edit_task'][0]->install ;
            
            
             $data['attach'] = array(           
              'attachment'       => $data['edit_task'][0]->attachments,
            );
            
            /*
            $attached = explode(',',$data['attach']['attachment']);
            print_r($attached);
           
            
        /*    $data['attached'] = explode(',',$data['attach']->attachment); */

            $data['attachment'] = array(
				  'name'        => 'uploadedimages[]',
				  'id'          => 'attachment',
				  'class'       => 'form-control',
				  'type'        => 'file'				    
				);
				
		/*	$file_path = './upload/';
			$files = scandir($file_path);        
             
			$files_array = array();        

			foreach($files as $key=>$file_name) {

				$file_name = trim($file_name);

				if($file_name != '.' || $file_name != '..') {
					if((is_file($file_path.$file_name))) {
						array_push($files_array,$file_name);
					}
				}
			}
			
			$data['files'] = $files_array;	
			
			print_r($attach_array);
			print_r($data['files']); exit; */
				
			
			 $data['aname'] = $data['edit_task'][0]->aname ;
            
             $data['aphone'] = $data['edit_task'][0]->aphone ;
            
             $data['aemail'] = $data['edit_task'][0]->aemail ;
            
             $data['tname'] = $data['edit_task'][0]->tname ;
            
             $data['tphone'] = $data['edit_task'][0]->tphone ;
            
             $data['temail'] = $data['edit_task'][0]->temail ;
            
             $data['bg'] = $data['edit_task'][0]->business	;	  
			
			$data['selected'] = $data['edit_task'][0]->database ;
				
			
			$return = array();
			
			if($data['user_type'] != 2)
			{
			   			
				foreach($data['assignee'] as $assign)
				{
					$return[$assign->id] = $assign->username ;
				}	
				
					
				$data['assignee'] = $return ;
				 
				
				$data['selectedassignee'] =  $data['editassignee'][0]->username ;
			
			}
			
			$statusarr = array();
								
			foreach($data['statuses'] as $status)
			{
				$statusarr[$status->id] = $status->statusname ;
			}	
			
				
			$data['statuses'] = $statusarr ;
			
			
			$data['selectedstatus'] = $data['editstatus'][0]->id ;
			
			$data['statusname'] = $data['editstatus'][0]->statusname;
			
		}
		   
		 $data['notes']= $this->task_model->getnote($sid);
		 $data['getusername'] = $this->task_model->getusername($sid);
			
          
         // print_r($data['selectedassignee']);
          
		  $this->load->view('admin/header',$data);
		  $this->load->view('admin/navbar',$data);
		  $this->load->view('admin/leftsidebar',$data);            
		  $this->load->view('admin/viewtask',$data);
          
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
			$data['title'] = "Delete Task";
			$did = $this->uri->segment(4);
            
   		    $data['Delete_task'] = $this->task_model->taskdelete($did); 
   		       		       		     
			if($data['Delete_task'] == true)
			{
				redirect('admin/taskmanagement/index/3', 'location');
			}
			else
			{
				redirect('admin/taskmanagement/index/0', 'location');
			}
		}
		else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }		 
	}
	/*Function inserted by Gaurav Daxini 21/04/2016 */
	
	function multipledelete(){
		$checklist= $this->input->post('check_list'); 
		$data['delmulti']= $this->task_model->taskmultidelete($checklist);
		
		if($data['delmulti'] == true)
			{
				redirect('admin/taskmanagement/index/3', 'location');
			}
			else
			{
				redirect('admin/taskmanagement/index/0', 'location');
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
			$data['title'] = "Edit Task";			
            $data['edit_task'] = $this->task_model->show_task($sid);  
             $data['editassignee'] = $this->task_model->editassignee($sid);
			$data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();			
            $data['showsitename'] = $this->customization_model->show_sitename();
			$data['assignee'] = $this->task_model->assignee();
			$data['statuses'] = $this->task_model->statuses();
			$data['editstatus'] = $this->task_model->editstatus($sid);
			 $data['site_font'] = $this->customization_model->site_font();
			 $data['font_size'] = $this->customization_model->font_size();
             if(isset($data['edit_task'][0]->id))
			{ 
		//	$data['edittypes'] = $this->m_login->editusertype($sid);  

        //    $types = array();
        //    foreach($data['edittypes'] as $data['edittype'])
        //    {     
		//	  $types[$data['edittype']->user3] = $data['edittype']->user1;					
		//	}
         //   $data['user'] = $types ;
         $data['applicationname'] = array(
              'name'        => 'appsname',
              'id'          => 'appsname',
              'value'       => $data['edit_task'][0]->application,
              'class'       => 'form-control',
              'placeholder' => 'Application Name'
            );
            
            $data['manufacturer'] = array(
              'name'        => 'manufact',
              'id'          => 'manufact',
              'value'       => $data['edit_task'][0]->manufacturer,
              'class'       => 'form-control',
              'placeholder' => 'Manufacturer'
            );
            
            $data['version'] = array(
              'name'        => 'version',
              'id'          => 'version',
              'value'       => $data['edit_task'][0]->version,
              'class'       => 'form-control',
              'placeholder' => 'Version'
            );
            
            $data['install'] = array(
              'name'        => 'install',
              'id'          => 'install',
              'value'       => $data['edit_task'][0]->install,
              'class'       => 'form-control',
              'placeholder' => 'Install Instruction',
              'rows'        => '3'    
            );
            
            
            
             $data['attach'] = array(           
              'attachment'       => $data['edit_task'][0]->attachments,
            );
            
         //   $data['attached'] = explode(',',$data['attach']->attachment);

            $data['attachment'] = array(
				  'name'        => 'uploadedimages[]',
				  'id'          => 'attachment',
				  'class'       => 'form-control',
				  'type'        => 'file'				    
				);
				
				
			
			 $data['aname'] = array(
              'name'        => 'aname',
              'id'          => 'aname',
              'value'       => $data['edit_task'][0]->aname,
              'class'       => 'form-control',
              'placeholder' => 'Name'
            );	
            
             $data['aphone'] = array(
              'name'        => 'aphone',
              'id'          => 'aphone',
              'value'       => $data['edit_task'][0]->aphone,
              'class'       => 'form-control',
              'placeholder' => 'Phone No.'
            );	
            
             $data['aemail'] = array(
              'name'        => 'aemail',
              'id'          => 'aemail',
              'value'       => $data['edit_task'][0]->aemail,
              'class'       => 'form-control',
              'placeholder' => 'Email'
            );	
            
             $data['tname'] = array(
              'name'        => 'tname',
              'id'          => 'tname',
              'value'       => $data['edit_task'][0]->tname,
              'class'       => 'form-control',
              'placeholder' => 'Name'
            );	
            
             $data['tphone'] = array(
              'name'        => 'tphone',
              'id'          => 'tphone',
              'value'       => $data['edit_task'][0]->tphone,
              'class'       => 'form-control',
              'placeholder' => 'Phone No.'
            );	
            
             $data['temail'] = array(
              'name'        => 'temail',
              'id'          => 'temail',
              'value'       => $data['edit_task'][0]->temail,
              'class'       => 'form-control',
              'placeholder' => 'Email'
            );	
            
             $data['bg'] = array(
              'name'        => 'bg',
              'id'          => 'bg',
              'value'       => $data['edit_task'][0]->business,
              'class'       => 'form-control',
              'placeholder' => 'Business Group'
            );	
            
            date_default_timezone_set("Asia/Kolkata");
            
             $data['timestamp'] = array(
              'name'        => 'timestamp',
              'id'          => 'timestamp',
              'value'       =>  date("Y/m/d"),
              'class'       => 'form-control',
              'placeholder' => 'timestamp'
            );	
            
            $data['lastupdate'] =  array(
              'name'        => 'lastupdate',
              'id'          => 'lastupdate',
              'value'       =>  date("h:i:sa"),
              'class'       => 'form-control',
              'placeholder' => 'lastupdate'
            );	
           			
			
			$data['database'] = array(
			  '0' => 'Select Status',
			  'yes'  => 'Yes',
			  'no'    => 'No'			  
			);		  
			
			$data['selected'] = array(
			  $data['edit_task'][0]->database  => $data['edit_task'][0]->database
			);	
			
			$return = array();
			
			
			
			if($data['user_type'] != 2)
			{			
				foreach($data['assignee'] as $assign)
				{
					$return[$assign->id] = $assign->username ;
				}	
				$data['assignee'] = $return ;
				$data['selectedassignee'] =  $data['editassignee'][0]->assignee ;
			  
		   }
          
          $statusarr = array();
								
			foreach($data['statuses'] as $status)
			{
				$statusarr[$status->id] = $status->statusname ;
			}	
			
				
			$data['statuses'] = $statusarr ;
			
			
			$data['selectedstatus'] = $data['editstatus'][0]->id ;
         }
          
		  $this->load->view('admin/header',$data);
		  $this->load->view('admin/navbar',$data);
		  $this->load->view('admin/leftsidebar',$data);            
		  $this->load->view('admin/taskchange',$data);
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
		$this->load->helper('form');
		$data['edit_task'] = $this->task_model->show_task($sid);  
			//print_r($_FILES['uploadedimages']['tmp_name'][0]);
			//exit;
		if($_FILES['uploadedimages']['tmp_name'][0] != '')
		{					// retrieve the number of images uploaded;
			$number_of_files = sizeof($_FILES['uploadedimages']['tmp_name']);
			// considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
			$files = $_FILES['uploadedimages'];
			$errors = array();

			// first make sure that there is no error in uploading the files
			for($i=0;$i<$number_of_files;$i++)
			{
			  if($_FILES['uploadedimages']['error'][$i] != 0) $errors[$i][] = 'Couldn\'t upload file '.$_FILES['uploadedimages']['name'][$i];
			}
			if(sizeof($errors)==0)
			{
			  // now, taking into account that there can be more than one file, for each file we will have to do the upload
			  // we first load the upload library
			  $this->load->library('upload');
			  // next we pass the upload path for the images
			  $config['upload_path'] =  './upload';
			  
		  
			//  echo $config['upload_path'];
			  // also, we make sure we allow only certain type of images
			  $config['allowed_types'] = '*';
			  for ($i = 0; $i < $number_of_files; $i++) {
				$_FILES['uploadedimage']['name'] = $files['name'][$i];
				$_FILES['uploadedimage']['type'] = $files['type'][$i];
				$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
				$_FILES['uploadedimage']['error'] = $files['error'][$i];
				$_FILES['uploadedimage']['size'] = $files['size'][$i];
				//now we initialize the upload library
				$this->upload->initialize($config);
				// we retrieve the number of files that were uploaded
				if ($this->upload->do_upload('uploadedimage'))
				{
				  $data['uploads'][$i] = $this->upload->data();
				  
				 $data['images'][$i] = $data['uploads'][$i]['file_name'];
				 
				}
				else
				{
				  $data['upload_errors'][$i] = $this->upload->display_errors();
				}
			  }
			}
			else
			{
			  print_r($errors);
			}
				$attach = array();
				$attach[] = $data['edit_task'][0]->attachments;
							   
				$result = array_merge($data['images'],$attach);
		
			   
				$data['upload'] = implode(",",$result);
			    $this->send_mail($sid);
				$data['update_task']=$this->task_model->edit_task($sid,$data['upload']);
				if($data['update_task'] == true)
				{
					redirect('admin/taskmanagement/index/2', 'location');
				}
				else
				{
					redirect('admin/taskmanagement/index/0', 'location');
				}	
		}	   
		else
		{
			$attach = array();
			$attach[] = $data['edit_task'][0]->attachments;
			$data['upload'] = implode(",",$attach);
			if($this->input->post())
			{  
				$addnote = $this->task_model->addnote($sid);
			}
			$this->send_mail($sid);
			$data['update_task']=$this->task_model->edit_task($sid,$data['upload']);
			if($data['update_task'] == true)
			{
				redirect('admin/taskmanagement/index/2', 'location');
			}
			else
			{
				redirect('admin/taskmanagement/index/0', 'location');
			}	
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
         //   $data['usertypes'] = $this->m_login->getusertype();
           // print_r($data['usertypes']);
			//$data['adid'] = $this->uri->segment(4);  
			$data['title'] = "Add New Task";
			$data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename();
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();            
            $data['assignee'] = $this->task_model->assignee();
            $data['statuses'] = $this->task_model->statuses();
            $data['font_size'] = $this->customization_model->font_size();
			$data['site_font'] = $this->customization_model->site_font();
            
            $data['applicationname'] = array(
              'name'        => 'appsname',
              'id'          => 'appsname',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Application Name'
            );
            
            $data['manufacturer'] = array(
              'name'        => 'manufact',
              'id'          => 'manufact',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Manufacturer'
            );
            
            $data['version'] = array(
              'name'        => 'version',
              'id'          => 'version',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Version'
            );
            
            $data['install'] = array(
              'name'        => 'install',
              'id'          => 'install',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Install Instruction',
              'rows'        => '3' 
            );
                       

            $data['attachment'] = array(
				  'name'        => 'uploadedimages[]',
				  'id'          => 'attachment',
				  'class'       => 'form-control',
				  'type'        => 'file'				    
				);
				
			 $data['aname'] = array(
              'name'        => 'aname',
              'id'          => 'aname',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Name'
            );	
            
             $data['aphone'] = array(
              'name'        => 'aphone',
              'id'          => 'aphone',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Phone No.'
            );	
            
             $data['aemail'] = array(
              'name'        => 'aemail',
              'id'          => 'aemail',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Email'
            );	
            
             $data['tname'] = array(
              'name'        => 'tname',
              'id'          => 'tname',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Name'
            );	
            
             $data['tphone'] = array(
              'name'        => 'tphone',
              'id'          => 'tphone',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Phone No.'
            );	
            
             $data['temail'] = array(
              'name'        => 'temail',
              'id'          => 'temail',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Email'
            );	
            
             $data['bg'] = array(
              'name'        => 'bg',
              'id'          => 'bg',
              'value'       => '',
              'class'       => 'form-control',
              'placeholder' => 'Business Group'
            );	
            
            date_default_timezone_set("Asia/Kolkata");
            
             $data['timestamp'] = array(
              'name'        => 'timestamp',
              'id'          => 'timestamp',
              'value'       =>  date("Y/m/d"),
              'class'       => 'form-control',
              'placeholder' => 'timestamp'
            );	
            	
            $data['lastupdate'] =  array(
              'name'        => 'lastupdate',
              'id'          => 'lastupdate',
              'value'       =>  date("h:i:sa"),
              'class'       => 'form-control',
              'placeholder' => 'lastupdate'
            );		
			
			$data['database'] = array(
			  '0' => 'select database connectivity',
			  'yes'  => 'Yes',
			  'no'    => 'No'			  
			);	
			
			$data['selected'] = array(
				'0' => 'Select Status'
				);	
				
			$return = array();
								
			foreach($data['assignee'] as $assign)
			{
				$return[$assign->id] = $assign->username ;
			}	
			
				
			$data['assignee'] = $return ;
			
			$data['selectedassignee'] = array(
				'0' => 'Select Worker'
				);	
				
			if($data['user_type'] == 2)
			{
				$statusarr = array();
									
				foreach($data['statuses'] as $status)
				{
					$statusarr[$status->id] = $status->statusname ;
				}
				$data['statuses'] = $statusarr ;
				$data['selectedstatus'] = 2  ;
			}
			else
			{				
				
				$statusarr = array();
									
				foreach($data['statuses'] as $status)
				{
					$statusarr[$status->id] = $status->statusname ;
				}	
				
					
				$data['statuses'] = $statusarr ;
				
				$data['selectedstatus'] = 0 ;
				
			}	
				

        //$types = array();
        //    foreach($data['usertypes'] as $data['usertype'])
        //    {     
		//	 $types[$data['usertype']->id] = $data['usertype']->user_type ;					
		//	}
        //    $data['user'] = $types ;
            
            
          $this->load->view('admin/header',$data);
          $this->load->view('admin/navbar',$data);
          $this->load->view('admin/leftsidebar',$data);                      
          $this->load->view('admin/taskchange',$data); 
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
		//echo $this->input->post('aname') ; exit;
		$this->load->helper('form');
		$session_data = $this->session->userdata('logged_in');
			$data['username'] = $session_data['username'];
			$data['id'] = $session_data['id'];	
			$data['user_type'] = $session_data['user_type'];
				
			if($_FILES['uploadedimages']['tmp_name'][0] != '')
			{	
				//retrieve the number of images uploaded;
				$number_of_files = sizeof($_FILES['uploadedimages']['tmp_name']);
				//considering that do_upload() accepts single files, we will have to do a small hack so that we can upload multiple files. For this we will have to keep the data of uploaded files in a variable, and redo the $_FILE.
				$files = $_FILES['uploadedimages'];
				$errors = array();

				// first make sure that there is no error in uploading the files
				for($i=0;$i<$number_of_files;$i++)
				{
				  if($_FILES['uploadedimages']['error'][$i] != 0) $errors[$i][] = 'Couldn\'t upload file '.$_FILES['uploadedimages']['name'][$i];
				}
				if(sizeof($errors)==0)
				{
				  // now, taking into account that there can be more than one file, for each file we will have to do the upload
				  // we first load the upload library
				  $this->load->library('upload');
				  // next we pass the upload path for the images
				  $config['upload_path'] =  './upload';
				  
				  
				//  echo $config['upload_path'];
				  // also, we make sure we allow only certain type of images
				  $config['allowed_types'] = '*';
				  for($i = 0; $i < $number_of_files; $i++) {
					$_FILES['uploadedimage']['name'] = $files['name'][$i];
					$_FILES['uploadedimage']['type'] = $files['type'][$i];
					$_FILES['uploadedimage']['tmp_name'] = $files['tmp_name'][$i];
					$_FILES['uploadedimage']['error'] = $files['error'][$i];
					$_FILES['uploadedimage']['size'] = $files['size'][$i];
					//now we initialize the upload library
					$this->upload->initialize($config);
					// we retrieve the number of files that were uploaded
					if ($this->upload->do_upload('uploadedimage'))
					{
					  $data['uploads'][$i] = $this->upload->data();				  
					  $data['images'][$i] = $data['uploads'][$i]['file_name'];
					}
					else
					{
					  $data['upload_errors'][$i] = $this->upload->display_errors();
					}
				  }
				}
				else
				{
				  print_r($errors);
				}
		 
				$data['upload'] = implode(",",$data['images']);
				$data['add_task']=$this->task_model->getadd($data['upload'],$data['id'],$data['user_type']);
				if($data['add_task'] == true)
				{
					redirect('admin/taskmanagement/index/1', 'location');
				}
				else
				{
					redirect('admin/taskmanagement/index/0', 'location');
				}	
			}
			else
			{
				$data['add_task']=$this->task_model->getalladd($data['id'],$data['user_type']);
				if($data['add_task'] == true)
				{
					redirect('admin/taskmanagement/index/1', 'location');
				}
				else
				{
					redirect('admin/taskmanagement/index/0', 'location');
				}	
			}
	}
	function deleteattach($did = 0,$dimg = 0)    
    {		  
		if($this->session->userdata('logged_in'))
        { 
			$this->load->helper('file');
			$session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['id'] = $session_data['id'];
			$data['did'] = $this->uri->segment(4);
			$data['dimg'] = $this->uri->segment(5);  
			$data['title'] = "View Admin";
			$did = $this->uri->segment(4);
			$dimg = $this->uri->segment(5);	
			
			
   		    $data['delete_img'] = $this->task_model->Deleteimg($did,$dimg); 
   		       		       		     
			if($data['delete_img'] == true)
			{
				  
				 redirect('admin/taskmanagement/edit/'.$did.'', 'location');
				
			}
			
		}
		else 
        {
        //If no session, redirect to login page
            redirect('admin/c_login', 'refresh');
        }		 
	}
	
	/*Function updated by Bhavna Dodiya 16/04/2016 */ 
	function statusaction()
	{		  
		if($this->session->userdata('logged_in'))
        {
            //$this->load->model('admin/profile',TRUE);
            $session_data = $this->session->userdata('logged_in');
            $data['username'] = $session_data['username'];
            $data['user_type'] = $session_data['user_type'];
            $data['id'] = $session_data['id'];
            $data['title'] = "Task Management";
            $data['icon'] = "glyphicon glyphicon-check";
            $data['filename'] = "taskmanagement";
            $data['addnew'] = "Add Task";
            $data['thfirst'] = "Request ID";
            $data['thsecond'] = "Application";
            $data['ththird'] = "Manufacturer";
            $data['thfourth'] = "Version";
            $data['thfifth'] = "Company name";
            $data['thsixth'] = "Request Date";
             if($data['user_type'] != 2)
            {
            $data['thseventh'] = "Engineer";
			}
            $data['theighth'] = "Status";
            
            $data['colfirst'] = "id"; 
            $data['colsecond'] = "application";
            $data['colthird'] = "manufacturer";
            $data['colfourth'] = "version";
            $data['colfifth'] = "install";
            $data['colsixth'] = "business";
             if($data['user_type'] != 2)
            {
            $data['colseventh'] = "username";
			}
            $data['coleighth'] = "statusname";
            $data['showtitle'] = $this->customization_model->show_title();
			$data['showfavicon'] = $this->customization_model->show_favicon();
			$data['showlogo'] = $this->customization_model->show_logo();
            $data['showsitename'] = $this->customization_model->show_sitename(); 
			$data['showheadercolor'] = $this->customization_model->show_header_bar_color();
            $data['statuses'] = $this->task_model->statuses();
			$data['assignee'] = $this->task_model->assignee();


			$data['font_size'] = $this->customization_model->font_size();
			$data['site_font'] = $this->customization_model->site_font();
           
			$statusarr = array();
								
			foreach($data['statuses'] as $status)
			{
				$statusarr[$status->id] = $status->statusname ;
			}	
			
				
			$data['statuses'] = $statusarr ;
			
			
			$return = array();
			$return[0] = 'Select Packaging Engineer';					
			foreach($data['assignee'] as $assign)
			{
				$return[$assign->id] = $assign->username ;
			}	
			
				
			$data['assignee'] = $return ;
			
			
			$data['selectedstatus'] = $this->input->post('status');
			$data['selectedassignee'] = $this->input->post('assign');
			$id=$data['id'];
			if($this->input->post('status') && $this->input->post('assign'))
			{	
				$total_record = $this->customization_model->total_record("tasklist",$data['user_type'],$id);
				$pagename="taskmanagement";
				$actionname="statusaction";
				$data['all']=$this->custom_pagination($data['id'],$data['user_type'],$total_record,$pagename,$actionname);
				$data['tablerow'] = $data['all']['tablerow'];	
				//$data['tablerow'] = $this->task_model->getcombo($data['id'],$data['user_type']);	
			}
			else if(($this->input->post('status') == '0') && ($this->input->post('assign') == '0'))
			{
				$total_record = $this->customization_model->total_record("tasklist",$data['user_type'],$id);
				$pagename="taskmanagement";
				$actionname="statusaction";
				$data['all']=$this->custom_pagination($data['id'],$data['user_type'],$total_record,$pagename,$actionname);
				$data['tablerow'] = $data['all']['tablerow'];	
				//$data['tablerow'] = $this->task_model->getstatusdefault($data['id'],$data['user_type']);	
			}
			else if($this->input->post('assign'))
			{
				$total_record = $this->customization_model->total_record("tasklist",$data['user_type'],$id);
				$pagename="taskmanagement";
				$actionname="statusaction";
				$data['all']=$this->custom_pagination($data['id'],$data['user_type'],$total_record,$pagename,$actionname);
				$data['tablerow'] = $data['all']['tablerow'];	
				//$data['tablerow'] = $this->task_model->getassignee($data['id']);
			} 
			else
			{
				$total_record = $this->customization_model->total_record("tasklist",$data['user_type'],$id);
				$pagename="taskmanagement";
				$actionname="statusaction";
				$data['all']=$this->custom_pagination($data['id'],$data['user_type'],$total_record,$pagename,$actionname);
				$data['tablerow'] = $data['all']['tablerow'];	
				//$data['tablerow'] = $this->task_model->getstatusval($data['id'],$data['user_type']);
			}  
            $this->load->view('admin/header', $data);
            $this->load->view('admin/navbar', $data);
            $this->load->view('admin/leftsidebar', $data);            
            $this->load->view('admin/tasklist', $data);
            $this->load->view('admin/footer', $data);
        }		
	}
	
	function download_zip() {

        $this->load->library('zip');
        $file_path = './upload/';
        $zip_file_name = $_POST['file_name'];

        $selected_files = $_POST['files'];

        foreach($selected_files as $key=>$file){
            $this->zip->read_file($file_path.$file);
        }

        $this->zip->download($zip_file_name);

    }
    
    function recursive_browse($files,&$files_array)
    {

        $file_path = './upload/';
        
        foreach($files as $key=>$file_name) {

            $file_name = trim($file_name);

            if($file_name != '.' || $file_name != '..') {
                if((is_file($file_path.$file_name))) {
                    array_push($files_array,$file_name);
                }
                else if(is_dir($file_path.$file_name)){
                    $recursive_files = scandir($file_path.$file_name);
                    print_r($file_name);exit;
                    $this->recursive_browse($recursive_files,$files_array);
                }
            }
        }
    }
    
    function send_mail($sid)
    {
		/**********************/
		   $this->load->library('email');
		   $session_data = $this->session->userdata('logged_in');
		   
			    $u_firstname = $this->task_model->user_firstname($session_data['id']);			    				
		        $old_status = $this->task_model->status1($sid);		        
		        $new_status = $this->task_model->get_statusname_from_id($this->input->post('status'));		        		        
		        $add_note = $this->task_model->worker_note($sid);
				$task_name = $this->task_model->task_name($sid);				
				$email_template = $this->task_model->all_email_template();
				foreach($email_template as $email_t)
				{
					$subject = $email_t->subject;
					$body = $email_t->body;
					$usertype = $email_t->user_type;
					$from_mail = $session_data['username'];
					if($usertype == "admin" )
					{
						$to_email = $this->task_model->admin();
					}
					if($usertype == "client" )
					{
						$to_email = $this->task_model->client_email($sid);							
					}
					if($usertype == "worker" )
					{
						$to_email = $this->task_model->worker_email($sid);
					}
					if($usertype == $session_data["user_type"])
					{						
						$to_email = $session_data['username'];
					}					
					if($usertype == "admin" && $from_mail == "admin")
					{						
						$from_mail = $this->task_model->admin();
					}
					if($session_data["user_type"] == 3)
					{
						$body = str_replace("%ADD_NOTE%",$add_note,$body);
					}				
					else
					{
						$body = str_replace("%ADD_NOTE%","",$body);
					}
					$body = str_replace("%USERNAME%",$from_mail,$body);
					$body = str_replace("%OLD_STATUS%",$old_status,$body);
					$body = str_replace("%NEW_STATUS%",$new_status,$body);
					$body = str_replace("%TASK_NAME%",$task_name,$body);					
					
					$this->email->from($from_mail,$u_firstname);
					$this->email->to($to_email);
					$this->email->subject($subject);
					$this->email->message($body);
					$this->email->send();						
					
				}
				
		   /**********************/
	}
	function viewnote($sid)
	{
	   $data['addnote'] = $this->task_model->viewnote($sid);
	   
	   $this->load->view('admin/viewtask',$data);
	   
	}
	/*Function created by Bhavna Dodiya for pagination 16/04/2016 */ 
	public function custom_pagination($id,$user_type,$total_record,$pagename,$actionname=null)
	{
		$data['records_per_page'] = $this->customization_model->record_per_page("variables");
		if(isset($data['records_per_page']['records_per_page']) && $data['records_per_page']['records_per_page']!="")
		{
			$per_page=$data['records_per_page']['records_per_page'];
			$l=$this->uri->segment(5);
			if($l)
				{	$page = $l;	}
			else
				{	$page = 1;	}
			$start= ($page-1)*$per_page;
		}
		else
		{
			$per_page=$total_record;
			$start = 0;
		}
		$config = array();
		if($actionname==null)
		{
			$config["base_url"] = base_url()."admin/".$pagename."/index/page";
		}
		else
		{
			$config["base_url"] = base_url()."admin/".$pagename."/".$actionname."/page";
		}
		$config["total_rows"] = $total_record;
		$config["per_page"] = $per_page;
		$config['use_page_numbers'] = true;
		$config['num_links'] = 3;
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
		if($this->input->post('status') && $this->input->post('assign'))
		{	
			
			$data['tablerow'] = $this->task_model->getcombo($id,$user_type,$per_page,$start);
			$data['pages'] = $this->pagination->create_links();	
		}
		else if(($this->input->post('status') == '0') && ($this->input->post('assign') == '0'))
		{	
			$data['tablerow'] = $this->task_model->getstatusdefault($id,$user_type,$per_page,$start);
			$data['pages'] = $this->pagination->create_links();	
		}
		else if($this->input->post('assign'))
		{
		  $data['tablerow'] = $this->task_model->getassignee($id,$per_page,$start);
		  $data['pages'] = $this->pagination->create_links();
		} 
		else
		{
			$data['tablerow'] = $this->task_model->getstatusval($id,$user_type,$per_page,$start);
			$data['pages'] = $this->pagination->create_links();
		}
		return $data;
	}
    
    
  
}
/* End of file c_home.php */
/* Location: ./application/controllers/c_home.php */
