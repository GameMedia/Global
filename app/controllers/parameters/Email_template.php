<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class email_template extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct();
		$this->load->model('backend/parameters/model_email');
		$this->load->model('backend/parameters/model_email_template');
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function index()
	 {
		//load menu
		$this->loadMenu();

		//mengambil list email
		$this->data['email'] = $this->model_email->loadEmailSelect();
		$this->data['pageTitle'] = 'Email Template';
		$this->data['pageTemplate'] = 'parameters/view_email_template';
		$this->load->view($this->folderLayout.'main', $this->data);
		
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function loadEmail_Template()
	 {
	 	$this->isAjax(404);
	 	$result = array();

	 	$params = $_POST;
	 	$data = $this->model_email_template->loadEmail_Template($params);

	 	if($data['count'])
	 	{
	 		for($i=0; $i<count($data['rows']);$i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['name_email'];
	 			$result['data'][$i][] = $data['rows'][$i]['code'];
	 			$result['data'][$i][] = $data['rows'][$i]['name'];
	 			$result['data'][$i][] = $data['rows'][$i]['title'];
	 			$result['data'][$i][] = ($data['rows'][$i]['status'])?'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>';

	 			$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target="#formAdd" data-toggle="modal"');
	 			$buttonDelete ="";
	 			if($this->data['accessDelete'])
	 				$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'parameters/email_template/deleteEmail_Template', 'datatable');

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
	public function getEmail_TemplateData()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_email_template->getEmail_TemplateData($params);
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function checkUI_ET()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'cms_email_template';
	 		$this->load->model('backend/model_global');
	 		$params = $_POST;
	 		$paramsData = array(
	 						'id_email' => $params['id_email'],
	 						'code' => $params['code'],
	 						'name' => $params['name'],
	 						'title' => $params['title'],
	 						'content' => array(htmlentities($params['content']),0), //0 artinya tidak escape str
	 						'status' => $params['status']);
	 		$paramsKey = array('id' => $params['id']);
	 		$result = $this->model_global->checkUI($table, $paramsData, $paramsKey);

	 		if($result)
	 		{
	 			$result = $this->model_global->update($table, $paramsData, $paramsKey);
	 			$params = array(
	 						'id_user' => $this->profile['id'],
	 						'action' => ACTION_HISTORY_UPDATE,
	 						'data' => ($result['success'])?json_encode($params):'',
	 						'result' => json_encode($result));
	 			$this->addActHistory($paramsAct);
	 		} else
	 		{
	 			$result = $this->model_global->insert($table, $paramsData);
	 			$params = array(
	 						'id_user' => $this->profile['id'],
	 						'action' => ACTION_HISTORY_SAVE,
	 						'data' => ($result['success'])?json_encode($params):'',
	 						'result' => json_encode($result));
	 			$this->addActHistory($paramsAct);
	 		}
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function deleteEmail_Template()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'cms_email_template';
	 		$this->load->model('backend/model_global');
	 		$params = $_POST;
	 		$paramsData = array('status' => '-1');
	 		$paramsKey = array('id' => $params['id']);

	 		$result = $this->model_global->delete($table, $paramsData, $paramsKey);
	 		//add history
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
	public function loadEmail_TemplateSelect()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_email_template->loadEmail_TemplateSelect($params);

	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/


}

/* End of file emailtemplate.php */
/* Location: ./application/controllers/emailtemplate.php */