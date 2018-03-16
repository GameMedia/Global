<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_employees extends MY_Model 
{
	private $tableEmployees		='cms_employee';
	private $tableUser			='cms_user';
	private $tableUserType		='cms_user_type';
	private $tablePrivilege		='cms_privilege';
	/*-------------------------------------------------------------------------------------------------*/
	public function __construct()
	{
		parent::__construct();
		$this->loadDbCms();		
	}
	/*-------------------------------------------------------------------------------------------------*/
	public function loadEmployees($params)
	{
		$result= array();
		$columnOrder= array(
						'1' => 'us.id_user_type',
						'2' => 'pv.id',
						'3' => 'em.name',
						'4'	=> 'em.email',
						'5' => 'em.phone',
						'6' => 'em.status');

		#select count data untuk hitung total
		$this->dbCms->select(' COUNT(1) AS count ');
		$this->dbCms->from($this->tableEmployees.' em');
		$this->dbCms->join($this->tableUser.' us', 'us.id_employee = em.id');
		$this->dbCms->join($this->tableUserType.' ut', 'us.id_user_type = ut.id');
		$this->dbCms->join($this->tablePrivilege.' pv', 'us.id_privilege = pv.id');

		if(!empty($params['search_name']))
			$this->dbCms->where("em.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");

		if(!empty($params['search_id_user_type']))
			$this->dbCms->where("us.id_user_type LIKE '%".$this->dbCms->escape_str($params['search_id_user_type'])."%'");

		if(!empty($params['search_id_privilege']))
			$this->dbCms->where("pv.id LIKE '%".$this->dbCms->escape_str($params['search_id_privilege'])."%'");

		if(!empty($params['search_phone']))
			$this->dbCms->where("em.phone LIKE '%".$this->dbCms->escape_str($params['search_phone'])."%'");

		if(!empty($params['search_email']))
			$this->dbCms->where("em.email LIKE '%".$this->dbCms->escape_str($params['search_email'])."%'");

		if(isset($params['search_status']) && $params['search_status'] != "")
			$this->dbCms->where("em.status", $this->dbCms->escape_str($params['search_status']));
		
		#data tidak di hapus
		$this->dbCms->where("em.status !=", "-1");
		$query = $this->dbCms->get();
		$result['total']= 0;
		foreach ($query->result_array() as $row) 
			$result['total'] = $row['count'];

		#select main data
		$this->dbCms->select('em.id, em.name, em.status, em.email, em.phone, em.entry_time, em.update_time');
		$this->dbCms->select('us.username AS username');
		$this->dbCms->select('ut.name AS name_user_type');
		$this->dbCms->select('pv.name AS name_privilege');
		$this->dbCms->from($this->tableEmployees.' em');
		$this->dbCms->join($this->tableUser.' us', 'us.id_employee = em.id');
		$this->dbCms->join($this->tableUserType.' ut','us.id_user_type = ut.id');
		$this->dbCms->join($this->tablePrivilege.' pv','us.id_privilege = pv.id');

		if(!empty($params['search_name']))
			$this->dbCms->where("em.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");

		if(!empty($params['search_id_user_type']))
			$this->dbCms->where("us.id_user_type LIKE '%".$this->dbCms->escape_str($params['search_id_user_type'])."%'");

		if(!empty($params['search_id_privilege']))
			$this->dbCms->where("pv.id LIKE '%".$this->dbCms->escape_str($params['search_id_privilege'])."%'");

		if(!empty($params['search_phone']))
			$this->dbCms->where("em.phone LIKE '%".$this->dbCms->escape_str($params['search_phone'])."%'");

		if(!empty($params['search_email']))
			$this->dbCms->where("em.email LIKE '%".$this->dbCms->escape_str($params['search_email'])."%'");

		if(isset($params['search_status']) && $params['search_status'] != "")
			$this->dbCms->where("em.status", $this->dbCms->escape_str($params['search_status']));

		#data main yg tidak dihapus
		$this->dbCms->where("em.status !=","-1");
		$this->dbCms->limit($params['length'], $params['start']);

		#order params dari datatable
		$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);
		$query = $this->dbCms->get();

		$i=0;
		if($query->num_rows() != 0)
	 	 {
			$result['count'] = true;
			foreach($query->result_array() as $row) 
			{
				$result['rows'][$i]['id'] = $row['id'];
				$result['rows'][$i]['name'] = $row['name'];
				$result['rows'][$i]['username'] = $row['username'];
				$result['rows'][$i]['name_user_type'] = $row['name_user_type'];
				$result['rows'][$i]['name_privilege'] = $row['name_privilege'];
				$result['rows'][$i]['email'] = $row['email'];
				$result['rows'][$i]['phone'] = $row['phone'];
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
	public function getEmployeesData($params){
		$this->dbCms->select('e.id, u.id_user_type, u.id_privilege, e.name, e.address, e.email, e.phone, e.status, u.username, e.entry_time, e.update_time');
		$this->dbCms->select('(SELECT username FROM '.$this->tableUser.' WHERE id = e.entry_by AND status = 1) AS entry_by');
		$this->dbCms->select('(SELECT username FROM '.$this->tableUser.' WHERE id = e.update_by AND status = 1) AS update_by');
		$this->dbCms->from($this->tableEmployees.' e');
		$this->dbCms->join($this->tableUser.' u', 'e.id = u.id_employee');
		$this->dbCms->where('e.id', $this->dbCms->escape_str($params['id']));
		$query = $this->dbCms->get();
		$result = array();
		if($query->num_rows() != 0){
			$result['count'] = true;
			foreach($query->result_array() as $row) {
				$result['id'] = $row['id'];
				$result['id_user_type'] = $row['id_user_type'];
				$result['id_privilege'] = $row['id_privilege'];
				$result['name'] = $row['name'];
				$result['address'] = $row['address'];
				$result['email'] = $row['email'];
				$result['phone'] = $row['phone'];
				$result['username'] = $row['username'];
				$result['status'] = (int) $row['status'];
				$result['entry_time'] = $row['entry_time'];
				$result['entry_by'] = $row['entry_by'];
				$result['update_time'] = $row['update_time'];
				$result['update_by'] = $row['update_by'];
			}
		} else {
			$result['count'] = false;
			$result['title'] = DB_TITLE_RESULT;
			$result['message'] = DB_NULL_RESULT;
		}
		return $result;
	}
	/*-------------------------------------------------------------------------------------------------*/
}

/* End of file model_Employees.php */
/* Location: ./application/models/model_Employees.php */