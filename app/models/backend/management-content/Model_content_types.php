<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_content_types extends MY_Model {

	private $tableContent_Types = 'contents_types';

	public function __construct()
	 {
		parent::__construct();
		$this->loadDbCms();
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function loadContent_Types($params)
	 {
	 	$result = array();
	 	$columnOrder = array(
	 						'1' => 'code',
	 						'2' => 'name',
	 						'4' => 'status');

	 	//select count data
	 	$this->dbCms->select(' COUNT(1) AS count ');
	 	$this->dbCms->from($this->tableContent_Types);

	 	if(!empty($params['search_name']))
			$this->dbCms->where("name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");

	 	if(!empty($params['search_code']))
			$this->dbCms->where("code LIKE '%".$this->dbCms->escape_str($params['search_code'])."%'");

	 	if(!empty($params['search_description']))
			$this->dbCms->where("description", $this->dbCms->escape_str($params['search_description']));

	 	if(isset($params['search_status']) && $params['search_status'] != "")
			$this->dbCms->where("status", $this->dbCms->escape_str($params['search_status']));
	 	//data not deleted
	 	$this->dbCms->where("status !=", "-1");
	 	$query = $this->dbCms->get();
	 	$result['total'] = 0;
	 	foreach ($query->result_array() as $row) 
	 		$result['total'] = $row['count'];
	 	

	 	//select Main data
	 	$this->dbCms->select('id, code, name, description, status, entry_time, update_time');
	 	$this->dbCms->from($this->tableContent_Types);

	 	if(!empty($params['search_name']))
	 		$this->dbCms->where("name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");

	 	if(!empty($params['search_code']))
	 		$this->dbCms->where("code LIKE '%",$this->dbCms->escape_str($params['search_code'])."%'");

	 	if(!empty($params['search_description']))
	 		$this->dbCms->where("description", $this->dbCms->escape_str($params['search_description']));

	 	if(isset($params['search_status']) && $params['search_status'] != "")
	 		$this->dbCms->where("status", $this->dbCms->escape_str($params['search_status']));
	 	//data not deleted
	 	$this->dbCms->where("status !=", "-1");
	 	$this->dbCms->limit($params['length'], $params['start']);
	 	//oreder by params from datatables
	 	$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);

	 	$query = $this->dbCms->get();
	 	$i=0;
	 	if($query->num_rows() != 0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['rows'][$i]['id'] = $row['id'];
	 			$result['rows'][$i]['code'] = $row['code'];
	 			$result['rows'][$i]['name'] = $row['name'];
	 			$result['rows'][$i]['description'] = $row['description'];
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
	public function getContent_TypesData($params)
	 {
	 	$this->dbCms->select('ct.id, ct.code, ct.name, ct.description, ct.status, ct.entry_by, ct.entry_time, ct.update_by, ct.update_time');
	 	$this->dbCms->from($this->tableContent_Types.' ct');

	 	if(isset($params['id']))
	 		$this->dbCms->where('ct.id', $this->dbCms->escape_str($params['id']));
	 	if(isset($params['code']))
	 		$this->dbCms->where('ct.code', $this->dbCms->escape_str($params['code']));

	 	$query = $this->dbCms->get();
	 	$result = array();
	 	if($query->num_rows() !=0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['id'] = $row['id'];
				$result['code'] = $row['code'];
				$result['name'] = $row['name'];
				$result['description'] = $row['description'];
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
	public function loadContent_TypesSelect()
	 {
	 	$result = array();

	 	$this->dbCms->select('id, name');
	 	$this->dbCms->from($this->tableContent_Types);
	 	$this->dbCms->where('status', '1');
	 	$this->dbCms->order_by('name', 'ASC');

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

	/*-------------------------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------------------------*/

}

/* End of file model_content_type.php */
/* Location: ./application/models/model_content_type.php */