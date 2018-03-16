<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_countries extends MY_Model {

	private $tableCountries = 'countries';

	public function __construct()
	 {
		parent::__construct();
		$this->loadDbCms();	
	 }
	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadCountries($params)
	 {
	 	$result = array();
	 	$columnOrder = array(
	 					'1' => 'code',
	 					'2' => 'name',
	 					'3' => 'utc_timezone',
	 					'4' => 'prefix',
	 					'5' => 'status');

	 	$this->dbCms->select(' COUNT(1) AS count');
	 	$this->dbCms->from($this->tableCountries);
	 	if(!empty($params['search_name']))
	 		$this->dbCms->where("name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
	 	if(!empty($params['search_code']))
	 		$this->dbCms->where("code LIKE '%".$this->dbCms->escape_str($params['search_code'])."%'");
	 	if(!empty($params['search_description']))
	 		$this->dbCms->where("desctripiton LIKE '%".$this->dbCms->escape_str($params['search_description'])."%'");
	 	if(isset($params['search_status']) && $params['search_status'] !="")
	 		$this->dbCms->where("status", $this->dbCms->escape_str($params['search_status']));

	 	//data not deleted
	 	$this->dbCms->where("status !=", "-1");

	 	$query = $this->dbCms->get();
	 	$result['total'] = 0;
	 	foreach ($query->result_array() as $row) 
	 	{
	 		$result['total'] = $row['count'];
	 	}

	 	//Main Data
	 	$this->dbCms->select('id, code, name, utc_timezone, prefix, status, entry_time, update_time');
	 	$this->dbCms->from($this->tableCountries);
	 	if(!empty($params['search_name']))
	 		$this->dbCms->where("name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
	 	if(!empty($params['search_code']))
	 		$this->dbCms->where("code LIKE '%".$this->dbCms->escape_str($params['search_code'])."%'");
	 	if(!empty($params['search_description']))
	 		$this->dbCms->where("desctripiton LIKE '%".$this->dbCms->escape_str($params['search_description'])."%'");
	 	if(isset($params['search_status']) && $params['search_status'] !="")
	 		$this->dbCms->where("status", $this->dbCms->escape_str($params['search_status']));

	 	//data not deleted
	 	$this->dbCms->where("status !=", "-1");

	 	$this->dbCms->limit($params['length'], $params['start']);
	 	//order by params from datatables
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
	 			$result['rows'][$i]['utc_timezone'] = $row['utc_timezone'];
	 			$result['rows'][$i]['prefix'] = $row['prefix'];
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
	public function getCountriesData($params)
	 {
	 	$this->dbCms->select('c.id, c.code, c.name, c.description, c.utc_timezone, c.prefix, c.status, c.entry_by, c.entry_time, c.update_by, c.update_time');
	 	$this->dbCms->from($this->tableCountries. ' c');
	 	$this->dbCms->where('c.id', $this->dbCms->escape_str($params['id']));
	 	$query = $this->dbCms->get();
	 	$result = array();
	 	if($query->num_rows() != 0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['id'] = $row['id'];
	 			$result['code'] = $row['code'];
	 			$result['name'] = $row['name'];
	 			$result['description'] = $row['description'];
	 			$result['utc_timezone'] = $row['utc_timezone'];
	 			$result['prefix'] = $row['prefix'];
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
	public function loadCountriesSelect($params = array())
	 {
	 	$result = array();
	 	$this->dbCms->select('id, name, code');
	 	$this->dbCms->from($this->tableCountries);
	 	$this->dbCms->where('status','1');
	 	$this->dbCms->order_by('name', 'ASC');

	 	if(isset($params['id_query']))
	 		$this->dbCms->where('code', $params['id_query']);

	 	if(isset($params['not_id']))
	 		$this->dbCms->where_not_in('id', $params['not_id']);

	 	$query = $this->dbCms->get();
	 	$i=0;
	 	if($query->num_rows() !=0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['rows'][$i]['id'] = $row['id'];
	 			$result['rows'][$i]['name'] = $row['name'];
	 			$result['rows'][$i]['code'] = $row['code'];
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

/* End of file model_countries.php */
/* Location: ./application/models/model_countries.php */
/* muhammad iqbal */