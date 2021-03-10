<?php 
	function r_n_customizations_install() {
		global $wpdb;

		add_option('nqs_info', '');
	}

	function r_n_customizations_uninstall() {
		global $wpdb;

	    delete_option('nqs_info');
	}

	function check_link($href, $ending) {
		if (strpos($href,'?')) $href = preg_replace('/(\?[^\/]+)\/(.*$)/','$2$1',$href);
		else $href .= '/';

		if ($ending) $href .= $ending;
		
		return $href;
	}

	function nqs_clean_array($value) {
		if (is_array($value)) foreach($value as $i=>$val) {
			if (is_array($val)) $value[$i] = nqs_clean_array($val);
			else $value[$i] = stripslashes($val);
		} else {
			$value = stripslashes($value);
		}
		return $value;
	}

	function nqs_clean_string($value) {
		$value = stripslashes($value);
		$value = htmlspecialchars_decode($value, ENT_QUOTES);
		$value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
		return $value;
	}

	function nqs_esc_attr($s) {
		return esc_attr(stripslashes(strip_tags($s)));
	}

	function nqs_esc_html($s) {
		return esc_html(stripslashes($s));
	}

	function is_mobile() {

		if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) return false;
		if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) return true;
		if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) return true;   
		if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) return true;
		
		$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
		$mobile_agents = array(
			'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
			'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
			'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
			'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
			'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
			'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
			'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
			'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
			'wapr','webc','winw','winw','xda ','xda-'
		);
	 
		return in_array($mobile_ua,$mobile_agents);
	}

	function deleteValueFromArray($array, $value) {
	    foreach ($array as $key => $val) {
			if ($val == $value) {
				unset($array[$key]);
			}
	    }

	    if (!count($array)) $array = null;

	    return $array;
	}

	function get_ipaddress() {
		$ipaddress = '';

	    if (getenv('HTTP_CLIENT_IP')) {
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    }
	    else if (getenv('HTTP_X_FORWARDED_FOR')) {
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		}
	    else if (getenv('HTTP_X_FORWARDED')) {
	        $ipaddress = getenv('HTTP_X_FORWARDED');
		}
	    else if (getenv('HTTP_FORWARDED_FOR')) {
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
		}
	    else if (getenv('HTTP_FORWARDED')) {
	       $ipaddress = getenv('HTTP_FORWARDED');
	    }
	    else if (getenv('REMOTE_ADDR')) {
	        $ipaddress = getenv('REMOTE_ADDR');
		}
	    else
	    {
	        $ipaddress = 'UNKNOWN';
	    }

	    return $ipaddress;
	}

	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randomString = '';

	    for ($i = 0; $i < $length; $i ++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    
	    return $randomString;
	}

	function is_telnum($telnum) {
		$regexp = '/^[0-9\+\-\)\(\d\s]{7,}$/';

		if (preg_match($regexp, $telnum))	  true;
		else return false;
	}
?>