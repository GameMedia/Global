<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_global extends MY_Model 
 {
	public function __construct()
	 {
		parent::__construct();
		$this->loadDbCms();
	 }
	/*-------------------------------------------------------------------------------------------------*/

	#cek status insert/update
	public function checkUI($table, $paramsData=array(), $paramsKey=array(),$db='dbCms')
	 {
	 	foreach ($paramsKey as $key => $value) 
	 	{
	 		$this->$db->select($key);
	 		$this->$db->where($key,$this->$db->escape_str($value));
	 	}
	 	$this->$db->from($table);
	 	$data=$this->$db->get();
	 	if($data->num_rows() != 0)
	 	{
	 		$result=true;
	 	}else
	 	{
	 		$result=false;
	 	}
	 	return $result;
	 }
	/*-------------------------------------------------------------------------------------------------*/

	public function insert($table,$paramsData=array(),$db='dbCms')
	 {
	 	$result= array();
		$input_by= $this->profile['id'];
		$input_time= date('Y-m-d H:i:s');

		$insert= array();
		foreach ($paramsData as $key => $value) 
		{
			if(is_array($value))
			{
				if(!$value[1])
				{
					$insert[$key]= $value[0];
				} else
				{
					$insert[$key]= $this->$db->escape_str($value[0]);
				}
			}else
			{
				$insert[$key]= $this->$db->escape_str($value);
			}
		}
		$insert['entry_by'] = $this->$db->escape_str($input_by);
		$insert['entry_time'] = $this->$db->escape_str($input_time);
		$this->$db->insert($table, $insert);

		$dbResponse = $this->$db->error();
		if($dbResponse['code'] == 0)
		{
			$result['id']=$this->$db->insert_id();
			$result['success']=true;
			$result['title']=DB_TITLE_SAVE;
			$result['message']=DB_SUCCESS_SAVE;
		}else
		{
			$result['success']=false;
			$result['title']=DB_TITLE_SAVE;
			$result['message']=$dbResponse['message'];
		}
		return $result;
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function update($table,$paramsData=array(),$paramsKey=array(),$db='dbCms')
	 {
	 	$update_by = $this->profile['id'];
	 	$update_time = date('Y-m-d H:i:s');
	 	$update = array();
	 	foreach ($paramsData as $key => $value) 
	 	{
	 		if(is_array($value))
	 		{
	 			if(!$value[1])
	 			{
	 				$update[$key] = $value[0];
	 			}else
	 			{
	 				$update[$key] = $this->$db->escape_str($value[0]);
	 			}
	 		}else
	 		{
	 			$update[$key] = $this->$db->escape_str($value);
	 		}
	 	}
	 	$update['update_by'] = $this->$db->escape_str($update_by);
	 	$update['update_time'] = $this->$db->escape_str($update_time);	

	 	foreach ($paramsKey as $key => $value) 
	 	{
	 		$this->$db->where($key, $this->$db->escape_str($value));
	 	}
	 	$this->$db->update($table, $update);
	 	$result = array();
	 	$dbResponse = $this->$db->error();
	 	if($dbResponse['code']==0)
	 	{
	 		$result['success']= true;
	 		$result['title']=DB_TITLE_UPDATE;
	 		$result['message']=DB_SUCCESS_UPDATE;
	 	}else
	 	{
	 		$result['success']= false;
	 		$result['title']= DB_TITLE_UPDATE;
	 		$result['message']= $dbResponse['message'];
	 	}
	 	return $result;
	 }

	/*-------------------------------------------------------------------------------------------------*/
	public function delete($table, $paramsData, $paramsKey, $db='dbCms')
	 {
	 	$update_by= $this->profile['id'];
	 	$update_time= date('Y-m-d H:i:s');
	 	$delete= array();
	 	foreach ($paramsData as $key => $value) 
	 	{
	 		$delete[$key] = $this->$db->escape_str($value);
	 	}
	 	$delete['update_by'] = $this->$db->escape_str($update_by);
	 	$delete['update_time'] = $this->$db->escape_str($update_time);

	 	foreach ($paramsKey as $key => $value) 
	 	{
	 		$this->$db->where($key, $this->$db->escape_str($value));
	 	}

	 	$this->$db->update($table, $delete);
	 	$result = array();
	 	$dbResponse = $this->$db->error();
	 	if($dbResponse['code'] == 0)
	 	{
	 		$result['success'] = true;
	 		$result['title'] = DB_TITLE_DELETE;
	 		$result['message'] = DB_SUCCESS_DELETE;
	 	}else
	 	{
	 		$result['success'] = false;
	 		$result['title'] = DB_TITLE_DELETE;
	 		$result['message'] = $dbResponse['message'];
	 	}
	 	return $result;
	 }

	/*-------------------------------------------------------------------------------------------------*/
 }

/* End of file model_Global.php */
/* Location: ./application/models/model_Global.php */