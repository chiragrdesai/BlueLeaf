<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  
class Style extends CI_Controller {
 
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
 
    function index()
    {
		$this->load->view('admin/stylecss');
	}   
	
	
}
  
