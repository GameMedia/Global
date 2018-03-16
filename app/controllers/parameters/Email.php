<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class email extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct();
		//load model
		$this->load->model('backend/parameters/model_email');
		$this->load->model('backend/model_global');
	 }

	public function index()
	 {
		//load menu
		$this->loadMenu();
		$this->data['pageTitle'] = 'Email';
		$this->data['pageTemplate'] = 'parameters/view_email';
		$this->load->view($this->folderLayout.'main', $this->data);	
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadEmail()
	 {
	 	$this->isAjax(404);
	 	$result = array();

	 	$params = $_POST;
	 	$data = $this->model_email->loadEmail($params);
	 	if($data['count'])
	 	{
	 		for($i=0; $i<count($data['rows']);$i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['name'];
	 			$result['data'][$i][] = '<a href="mailto:'.$data['rows'][$i]['email_user'].'">'.$data['rows'][$i]['email_user'].'</a>';
	 			$result['data'][$i][] = $data['rows'][$i]['host'];
	 			$result['data'][$i][] = $data['rows'][$i]['port'];
	 			$result['data'][$i][] = ($data['rows'][$i]['status'])?'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>';

				$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target="#formAdd" data-toggle="modal"');
				$buttonDelete = "";
				if($this->data['accessDelete'])
					$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'parameters/email/deleteEmail', ' datatable');
				$result['data'][$i][] = $buttonView.' '.$buttonDelete;
	 		}
	 	} else
	 	{
	 		$result['data'] = array();
	 	}
	 	$result["draw"] = $params['draw'];
	 	$result["recordsTotal"] = $data['total'];
	 	$result["recordsFiltered"] = $data['total'];

	 	echo json_encode($result);
	 }
	
	/*-------------------------------------------------------------------------------------------------*/ 
	public function getEmailData()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_email->getEmailData($params);
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function checkUI_Em()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'cms_email';
	 		$params = $_POST;

	 		if(empty($params['email_pass']))
	 		{
	 			$paramsData = array(
	 							'name' => $params['name'],
	 							'email_user' => $params['email_user'],
	 							'host' => $params['host'],
	 							'port' => $params['port'],
	 							'status' => $params['status']);
	 		} else
	 		{
	 			$paramsData = array(
	 							'name' => $params['name'],
	 							'email_user' => $params['email_user'],
	 							'email_pass' => base64_encode($params['email_pass']),
	 							'host' => $params['host'],
	 							'port' => $params['port'],
	 							'status' => $params['status']);
	 		}
	 		$paramsKey = array('id' => $params['id']);
	 		$result = $this->model_global->checkUI($table, $paramsData, $paramsKey);

	 		if($result)
	 		{
	 			$result = $this->model_global->update($table, $paramsData, $paramsKey);
	 			$paramsAct = array(
	 							'id_user' => $this->profile['id'],
	 							'actions' => ACTION_HISTORY_UPDATE,
	 							'data' => ($result['success'])?json_encode($params):'',
	 							'result' => json_encode($result));
	 			$this->addActHistory($paramsAct);
	 		} else
	 		{
	 			$result = $this->model_global->insert($table, $paramsData);
	 			$paramsAct = array(
	 							'id_user' => $this->profile['id'],
	 							'actions' => ACTION_HISTORY_SAVE,
	 							'data' => ($result['success'])?json_encode($params):'',
	 							'result' => json_encode($result));
	 			$this->addActHistory($paramsAct);
	 		}
	 		echo json_encode($result);
	 	}	
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function deleteEmail()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'cms_email';
	 		$params = $_POST;
	 		$paramsData = array('status' => '-1');
	 		$paramsKey = array('id' => $params['id']);
	 		$result = $this->model_global->delete($table, $paramsData, $paramsKey);

	 		$paramsAct = array(
	 						'id_user' => $this->profile['id'],
	 						'actions' => ACTION_HISTORY_DELETE,
	 						'data' => ($result['success'])?json_encode($params):'',
	 						'result' => json_encode($result));
	 		$this->addActHistory($paramsAct);
	 		echo json_encode($result);	 	
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadEmailSelect()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_email->loadEmailSelect($params);
	 		echo json_encode($result);
	 	}
	 }
	 
	 /*-------------------------------------------------------------------------------------------------*/ 
}

/* End of file email.php */
/* Location: ./application/controllers/email.php */