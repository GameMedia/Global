<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller_Admin extends MY_Controller {

	protected $folder 			= "backend/";
	protected $folderLayout		= "backend/layout/";
	protected $folderView		= "backend/metronic/";
	/*-------------------------------------------------------------------------------------------------*/
	function __construct()
	 {
		parent::__construct();
	
		$this->isLogin();
		$this->isAdmin(); 									#cek request user
		$this->data['folder']		= $this->folder;		#setbackend folder
		$this->data['folderLayout']	= $this->folderLayout;	#setbackend folder layout
		$this->data['folderView']	= $this->folderView;	#setbackend folder view
		$this->getUriString();
		$this->getAccess();
	 }
	/*-------------------------------------------------------------------------------------------------*/

	/*-------------------------------------------------------------------------------------------------*/
	private function isAdmin()
	 {
	 	$_sessProfile			= $this->session->userdata('profile');
	 	$this->profile 			= $_sessProfile;
	 	$this->data['profile']	= $_sessProfile;

	 	if(!$_sessProfile['isAdmin'])
	 		redirect($this->data['base_url_index'].'backend', 'location', 301);

	 	return true;
	 }
	/*-------------------------------------------------------------------------------------------------*/
	protected function isLogin()
	 {
	 	$_sessProfile = $this->session->userdata('profile');  	#mengambil session data
	 	$_sessLocked = $this->session->userdata('isLocked');  	#mengambil data session privilege

	 	if(!isset($_sessProfile))
	 	{
	 		if($this->input->is_ajax_request())
	 		{
	 			echo json_encode(array('succes'=>'out','url'=>$this->data['base_url_index'].$this->folder));
	 			die();
	 		} else
	 		{
	 			redirect($this->data['base_url_index'].$this->folder,'location', 301);	
	 		}
	 	}else
	 	{
	 		if($_sessLocked) #menampilkan menu lockscreen
	 		{
	 			redirect($this->data['base_url_index'].'backend/lockscreen','location', 301);
	 		}	
	 	}
	 }
	/*-------------------------------------------------------------------------------------------------*/
	protected function loadMenu()
	 {
		$_sessProfile=$this->session->userdata('profile');
		$_sessPrivilege=$this->session->userdata('privilege');
		$_sessIsLogged=$this->session->userdata('isLogged');

		if(!$_sessProfile['isAdmin'])
		{
			return false;
		}

		$this->load->model('model_menu');
		$this->data['parentList']		=$this->model_menu->loadParentList($this->uri_string,$_sessPrivilege['privilege_id']);
		
		$this->data['menu']				=$this->model_menu->loadMenu($_sessPrivilege['menu']);
		$this->data['pageTitle']		=$this->data['parentList']['name'][0];
		$this->data['pageDescription']	=$this->data['parentList']['description'][0];
		return true;
	 }
	/*-------------------------------------------------------------------------------------------------*/
	protected function getAccess() #perhitungan biner untuk Hak Aksess
	 {
	 	$_sessProfile = $this->session->userdata('profile');
	 	$_sessPrivilege = $this->session->userdata('privilege');
	 	$_sessIsLogged = $this->session->userdata('isLogged');

	 	if (!$_sessProfile['isAdmin'])
	 		return false;
	 	$_modelMenu = $this->load->model('model_menu');
	 	$this->data['parentList'] = $this->model_menu->loadParentList($this->uri_string, $_sessPrivilege['privilege_id']);

	 	$access = $this->data['parentList']['access'];

	 	$this->data['accessView']	=(!(1&$access) !=0)?0:1;
	 	$this->data['accessAdd']	=(!(2&$access) !=0)?0:1;
		$this->data['accessEdit']	=(!(4&$access) !=0)?0:1;
		$this->data['accessDelete']	=(!(8&$access) !=0)?0:1;
		return true;
	 }

	/*-------------------------------------------------------------------------------------------------*/
	protected function calculateAccess($access)
	 {
	 	$result['view']		=(!(1&$access) !=0)?'':'active';
	 	$result['add']		=(!(2&$access) !=0)?'':'active';
	 	$result['edit']		=(!(2&$access) !=0)?'':'active';
	 	$result['delete']	=(!(8&$access) !=0)?'':'active';
	 	return $result;
	 }
	/*-------------------------------------------------------------------------------------------------*/
	protected function loadMenuTree($params = array())
	 {
	 	$this->load->model($this->folder.'user-management/model_privilege_menu');
	 	if(sizeof($_POST))
	 		$params = $_POST;
	 	$result = $this->model_privilege_menu->loadMenuSelect($params);
	 	$result = $this->makeListMenu($result);
	 	return $result;
	 }
	/*-------------------------------------------------------------------------------------------------*/
	protected function makeListMenu($params)
	 {
	 	$separator = array(
	 					'0' => '',
						'1' => ' ../ ',
						'2' => ' ../../ ',
						'3' => ' ../../../ ',
						'4' => ' ../../../../ '
	 					);
	 	$result =array();
	 	$n =0;
	 	for($i=0; $i<count($params['rows'][0]); $i++)
	 	{
	 		$row = $params['rows'][0];
	 		$result['rows'][$n]['id'] 	= $row[$i]['id'];
			$result['rows'][$n]['name'] = $row[$i]['name'];
			$result['rows'][$n]['parent'] = $row[$i]['parent'];
			$result['rows'][$n]['url'] = $row[$i]['url'];
			//$result['rows'][$n]['sort'] = $row[$i]['sort'];
			$result['rows'][$n]['status'] = ($row[$i]['status'] == '0')?'No':'Yes';
			$result['rows'][$n]['level'] = $row[$i]['level'];
			$result['rows'][$n]['child'] = $row[$i]['child'];
			//$result['rows'][$n]['sort_up'] = $row[$i]['sort_up'];
			//$result['rows'][$n]['sort_down'] = $row[$i]['sort_down'];
			$result['rows'][$n]['id_privilege'] = $row[$i]['id_privilege'];
			$result['rows'][$n]['name_privilege'] = $row[$i]['name_privilege'];
			$result['rows'][$n]['access'] = $row[$i]['access'];
			$result['rows'][$n]['access_button'] = $this->calculateAccess($row[$i]['access']);
			$result['rows'][$n]['icon'] = $row[$i]['icon'];
			$n++;
			if($row[$i]['child'] != 0)
			{
				for($x=0; $x<$row[$i]['child']; $x++)
				{
					$rowChild = $params['rows'][$row[$i]['id']];
					$result['rows'][$n]['id'] 	= $rowChild[$x]['id'];
					$result['rows'][$n]['name'] = $separator[$rowChild[$x]['level']].$rowChild[$x]['name'];
					$result['rows'][$n]['parent'] = $rowChild[$x]['parent'];
					$result['rows'][$n]['url'] = $rowChild[$x]['url'];
					//$result['rows'][$n]['sort'] = $rowChild[$x]['sort'];
					$result['rows'][$n]['status'] = ($rowChild[$x]['status'] == '0')?'No':'Yes';
					$result['rows'][$n]['level'] = $rowChild[$x]['level'];
					$result['rows'][$n]['child'] = $rowChild[$x]['child'];
					//$result['rows'][$n]['sort_up'] = $rowChild[$x]['sort_up'];
					//$result['rows'][$n]['sort_down'] = $rowChild[$x]['sort_down'];
					$result['rows'][$n]['id_privilege'] = $rowChild[$x]['id_privilege'];
					$result['rows'][$n]['name_privilege'] = $rowChild[$x]['name_privilege'];
					$result['rows'][$n]['access'] = $rowChild[$x]['access'];
					$result['rows'][$n]['access_button'] = $this->calculateAccess($rowChild[$x]['access']);
					$result['rows'][$n]['icon'] = $rowChild[$x]['icon'];
					$n++;

					if($rowChild[$x]['child'])
					{
						
						$rowChildChild = $params['rows'][$rowChild[$x]['id']];
						for($y=0; $y<$rowChild[$x]['child']; $y++)
						{
							$result['rows'][$n]['id'] 	= $rowChildChild[$y]['id'];
							$result['rows'][$n]['name'] = $separator[$rowChildChild[$y]['level']].$rowChildChild[$y]['name'];
							$result['rows'][$n]['parent'] = $rowChildChild[$y]['parent'];
							$result['rows'][$n]['url'] = $rowChildChild[$y]['url'];
							//$result['rows'][$n]['sort'] = $rowChildChild[$y]['sort'];
							$result['rows'][$n]['status'] = ($rowChildChild[$y]['status'] == '0')?'No':'Yes';
							$result['rows'][$n]['level'] = $rowChildChild[$y]['level'];
							$result['rows'][$n]['child'] = $rowChildChild[$y]['child'];
							//$result['rows'][$n]['sort_up'] = $rowChildChild[$y]['sort_up'];
							//$result['rows'][$n]['sort_down'] = $rowChildChild[$y]['sort_down'];
							$result['rows'][$n]['id_privilege'] = $rowChildChild[$y]['id_privilege'];
							$result['rows'][$n]['name_privilege'] = $rowChildChild[$y]['name_privilege'];
							$result['rows'][$n]['access'] = $rowChildChild[$y]['access'];
							$result['rows'][$n]['access_button'] = $this->calculateAccess($rowChildChild[$y]['access']);
							$result['rows'][$n]['icon'] = $rowChildChild[$y]['icon'];
							$n++;
						}
					}
				}
			}
	 	}
	 	return $result;
	 }

	/*-------------------------------------------------------------------------------------------------*/
	protected function upload($type="", $config="", $user="", $resize=true, $max_size=0)
	 {
	 	$dirUpload = $this->config->item($config);
	 	if(!empty($max_size))
	 		$dirUpload['max_size'] = $max_size;

	 	switch($type)
	 	{
	 		case "Image":
	 			$result = array();
	 			foreach ($_FILES as $file ) 
	 			{
	 				//cek file size
	 				if($file['size']>$dirUpload['max_size'])
	 				{
	 					$result['message'] = $dirUpload['message_max_size'];
	 					$result['status'] = false;
	 				} else
	 				{   /*--------------------------------------------------------
	 					//cek folder is exists
	 					if(!empty($user))
	 					{
	 						$dirUpload['path_ori'] = str_replace('{user}', $user, $dirUpload['path_ori']);
	 						$dirUpload['path_thumb'] = str_replace('{user}', $user, $dirUpload['path_thumb']);
	 						$dirUpload['url_ori'] = str_replace('{user}', $user, $dirUpload['path_ori']);
	 						$dirUpload['url_thumb'] = str_replace('{user', $user, $dirUpload['path_thumb']);
	 						if(!file_exists(str_replace('{user}', $user, $dirUpload['path_ori'])))
	 						{
	 							mkdir($dirUpload['path_ori'], 0777);
	 							mkdir($dirUpload['path_thumb'], 0777);
	 						}
	 					} -------------------------------------------------------*/
	 					$pathInfo = pathinfo($file['name']);
	 					$physicName = md5(date("YmdHis")).'.'.$pathInfo['extension'];

	 					//upload original file
	 					if(move_uploaded_file($file['tmp_name'], $dirUpload['path']))
	 					{			
							$result['files']['path'] 	= $dirUpload['path'];
							$result['files']['url_ori'] 	= $dirUpload['url_ori'].$physicName;
							$result['files']['file_name'] 	= $physicName;
							$result['files']['img_mime'] 	= mime_content_type($dirUpload['path_ori'].$physicName);
							$imageSize = getimagesize($dirUpload['path_ori'].$physicName);
							$result['files']['img_width'] 	= $imageSize[0];
							$result['files']['img_height'] 	= $imageSize[1];
							$result['status'] 				= true;
							$result['icon'] 				= $dirUpload['url'].$dirUpload['url_ori'].$physicName;
	 					} else
	 					{
	 						$result['error'] 	= 'Uploading error.';
							$result['status'] 	= false;
	 					}

	 					#resize to thumb file
	 					if($result['status'])
	 					{
							if($resize)
							{
								//identitas file asli  
								if ($file['type']=="image/jpeg" ){
									$im_src = imagecreatefromjpeg($dirUpload['path'].$physicName);
								} elseif ($file['type']=="image/png" ){
									$im_src = imagecreatefrompng($dirUpload['path'].$physicName);
								}elseif ($file['type']=="image/gif" ){
									$im_src = imagecreatefromgif($dirUpload['path'].$physicName);
								}elseif ($file['type']=="image/wbmp" ){
									$im_src = imagecreatefromwbmp($dirUpload['path'].$physicName);
								}
								
								$src_width = imageSX($im_src);
								$src_height = imageSY($im_src);
		 						//simpan dalam versi small 110 pixel
		 						$dst_width = 100;
								$dst_height = ($dst_width/$src_width)*$src_height;
		 						//proses ubah ukuran
		 						$im = imagecreatetruecolor($dst_width,$dst_height);
									imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

		 						//simpan gambar
		 						if ($file['type']=="image/jpeg" ){
										imagejpeg($im, $dirUpload['path'].$physicName);
									} elseif ($file['type']=="image/png" ){
										imagepng($im, $dirUpload['path'].$physicName);
									} elseif ($file['type']=="image/gif" ){
										imagegif($im, $dirUpload['path'].$physicName);
									} elseif($file['type']=="image/wbmp" ){
										imagewbmp($im, $dirUpload['path'].$physicName);
									}

		 						$result['files']['url_thumb'] 	= $dirUpload['url_thumb'].$physicName;
								$result['files']['path_thumb'] 	= $dirUpload['path_thumb'].$physicName;
								$result['icon'] = $dirUpload['url'].$dirUpload['url_thumb'].$physicName;
		 						//hapus gambar di memori komputer
		 						imagedestroy($im_src);
		 						imagedestroy($im);
	 						}
	 					}
	 				}
	 			}
	 	break;
	 	default:
	 		$result = array();
	 		foreach ($_FILES as $file) 
	 		{
	 			#cek file size
	 			if($file['size'] > $dirUpload['max_size'])
	 			{
	 				$result['message'] = $dirUpload['message_max_size'];
	 				$result['status'] = false;
	 			} else
	 			{
	 				$dirUpload['path'] = $dirUpload['path'];
	 				$dirUpload['url_ori'] = $dirUpload['url_ori'];
	 				$pathinfo = pathinfo($file['name']);
	 				$physicName = md5(date("YmdHis")).'.'.$pathInfo['extension'];
	 				$physicName = $file['name'];
		 			//upload original file
		 			if(move_uploaded_file($file['tmp_name'], $dirUpload['path'].$physicName))
		 			{
		 				$result['files']['path'] = $dirUpload['path'];
		 				$result['files']['url_ori'] = $dirUpload['url_ori'].$physicName;
		 				$result['files']['file_name'] = $physicName;
		 				$result['status'] = true;
		 			} else
		 			{
		 				$result['error'] = 'Uploading Error.';
		 				$result['status'] =  fasle;
		 			}
		 		}
	 		}
	 		break;
	 	}
	 return $result;
	 }
	/*-------------------------------------------------------------------------------------------------*/


}

/* End of file mY_Controller_Admin.php */
/* Location: ./application/controllers/mY_Controller_Admin.php */