<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller_Public extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
						
		#Get URI String (Menu URL)
		$this->getUriString();
		$this->data['uriString'] = $this->uri_string;
		
		$this->data['in'] = false;
		if(isset($this->profile) && !empty($this->profile['id']))
			$this->data['in'] = true;
	}	
	
    #Handle Session Login Checking
    /*
     * login = true, means it is loggedIn and redirect into LoggedIn Page
     */ 
    protected function isLoggedIn($status = true){
		#Getting Data Session Profile
		$_sessProfile = $this->session->userdata('profile');
				
		#Make Session Profile Shared into Controller
		$this->profile = $_sessProfile;
		
		if($status)
		{
			if (isset($_sessProfile) && !empty($_sessProfile))
			{
				#Make Session Profile Shared into View
				$this->data['profile'] = $_sessProfile;
			} else {
				#If request is Ajax 
				if ($this->input->is_ajax_request())
				{
					echo json_encode(array('success'=>'out','url'=>$this->data['base_url_index'].'login'));
					exit();
				} else {
					redirect($this->data['base_url_index'], 'location', 301);
				}
			}
		}
		return true;	
	}
}
