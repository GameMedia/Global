<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	protected $data;
	protected $profile;
	protected $tableCms;
	protected $dbCms = NULL;
	
	
	function __construct()
	{
		parent::__construct();
		
		$_sessProfile = $this->session->userdata('profile');
		$this->profile = $_sessProfile;
		$this->tableCms = array(
								'cms_action_history',
								'cms_email');
    }
    
    #CMS
    protected function loadDbCms(){
		$this->dbCms = $this->load->database('cms', TRUE);
		return true;
	}
	
	protected function createTable($conn, $baseTable, $newTable){
		$conn->query('CREATE TABLE IF NOT EXISTS '.$newTable.' LIKE '.$baseTable);
	}	
	

}
