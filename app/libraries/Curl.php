<?php 
/**
 *  
 *  
 * 
 * @author 
 **/
Class curl
{
	public function getCurl($url, $method = 'get', $header = null, $postdata = null, $new = false, $timeout = 15){
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $url);

		if ($header) {
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		}

		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt($curl, CURLOPT_MAXREDIRS, 5);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

		if (strtolower($method) == 'post') {
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
		} else if (strtolower($method) == 'delete') {
			curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
		} else if (strtolower($method) == 'put') {
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postdata));
		}

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($curl);

		curl_close($curl);
		return $result;
	}
}
?>
