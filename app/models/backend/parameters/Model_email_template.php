<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_email_template extends MY_Model
{
	private $tableEmail = 'cms_email';
	private $tableEmail_Template = 'cms_email_template';

	public function __construct()
	 {
		parent::__construct();
		$this->loadDbcms();
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function loadEmail_Template($params)
	 {
	 	$result = array();
	 	$columnOrder = array(
	 						'1' => 'name_email',
	 						'2' => 'et.code',
	 						'3' => 'et.name',
	 						'4' => 'et.title',
	 						'5' => 'et.status');

	 	//select count data
	 	$this->dbCms->select(' COUNT(1) AS count ');
	 	$this->dbCms->from($this->tableEmail_Template.' et');
	 	$this->dbCms->join($this->tableEmail.' e', 'et.id_email=e.id');

	 	if(!empty($params['search_name']))
	 		$this->dbCms->where("et.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");

	 	if(!empty($params['search_id_email']))
	 		$this->dbCms->where("e.id LIKE '%".$this->dbCms->escape_str($params['search_id_email'])."%'");

	 	if(!empty($params['search_code']))
	 		$this->dbCms->where("et.code LIKE '%".$this->dbCms->escape_str($params['search_code'])."%'");

	 	if(!empty($params['search_title']))
	 		$this->dbCms->where("et.title LIKE '%".$this->dbCms->escape_str($params['search_title'])."%'");

	 	if(isset($params['search_status']) && $params['search_status'] !="")
	 		$this->dbCms->where("et.status", $this->dbCms->escape_str($params['search_status'])."%'");

	 	//data yg tidak dihapus
	 	$this->dbCms->where("et.status !=", "-1");
	 	$this->dbCms->where("e.status !=", "-1");

	 	$query = $this->dbCms->get();
	 	$result['total'] = 0;
	 	foreach ($query->result_array() as $row) 
	 	{
	 		$result['total'] = $row['count'];
	 	}

	 	//main data
	 	$this->dbCms->select('et.id, et.name, e.name AS name_email, et.code, et.title, et.status');
	 	$this->dbCms->from($this->tableEmail_Template.' et');
	 	$this->dbCms->join($this->tableEmail.' e', 'et.id_email=e.id');

	 	
	 	if(!empty($params['search_name']))
	 		$this->dbCms->where("et.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");

	 	if(!empty($params['search_id_email']))
	 		$this->dbCms->where("e.id LIKE '%".$this->dbCms->escape_str($params['search_id_email'])."%'");

	 	if(!empty($params['search_code']))
	 		$this->dbCms->where("et.code LIKE '%".$this->dbCms->escape_str($params['search_code'])."%'");

	 	if(!empty($params['search_title']))
	 		$this->dbCms->where("et.title LIKE '%".$this->dbCms->escape_str($params['search_title'])."%'");

	 	if(isset($params['search_status']) && $params['search_status'] !="")
	 		$this->dbCms->where("et.status", $this->dbCms->escape_str($params['search_status'])."%'");

	 	//data yg tidak dihapus
	 	$this->dbCms->where("et.status !=", "-1");
	 	$this->dbCms->where("e.status !=", "-1");

	 	//limit params
	 	$this->dbCms->limit($params['length'], $params['start']);

	 	//order params from datatable
	 	$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);
		$query = $this->dbCms->get();

		$i=0;
		if($query->num_rows() != 0)
		{
			$result['count'] = true;
			foreach ($query->result_array() as $row) 
			{
				$result['rows'][$i]['id']	= $row['id'];
				$result['rows'][$i]['name']	= $row['name'];
				$result['rows'][$i]['name_email'] = $row['name_email'];
				$result['rows'][$i]['title'] = $row['title'];
				$result['rows'][$i]['code'] = $row['code'];
				$result['rows'][$i]['status'] = $row['status'];
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
	public function getEmail_TemplateData($params)
	 {
	 	$this->dbCms->select('id, name, id_email, code, title, content, status');
	 	$this->dbCms->from($this->tableEmail_Template);
	 	$this->dbCms->where('id', $this->dbCms->escape_str($params['id']));
	 	$query = $this->dbCms->get();
	 	$result = array();
	 	if($query->num_rows() !=0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['id'] = $row['id'];
	 			$result['name'] = $row['name'];
	 			$result['code'] = $row['code'];
	 			$result['title'] = $row['title'];
	 			$result['content'] = html_entity_decode(htmlspecialchars_decode($row['content']));
	 			$result['id_email'] = $row['id_email'];
	 			$result['status'] = (int) $row['status'];
	 		}
	 	} else
	 	{
	 		$result['count'] = false;
	 		$result['title'] = DB_TITLE_RESULT;
	 		$result['message'] = DB_NULL_RESUL;
	 	}
	 	return $result;
	 }
	 
	/*-------------------------------------------------------------------------------------------------*/
	public function loadEmail_TemplateSelect($params)
	 {
	 	$result = array();

	 	$this->dbCms->select('id, name');
	 	$this->dbCms->from($this->tableEmail_Template);
	 	$this->dbCms->where('status','1');
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


	/*-------------------------------------------------------------------------------------------------*/

}

/* End of file model_email_template.php */
/* Location: ./application/models/model_email_template.php */