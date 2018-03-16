<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_types extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct();
		$this->load->model('backend/management-content/model_content_types');	
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function index()
	 {
		//load menu
		$this->loadMenu();
		$this->data['pageTitle'] = 'Content Type';
		$this->data['pageTemplate'] = 'management-content/view_content_types';
		$this->load->view($this->folderLayout.'main', $this->data);
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function loadContent_Types()
	 {
	 	$this->isAjax(404);
	 	$result = array();
	 	$params = $_POST;
	 	$data = $this->model_content_types->loadContent_Types($params);

	 	if($data['count'])
	 	{
	 		for($i=0; $i<count($data['rows']); $i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['code'];
	 			$result['data'][$i][] = $data['rows'][$i]['name'];
	 			$result['data'][$i][] = $data['rows'][$i]['description'];
	 			$result['data'][$i][] = ($data['rows'][$i]['status'])?'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>';
	 		
	 		$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target="#formAdd" data-toggle="modal"');

	 		$buttonDelete = "";
	 		if($this->data['accessDelete'])
	 			$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'management-content/content_types/deleteContent_Types', 'datatable');

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
	public function getContent_TypesData()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_content_types->getContent_TypesData($params);
	 		$result['update_by'] = empty($result['entry_by'])?$result['update_by']:$result['entry_by'];
	 		$result['update_time'] = empty($result['entry_time'])?$result['update_time']:$result['entry_time'];

	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function checkUI_CT()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'contents_types';
	 		$this->load->model('backend/model_global');
	 		$params = $_POST;
	 		$paramsData = array(
	 						'code' => $params['code'],
	 						'name' => $params['name'],
	 						'description' => $params['description'],
	 						'status' => $params['status']
	 						);
	 		$paramsKey = array( 'id' => $params['id']);

	 		$result = $this->model_global->checkUI($table, $paramsData, $paramsKey);

	 		if($result)
	 		{
	 			$result = $this->model_global->update($table, $paramsData, $paramsKey);
	 			//add history
	 			$paramsAct = array(
	 							'id_user' => $this->profile['id'],
	 							'actions' => ACTION_HISTORY_UPDATE,
	 							'data' => ($result['success'])?json_encode($params):'',
	 							'result'=> json_encode($result));
	 			$this->addActHistory($paramsAct);
	 		} else
	 		{
	 			$result = $this->model_global->insert($table, $paramsData);
	 			//add history
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
	public function deleteContent_Types()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'contents_types';
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
	public function loadContent_TypesSelect()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_content_types->loadContent_TypesSelect($params);

	 		echo json_encode($result);
	 	}
	 }
	/*-------------------------------------------------------------------------------------------------*/

}

/* End of file content_type.php */
/* Location: ./application/controllers/content_type.php */
/* Muhammad Iqbal */