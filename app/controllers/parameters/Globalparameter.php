<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Globalparameter extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct();
		$this->load->model($this->folder.'parameters/model_global_parameters');
		
	 }
	 
 	/*-------------------------------------------------------------------------------------------------*/ 
	public function index()
	 {
	 	$this->loadMenu();

	 	$this->data['pageTitle'] = 'Global Parameters';
	 	$this->data['pageTemplate'] = 'parameters/view_global_parameter';
	 	$this->load->view($this->folderLayout.'main',$this->data);
	 }

	/*-------------------------------------------------------------------------------------------------*/  
	public function loadGlobal_Parameter()
	 {
	 	$this->isAjax(404);
		$result = array();
			
		$params = $_POST;
		$data = $this->model_global_parameters->loadGlobal_Parameter($params);
	 	if($data['count'])
	 	{
	 		for($i=0; $i<count($data['rows']); $i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['id'];
	 			$result['data'][$i][] = $data['rows'][$i]['value'];

	 			$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target="#formAdd" data-toggle="modal"');
	 			$buttonDelete = "";
	 			if($this->data['accessDelete'])
	 				$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'],'parameters/globalparameter/deleteGlobal_Parameter','datatable');
	 			$result['data'][$i][] = $buttonView.' '.$buttonDelete;
 	 		}
	 	} else
	 	{
	 		$result['data'] = array();

	 	}
	 	$result["draw"]	= $params['draw'];
	 	$result["recordsTotal"] = $data['total'];
	 	$result["recordsFiltered"] = $data['total'];
	 	echo json_encode($result);
	 }

	/*-------------------------------------------------------------------------------------------------*/  
	public function getGlobalparameterData()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_global_parameters->getGlobal_ParameterData($params);
	 		echo json_encode($result);
	 	}
	 }
	/*-------------------------------------------------------------------------------------------------*/  
	public function saveGlobal_Parameter()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'cms_global_parameter';
	 		$this->load->model('backend/model_global');
	 		$params = $_POST;
	 		$paramsData = array(
	 						'id' => $params['id'],
	 						'value' => $params['value'],
	 						'description' => $params['description']);
	 		$paramsKey = array( 'id' => $params['id']);

	 		$result = $this->model_global->CheckUI($table, $paramsData, $paramsKey);
	 		if($result)
	 		{
	 			$result = $this->model_global->update($table, $paramsData, $paramsKey);
	 			$paramsAct = array( 
	 							'id_user' => $this->profile['id'],
	 							'actions' => ACTION_HISTORY_UPDATE,
	 							'data' => ($result['success'])? json_encode($params):'',
	 							'result' => json_encode($result));
	 			$this->addActHistory($paramsAct);
	 		} else
	 		{
	 			$result = $this->model_global->insert($table, $paramsData);
	 			$paramsAct = array( 
	 							'id_user' => $this->profile['id'],
	 							'actions' => ACTION_HISTORY_SAVE,
	 							'data' => ($result['success'])? json_encode($params):'',
	 							'result' => json_encode($result));
	 			$this->addActHistory($paramsAct);
	 		}
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/  
	public function deleteGlobal_Parameter()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_global_parameters->deleteGlobal_Parameter($params);

	 		//add history
	 		$paramsAct = array(
	 						'id_user'	=> $this->profile['id'],
	 						'actions'	=> ACTION_HISTORY_DELETE,
	 						'data'		=> ($result['success'])?json_encode($params):'',
	 						'result'	=> json_encode($result)
	 						);
	 		$this->addActHistory($paramsAct);

	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/  

	/*-------------------------------------------------------------------------------------------------*/  
}

/* End of file globalparameter.php */
/* Location: ./application/controllers/globalparameter.php */