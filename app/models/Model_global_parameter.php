<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_global_parameter extends MY_Model {

	public function __construct () {
		parent::__construct();
		
		$this->loadDbCms();
	}

	public function loadGlobalParameter(){
		$this->dbCms->select('id, value');
		$this->dbCms->from('cms_global_parameter');
		$query = $this->dbCms->get();
		
		$result = array();
		if($query->num_rows() != 0){
			foreach($query->result_array() as $row) {
				$result[$row['id']] = $row['value'];
			}
		}
		return $result;
	}
}
?>
