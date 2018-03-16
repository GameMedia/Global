<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_galleries extends MY_Model {

	private $tableGalleries = 'galleries';
	private $tableContentType = 'contents_types';

	public function __construct()
	 {
		parent::__construct();
		$this->loadDbCms();
	 }

	/*-------------------------------------------------------------------------------------------------*/ 
	public function loadGalleries($params)
	 {
	 	$result = array();
	 	$columnOrder = array(
	 						'1' => 'ct.name',
	 						'2' => 'g.name',
	 						'4' => 'g.status');

	 	//select count data
	 	$this->dbCms->select(' COUNT(1) AS count ');
	 	$this->dbCms->from($this->tableGalleries.' g');
	 	$this->dbCms->join($this->tableContentType.' ct', 'ct.id = g.id_content_type');

	 	if(!empty($params['search_type']))
	 		$this->dbCms->where("ct.id LIKE '%".$this->dbCms->escape_str($params['search_id_content_types'])."%'");
	 	if(!empty($params['search_name']))
	 		$this->dbCms->where("g.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
	 	if(isset($params['search_status']) && $params['search_status'] !="")
	 		$this->dbCms->where("g.status", $this->dbCms->escape_str($params['search_status']));

	 	//data not deleted
	 	$this->dbCms->where("g.status !=", "-1");
	 	$query = $this->dbCms->get();

	 	$result['total'] = 0;
	 	foreach ($query->result_array() as $row) 
	 		$result['total'] = $row['count'];

	 	//main data 
	 	$this->dbCms->select('g.id, g.id_content_type, g.name AS name_galleri, g.url_thumb, g.url_ori, g.status, g.entry_time, g.update_time');
	 	$this->dbCms->select('ct.name AS name_content_type');
	 	$this->dbCms->from($this->tableGalleries.' g');
	 	$this->dbCms->join($this->tableContentType.' ct', 'g.id_content_type = ct.id');

	 	if(!empty($params['search_type']))
	 		$this->dbCms->where("ct.id LIKE '%".$this->dbCms->escape_str($params['search_id_content_type'])."%'");
	 	if(!empty($params['search_name']))
	 		$this->dbCms->where("g.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
	 	if(isset($params['search_status']) && $params['search_status'] !="")
	 		$this->dbCms->where("g.status", $this->dbCms->escape_str($params['search_status']));
		
		//data not deleted
		$this->dbCms->where("g.status !=", "-1");
		$this->dbCms->limit($params['length'], $params['start']);
		
		//order by params from datatable
		$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);
		$query = $this->dbCms->get();

		$i=0;
		if($query->num_rows() !=0)
		{
			$result['count'] = true;
			foreach ($query->result_array() as $row) 
			{
					$result['rows'][$i]['id'] = $row['id'];
					$result['rows'][$i]['name_content_type'] = $row['name_content_type'];
					$result['rows'][$i]['name_galleri'] = $row['name_galleri'];
					$result['rows'][$i]['url_ori'] = $row['url_ori'];
					$result['rows'][$i]['url_thumb'] = $row['url_thumb'];
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
	public function getGalleriesData($params)
	 {
	 	$this->dbCms->select('id, id_reference, id_content_type, name, description, path, url_ori, url_thumb, mime_type, status, entry_by, entry_time, update_by, update_time');
	 	$this->dbCms->from($this->tableGalleries);
	 	$this->dbCms->where('id', $this->dbCms->escape_str($params['id']));
	 	$query = $this->dbCms->get();
	 	$result = array();
	 	if($query->num_rows() != 0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['id'] = $row['id'];
	 			$result['id_reference'] = $row['id_reference'];
	 			$result['id_content_type'] = $row['id_content_type'];
	 			$result['name'] = $row['name'];
	 			$result['description'] = $row['description'];
	 			$result['path'] = $row['path'];
	 			$result['url_ori'] = $row['url_ori'];
	 			$result['url_thumb'] = $row['url_thumb'];
	 			$result['mime_type'] = $row['mime_type'];
	 			$result['status'] = (int) $row['status'];
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

	/*-------------------------------------------------------------------------------------------------* 
	public function loadGalleriesSelect($params = array())
	 {
 	
     }

	/*-------------------------------------------------------------------------------------------------*/ 


	/*-------------------------------------------------------------------------------------------------*/ 
	

}

/* End of file model_galleries.php */
/* Location: ./application/models/model_galleries.php */