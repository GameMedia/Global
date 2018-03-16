<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_backend_login extends MY_Model {
	private $tableuser			= 'cms_user';
	private $tableusertype		= 'cms_user_type';
	private $tableemployee		= 'cms_employee';
	private $tableprivilege		= 'cms_privilege';
	private $tableprivilegemenu = 'cms_privilege_menu';
	private $tablemenu 			= 'cms_menu';
	
	public function __construct()
	{
		parent::__construct();
		$this->loadDbCms();
	}

	public function auth($_username)
	{
		$this->dbCms->select('us.id, us.id_employee, us.id_user_type, us.id_privilege, us.username, us.userpass, us.status AS status_user');
		$this->dbCms->select('em.name AS name_employee, em.account_id, em.email, em.avatar_thumb, em.status AS status_employee');
		$this->dbCms->select('ut.name AS name_user_type, ut.isAdmin, ut.status AS status_user_type');
		$this->dbCms->from($this->tableuser.' us');
		$this->dbCms->join($this->tableusertype.' ut','us.id_user_type = ut.id');
		$this->dbCms->join($this->tableemployee.' em', 'us.id_employee = em.id');
		$this->dbCms->where('us.username',$_username);
		$query = $this->dbCms->get();
	
		$result = array();
		if($query->num_rows() != 0)
		{
			foreach ($query->result_array() as $row) 
			{
				$result['id']				= $row['id'];
				$result['id_employee']		= $row['id_employee'];
				$result['id_user_type']		= $row['id_user_type'];
				$result['id_privilege']		= $row['id_privilege'];
				$result['username']			= $row['username'];
				$result['userpass']			= $row['userpass'];
				$result['status_user']		= $row['status_user'];
				$result['name_employee'] 	= $row['name_employee'];
				$result['account_id']		= $row['account_id'];
				$result['email']			= $row['email'];
				$result['avatar_thumb']		= $row['avatar_thumb'];
				$result['status_employee']	= $row['status_employee'];
				$result['name_user_type'] 	= $row['name_user_type'];
				$result['isAdmin']			= $row['isAdmin'];
				$result['status_user_type']	= $row['status_user_type'];
				$result['isPatner']			= !empty($row['account_id'])?true:false;
			}
		}
		return $result;
	}

	public function getPrivilege($id_privilege)
	{
		$this->dbCms->select('p.status, p.default_menu, pm.id_privilege, pm.id_menu, pm.access, m.url, m.name, m.description, m.icon, m.parent, m.sort');
		$this->dbCms->select('(SELECT count(1) FROM cms_menu WHERE parent=pm.id_menu) AS child');
		$this->dbCms->from($this->tableprivilege.' p');
		$this->dbCms->join($this->tableprivilegemenu.' pm','p.id=pm.id_privilege');
		$this->dbCms->join($this->tablemenu.' m','m.id=pm.id_menu');
		$this->dbCms->where('m.status','1');
		$this->dbCms->where('p.id', $id_privilege);
		$this->dbCms->order_by('m.parent, m.sort','ASC');
		$query=$this->dbCms->get();
		$result=array();
		if($query->num_rows() != 0)
		{
			$i = 0;
			$row['default_url'] = "";
			foreach($query->result_array() as $row) 
			{
				$result['status'] = $row['status'];
				$result['id_privilege'] = $row['id_privilege'];
				$result['menu'][$i] = $row['id_menu'];
				if($row['default_menu'] == $row['id_menu'])
					$result['default_url'] = $row['url'];
				$i++;
			}
		}
		return $result;
	}

		#function untuk forgot password
	/*public function getDataUser($params) 
	{
		$this->dbCms->select('us.id, us.id_employee, us.id_user_type, us.privilege, us.username, us.userpass, us.status AS status_user');
		$this->dbCms->select('ut.name AS name_user_type, ut.isAdmin, ut.status AS status_user_type');
		$this->dbCms->select('em.name AS name_employe, em.status AS status_employee, em.account_id');
		$this->dbCms->from($this->tableuser.'us');
		$this->dbCms->join($this->tableusertype.'ut','us.id_user_type = ut.id');
		$this->dbCms->join($this->tableemployee.'em','us.id_employee = em.id');

		if(isset($params['forgot_email']))
			$this->dbCms->where('em.email',$this->dbCms->escape_str($params['forgot_email']));
		$query = $this->dbCms->get();
		$result = array();
		if($query->num_row() != 0)
		{
			$result['count'] = true;
			foreach ($query->result_array() as $row) 
			{
				$result['user_id']= $row['id'];
				$result['employee_id']=$row['id'];
				$result['employee_name']=$row['name_employe'];
			}
		} else {
			$result['count'] = false;
		}
		return $result;
	}*/

	public function out()
	{
		$result = $this->session->session_destroy();
		redirect('backend','location');
	}

















}

/* End of file Model_backend_login.php */
/* Location: .//C/xampp/htdocs/Gmedia/app/models/Model_backend_login.php */