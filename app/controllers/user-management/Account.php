<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller_Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('backend/user-management/model_account');
	}

	public function index()
	{
		
	}

	/*-------------------------------------------------------------------------------------------------*/

	public function saveAccount()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_account->saveAccount($params);

	 		if($result)
	 		{
	 			$result = $this->updateAccount($params);
	 		}else
	 		{
	 			$result = $this->insertAccount($params);
	 		}
	 		echo json_encode($result);
	 	}
	 }
	/*-------------------------------------------------------------------------------------------------*/

	private function insertAccount()
	 {
	 	if(is_array($params))
	 	{
	 		$result = $this->model_account->insertAccount($params);
	 		$paramsAct = array(
	 						'id_user'	=> $this->profile['id'],
	 						'action'	=> ACTION_HISTORY_SAVE,
	 						'data'		=> ($result['success'])?json_encode($params):'',
							'result'	=> json_encode($result)
	 					);
	 		$this->addActHistory($paramsAct);
			return $result;
	 	}
	 }
	/*-------------------------------------------------------------------------------------------------*/

	private function updateAccount($params)
	 {
		if(is_array($params))
		{
			$result = $this->model_account->updateAccount($params);
			$paramsAct = array(
								'id_user' 	=> $this->profile['id'],
								'actions' 	=> ACTION_HISTORY_UPDATE,
								'data' 		=> ($result['success'])?json_encode($params):'',
								'result'	=> json_encode($result)
							  );
			$this->addActHistory($paramsAct);
			return $result;
		}
	 }
	/*-------------------------------------------------------------------------------------------------*/

	public function saveAccountPass()
	 {
		$this->isAjax(404);
		if(sizeof($_POST)){
			$params = $_POST;
			$checkingUserPass = true;
			
			#Cek user pass
			if(isset($params['user_pass']) && !empty($params['user_pass']))
			{
				$checkingUserPass = $this->model_account->checkingUserPass($params);
			}
			
			if($checkingUserPass)
			{
				#Set ID Account kalau kosong
				if(!isset($params['id']))
				{
					$params['id'] = $this->profile['account_id'];
				}
				$result = $this->model_account->saveAccountPass($params);
			} else 
			{
				$result['success'] = false;
				$result['count'] = false;
				$result['message'] = "User Password is Failed!";
			}
			$paramsAct = array(
								'id_user' 	=> $this->profile['id'],
								'actions' 	=> ACTION_HISTORY_UPDATE,
								'data' 		=> ($result['success'])?json_encode($params):'',
								'result'	=> json_encode($result)
							  );
			$this->addActHistory($paramsAct);
			echo json_encode($result);
		}
	}
	/*-------------------------------------------------------------------------------------------------*/

	public function saveChangePassword()
	{
		$this->isAjax(404);
		if(sizeof($_POST))
		{
			$params = $_POST;
			$result = $this->model_account->saveChangePassword($params);
			$paramsAct = array(
								'id_user' 	=> $this->profile['id'],
								'actions' 	=> ACTION_HISTORY_UPDATE,
								'data' 		=> ($result['success'])?json_encode($params):'',
								'result'	=> json_encode($result)
							  );
			$this->addActHistory($paramsAct);
			echo json_encode($result);
		}
	}
	/*-------------------------------------------------------------------------------------------------*/

}

/* End of file account.php */
/* Location: ./application/controllers/account.php */