<?php

class Logout extends CI_Controller {

    function index()
    {
		$this->session->unset_userdata('logged_in');
        //$this->session->sess_destroy();
        redirect(base_url('admin/c_login'), 'refresh');
    }
}


?>
