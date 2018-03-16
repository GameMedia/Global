<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usertype extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct();
		$this->load->model('backend/parameters/model_user_type');
	 }
	/*-------------------------------------------------------------------------------------------------*/ 
	public function index()
	 {
		//loadMenu
		$this->loadMenu();
		
		$this->data['pageTitle'] = 'User Type';
		$this->data['pageTemplate'] = 'parameters/view_user_type';
		$this->load->view($this->folderLayout.'main', $this->data);
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function loadUser_Type()
	 {
	 	$this->isAjax(404);
	 	$result = array();

	 	$params = $_POST;
	 	$data = $this->model_user_type->loadUser_Type($params);
	 	if($data['count'])
	 	{
	 		for($i=0; $i<count($data['rows']);$i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['name'];
	 			$result['data'][$i][] = ($data['rows'][$i]['isAdmin'])?'Yes':'No';
	 			$result['data'][$i][] = ($data['rows'][$i]['status'])?'<span class="label label-sm label-success"> Active</span>':'<span class="label label-sm label-danger"> Inactive</span>';
	 			//add  button
	 			$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target="#formAdd" data-toggle="modal"');

	 			$buttonDelete = "";
	 			if($this->data['accessDelete'])
	 				$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'parameters/usertype/deleteUser_Type','datatable');

	 			$result['data'][$i][] = $buttonView.' '.$buttonDelete;
	 		}
	 	} else
	 		$result['data'] = array();
	 	$result["draw"] = $params['draw'];
	 	$result["recordsTotal"] = $data['total'];
	 	$result["recordsFiltered"] = $data['total'];

	 	echo json_encode($result);
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function getUsertypeData()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_user_type->getUser_TypeData($params);
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function deleteUser_Type()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'cms_user_type';
	 		$this->load->model('backend/model_global');
	 		$params = $_POST;
	 		$paramsData = array('status'	=> '-1');
	 		$paramsKey = array('id'		=>$params['id']);

	 		$result = $this->model_global->delete($table, $paramsData, $paramsKey);
	 		//add action history
	 		$paramsAct = array(
	 						'id_user'	=> $this->profile['id'],
	 						'actions'	=> ACTION_HISTORY_DELETE,
	 						'data'		=> ($result['success'])?json_encode($params):'',
	 						'result'	=> json_encode($result));
	 		$this->addActHistory($paramsAct);
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function saveUser_Type()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'cms_user_type';
	 		$this->load->model('backend/model_global');
	 		$params = $_POST;
	 		$paramsData = array(
	 						'name'		=> $params['name'],
	 						'isAdmin'	=> $params['isAdmin'],
	 						'status'	=> $params['status']);
	 		$paramsKey = array('id'		=> $params['id']);
	 		$result = $this->model_global->checkUI($table, $paramsData, $paramsKey);

	 		if($result)
	 		{
	 			$result = $this->model_global->update($table, $paramsData, $paramsKey);
	 			$paramsAct = array (
	 							'id_user'	=> $this->profile['id'],
	 							'actions'	=> ACTION_HISTORY_UPDATE,
	 							'data'		=> ($result['success'])?json_encode($params):'',
	 							'result'	=> json_encode($result));
	 			$this->addActHistory($paramsAct);
	 		} else
	 		{
	 			$result = $this->model_global->insert($table, $paramsData);
	 			$paramsAct = array (
	 							'id_user'	=> $this->profile['id'],
	 							'actions'	=> ACTION_HISTORY_SAVE,
	 							'data'		=> ($result['success'])? json_encode($params):'',
	 							'result'	=> json_encode($result));
	 			$this->addActHistory($paramsAct);
	 		}
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/

}

/* End of file s Usertype.php */
/* Location: ./application/controllers/s Usertype.php */