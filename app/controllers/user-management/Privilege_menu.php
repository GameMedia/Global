<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege_menu extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct();
		$this->load->model('backend/user-management/model_privilege_menu');
		$this->load->model('backend/user-management/model_privileges');
		$this->load->model('backend/parameters/model_user_type');
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function index()
	 {
		$this->loadMenu();
				
		$this->data['sortedMenu'] = $this->loadMenuSelect(array('parent' => '0'));
		$this->data['privileges'] = $this->model_privileges->loadPrivilegesSelect();
				
		$this->data['layout'] = 'others_1/';
		$this->data['pageTitle'] = 'Privileges Menu';
		$this->data['pageTemplate'] = 'user-management/view_privilege_menu';
		$this->load->view($this->folderLayout.'main', $this->data);
	 }
	 
	/*-------------------------------------------------------------------------------------------------*/
	public function loadPrivilege_Menu()
	 {
		$this->isAjax(404);
		$result = array();
		$params = $_POST;
		$data = $this->model_privilege_menu->loadPrivilege_Menu($params);
		
		if($data['count'])
		{
			for($i=0;$i<count($data['rows']);$i++)
			{
				$result['data'][$i][] = $params['start'] + ($i+1);
				$result['data'][$i][] = $data['rows'][$i]['name_user_type'];
				$result['data'][$i][] = $data['rows'][$i]['name_privilege'];
				$result['data'][$i][] = $data['rows'][$i]['name_menu'];
				$result['data'][$i][] = ($data['rows'][$i]['status'])?'Active':'Inactive';
				
				$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target="#formAdd" data-toggle="modal"');
				
				$buttonDelete = "";
				if($this->data['accessDelete'])
					$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'user-management/privilege_menu/deletePrivilege_Menu', 'datatable');
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
	public function loadMenuSelect($params = array())
	 {
		if(sizeof($_POST))	
			$params = $_POST;	
		$result = $this->loadMenuTree($params);
					
		if ($this->input->is_ajax_request())
		{
			echo json_encode($result);
		} else 
			return $result;
	 }
	
	/*-------------------------------------------------------------------------------------------------*/
	public function cekUI_PM()
	 {
		$this->isAjax(404);
		
		if(sizeof($_POST)){
			$params = $_POST;
			$result = $this->model_privilege_menu->cekUI_PM($params);
			
			if($result)
			{
				$result = $this->update_PM($params);
			} else
				$result = $this->insert_PM($params);
			echo json_encode($result);
		}

	 }

	/*-------------------------------------------------------------------------------------------------*/
	private function insert_PM($params)
	 {
		if(is_array($params))
		{
			$result = $this->model_privilege_menu->insert_PM($params);
			#simpan history
			$paramsAct = array(
								'id_user' 	=> $this->profile['id'],
								'actions' 	=> ACTION_HISTORY_SAVE,
								'data' 		=> ($result['success'])?json_encode($params):'',
								'result'	=> json_encode($result)
							  );
			$this->addActHistory($paramsAct);
			return $result;
		}
	 }

	/*-------------------------------------------------------------------------------------------------*/
	private function update_PM($params)
	 {
		if(is_array($params)){
			$result = $this->model_privilege_menu->update_PM($params);
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
	public function delete_PM()
	 {
		$this->isAjax(404);
		if(sizeof($_POST))
		{
			$params = $_POST;
			$result = $this->model_privilege_menu->delete_PM($params);
			#Simpan history
			$paramsAct = array(
								'id_user' 	=> $this->profile['id'],
								'actions' 	=> ACTION_HISTORY_DELETE,
								'data' 		=> ($result['success'])?json_encode($params):'',
								'result'	=> json_encode($result)
							  );
			$this->addActHistory($paramsAct);
			
			echo json_encode($result);
		}
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function getPrivilege_MenuData()
	 {
		$this->isAjax(404);
		if(sizeof($_POST))
		{
			$params = $_POST;
			$result = $this->model_privilege_menu->getPrivilege_MenuData($params);
			echo json_encode($result);
		}
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function setAccess()
	 {
	 	$this->isAjax(404);
	 	if(isset($_POST))
	 	{
	 		$params = $_POST;
	 		$result = $this->model_privilege_menu->setAccess($params);

	 		#add history
	 		$paramsAct = array(
	 						'id_user'	=> $this->profile['id'],
	 						'actions'	=> ACTION_HISTORY_SAVE,
	 						'data'		=> ($result['success'])? json_encode($params):'',
	 						'result'	=> json_encode($result));
	 		$this->addActHistory($paramsAct);
	 		echo json_encode($result);
	 	}
	 }

	/*-------------------------------------------------------------------------------------------------*/
}

/* End of file privilege_menu.php */
/* Location: ./application/controllers/privilege_menu.php */