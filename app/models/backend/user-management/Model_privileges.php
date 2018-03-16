<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_privileges extends MY_Model 
 {
	private $tablePrivileges		= 'cms_privilege';
	private $tablePrivileges_Menu	= 'cms_privilege_menu';
	private $tableMenu 				= 'cms_menu';
	private $tableUserType			= 'cms_user_type';
	private $tableUser 				= 'cms_user';

	/*-------------------------------------------------------------------------------------------------*/
	public function __construct()
	 {
		parent::__construct();
		$this->loadDbCms();
  	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function loadPrivileges($params)
	 {
		$result = array();
		
		$columnOrder = array(
							'1' => 'ut.name',
							'2' => 'pv.name',
							'4' => 'pv.status'
							);
		
		#Select Count Data 
		$this->dbCms->select(' COUNT(1) AS count ');
		$this->dbCms->from($this->tablePrivileges.' pv');
		$this->dbCms->join($this->tableMenu.' me', 'pv.default_menu = me.id');
		$this->dbCms->join($this->tableUserType.' ut', 'pv.id_user_type = ut.id');
		
		if(!empty($params['search_name']))
			$this->dbCms->where("pv.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
			
		if(!empty($params['search_id_user_type']))
			$this->dbCms->where("ut.id LIKE '%".$this->dbCms->escape_str($params['search_id_user_type'])."%'");
			
		if(!empty($params['search_default_menu']))
			$this->dbCms->where("pv.default_menu", $this->dbCms->escape_str($params['search_default_menu']));
			
		if(isset($params['search_status']) && $params['search_status'] != "")
			$this->dbCms->where("pv.status", $this->dbCms->escape_str($params['search_status']));
		
		#Where data not deleted	
		$this->dbCms->where("pv.status !=", "-1");
		
		$query = $this->dbCms->get();
		
		$result['total'] = 0;
		foreach($query->result_array() as $row)
			$result['total'] = $row['count'];
		
		#Select Main Data
		$this->dbCms->select('pv.id, pv.name AS name_privilege, pv.status, pv.entry_time, pv.update_time');
		$this->dbCms->select('me.name AS name_menu');
		$this->dbCms->select('ut.name AS name_user_type');
		$this->dbCms->from($this->tablePrivileges.' pv');
		$this->dbCms->join($this->tableMenu.' me', 'pv.default_menu = me.id');
		$this->dbCms->join($this->tableUserType.' ut', 'pv.id_user_type = ut.id');
		
		if(!empty($params['search_name']))
			$this->dbCms->where("pv.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
			
		if(!empty($params['search_id_user_type']))
			$this->dbCms->where("ut.id LIKE '%".$this->dbCms->escape_str($params['search_id_user_type'])."%'");
			
		if(!empty($params['search_default_menu']))
			$this->dbCms->where("pv.default_menu", $this->dbCms->escape_str($params['search_default_menu']));
			
		if(isset($params['search_status']) && $params['search_status'] != "")
			$this->dbCms->where("pv.status", $this->dbCms->escape_str($params['search_status']));
		
		#Where data not deleted	
		$this->dbCms->where("pv.status !=", "-1");
		$this->dbCms->limit($params['length'], $params['start']);
		
		#Order By Params from Datatables
		$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);
		$query = $this->dbCms->get();
					
		$i=0;
		if($query->num_rows() != 0)
		{
			$result['count'] = true;
			foreach($query->result_array() as $row) 
			{
				$result['rows'][$i]['id'] = $row['id'];
				$result['rows'][$i]['name_privilege'] = $row['name_privilege'];
				$result['rows'][$i]['name_menu'] = $row['name_menu'];
				$result['rows'][$i]['name_user_type'] = $row['name_user_type'];
				$result['rows'][$i]['status'] = $row['status'];
				$result['rows'][$i]['entry_time'] = $row['entry_time'];
				$result['rows'][$i]['update_time'] = $row['update_time'];
				$i++;
			}
		} else 
		{
			$result['count'] = false;
			$result['message'] = DB_NULL_RESULT;
		}
		return $result;
	 }
 
	/*-------------------------------------------------------------------------------------------------*/
	public function loadPrivilegesSelect($params = array())
	 {
		$result = array();
				
		$this->dbCms->select('id, name');
		$this->dbCms->from($this->tablePrivileges);
		$this->dbCms->where('status', '1');
		$this->dbCms->order_by('name', 'ASC');
		
		if(isset($params['id_query']))
			$this->dbCms->where('id_user_type', $params['id_query']);
		
		$query = $this->dbCms->get();
		$i=0;
		if($query->num_rows() != 0)
		{
			$result['count'] = true;
			foreach($query->result_array() as $row) 
			{
				$result['rows'][$i]['id'] = $row['id'];
				$result['rows'][$i]['name'] = $row['name'];
				$i++;
			}
		} else 
		{
			$result['count'] = false;
			$result['title'] = DB_TITLE_RESULT;
			$result['message'] = DB_NULL_RESULT;
		}
		return $result;
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function deletePrivileges($params)
	 {
		$delete = array( 'status' => $this->dbCms->escape_str("-1") );
		$this->dbCms->where('id', $this->dbCms->escape_str($params['id']));
		$this->dbCms->update($this->tablePrivileges, $delete);
		
		$result = array();
		$dbResponse = $this->dbCms->error();
		if($dbResponse['code'] == 0){
			$result['success'] = true;
			$result['title'] = DB_TITLE_UPDATE;
			$result['message'] = DB_SUCCESS_UPDATE;
		} else {
			$result['success'] = false;
			$result['title'] = DB_TITLE_UPDATE;
			$result['message'] = $dbResponse['message'];
		}
		return $result;
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function getPrivilegesData($params)
	 {
		$this->dbCms->select('pv.id, pv.id_user_type, pv.name, pv.default_menu, pv.status, pv.entry_time, pv.update_time');
		$this->dbCms->select('(SELECT username FROM '.$this->tableUser.' WHERE id = pv.entry_by AND status = 1) AS entry_by');
		$this->dbCms->select('(SELECT username FROM '.$this->tableUser.' WHERE id = pv.update_by AND status = 1) AS update_by');
		$this->dbCms->from($this->tablePrivileges . ' pv');
		$this->dbCms->where('pv.id', $this->dbCms->escape_str($params['id']));
		$query = $this->dbCms->get();
		$result = array();
		if($query->num_rows() != 0)
		{
			$result['count'] = true;
			foreach($query->result_array() as $row) 
			{
				$result['id'] = $row['id'];
				$result['id_user_type'] = $row['id_user_type'];
				$result['name'] = $row['name'];
				$result['default_menu'] = (int) $row['default_menu'];
				$result['status'] = (int) $row['status'];
				$result['entry_time'] = $row['entry_time'];
				$result['entry_by'] = $row['entry_by'];
				$result['update_time'] = $row['update_time'];
				$result['update_by'] = $row['update_by'];
			}
		} else 
		{
			$result['count'] = false;
			$result['title'] = DB_TITLE_RESULT;
			$result['message'] = DB_NULL_RESULT;
		}
		return $result;
	 }

	/*-------------------------------------------------------------------------------------------------*/


	

 }

/* End of file model_privilege.php */
/* Location: ./application/models/model_privilege.php */