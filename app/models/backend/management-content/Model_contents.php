<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_contents extends MY_Model 
 {
 	private $tableContentTypes	= 'contents_types';
 	private $tableGalleries	= 'galleries';
 	private $tableCountries = 'countries';
 	private $tableContents 	= 'contents';

 	/*-------------------------------------------------------------------------------------------------*/ 
 	public function __construct()
 	 {
 		parent::__construct();
 		$this->loadDbCms();
 	 }

 	/*-------------------------------------------------------------------------------------------------*/  
 	public function loadContents($params)
 	 {
 	 	$result = array();
 	 	////////////////////////////////////////////////////short menu
 	 	$columnOrder = array(
 	 					'1' => 'c.id_content_type',
 	 					'2' => 'c.parent',
 	 					'3' => 'c.id_country',
 	 					'4' => 'c.name',
 	 					'6' => 'c.publish_time',
 	 					'7' => 'c.status');

 	 	///////////////////////////////////////////////////select Count Data
 	 	$this->dbCms->select(' COUNT(1) AS count ');
 	 	$this->dbCms->from($this->tableContents.' c');
 	 	$this->dbCms->join($this->tableContentTypes.' ct', 'c.id_content_type = ct.id');
 	 	$this->dbCms->join($this->tableCountries.' cu', 'c.id_country = cu.id');

 	 	if(!empty($params['search_id_content_type'])) //type content
			$this->dbCms->where("c.id_content_type", $this->dbCms->escape_str($params['search_id_content_type']));
		if(!empty($params['search_parent']))  //parent
			$this->dbCms->where("c.parent LIKE '%".$this->dbCms->escape_str($params['search_parent'])."%'");
		if(!empty($params['search_id_country'])) //country
			$this->dbCms->where("c.id_country", $this->dbCms->escape_str($params['search_id_country']));
		if(!empty($params['search_name'])) //name content
			$this->dbCms->where("c.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
		if(!empty($params['search_publish'])) //publish
			$this->dbCms->where("c.publish_time LIKE '%".$this->dbCms->escape_str($params['search_publish_time'])."%'");
		if(isset($params['search_status']) && $params['search_status'] != "") //status
			$this->dbCms->where("c.status", $this->dbCms->escape_str($params['search_status']));

		//data not deleted
		$this->dbCms->where("c.status !=", "-1");
		$this->dbCms->where("ct.status", "1");
		$this->dbCms->where("cu.status", "1");
		$this->dbCms->where("c.parent >","0");

		$query = $this->dbCms->get();
		$result['total'] = 0;
		foreach ($query->result_array() as $row ) 
		{
			$result['total'] = $row['count'];
		}
		
		///////////////////////////////////////////////////////select main data
		$this->dbCms->select('c.id, c.parent, c.code, c.name, c.status, c.publish_time, c.entry_time, c.update_time');
		$this->dbCms->select('ct.name AS name_content_type');
		$this->dbCms->select('cu.code AS code_country');
		$this->dbCms->select('g.url_thumb, g.url_ori');
		$this->dbCms->from($this->tableContents.' c');
		$this->dbCms->join($this->tableContentTypes.' ct', 'c.id_content_type = ct.id');
		$this->dbCms->join($this->tableCountries.' cu', 'c.id_country = cu.id');
		$this->dbCms->join($this->tableGalleries.' g', 'c.id_gallery = g.id');

		if(!empty($params['search_id_content_type'])) //type content
			$this->dbCms->where("c.id_content_type", $this->dbCms->escape_str($params['search_id_content_type']));
		if(!empty($params['search_parent']))  //parent
			$this->dbCms->where("c.parent LIKE '%".$this->dbCms->escape_str($params['search_parent'])."%'");
		if(!empty($params['search_id_country'])) //country
			$this->dbCms->where("c.id_country", $this->dbCms->escape_str($params['search_id_country']));
		if(!empty($params['search_name'])) //name content
			$this->dbCms->where("c.name LIKE '%".$this->dbCms->escape_str($params['search_name'])."%'");
		if(!empty($params['search_publish'])) //publish
			$this->dbCms->where("c.publish_time LIKE '%".$this->dbCms->escape_str($params['search_publish_time'])."%'");
		if(isset($params['search_status']) && $params['search_status'] != "") //status
			$this->dbCms->where("c.status", $this->dbCms->escape_str($params['search_status']));

		//data not deleted
		$this->dbCms->where("c.status !=","-1");
		$this->dbCms->where("ct.status","1");
		$this->dbCms->where("cu.status","1");
		$this->dbCms->where("g.status","1");
		$this->dbCms->where("c.parent >","0");

		$this->dbCms->limit($params['length'], $params['start']);
		//order by params from datatable
		$this->dbCms->order_by($columnOrder[$params['order'][0]['column']], $params['order'][0]['dir']);

		$query = $this->dbCms->get();

		$i = 0;
		if($query->num_rows() != 0)
		{
			$result['count'] = true;
			foreach ($query->result_array() as $row) 
			{
				$result['rows'][$i]['id'] = $row['id'];
				$result['rows'][$i]['name_content_type'] = $row['name_content_type'];
				$result['rows'][$i]['parent'] = $row['parent'];
				$result['rows'][$i]['code_country'] = $row['code_country'];
				$result['rows'][$i]['name'] = $row['name'];
				$result['rows'][$i]['url_ori'] = $row['url_ori'];
				$result['rows'][$i]['url_thumb'] = $row['url_thumb'];
				$result['rows'][$i]['code'] = $row['code'];
				$result['rows'][$i]['publish_time'] = $row['publish_time'];
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
	public function loadContentsSelect($params = array())
	 {
	 	$result = array();

	 	$this->dbCms->select('c.id, c.parent, c.level, c.code, c.name, c.seen, c.publish_time, c.icon, c.status');
	 	$this->dbCms->select('(SELECT COUNT(1) FROM '.$this->tableContents.' WHERE parent = c.id AND status !="-1") AS child');
	 	$this->dbCms->from($this->tableContents.' c');
	 	$this->dbCms->where('c.status !=','-1');

	 	$this->dbCms->order_by('c.name', 'ASC');
	 	$query = $this->dbCms->get();

	 	$i=0;
	 	if($query->num_rows() !=0)
	 	{
	 		$result['count'] = true;
	 		$level =  !empty($params['level'])?$params['level']:0;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['rows'][$level][$i]['id'] = $row['id'];
	 			$result['rows'][$level][$i]['name'] = $row['name'];
	 			$result['rows'][$level][$i]['parent'] = $row['parent'];
	 			$result['rows'][$level][$i]['status'] = $row['status'];
	 			$result['rows'][$level][$i]['level'] = $level;
	 			$result['rows'][$level][$i]['child'] = $row['child'];
	 			$result['rows'][$level][$i]['code'] = $row['code'];
	 			$result['rows'][$level][$i]['seen'] = $row['seen'];
	 			$result['rows'][$level][$i]['publish_time'] = $row['publish_time'];
	 			$result['rows'][$level][$i]['icon'] = $row['icon'];
	 		
	 			if(!empty($row['child']))
	 			{
	 				$result['rows'][$row['id']] = $this->loadChildSelect(array('parent' => $row['id'], 'level' => $level+1), $params);
	 				foreach ($result['rows'][$row['id']] as $key => $val) 
	 				{
	 					if($val['child'])
	 						$result['rows'][$val['id']] = $this->loadChildSelect(array('parent' => $val['id'], 'level' => $level+2), $params);
	 				}
	 			}
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
	public function loadChildSelect($params= array(), $paramsPost = array())
	 {
	 	$result = array();
	 	$this->dbCms->select('c.id, c.parent, c.level, c.code, c.name, c.seen, c.publish_time, c.icon, c.status');
	 	$this->dbCms->select('(SELECT COUNT(1) FROM '.$this->tableContents.' WHERE parent = c.id AND status !="-1") AS child');
	 	$this->dbCms->from($this->tableContents.' c');
	 	$this->dbCms->where('c.status !=','-1');

	 	if($params['parent'] != '')
	 		$this->dbCms->where('c.parent', $this->dbCms->escape_str($params['parent']));

	 	$this->dbCms->order_by('c.name', 'ASC');
	 	$query = $this->dbCms->get();

	 	$i=0;
	 	if($query->num_rows() !=0)
	 	{
	 		$level =  !empty($params['level'])?$params['level']:1;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			$result['rows'][$level][$i]['id'] = $row['id'];
	 			$result['rows'][$level][$i]['name'] = $row['name'];
	 			$result['rows'][$level][$i]['parent'] = $row['parent'];
	 			$result['rows'][$level][$i]['status'] = $row['status'];
	 			$result['rows'][$level][$i]['level'] = $level;
	 			$result['rows'][$level][$i]['child'] = $row['child'];
	 			$result['rows'][$level][$i]['code'] = $row['code'];
	 			$result['rows'][$level][$i]['seen'] = $row['seen'];
	 			$result['rows'][$level][$i]['publish_time'] = $row['publish_time'];
	 			$result['rows'][$level][$i]['icon'] = $row['icon'];
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
	public function getContentData($params)
	 {
	 	$this->dbCms->select('id, id_content_type, id_gallery, id_country, parent, code, name, seen, publish_time, seq, icon, status, entry_by, entry_time, update_by, update_time, short_desc, long_desc, is_icon_show, is_show_image');
	 	$this->dbCms->from($this->tableContents);
	 	$this->dbCms->where('id', $this->dbCms->escape_str($params['id']));
	 	$query = $this->dbCms->get();
	 	$result = array();
	 	if($query->num_rows() !=0)
	 	{
	 		$result['count'] = true;
	 		foreach ($query->result_array() as $row) 
	 		{
	 			foreach ($row as $key => $val) 
	 			{
	 				$result[$key] = $val;
	 			}
	 			$result['short_desc'] = stripslashes($row['short_desc']);
	 			$result['long_desc'] = stripslashes($row['long_desc']);
	 			$result['status'] =(int) $row['status'];
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



 }

/* End of file model_content.php */
/* Location: ./application/models/model_content.php */