<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_global_parameters extends MY_Model {

	private $tableGlobal_Parameter = 'cms_global_parameter';
	private $tableUser = 'cms_user';

	public function __construct()
	 {
		parent::__construct();
		$this->loadDbCms();
	 }
	
	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadGlobal_Parameter($params)
	 {
	 	$result = array();
	 	$columnOrder = array( 
	 					'1' => 'id', 
	 					'2' => 'value');

	 	//select count data
	 	$this->dbCms->select('COUNT(1) AS count');
	 	$this->dbCms->from($this->tableGlobal_Parameter);

	 	if(!empty($params['search_value']))
	 		$this->dbCms->where("value LIKE '%".$this->dbCms->escape_str($params['search_value'])."%'");

	 	if(!empty($params['search_id']))
	 		$this->dbCms->where("id LIKE '%".$this->dbCms->escape_str($params['search_value'])."%'");

	 	$query = $this->dbCms->get();
	 	$result['total'] = 0;
	 	foreach ($query->result_array() as $row) 
	 	 {
	 		$result['total'] = $row['count'];
	 	 }

	 	//select main data
	 	$this->dbCms->select('id, value, description');
	 	$this->dbCms->from($this->tableGlobal_Parameter);

	 	if(!empty($params['search_value']))
	 		$this->dbCms->where("value LIKE '%".$this->dbCms->escape_str($params['search_value'])."%.'");

	 	if(!empty($params['search_id']))
	 		$this->dbCms->wheere("id LIKE'%".$this->dbCms->escape_str($params['search_value'])."%'");

	 	$this->dbCms->limit($params['length'], $params['start']);
	 	$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);
	 	$query = $this->dbCms->get();

	 	$i=0;
	 	if($query->num_rows() !=0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['rows'][$i]['id'] = $row['id'];
	 			$result['rows'][$i]['value'] = $row['value'];
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
	public function getGlobal_ParameterData($params)
	 {
	 	$this->dbCms->select('id, value, description, entry_time, update_time');
	 	$this->dbCms->select('(SELECT username FROM '.$this->tableUser.' WHERE id = gp.entry_by AND status = 1) AS entry_by');
	 	$this->dbCms->select('(SELECT username FROM '.$this->tableUser.' WHERE id = gp.update_by AND status = 1) AS update_by');
	 	$this->dbCms->from($this->tableGlobal_Parameter . ' gp');
		$this->dbCms->where('id', $this->dbCms->escape_str($params['id']));
		$query = $this->dbCms->get();
		$result = array();
		if($query->num_rows() != 0)
		{
			$result['count'] = true;
			foreach ($query->result_array() as $row ) 
			{
				$result['id'] = $row['id'];
				$result['value'] = $row['value'];
				$result['description'] = $row['description'];
				$result['entry_by'] = $row['entry_by'];
				$result['entry_time'] = $row['entry_time'];
				$result['update_by'] = $row['update_by'];
				$result['update_time'] = $row['update_time'];
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
	public function deleteGlobal_parameter($params)
	 {
	 	$this->dbCms->where('id', $this->dbCms->escape_str($params['id']));
	 	$this->dbCms->delete($this->tableGlobal_Parameter);

	 	$result = array();
	 	$dbResponse = $this->dbCms->error();
	 	if($dbResponse['code'] == 0)
	 	{
	 		$result['success'] = true;
	 		$result['title'] = DB_TITLE_DELETE;
	 		$result['message'] = DB_SUCCESS_DELETE;
	 	} else
	 	{
	 		$result['success'] = false;
	 		$result['title'] = DB_TITLE_DELETE;
	 		$result['message'] = $dbResponse['message'];
	 	}
	 	return $result;
	 }

}

/* End of file model_global_parameter.php */
/* Location: ./application/models/model_global_parameter.php */