<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class countries extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct();
		$this->load->model('backend/master-management/model_countries');
	 }
	/*-------------------------------------------------------------------------------------------------*/ 
	public function index()
	 {
		//load menu
		$this->loadMenu();

		//utc timezone
		$this->data['utc_timezone'] = $this->setUtcTimezone();
		$this->data['pageTitle'] = 'Countries';
		$this->data['pageTemplate'] = 'master-management/view_countries';
		$this->load->view($this->folderLayout.'main', $this->data);
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadCountries()
	 {
	 	$this->isAjax(404);
	 	$result = array();
	 	$params = $_POST;
	 	$data = $this->model_countries->loadCountries($params);

	 	//utc timezone
	 	$utc_timezone = $this->setUtcTimezone();
	 	if($data['count'])
	 	{
	 		for($i=0;$i<count($data['rows']);$i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['code'];
	 			$result['data'][$i][] = $data['rows'][$i]['name'];
	 			$result['data'][$i][] = $utc_timezone[$data['rows'][$i]['utc_timezone']];
	 			$result['data'][$i][] = $data['rows'][$i]['prefix'];
	 			$result['data'][$i][] = ($data['rows'][$i]['status'])?'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>'; 

	 			$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target="#formAdd" data-toggle="modal"');
				
				$buttonDelete = "";
				if($this->data['accessDelete'])
					$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'master-management/countries/deleteCountries', 'datatable');
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
	public function getCountriesData()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_countries->getCountriesData($params);
	 		$result['update_by'] = empty($result['entry_by'])?$result['update_by']:$result['entry_by'];
	 		$result['update_time'] =  empty($result['entry_time'])?$result['update_time']:$result['entry_time'];
	 		echo json_encode($result);
	 	}	
	 }

	/*-------------------------------------------------------------------------------------------------BUG*/ 
	public function checkUI_CO()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'countries';
	 		$this->load->model('backend/model_global');
	 		$params = $_POST;
	 		$paramsData = array(
	 						'code'	=> $params['code'],
	 						'name'	=> $params['name'],
	 						'description'	=> $params['description'],
	 						'utc_timezone'	=> $params['utc_timezone'],
	 						'prefix'	=> $params['prefix'],
	 						'status'	=> $params['status']);
	 		$paramsKey = array( 'id' => $params['id']);
	 		$result = $this->model_global->checkUI($table, $paramsData, $paramsKey);

	 		if($result)
	 		{
	 			$result = $this->model_global->update($table, $paramsData, $paramsKey);
	 			$paramsAct = array(
	 							'id_user'	=> $this->profile['id'],
	 							'actions'	=> ACTION_HISTORY_UPDATE,
	 							'data'		=> ($result['success'])?json_encode($params):'',
	 							'result'	=> json_encode($result));
	 			$this->addActHistory($paramsAct);
	 		} else
	 		{
	 			$result = $this->model_global->insert($table, $paramsData);
	 			//if success save insert into dictionaries
	 			
	 			if($result['success'])
	 			{
	 				$this->load->model('backend/master-management/model_dictionaries');
	 				$countries = $this->model_countries->loadCountriesSelect(array('not_id'=>$result['id']));
	 				$lastCountry = NULL;

	 				if($countries['count'])
	 					$lastCountry = $countries['rows'][0]['id'];

	 				$dictionaries = $this->model_dictionaries->loadDictionariesSelect(array('id_country' => $lastCountry));
	 				if($dictionaries['count'])
	 				{
	 					foreach ($dictionaries['rows'] as $key) 
	 					{
	 						$paramsDictionary = array(
	 											'code' => $key['code'],
	 											'id_country' => $result['id_query']);
	 						$this->model_global->insert('dictionaries', $paramsDictionary);
	 					}
	 				}
	 			}

	 			//Act hisotry
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
	public function deleteCountries()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'countries';
	 		$this->load->model('backend/model_global');
	 		$params = $_POST;
	 		$paramsData = array( 'status' => '-1');
	 		$paramsKey	= array( 'id' => $params['id']);

	 		$result = $this->model_global->delete($table, $paramsData, $paramsKey);
	 		//act history
	 		$paramsAct = array(
	 						'id_user' 	=> $this->profile['id'],
	 						'actions'	=> ACTION_HISTORY_DELETE,
	 						'data'		=> ($result['success'])?json_encode($params):'',
	 						'result'	=> json_encode($result));
	 		$this->addActHistory($paramsAct);
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadCountriesSelect()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_countries->loadCountriesSelect($params);

	 		echo json_encode($result);
	 	}
	 }
	/*-------------------------------------------------------------------------------------------------*/ 

}

/* End of file countries.php */
/* Location: ./application/controllers/countries.php */
/* muhammad iqbal */