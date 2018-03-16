<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class backend extends MY_Controller_Public {

	public function __construct() {
		parent::__construct();
	
	}
	 /*-------------------------------------------------------------------------------------------------*/
	public function index()
	{	
		redirect($this->data['base_url_index'].'backend/login', 'location', 301);
	}
	 /*-------------------------------------------------------------------------------------------------*/

	public function login()
	{		
		#Checking is user logged in
		$this->isLoggedIn(false);
		$this->data['pageTitle'] = 'Login';
		$this->load->view("backend/metronic/view_login", $this->data);
	}
	 /*-------------------------------------------------------------------------------------------------*/

	public function auth()
	{
		#cek ajax request
		if(!$this->input->is_ajax_request())
		{
			return $this->redirect();
		}

		#post request
		$_username = $this->input->post('username');
		$_password = $this->input->post('password');
		/* Captcha aktif di live
		$_captcha  = $this->input->post('g-recaptcha-response');
		$response = array();  #cek captcha
		if(!$_captcha)
		{
			$response['status'] = false;
			$response['message'] = 'Please Check the CAPTCHA!!';
			echo json_encode($response);
			exit;
		}
		$captchaCheck = $this->captchaverify($_captcha);
		if(!$captchaCheck)
		{
			$response['status'] = false;
			$response['message'] = 'Please check the CAPTCHA!!';
			echo json_encode($response);
			exit;
		}*/

		#load model backend
		$this->load->model('model_backend_login');
		#getting data username
		$ruser= $this->model_backend_login->auth($_username);
		$_responseStat= false;
		if (is_array($ruser)&& !empty($ruser))
		{
			#cek password salah
			$response['success']= false;
			if($ruser['userpass'] != md5($_password))
			{
				$response['massage']= 'Invalid Username or Password';
			}else 
				#cek aktif employee
				if ($ruser['status_employee'] != 1 || $ruser['status_user'] != 1 || $ruser['status_user_type'] !=1)
				{
					$response['massage']= 'User Does not active.';
				} else{
					#cek aktif hak akses
					$rprivilege =$this->model_backend_login->getPrivilege($ruser['id_privilege']);
					if ($rprivilege['status'] != 1 && $rprivilege['status'] !=2)
					{
						$response['massage'] = 'User does not have privilege.';
					} else {
						$auserprofile = array(
											'id'			=>$ruser['id'],
											'id_employee'	=>$ruser['id_employee'],
											'account_id'	=>$ruser['account_id'],
											'name_employee'	=>$ruser['name_employee'],
											'id_user_type'	=>$ruser['id_user_type'],
											'name_user_type'=>$ruser['name_user_type'],
											'username'		=>$ruser['username'],
											'email'			=>$ruser['email'],
											'isAdmin'		=>$ruser['isAdmin'],
											'isPatner'		=>$ruser['isPatner']);
						$auserprivilege =array(
											'menu'			=>implode(',', $rprivilege['menu']),
											'defaulturl'	=>$rprivilege['default_url'],
											'privilege_id'	=>$rprivilege['id_privilege']
											);

						$_responseStat	= true;
						$this->session->set_userdata('isLogged',true);
						#$this->session->set_userdaa('isLocked',false); #true = posisi di lock screen
						$this->session->set_userdata('profile',$auserprofile);
						$this->session->set_userdata('privilege',$auserprivilege);

						$response['url'] = $rprivilege['default_url'];
						$response['success'] = true;
					}
				}

		} else 
		{
			$response['message']='Invalid Username and Password';
		}
		$response['status']=$_responseStat;
		echo json_encode($response);
	}

 	/*-------------------------------------------------------------------------------------------------*/
















}
