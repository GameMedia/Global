<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends MY_Controller_Admin {

	public function __construct()
	 {
		parent::__construct(); 
		$this->load->model('backend/user-management/model_employees');
		$this->load->model('backend/parameters/model_user_type');
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function index()
	 {
		$this->loadMenu();		#load menu dari my_controller_admin
		$this->data['user_type']= $this->model_user_type->loadUser_TypeSelect();
		$this->data['privilege']['title']= "Privilege";
		$this->data['privilege']['url']= "user-management/privileges/loadPrivilegesSelect";

		$this->data['pageTitle']= 'Employees'; #tampilan header merah
		$this->data['pageTemplate']= 'user-management/view_employees'; # tabel employee
		$this->load->view($this->folderLayout.'main',$this->data);  #load view main layout	
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function loadEmployees()
	 {
		$this->isAjax(404);
		$result = array();

		$params = $_POST;
		$data = $this->model_employees->loadEmployees($params);

		if($data['count'])
		{
			for($i=0;$i<count($data['rows']);$i++)
			{
				$result['data'][$i][]=$params['start']+($i+1);
				$result['data'][$i][]=$data['rows'][$i]['name_user_type'];
				$result['data'][$i][]=$data['rows'][$i]['name_privilege'];
				$result['data'][$i][]=$data['rows'][$i]['name'];
				$result['data'][$i][]=$data['rows'][$i]['email'];
				$result['data'][$i][]=$data['rows'][$i]['phone'];
				$result['data'][$i][]=($data['rows'][$i]['status'])?
				'<span class="label label-sm label-success"> Active </span>':'<span class="label label-sm label-danger"> Inactive </span>';

					$buttonView=$this->createElementButtonView('view(\''.$data['rows'][$i]['id'].'\')','data-target="#formAdd" data-toggle="modal"'); #untuk pop up view data employee
				
					$buttonDelete="";
					if($this->data['accessDelete'])
						$buttonDelete=$this->createElementButtonDelete($data['rows'][$i]['id'], 'user-management/employees/deleteEmployees','datatable'); #fungsi self
				$result['data'][$i][]=$buttonView.' '.$buttonDelete;
			}
		}else
			$result['data'] = array();
		$result["draw"]				= $params['draw'];
		$result["recordsTotal"]		= $data['total'];
		$result["recordsFiltered"]	= $data['total'];

		echo json_encode($result);
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function getEmployeesData()  #mengambil data pop up detail view
	 {
		$this->isAjax(404);
		if(sizeof($_POST))
		{
			$params=$_POST;
			$result=$this->model_employees->getEmployeesData($params);
			echo json_encode($result);
		}
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function deleteEmployees() #untuk memproses penghapusan data
	 {
		$this->isAjax(404);
		if(sizeof($_POST))
		{
			$table='cms_employee';
			$this->load->model('backend/model_global');
			$params=$_POST;
			$paramsData=array('status'=>'-1');
			$paramsKey=array('id'=>$params['id']);
			$result=$this->model_global->delete($table,$paramsData,$paramsKey);

			#Adding to action history
			$paramsAct=array(
							'id_user'	=>$this->profile['id'],
							'actions'	=>ACTION_HISTORY_DELETE,
							'data'		=>($result['success'])?json_encode($params):'',
							'result'	=>json_encode($result));
			$this->addActHistory($paramsAct);
			echo json_encode($result);
		}
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function saveEmployees()
	 {
	 	$this->isAjax(404);
	 	if(sizeof($_POST))
	 	{
	 		$table 		= 'cms_employee';
	 		$tableuser 	= 'cms_user';
	 		$this->load->model('backend/model_global');
	 		$params 	= $_POST;
	 		$paramsData	= array(
	 						'name'		=> $params['name'],
	 						'address'	=> $params['address'],
	 						'email'		=> $params['email'],
	 						'phone'		=> $params['phone'],
	 						'status'	=> $params['status']);
	 		$paramsKey	= array('id'	=> $params['id']);
	 		$result		= $this->model_global->checkUI($table, $paramsData, $paramsKey);
	 		if($result)
	 		{
				$result = $this->model_global->update($table, $paramsData, $paramsKey);
	 			#cek update userdata
	 			if($result['success'])
	 			{
	 				if(empty($params['password']))
	 				{
	 					$ParamsDataUser = array(
											'id_user_type' 	=> $params['id_user_type'],
											'id_privilege' 	=> $params['id_privilege'],
											'username' 		=> $params['username'],
											'status'		=> $params['status']);
	 				} else
	 				{
	 					$ParamsDataUser = array(
											'id_user_type' 	=> $params['id_user_type'],
											'id_privilege' 	=> $params['id_privilege'],
											'username' 		=> $params['username'],
											'userpass' 		=> md5($params['password']),
											'status'		=> $params['status']);		
	 				}
	 				$paramsKeyUser = array('id_employee' => $params['id']);
	 				$this->model_global->update($tableuser, $ParamsDataUser, $paramsKeyUser);
	 			}
	 			$paramsAct = array(
	 							'id_user'	=>$this->profile['id'],
	 							'actions'	=>ACTION_HISTORY_UPDATE,
	 							'data'		=>($result['success'])?json_encode($params):'',
	 							'result'	=>json_encode($result));
	 			$this->addActHistory($paramsAct);
	 		}else
	 		{
	 			$result	= $this->model_global->insert($table, $paramsData);
	 			#cek untuk insert userdata
	 			if($result['success'])
	 			{
	 				$ParamsDataUser = array(
	 									'id_employee'	=> $result['id'],
	 									'id_user_type'	=> $params['id_user_type'],
	 									'id_privilege'	=> $params['id_privilege'],
	 									'username'		=> $params['username'],
	 									'userpass'		=> md5($params['password']),
	 									'status'		=> $params['status']);
	 				$this->model_global->insert($tableuser, $ParamsDataUser);
	 			}
	 			#add action history
	 			$paramsAct = array(
	 							'id_user'	=>	$this->profile['id'],
	 							'actions'	=>	ACTION_HISTORY_SAVE,
	 							'data'		=>	($result['success'])?json_encode($params):'',
	 							'result'	=> json_encode($result));
		 		$this->addActHistory($paramsAct);
		 	}
	 	echo json_encode($result);
		}
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function loadMenuSelect($params= array())
	 {
	 	$this->load->model('backend/user-management/model_privilege_menu');
	 	if(sizeof($_POST))
	 		$params = $_POST;
	 	$result = $this->model_privilege_menu->loadMenuSelect($params);
	 	$result = $this->makeListMenu($result);

	 	if($this->input->is_ajax_reques())
	 	{
	 		echo json_encode($result);
	 	}else
	 		return $result;
	 }

}

/* End of file employee.php */
/* Location: ./application/controllers/employee.php */