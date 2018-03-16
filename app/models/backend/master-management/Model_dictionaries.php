<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dictionaries extends MY_Model {

	private $tabledt	= 'dictionaries';
	private $tableco	= 'countries';

	public function __construct()
	 {
		parent::__construct();
		$this->loadDbCms();
	 }
	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadDictionaries($params)
	 {
		$result = array();
		$columnOrder = array(
						'1' => 'dt.id_country',
						'2' => 'dt.device',
						'3' => 'dt.code',
						'4' => 'dt.value',
						'5' => 'dt.status');
		
		//count data
		$this->dbCms->select(' COUNT(1) AS count');
		$this->dbCms->from($this->tabledt . ' dt');
		$this->dbCms->join($this->tableco . ' co', 'dt.id_country = co.id');
		//search filter
		if(!empty($params['search_id_country']))
			$this->dbCms->where("dt.id_country", $this->dbCms->escape_str($params['search_id_country']));
		if(!empty($params['search_device']))
			$this->dbCms->where("dt.device", $this->dbCms->escape_str($params['search_device']));
		if(!empty($params['search_code']))
			$this->dbCms->where("dt.code LIKE '%".$this->dbCms->escape_str($params['search_code'])."%'");
		if(!empty($params['search_value']))
			$this->dbCms->where("dt.value LIKE '%".$this->dbCms->escape_str($params['search_value'])."%'");
		if(isset($params['search_status']) && $params['search_status'] != "")
			$this->dbCms->where("dt.status", $this->dbCms->escape_str($params['search_status']));
		//data not deleted
		$this->dbCms->where("dt.status !=", "-1");
	
		$query = $this->dbCms->get();
		$result['total'] = 0;
		foreach ($query->result_array() as $row ) 
			$result['total'] = $row['count'];
		

		//Main Data
		$this->dbCms->select('dt.id, dt.id_country, dt.device, dt.code, dt.value, dt.status, dt.entry_time, dt.update_time');
		$this->dbCms->select('co.name as name_country');
		$this->dbCms->from($this->tabledt. ' dt');
		$this->dbCms->join($this->tableco. ' co', 'dt.id_country = co.id');
		//search filter
		if(!empty($params['search_id_country']))
			$this->dbCms->where("dt.id_country", $this->dbCms->escape_str($params['search_id_country']));
		if(!empty($params['search_device']))
			$this->dbCms->where("dt.device", $this->dbCms->escape_str($params['search_device']));
		if(!empty($params['search_code']))
			$this->dbCms->where("dt.code LIKE '%".$this->dbCms->escape_str($params['search_code'])."%'");
		if(!empty($params['search_value']))
			$this->dbCms->where("dt.value LIKE '%".$this->dbCms->escape_str($params['search_value'])."%'");
		if(isset($params['search_status']) && $params['search_status'] != "")
			$this->dbCms->where("dt.status", $this->dbCms->escape_str($params['search_status']));
		//data not deleted 
		$this->dbCms->where("dt.status !=", "-1");
		$this->dbCms->limit($params['length'], $params['start']);
		//order by params from datatable
		$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);
		$query = $this->dbCms->get();

		$i = 0;
		if($query && $query->num_rows() !=0)
		{
			$result['count'] =  true;
			foreach ($query->result_array() as $row) 
			{	
				$result['rows'][$i]['id'] = $row['id'];
				$result['rows'][$i]['name_country'] = $row['name_country'];
				$result['rows'][$i]['device'] = $row['device'];
				$result['rows'][$i]['code'] = $row['code'];
				$result['rows'][$i]['value'] = $row['value'];
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
	public function loadDictionariesSelect($params)
	 {
	 	$result = array();
	 	$this->dbCms->select('code, value');
	 	$this->dbCms->from($this->tabledt);

	 	if(isset($params['id_country']))
	 		$this->dbCms->where('id_country', $params['id_country']);

	 	$query = $this->dbCms->get();
	 	$i = 0;
	 	if($query->num_rows() !=0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['rows'][$i]['code'] = $row['code'];
	 			$result['rows'][$i]['value'] = $row['value'];
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
	public function getDictionariesData($params)
	 {
	 	$this->dbCms->select('id, id_country, device, code, value, status, entry_by, entry_time, update_by, update_time');
	 	$this->dbCms->from($this->tabledt);
	 	$this->dbCms->where('id', $this->dbCms->escape_str($params['id']));

	 	$query = $this->dbCms->get();
	 	$result = array();
	 	if($query->num_rows() != 0)
	 	{
	 		$result['count'] = true;
	 		$i=0;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['id'] = $row['id'];
	 			$result['id_country'] = $row['id_country'];
	 			$result['device'] = $row['device'];
	 			$result['code'] = $row['code'];
	 			$result['value'] = $row['value'];
	 			$result['status'] = $row['status'];
	 			$result['entry_by'] = $row['entry_by'];
	 			$result['entry_time'] = $row['entry_time'];
	 			$result['update_by'] = $row['update_by'];
	 			$result['update_time'] = $row['update_time'];
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


	/*-------------------------------------------------------------------------------------------------*/ 

}

/* End of file model_dictionaries.php */
/* Location: ./application/models/model_dictionaries.php */
/* Muhammad Iqbal */