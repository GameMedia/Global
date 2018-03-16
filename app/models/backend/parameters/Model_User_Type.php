<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_user_type extends MY_Model 
{

	private $tableUser_Type = 'cms_user_type';
	private $tableUser = 'cms_user';

	/*-------------------------------------------------------------------------------------------------*/ 
	public function __construct () 
	{
		parent::__construct();	
		$this->loadDbCms();
	}

	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadUser_Type($params)
	 {
		$result = array();
		
		$columnOrder = array(
							'1' => 'name',
							'2' => 'isAdmin',
							'3' => 'status'
							);
		
		#Select Count Data
		$this->dbCms->select(' COUNT(1) AS count ');
		$this->dbCms->from($this->tableUser_Type);
		
		if(!empty($params['search_name']))
			$this->dbCms->where("name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
			
		if(!empty($params['search_isAdmin']))
			$this->dbCms->where("isAdmin", $this->dbCms->escape_str($params['search_isAdmin']));
			
		if(!empty($params['search_status']))
			$this->dbCms->where("status", $this->dbCms->escape_str($params['search_status']));
		
		#Where data not deleted	
		$this->dbCms->where("status !=", "-1");
		
		$query = $this->dbCms->get();
		
		$result['total'] = 0;
		foreach($query->result_array() as $row)
			$result['total'] = $row['count'];
				
		#Select Main Data
		$this->dbCms->select('id, name, isAdmin, status');
		$this->dbCms->from($this->tableUser_Type);
		
		if(!empty($params['search_name']))
			$this->dbCms->where("name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
			
		if(!empty($params['search_isAdmin']))
			$this->dbCms->where("isAdmin", $this->dbCms->escape_str($params['search_isAdmin']));
			
		if(!empty($params['search_status']))
			$this->dbCms->where("status", $this->dbCms->escape_str($params['search_status']));		
			
		#Where data not deleted	
		$this->dbCms->where("status !=", "-1");
		
		#Limit By Params
		$this->dbCms->limit($params['length'], $params['start']);
		
		#Order By Params from Datatables
		$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);
		$query = $this->dbCms->get();
				
		$i=0;
		if($query->num_rows() != 0){
			$result['count'] = true;
			foreach($query->result_array() as $row) {
				$result['rows'][$i]['id'] = $row['id'];
				$result['rows'][$i]['name'] = $row['name'];
				$result['rows'][$i]['isAdmin'] = $row['isAdmin'];
				$result['rows'][$i]['status'] = $row['status'];
				$i++;
			}
		} else {
			$result['count'] = false;
			$result['message'] = DB_NULL_RESULT;
		}
		return $result;
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadUser_TypeSelect()
	 {
		$result = array();
				
		$this->dbCms->select('id, name');
		$this->dbCms->from($this->tableUser_Type);
		$this->dbCms->where('status', '1');
		$this->dbCms->order_by('name', 'ASC');
		$query = $this->dbCms->get();
		$i=0;
		if($query->num_rows() != 0){
			$result['count'] = true;
			foreach($query->result_array() as $row) {
				$result['rows'][$i]['id'] = $row['id'];
				$result['rows'][$i]['name'] = $row['name'];
				$i++;
			}
		} else {
			$result['count'] = false;
			$result['title'] = DB_TITLE_RESULT;
			$result['message'] = DB_NULL_RESULT;
		}
		return $result;
	 }
	
	/*-------------------------------------------------------------------------------------------------*/ 
	public function getUser_TypeData($params)
	 {
		$this->dbCms->select('id, name, isAdmin, status, entry_time, update_time');
		$this->dbCms->select('(SELECT username FROM '.$this->tableUser.' WHERE id = ut.entry_by AND status = 1) AS entry_by');
		$this->dbCms->select('(SELECT username FROM '.$this->tableUser.' WHERE id = ut.update_by AND status = 1) AS update_by');
		$this->dbCms->from($this->tableUser_Type . ' ut');
		$this->dbCms->where('id', $this->dbCms->escape_str($params['id']));
		$query = $this->dbCms->get();
		$result = array();
		if($query->num_rows() != 0){
			$result['count'] = true;
			foreach($query->result_array() as $row) {
				$result['id'] = $row['id'];
				$result['name'] = $row['name'];
				$result['isAdmin'] = (int) $row['isAdmin'];
				$result['status'] = (int) $row['status'];
				$result['entry_by'] = $row['entry_by'];
				$result['entry_time'] = $row['entry_time'];
				$result['update_by'] = $row['update_by'];
				$result['update_time'] = $row['update_time'];
			}
		} else {
			$result['count'] = false;
			$result['title'] = DB_TITLE_RESULT;
			$result['message'] = DB_NULL_RESULT;
		}
		return $result;
	 }
	 
}
?>
