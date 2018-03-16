<?php
/**
 * Class IP Filter
 *
 *  $libFilter = CMS::loadLibrary('ipfilter');
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	$checkIP = $libFilter->checkIP($ipAddress, array("27.*.*.*","171.*.*.*","125.*.*.*"));
	if($checkIP){
		$sess = array(
				"url" => 'http://'.$_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']
				);
		$this->session->set_userdata('urlRedirection', $sess);

		$this->redirect($this->encMsisdnMPS());
	} else {
		$sess = array(
				"msisdn" => '',
				"appid"	 => $appId,
				"operator" => "viettel",
				"mps" => true	
			 );
		$this->session->set_userdata('Viettel', $sess);
	}
 * 
 * 
 * 
 **/

class Ipfilter
{
    private static $_IP_TYPE_SINGLE = 'single';
    private static $_IP_TYPE_WILDCARD = 'wildcard';
    private static $_IP_TYPE_MASK = 'mask';
    private static $_IP_TYPE_SECTION = 'section';
    private $_allowed_ips = array();

    public function __construct($allowed_ips = array())
    {
        $this -> _allowed_ips = $allowed_ips;
    }

    public function checkIP($ip, $allowed_ips = null)
    {
        if (strpos($ip, ',') !== FALSE)
            $aIPs = explode (',', $ip);
        else
            $aIPs[] = $ip;
            
        if (strpos($allowed_ips, ',') !== FALSE)
            $aAllowed_ips = explode (',', $allowed_ips);
        else
            $aAllowed_ips[] = $allowed_ips;    

        foreach ($aIPs as $ipRemote)
        {
            if ($ipRemote = trim($ipRemote))
            {
                $return = $this->check($ipRemote, $aAllowed_ips);
                if ($return === TRUE) return $return;
            }
        }

        return false;
    }


    public function check($ip, $allowed_ips = null)
    {
        $allowed_ips = $allowed_ips ? $allowed_ips : $this->_allowed_ips;

        foreach($allowed_ips as $allowed_ip)
        {
            $type = $this -> _judge_ip_type($allowed_ip);
            $sub_rst = call_user_func(array($this,'_sub_checker_' . $type), $allowed_ip, $ip);

            if ($sub_rst)
            {
                return true;
            }
        }

        return false;
    }

    private function _judge_ip_type($ip)
    {
        if (strpos($ip, '*') !== FALSE)
        {
            return self :: $_IP_TYPE_WILDCARD;
        }

        if (strpos($ip, '/') !== FALSE)
        {
            return self :: $_IP_TYPE_MASK;
        }

        if (strpos($ip, '-') !== FALSE)
        {
            return self :: $_IP_TYPE_SECTION;
        }

        if (ip2long($ip))
        {
            return self :: $_IP_TYPE_SINGLE;
        }

        return false;
    }

    private function _sub_checker_single($allowed_ip, $ip)
    {
        return (ip2long($allowed_ip) == ip2long($ip));
    }

    private function _sub_checker_wildcard($allowed_ip, $ip)
    {
        $allowed_ip_arr = explode('.', $allowed_ip);
        $ip_arr = explode('.', $ip);
        for($i = 0;$i < count($allowed_ip_arr);$i++)
        {
            if ($allowed_ip_arr[$i] == '*')
            {
                return true;
            }
            else
            {
                if (false == ($allowed_ip_arr[$i] == $ip_arr[$i]))
                {
                    return false;
                }
            }
        }
    }

    private function _sub_checker_mask($allowed_ip, $ip)
    {
        list($allowed_ip_ip, $allowed_ip_mask) = explode('/', $allowed_ip);
        $begin = (ip2long($allowed_ip_ip) &ip2long($allowed_ip_mask)) + 1;
        $end = (ip2long($allowed_ip_ip) | (~ip2long($allowed_ip_mask))) + 1;
        $ip = ip2long($ip);
        return ($ip >= $begin && $ip <= $end);
    }

    private function _sub_checker_section($allowed_ip, $ip)
    {
        list($begin, $end) = explode('-', $allowed_ip);
        $begin = ip2long($begin);
        $end = ip2long($end);
        $ip = ip2long($ip);
        return ($ip >= $begin && $ip <= $end);
    }
}
