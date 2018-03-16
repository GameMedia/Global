<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	protected $data			= array();
	protected $profile 		= array();
	protected $uri_string 	= NULL;
	
	function __construct()
	 {
		parent::__construct();		
		#Set data to display on View
		$this->data['base_url'] = $this->config->item('base_url');
		$this->data['base_url_index'] = $this->config->item('base_url_index');

		#Set data to display on View
		$this->data['globalParameter'] = $this->model_global_parameter->loadGlobalParameter();
     }
    /*-------------------------------------------------------------------------------------------------*/
    #Ajax Checking
    protected function isAjax($responseCode = 404)
     {
		if (!$this->input->is_ajax_request())
			die(http_response_code($responseCode));
	 }
	/*-------------------------------------------------------------------------------------------------*/
	#Getting URI STRING
	protected function getUriString()
	 {
		#Creating URI String (Menu)
		$url = explode('/', $this->uri->uri_string());
		if(count($url) > 2)
		{
			$this->uri_string = $url[0].'/'.$url[1];
		} else
			$this->uri_string = $this->uri->uri_string();
	 }
	/*-------------------------------------------------------------------------------------------------*/
	#Add Action History
	protected function addActHistory($params)
	 {
		$this->load->model('model_history');
		$paramsAct = array(
						'id'		=> $this->createTransactionId(),
						'id_user' 	=> $params['id_user'],
						'url' 		=> $this->uri_string,
						'actions'	=> $params['actions'],
						'data'		=> $params['data'],
						'result'	=> $params['result']);
		$this->model_history->addActHistory($paramsAct);
		return true;
	 }
	 /*-------------------------------------------------------------------------------------------------*/
	 #Create Transaction ID
	protected function createTransactionId()
	 {
		$micro = explode('.',microtime(true));
		$this->transactionId = date("YmdHis").$micro[1];
		return $this->transactionId;
	 }
	/*-------------------------------------------------------------------------------------------------*/
	protected function createElementButtonView($onclick, $modal="", $title="View", $icon="fa fa-search")
	 {
		return '<button class="btn btn-xs margin-bottom" title="'.$title.'" onclick="'.$onclick.'" '.$modal.'><i class="'.$icon.'"></i></button>';
	 }
    /*-------------------------------------------------------------------------------------------------*/
    protected function createElementButtonDelete($id,$url,$datatable,$title="Delete", $icon="fa fa-trash-o")
     {
    	$onclick="deleteID='".$id."', deleteUrl='".$url."', deleteDataTable='".$datatable."'";
    	return '<button class="btn red btn-xs margin-bottom" title="'.$title.'" onclick="'.$onclick.'" data-target="#formDelete" data-toggle="modal"><i class="'.$icon.'"></i></button>';
     }
    /*-------------------------------------------------------------------------------------------------*/
    //list timezone
    protected function setUtcTimezone()
     {
     	$setUtcTimezone = array();
     	for($i=-12; $i<15; $i++)
     	{
     		if($i>0)
     		{
     			$timezone = ($i<10)?''.$i:$i;
     			$utcTimezone[$i] = 'UTC +'.$timezone.'.00';
     		} elseif ($i<0) 
     		{
     			$timezone = ($i<10)?''.$i:$i;
     			$utcTimezone[$i] = 'UTC '.$timezone.'.00';
     		} else
     		{
     			$timezone = ($i<10)?''.$i:$i;
     			$utcTimezone[$i] = 'UTC';
     		}
     	}
     	return $this->utcTimezone = $utcTimezone;
     }
	
	/*-------------------------------------------------------------------------------------------------*/
	protected function setTime()
	 {
	 	$utcTimezone = array();
	 	for($i=0; $i<24; $i++)
	 	{
	 		$time = ($i<10)?'0'.$i:$i;
	 		$utcTimezone[$i] = $time;
	 	}
	 	return $utcTimezone;
	 }

	/*-------------------------------------------------------------------------------------------------*/
	protected function setYearList($yearFirst = 2015)
	 {
	 	$year = array();
	 	for($i=date('Y'); $i>=$yearFirst; $i--)
	 	{
	 		$year[] = $i;
	 	}
	 	return $this->yearList = $year;
	 }

	/*-------------------------------------------------------------------------------------------------*/




	/*-------------------------------------------------------------------------------------------------*/

    protected function captchaVerify($_captcha)
     {
     	$url = GOOGLE_RECAPTCHA_VERIFY;
     	$url = str_replace('{RECAPTCHA_RESPONSE}', $_captcha, $url);
     	$url = str_replace('{IP-ADDRESS}', $_SERVER['REMOTE_ADDR'], $url);

     	$captchaCheck = json_decode(file_get_contents($url), true);
     	if($captchaCheck['success'])
     		return true;
     	return false;
     }

    /*-------------------------------------------------------------------------------------------------*/

}
