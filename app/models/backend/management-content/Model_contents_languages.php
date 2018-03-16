<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_contents_languages extends MY_Model {

	private $tableLanguage = 'contents_languages';
	private $tableContent = 'contents';
	private $tableCountry = 'countries';

	public function __construct()
	{
		parent::__construct();
		$this->loadDbCms();
	}
	
	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadLanguages($params)
	 {
	 	$result = array();
	 	$columnOrder = array(
	 					'1' => 'co.id', //content id
	 					'2' => 'cu.id', //country id
	 					'3' => 'l.name',
	 					'4' => 'l.status');
	 	//count data
	 	$this->dbCms->select('COUNT(1) AS count');
	 	$this->dbCms->from($this->tableLanguage.' l');
	 	$this->dbCms->from($this->tableContent.' co');
	 	$this->dbCms->from($this->tableCountry.' cu');

	 	if(!empty($params['search_id_content']))
	 		$this->dbCms->where("co.id LIKE '%". $this->dbCms->escape_str($params['search_id_content'])."%'");
	 	if(!empty($params['search_id_country']))
	 		$this->dbCms->where("cu.id LIKE '%". $this->dbCms->escape_str($params['search_id_country'])."%'");
	 	if(!empty($params['search_name']))
	 		$this->dbCms->where("l.name", $this->dbCms->escape_str($params['search_name'])."%'");

	 	//count data not deleted
	 	$this->dbCms->where("l.status !=", "-1");
	 	$query = $this->dbCms->get();
	 	$result['total'] = 0;
	 	foreach ($query->result_array() as $row) 
	 	{
	 		$result['total'] = $row['count'];
	 	}

	 	//main data
	 	$this->dbCms->select('l.name, l.status, l.entry_time, l.update_time');
	 	$this->dbCms->select('co.name AS name_content');
	 	$this->dbCms->select('cu.name AS name_country');
	 	$this->dbCms->from($this->tableLanguage.' l');
	 	$this->dbCms->join($this->tableContent.' co','l.id_content = co.id');
	 	$this->dbCms->join($this->tableCountry.' cu','l.id_country = cu.id');

	 	if(!empty($params['search_id_content']))
	 		$this->dbCms->where("co.id LIKE '%". $this->dbCms->escape_str($params['search_id_content'])."%'");
	 	if(!empty($params['search_id_country']))
	 		$this->dbCms->where("cu.id LIKE '%". $this->dbCms->escape_str($params['search_id_country'])."%'");
	 	if(!empty($params['search_name']))
	 		$this->dbCms->where("l.name", $this->dbCms->escape_str($params['search_name'])."%'");

	 	//maindata not deleted
	 	$this->dbCms->where("l.status !=","-1");
	 	$this->dbCms->limit($params['length'], $params['start']);

	 	//order by datatables
	 	$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);
	 	$query = $this->dbCms->get();

	 	$i =0;
	 	if($query->num_rows() != 0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['rows'][$i]['name_content'] = $row['name_content'];
	 			$result['rows'][$i]['name_country'] = $row['name_country'];
	 			$result['rows'][$i]['name'] = $row['name'];
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

	/*-------------------------------------------------------------------------------------------------*/ 

	/*-------------------------------------------------------------------------------------------------*/ 

}

/* End of file model_contents_languages.php */
/* Location: ./application/models/model_contents_languages.php */