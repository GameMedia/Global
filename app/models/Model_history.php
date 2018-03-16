<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_history extends MY_Model {
	
	private $tableActHistory	= 'cms_action_history';
	private $tableDataHistory 	= 'cms_data_history';

	public function __construct () {
		parent::__construct();
		
		$this->loadDbCms();
	}
	/*-------------------------------------------------------------------------------------------------*/
	public function addActHistory($params){
		$result = array();
		$input_by = isset($this->profile['id_user'])?$this->profile['id_user']:$params['id_user'];
		$input_time = date('Y-m-d H:i:s');
		$insert = array(
						'id' 			=> $this->dbCms->escape_str($params['id']),
						'id_user' 		=> $this->dbCms->escape_str($params['id_user']),
						'url'			=> $this->dbCms->escape_str($params['url']),
						'actions'		=> $this->dbCms->escape_str($params['actions']),
						'data'			=> $this->dbCms->escape_str($params['data']),
						'result'		=> $this->dbCms->escape_str($params['result']),
						'ip'			=> $this->dbCms->escape_str($this->input->ip_address()),
						'entry_by' 		=> $this->dbCms->escape_str($input_by),
						'entry_time'	=> $this->dbCms->escape_str($input_time)
					   );
		$this->dbCms->insert($this->tableActHistory, $insert);
		return true;
	}
}
?>
