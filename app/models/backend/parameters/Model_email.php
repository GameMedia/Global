<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_email extends MY_Model 
{
	private $tableEmail = 'cms_email';

	public function __construct()
	{
		parent::__construct();
		$this->loadDbCms();
	}
	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadEmail($params)
	 {
	 	$result = array();
	 	$columnOrder = array(
	 					'1' => 'e.name',
	 					'2' => 'e.email_user',
	 					'3' => 'e.host',
	 					'4' => 'e.port',
	 					'5' => 'status');
	 	//select count
	 	$this->dbCms->select(' COUNT(1) AS count ');
		$this->dbCms->from($this->tableEmail.' e');


		if(!empty($params['search_name']))
			$this->dbCms->where("e.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
			
		if(!empty($params['search_email_user']))
			$this->dbCms->where("e.email_user LIKE '%".$this->dbCms->escape_str($params['search_email_user'])."%'");
			
		if(!empty($params['search_host']))
			$this->dbCms->where("e.host LIKE '%".$this->dbCms->escape_str($params['search_host'])."%'");
			
		if(!empty($params['search_port']))
			$this->dbCms->where("e.port LIKE '%".$this->dbCms->escape_str($params['search_port'])."%'");
			
		if(isset($params['search_status']) && $params['search_status'] != "")
			$this->dbCms->where("e.status", $this->dbCms->escape_str($params['search_status']));
	 	//cek data yang tidak dihapus
	 	$this->dbCms->where("e.status !=", "-1");
	 	$query = $this->dbCms->get();

	 	$result['total'] = 0;
	 	foreach ($query->result_array() as $row) 
	 		$result['total'] = $row['count'];

	 	//main data
	 	$this->dbCms->select('e.id, e.name, e.email_user, e.host, e.port, e.status');
		$this->dbCms->from($this->tableEmail.' e');
	 	
		if(!empty($params['search_name']))
			$this->dbCms->where("e.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
			
		if(!empty($params['search_email_user']))
			$this->dbCms->where("e.email_user LIKE '%".$this->dbCms->escape_str($params['search_email_user'])."%'");
			
		if(!empty($params['search_host']))
			$this->dbCms->where("e.host LIKE '%".$this->dbCms->escape_str($params['search_host'])."%'");
			
		if(!empty($params['search_port']))
			$this->dbCms->where("e.port LIKE '%".$this->dbCms->escape_str($params['search_port'])."%'");
			
		if(isset($params['search_status']) && $params['search_status'] != "")
			$this->dbCms->where("e.status", $this->dbCms->escape_str($params['search_status']));
	 	//cek data not delete
	 	$this->dbCms->where("e.status !=", "-1");
	 	//limit params
	 	$this->dbCms->limit($params['length'], $params['start']);
	 	//order by params from datatable
	 	$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);

	 	$query = $this->dbCms->get();
	 	$i=0;
	 	if($query->num_rows() != 0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['rows'][$i]['id'] = $row['id'];
	 			$result['rows'][$i]['name'] = $row['name'];
	 			$result['rows'][$i]['email_user'] = $row['email_user'];
	 			$result['rows'][$i]['host'] = $row['host'];
	 			$result['rows'][$i]['port'] = $row['port'];
	 			$result['rows'][$i]['status']= $row['status'];
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
	public function getEmailData($params)
	 {
	 	$this->dbCms->select('id, name, email_user, email_pass, host, port, status');
	 	$this->dbCms->from($this->tableEmail);
	 	$this->dbCms->where('id', $this->dbCms->escape_str($params['id']));
	 	$query = $this->dbCms->get();
	 	$result = array();

	 	if($query->num_rows() != 0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
		 		$result['id'] = $row['id'];
		 		$result['name'] = $row['name'];
		 		$result['email_user'] = $row['email_user'];
		 		$result['email_pass'] = $row['email_pass'];
		 		$result['host'] = $row['host'];
		 		$result['port'] = $row['port'];
		 		$result['status'] = (int) $row['status'];
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
	public function loadEmailSelect($params = array())
	 {
	 	$result = array();
	 	$this->dbCms->select('id, name');
	 	$this->dbCms->from($this->tableEmail);
	 	$this->dbCms->where('status', '1');
	 	$this->dbCms->order_by('name', 'ASC');

	 	if(isset($params['id_query']))
	 		$this->dbCms->where('id_user_type', $params['id_query']);
	 	$query = $this->dbCms->get();
	 	$i=0;
	 	if($query->num_rows() != 0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
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

}

/* End of file model_email.php */
/* Location: ./application/models/model_email.php */