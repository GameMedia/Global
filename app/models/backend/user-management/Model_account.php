<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_account extends MY_Model {

	private $tableUser 			= 'cms_user';
	private $tableEmployees 	= 'cms_employee';
	
	public function __construct () 
	 {
		parent::__construct();
		$this->loadDbCms();
		$this->loadDbPlatform();
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function loadAccountSelect()
	 {
		$result = array();		
		$this->dbCms->select('id, name');
		$this->dbCms->from($this->tableAccount);
		$this->dbCms->where('status', '1');
		$this->dbCms->order_by('name', 'ASC');
		$query = $this->dbCms->get();
		$i=0;
		if($query->num_rows() != 0)
		{
			$result['count'] = true;
			foreach($query->result_array() as $row) 
			{
				$result['rows'][$i]['id'] 	= $row['id'];
				$result['rows'][$i]['name'] = $row['name'];
				$i++;
			}
		} else 
		{
			$result['count'] 	= false;
			$result['title'] 	= DB_TITLE_RESULT;
			$result['message'] 	= DB_NULL_RESULT;
		}
		return $result;
	 }
	/*-------------------------------------------------------------------------------------------------*/
	public function saveAccount($params)
	 {
		$this->dbCms->select('id');
		$this->dbCms->from($this->tableAccount);
		$this->dbCms->where('id', $this->dbCms->escape_str($params['id']));
		$data = $this->dbCms->get();
		if($data->num_rows() != 0)
		{
			$result = true;	
		} else 
			$result = false;
		return $result;
	 }
	/*-------------------------------------------------------------------------------------------------*/

	public function updateAccount($params)
	 {
		$update_by = $this->profile['id'];
		$update_time = date('Y-m-d H:i:s');
		$update = array(
						'name' 			=> $this->dbCms->escape_str($params['name']),
						'isAdmin' 		=> $this->dbCms->escape_str($params['isAdmin']),
						'status'		=> $this->dbCms->escape_str($params['status']),
						'update_by' 	=> $this->dbCms->escape_str($update_by),
						'update_time'	=> $this->dbCms->escape_str($update_time)
					   );
		$this->dbCms->where('id', $this->dbCms->escape_str($params['id']));
		$this->dbCms->update($this->tableAccount, $update);
		$result = array();
		$dbResponse = $this->dbCms->error();		
		if($dbResponse['code'] == 0)
		{
			$result['success'] = true;
			$result['title'] = DB_TITLE_UPDATE;
			$result['message'] = DB_SUCCESS_UPDATE;
		} else 
		{
			$result['success'] = false;
			$result['title'] = DB_TITLE_UPDATE;
			$result['message'] = $dbResponse['message'];
		}	
		return $result;
	 } 
	/*-------------------------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------------------------*/
}

/* End of file model_account.php */
/* Location: ./application/models/model_account.php */