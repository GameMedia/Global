<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class galleries extends MY_Controller_Admin {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('backend/master-management/model_galleries');
		$this->load->model('backend/management-content/model_content_types');
	}

	/*-------------------------------------------------------------------------------------------------*/
	public function index()
	{
		$this->loadMenu();
		$this->data['content_types'] = $this->model_content_types->loadContent_TypesSelect();
		$this->data['pageTitle'] = 'Galleries';
		$this->data['pageTemplate'] = 'master-management/view_galleries';  //debug
		$this->load->view($this->folderLayout.'main', $this->data);
	}

	/*-------------------------------------------------------------------------------------------------*/
	public function loadGalleries()
	 {
	 	$this->isAjax(404);
	 	$result = array();
	 	$params = $_POST;
	 	$data = $this->model_galleries->loadGalleries($params);

	 	//count data
	 	if ($data['count']) 
	 	{
	 		for($i=0; $i<count($data['rows']); $i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['name_content_type'];
	 			$result['data'][$i][] = $data['rows'][$i]['name_galleri'];
	 			$result['data'][$i][] = (!empty($data['rows'][$i]['url_thumb']) || !empty($data['rows'][$i]['url_ori']) )?"<img src='".URL_PLATFORM.((!empty($data['rows'][$i]['url_thumb']))?$data['rows'][$i]['url_thumb']:$data['rows'][$i]['url_ori'])."' width='100' />":"";
	 			$result['data'][$i][] = ($data['rows'][$i]['status'])?'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>';
	 			$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target="#formAdd" data-toggle="modal"');

	 			$buttonDelete = ""; 
	 				if($this->data['accessDelete'])
	 					$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'master-management/galleries/deleteGalleries', 'datatable');

	 			$result['data'][$i][] = $buttonView.' '.$buttonDelete;
	 		}
	 	} else
	 	{
	 		$result['data'] = array();
	 	}
	 	$result["draw"] = $params['draw'];
	 	$result["recordsTotal"] = $data['total'];
	 	$result["recordsFiletered"] = $data['total'];
	 	echo json_encode($result);
	 }


	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadGalleriesSelect()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_galleries->loadGalleriesSelect($params);

	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/ //cek save or update 
	public function checkUI()
	{
		$this->isAjax(404);
		if(sizeof($_POST))
		{
			$table = 'galleries';
			$this->load->model('backend/model_global');
			$params = $_POST;

			$paramsData = array(
							'id_content_type' => $params['id_content_type'],
							'id_reference' => $params['id_reference'],
							'name' => $params['name'],
							'description' => array($params['description'], true),
							'path' => $params['path'],
							'url_ori' => $params['url_ori'],
							'url_thumb' => $params['url_thumb'],
							'mime_type' => $params['mime_type'],
							'status' => $params['status']);
			$paramsKey = array( 'id' => $params['id']);
			$result = $this->model_global->checkUI($table, $paramsData,$paramsKey);

			if($result)
			{
				$result = $this->model_global->update($table, $paramsData, $paramsKey);
				//act history
				$paramsAct = array(
								'id_user' => $this->profile['id'],
								'actions' => ACTION_HISTORY_UPDATE,
								'data' => ($result['success'])? json_encode($params):'',
								'result' => json_encode($result));
				$this->addActHistory($paramsAct);
			} else
			{
				$result = $this->model_global->insert($table, $paramsData);
				//act history
				$paramsAct = array(
								'id_user' => $this->profile['id'],
								'actions' => ACTION_HISTORY_UPDATE,
								'data' => ($result['success'])? json_encode($params):'',
								'result' => json_encode($result));
				$this->addActHistory($paramsAct);
			}
			echo json_encode($result);
		}
	}

	/*-------------------------------------------------------------------------------------------------*/ 
	public function getGalleriesData()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_galleries->getGalleriesData($params);
	 		$result['update_by'] = empty($result['entry_by'])?$result['update_by']:$result['entry_by'];
	 		$result['update_time'] = empty($result['entry_time'])?$result['update_time']:$result['entry_time'];
	 		$result['url'] = URL_PLATFORM;
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function deleteGalleries()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table = 'galleries';
	 		$this->load->model('backend/model_global');
	 		$params = $_POST;
	 		$paramsData = array('status' => '-1');
	 		$paramsKey = array('id' => $params['id']);

	 		$result = $this->model_global->delete($table, $paramsData, $paramsKey);

	 		//act history
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
	public function uploadGalleries()
	 {
	 	$this->isAjax(404);
	 	if(!isset($_GET['files']))
	 	{
	 		echo json_encode(array('message' => 'missing parameter', 'status' => false));
	 		die();
	 	}
	 	$result = $this->upload('Image','galleries', NULL, false, 10485760);
	 	echo json_encode($result);
	 }


	/*-------------------------------------------------------------------------------------------------*/ 



	/*-------------------------------------------------------------------------------------------------*/ 
}

/* End of file galleries.php */
/* Location: ./application/controllers/galleries.php */
/* muhammad iqbal */