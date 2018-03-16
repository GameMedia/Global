<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dictionaries extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct();
		$this->load->model('backend/master-management/model_dictionaries');
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function index()
	 { 
		//load menu
		$this->loadMenu();
		//model Country
	 	$this->load->model('backend/master-management/model_countries');
	 	//countries
	 	$this->data['countries'] = $this->model_countries->loadCountriesSelect();
	 	$this->data['pageTitle'] = 'Dictionaries';
	 	$this->data['pageTemplate'] = 'master-management/view_dictionaries';
	 	$this->load->view($this->folderLayout.'main', $this->data);
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function loadDictionaries()
	 {
	 	$this->isAjax(404);
	 	$result = array();

	 	$params = $_POST;
	 	$data = $this->model_dictionaries->loadDictionaries($params);
	 	if($data['count'])
	 	{
	 		for($i=0; $i<count($data['rows']); $i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['name_country'];
	 			$result['data'][$i][] = $data['rows'][$i]['device'];
	 			$result['data'][$i][] = $data['rows'][$i]['code'];
	 			$result['data'][$i][] = $data['rows'][$i]['value'];
	 			$result['data'][$i][] = ($data['rows'][$i]['status'])?'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>';
				;
	 			$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target="#formAdd" data-toggle="modal"');
				
				$buttonDelete = "";
				if($this->data['accessDelete'])
					$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'master-management/dictionaries/deleteDictionaries', 'datatable');
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
	public function loadDictionariesSelect()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_dictionaries->loadDictionariesSelect($params);
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function getDictionariesData()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_dictionaries->getDictionariesData($params);
	 		$result['update_by'] = empty($result['entry_by'])?$result['update_by']:$result['entry_by'];
			$result['update_time'] = empty($result['entry_time'])?$result['update_time']:$result['entry_time'];
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function deleteDictionaries()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'dictionaries';
	 		$this->load->model('backend/modal_global');
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
	public function saveDictionaries()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'dictionaries';
	 		$this->load->model('backend/model_global');
	 		$params = $_POST;

	 		for($i=0; $i<count($params['country']); $i++)
	 		{
	 			$paramsData = array (
	 							'id_country' => $params['country'][$i],
	 							'code' => $params['code'],
	 							'value' => $params['value'][$i]
	 							);
	 			$paramsKey = array(
	 							'id'	=> empty($params['id'])?$params['code']:$params['id'],
	 							'id_country'	=> $params['country'][$i]
	 							);
	 		}
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/
}

/* End of file dictionaries.php */
/* Location: ./application/controllers/dictionaries.php */
/* Muhammad Iqbal */