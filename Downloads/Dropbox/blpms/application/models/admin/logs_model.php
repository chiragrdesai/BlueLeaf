<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
  
class Logs_model extends CI_Model {
 
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
    }
    
    /* Function Update by BHavna Dodiya 15/04/2016*/
    function getlogs($per_page,$start,$username,$id)
	{
		$this->db->select("*");
		if($username!=null && $id!=null)
		{
			$this->db->where('username = "'.$username.'"');
			$this->db->where('DATE(timestamp) = "'.$id.'"');
		}else if($username!=null)
		{
			$this->db->where('username = "'.$username.'"');
		}else if($id!=null)
		{
			$this->db->where('DATE(timestamp) = "'.$id.'"');
		}		
		else
		{
		}
		$this->db->order_by('timestamp', 'desc');
		$this->db->limit($per_page,$start);
		$this->db->from('logs');
		$query = $this->db->get();
		
		if( $query->result())
		{
			return $query->result();
		}
		return array();
	}
	
	
	
	function getDeleteview($did)
	{
		$query = $this->db->query('delete from logs  where id = "'.$did.'"') or die(mysql_error());	
		if($query)
			return true;
		else
			return false;
	}
	
	/*Function inserted by Gaurav Daxini 27/04/2016 */
	function getmultiDeleteview($checklist)
	{
		$checklist=(array) $checklist;
		foreach($checklist as $id)
		{
			$this->db->where('id', $id);
			$this->db->delete('logs');	
		}
		return true;
	}
	/*Function inserted by Gaurav Daxini 27/04/2016 */
	function get_user()
	{
		$userdata=array();
		$userdata[0]='Select user';
		$this->db->distinct();
		$this->db->select('username'); 
		$this->db->from('admin');  
		$query = $this->db->get(); 
		foreach($query->result() as $row)
		{
			$userdata[]=$row->username;
		}		
		return $userdata;
	}
	
}
