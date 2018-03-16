<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class privileges extends MY_Controller_Admin {

	public function __construct() 
	 {
		parent::__construct();
			
		$this->load->model('backend/user-management/model_privileges');
		$this->load->model('backend/parameters/model_user_type');
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function index()
	 {	
		#LoadMenu
		$this->loadMenu();
		$this->data['user_type'] = $this->model_user_type->loadUser_TypeSelect();
		$this->data['sortedMenu'] = $this->loadMenuSelect(array('parent' => '0'));
		$this->data['pageTitle'] = 'Privileges';
		$this->data['pageTemplate'] = 'user-management/view_privileges';
		$this->load->view($this->folderLayout.'main', $this->data);
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function loadPrivileges()  #menampilkan data privilege tabel utama
	 {
		$this->isAjax(404);
		$result = array();
		$params = $_POST;
		$data = $this->model_privileges->loadPrivileges($params);
		
		if($data['count']){
			for($i=0;$i<count($data['rows']);$i++){
				$result['data'][$i][] = $params['start'] + ($i+1);
				$result['data'][$i][] = $data['rows'][$i]['name_user_type'];
				$result['data'][$i][] = $data['rows'][$i]['name_privilege'];
				$result['data'][$i][] = $data['rows'][$i]['name_menu'];
				$result['data'][$i][] = ($data['rows'][$i]['status'])?'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>';
				
				$buttonView = $this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')', 'data-target="#formAdd" data-toggle="modal"');
				
				$buttonDelete = "";
				if($this->data['accessDelete'])
					$buttonDelete = $this->createElementButtonDelete($data['rows'][$i]['id'], 'user-management/privileges/deletePrivileges', 'datatable');
				
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
	public function loadPrivilegesSelect()	#load privilege pada menu popup
	 {
		$this->isAjax(404);
		if(sizeof($_POST)){
			$params = $_POST;
			$result = $this->model_privileges->loadPrivilegesSelect($params);
			
			echo json_encode($result);
		}
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function loadMenuSelect($params = array())  #load default menu pada popup

	 {
		$this->load->model('backend/user-management/model_privilege_menu');
		if(sizeof($_POST))	
			$params = $_POST;
			
		$result = $this->model_privilege_menu->loadMenuSelect($params);
		$result = $this->makeListMenu($result);
		
		if ($this->input->is_ajax_request()){
			echo json_encode($result);
		}else 
			return $result;
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function savePrivileges()
	 {		
		$this->isAjax(404);
		
		if(sizeof($_POST)){
			$table = 'cms_privilege';
			$tablePrivilegeMenu = 'cms_privilege_menu';
			$this->load->model('backend/model_global');
			
			$params = $_POST;
			
			$paramsData = array(
								'id_user_type'	=> $params['id_user_type'],
								'name' 			=> $params['name'],
								'default_menu'	=> $params['default_menu'],
								'status'		=> $params['status']
								);
			
			$paramsKey = array(
								'id' 			=> $params['id']
								);
			
			$result = $this->model_global->checkUI($table, $paramsData, $paramsKey);
			
			if($result){
				$result = $this->model_global->update($table, $paramsData, $paramsKey);
				
				$paramsAct = array(
									'id_user' 	=> $this->profile['id'],
									'actions' 	=> ACTION_HISTORY_UPDATE,
									'data' 		=> ($result['success'])?json_encode($params):'',
									'result'	=> json_encode($result)
								  );
				$this->addActHistory($paramsAct);
			} else {
				$result = $this->model_global->insert($table, $paramsData);
				
				if($result['success']){
					#Get All Menu And Insert into table privilege
					$this->load->model('backend/user-management/model_privilege_menu');
					$dataMenu = $this->model_privilege_menu->getMenuAll();
					if($dataMenu['count']){
						foreach($dataMenu['rows'] as $key => $val){
							$paramsAct = array(
											'id_privilege' 	=> $result['id'],
											'id_menu' 		=> $val['id'],
											'access' 		=> '0',
											'status' 		=> $val['status']
										   );
							$this->model_global->insert($tablePrivilegeMenu, $paramsAct);
						}	
					}
					
				}
				
				#Adding to Action History
				$paramsAct = array(
									'id_user' 	=> $this->profile['id'],
									'actions' 	=> ACTION_HISTORY_SAVE,
									'data' 		=> ($result['success'])?json_encode($params):'',
									'result'	=> json_encode($result)
								  );
				$this->addActHistory($paramsAct);
			}
			
			echo json_encode($result);
		}

	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function deletePrivileges()
	 {		
		$this->isAjax(404);
		
		if(sizeof($_POST)){
			$table = 'cms_privilege';
			$this->load->model('backend/model_global');
			
			$params = $_POST;
			
			$paramsData = array(
								'status'		=> '-1'
								);
			
			$paramsKey = array(
								'id' 			=> $params['id']
								);
			
			$result = $this->model_global->delete($table, $paramsData, $paramsKey);
			
			#Adding to Action History
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
	public function getPrivilegesData()
	 {
		$this->isAjax(404);
		
		if(sizeof($_POST)){
			$params = $_POST;
			$result = $this->model_privileges->getPrivilegesData($params);
			echo json_encode($result);
		}
	 }
} 
