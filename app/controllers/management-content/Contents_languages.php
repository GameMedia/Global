<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contents_languages extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct();
		$this->load->model('backend/management-content/model_contents_languages');
		$this->load->model('backend/management-content/model_contents');
		$this->load->model('backend/master-management/model_countries');
	 }
	/*-------------------------------------------------------------------------------------------------*/ 
	public function index()
	 {
		//load menu
		$this->loadMenu();
		//content
		//HODL  $this->data['content'] = $this->model_contents->loadContentsSelect();  
		//country
		$this->data['country'] = $this->model_countries->loadCountriesSelect();
		$this->data['pageTitle'] = 'Content Languages';
		$this->data['pageTemplate'] = 'management-content/view_content_languages';
		$this->load->view($this->folderLayout.'main', $this->data);
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function loadLanguages()
	 {
	 	$this->isAjax(404);
	 	$result = array();
	 	$params =  $_POST;
	 	$data = $this->model_contents_languages->loadLanguages($params);

	 	if($data['count'])
	 	{
	 		for($i=0; $i<count($data['rows']); $i++)
	 		{
	 			$result['data'][$i][] = $params['start'] + ($i+1);
	 			$result['data'][$i][] = $data['rows'][$i]['name_content'];
	 			$result['data'][$i][] = $data['rows'][$i]['code_country'];
	 			$result['data'][$i][] = $data['rows'][$i]['name'];
	 			$result['data'][$i][] = ($data['rows'][$i]['status'])?'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>';
	 			$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target="#formAdd" data-toggle="modal"');
	 			$buttonDelete = "";
	 			if($this->data['accessDelete'])
	 				$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'management-content/contents_languages/deleteLanguages');
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
	/*-------------------------------------------------------------------------------------------------*/ 
	/*-------------------------------------------------------------------------------------------------*/ 
	/*-------------------------------------------------------------------------------------------------*/ 
	/*-------------------------------------------------------------------------------------------------*/ 

}

/* End of file contents_languages.php */
/* Location: ./application/controllers/contents_languages.php */