<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class model_menu extends MY_Model {

	public function __construct () {
		parent::__construct();
		
		$this->loadDbCms();
	}

	public function loadMenu($privilege){			
		$_sessProfile = $this->session->userdata('profile');
		$_sessPrivilege = $this->session->userdata('privilege');
		
		$this->dbCms->select('id, url, name, description, icon, parent, sort');
		$this->dbCms->select('(SELECT COUNT(*) FROM cms_menu WHERE parent = m.id) AS child');		
		$this->dbCms->select('(SELECT access FROM cms_privilege_menu WHERE id_menu = m.id AND id_privilege = \''.$_sessPrivilege['privilege_id'].'\' ) AS access');
		$this->dbCms->from('cms_menu m');
		$this->dbCms->where('parent', '0');
		$this->dbCms->where('id IN('.$privilege.')');
		$this->dbCms->where('status', '1');
		$this->dbCms->order_by('sort', 'ASC');
		$query = $this->dbCms->get();
		
		$result = array();
		$i=0;
		if($query->num_rows() != 0){
			$result['count'] = true;
			foreach($query->result_array() as $row) {
				if(($row['access'] & 1)){
					$result['rows'][$i]['id'] = $row['id'];
					$result['rows'][$i]['url'] = $row['url'];
					$result['rows'][$i]['name'] = $row['name'];
					$result['rows'][$i]['description'] = $row['description'];
					$result['rows'][$i]['icon'] = $row['icon'];
					$result['rows'][$i]['parent'] = $row['parent'];
					$result['rows'][$i]['sort'] = $row['sort'];
					if($row['child']!=0){
						$result['rows'][$i]['sub'] = $this->loadSubMenu($row['id'], $i, $privilege);
					}
					$i++;
				}
			}
		} else {
			$result['count'] = false;
		}
		return $result;
	}
	
	public function loadSubMenu($id, $i, $privilege){	
		$_sessProfile = $this->session->userdata('profile');
		$_sessPrivilege = $this->session->userdata('privilege');
		
		$this->dbCms->select('id, url, name, description, icon, parent, sort');
		$this->dbCms->select('(SELECT COUNT(*) FROM cms_menu WHERE parent = m.id) AS child');
		$this->dbCms->select('(SELECT access FROM cms_privilege_menu WHERE id_menu = m.id AND id_privilege = \''.$_sessPrivilege['privilege_id'].'\' ) AS access');
		$this->dbCms->from('cms_menu m');
		$this->dbCms->where('parent', $id);
		$this->dbCms->where('id IN('.$privilege.')');
		$this->dbCms->where('status', '1');
		$this->dbCms->order_by('sort', 'ASC');
		$query = $this->dbCms->get();
		$result = array();
		$ii=0;
		if($query->num_rows() != 0){
			$result['count'] = true;
			foreach($query->result_array() as $row) {
				if(($row['access'] & 1)){
					$result['rows'][$ii]['id'] = $row['id'];
					$result['rows'][$ii]['url'] = $row['url'];
					$result['rows'][$ii]['name'] = $row['name'];
					$result['rows'][$ii]['description'] = $row['description'];
					$result['rows'][$ii]['icon'] = $row['icon'];
					$result['rows'][$ii]['parent'] = $row['parent'];
					$result['rows'][$ii]['sort'] = $row['sort'];
					if($row['child']!=0){
						$result['rows'][$ii]['sub'] = $this->loadSubMenu($row['id'], $ii, $privilege);
					}
					$ii++;
				}
			}
		} else {
			$result['count'] = false;
		}
		return $result;
	}
	
	public function loadParentList($id, $id_privilege){
		$this->dbCms->select('id, name, description, parent');
		$this->dbCms->select('(SELECT parent FROM cms_menu WHERE id = m.parent) AS parent_0');
		$this->dbCms->select('(SELECT parent FROM cms_menu WHERE id = parent_0) AS parent_1');
		$this->dbCms->select('(SELECT parent FROM cms_menu WHERE id = parent_1) AS parent_2');
		$this->dbCms->select('(SELECT parent FROM cms_menu WHERE id = parent_2) AS parent_3');
		$this->dbCms->select('(SELECT name FROM cms_menu WHERE id = m.parent) AS name_0');
		$this->dbCms->select('(SELECT name FROM cms_menu WHERE id = parent_0) AS name_1');
		$this->dbCms->select('(SELECT name FROM cms_menu WHERE id = parent_1) AS name_2');
		$this->dbCms->select('(SELECT name FROM cms_menu WHERE id = parent_2) AS name_3');
		$this->dbCms->select('(SELECT description FROM cms_menu WHERE id = m.parent) AS description_0');
		$this->dbCms->select('(SELECT description FROM cms_menu WHERE id = parent_0) AS description_1');
		$this->dbCms->select('(SELECT description FROM cms_menu WHERE id = parent_1) AS description_2');
		$this->dbCms->select('(SELECT description FROM cms_menu WHERE id = parent_2) AS description_3');
		$this->dbCms->select('(SELECT access FROM cms_privilege_menu WHERE id_menu = m.id AND id_privilege = \''.$id_privilege.'\' ) AS access');
		$this->dbCms->from('cms_menu m');
		$this->dbCms->where('url', $id);
		$query = $this->dbCms->get();
		$result = array();
		if($query->num_rows() != 0){
			$result['count'] = true;
			foreach($query->result_array() as $row) {
				$result['rows'][0] = $row['id'];
				$result['rows'][1] = $row['parent'];
				$result['rows'][2] = $row['parent_0'];
				$result['rows'][3] = $row['parent_1'];
				$result['rows'][4] = $row['parent_2'];
				$result['rows'][5] = $row['parent_3'];
				
				$result['name'][0] = $row['name'];
				$result['name'][1] = $row['name_0'];
				$result['name'][2] = $row['name_1'];
				$result['name'][3] = $row['name_2'];
				$result['name'][4] = $row['name_3'];
				
				$result['description'][0] = $row['description'];
				$result['description'][1] = $row['description_0'];
				$result['description'][2] = $row['description_1'];
				$result['description'][3] = $row['description_2'];
				$result['description'][4] = $row['description_3'];
				
				$result['access'] = $row['access'];
			}
		} else {
			$result['count'] = false;
		}
		return $result;
	}	
}
?>
