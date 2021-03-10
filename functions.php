<?php 
	function r_n_customizations_install() {
		global $wpdb;

		add_option('nqs_info', '');
	}

	function r_n_customizations_uninstall() {
		global $wpdb;

	    delete_option('nqs_info');
	}

	function nqs_return_image($image_arr, $size = 'thumbnail') {
		
		$post_image = @unserialize($image_arr);
		$image_exists = true;

		if (empty($post_image['sizes'][$size])) {

			if (!empty($post_image['file'])) $post_image['sizes'][$size]['file'] = $post_image['file'];
			else $image_exists = false; 

		}
		else
		{

			$temp_arr = explode('/', $post_image['file']);
			$post_image['sizes'][$size]['file'] = $temp_arr[0].'/'.$temp_arr[1].'/'.$post_image['sizes'][$size]['file'];

		}

		if ($image_exists) {

			$full_array['full'] = $post_image['file'];
			$full_array['image'] = $post_image['sizes'][$size]['file'];

		}
		else
		{

			$full_array = '';

		}

		return $full_array;

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

	function nqs_esc_attr( $s ) {
		return esc_attr(stripslashes(strip_tags($s)));
	}

	function nqs_esc_html( $s ) {
		return esc_html(stripslashes($s));
	}

	function nqs_float( $s,$dec=2 ) {
		$s = floatval($s);
		if ($s) return round($s,$dec);
		else return 0;
	}

	function _nf($price, $count=2, $thousand='.', $dilimeter=',', $excel=false) {
		if (!$excel) return number_format($price, $count, $thousand, $dilimeter); else return number_format($price, 2, ',', '.');
	}

	function in_array_r($value,$arr,$type,$result) {
		if ($arr) {
			foreach($arr as $key=>$val) {
				if ($val->$type==$value) return $val->$result;
			}
		} else {
			return false;
		}
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
			'wapr','webc','winw','winw','xda ','xda-');
	 
		return in_array($mobile_ua,$mobile_agents);
	}

	function nqs_check_date($date,$sep='-') {
		if (strpos($date,' ') !== false) {
			$new_date = explode(' ',$date);
			$date = $new_date[0];
		}
		$date_arr = explode($sep,$date);
		
		if (count($date_arr)==3) {
			if (wp_checkdate($date_arr[1],$date_arr[2],$date_arr[0],$date)) return date('Y-m-d',strtotime($date));
			else return '';
		} else return '';
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

	function role_exists($role) {

	    if (!empty($role)) {

	    	return $GLOBALS['wp_roles']->is_role($role);

	  	}
	  	
	  	return false;

	}

	function is_logged($caps = array()) {

		global $current_user;
		
		if (!$current_user->ID or $current_user->caps['inactive']) return false;
		
		if ($caps) {

			$exist = false;

			foreach ($caps as $cap) {

				if ($current_user->caps[$cap]) {

					$exist = true;

					break;

				}

			}

			return $exist;

		}
		else
		{

			return true;

		}

	}

	function is_telnum($telnum) {

		$regexp = '/^[0-9\+\-\)\(\d\s]{7,}$/';

		if(preg_match($regexp, $telnum))

			return true;

		else

			return false;
		

	}

	function get_attachment_id_from_src($image_src) {

		global $wpdb;

		$id = $wpdb->get_var("SELECT `ID` FROM $wpdb->posts WHERE `guid` = '$image_src'");
		
		return $id;

	}

	function formatBytes($size, $precision = 2) {

	    return round(number_format($size / 1048576, 2), $precision);
	
	}
	
	function nqs_sanitize_string($title, $cut = 0) {
		$title = strip_tags($title);
		$title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
		$title = str_replace('%', '', $title);
		$title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);
		$title = remove_accents($title);
		
		if (function_exists('mb_strtolower')) $title = mb_strtolower($title, 'UTF-8'); else $title = strtolower($title);
		
		$title = preg_replace('/&.+?;/', '', $title);
		$title = str_replace(array('.', '"', '“', '„', '”'), '-', $title);
		$title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
		$title = preg_replace('/\s+/', '-', $title);
		$title = preg_replace('|-+|', '-', $title);
		
		if ($cut) $title = substr($title, 0, $cut);
		
		$title = trim($title, '-');
		
		return $title;
	}

	function convertCurrency($amount, $from = 'EUR', $to = 'USD') {
		$API = 'f85ce7cb29d15b6f4e7616de';
		$fgc = file_get_contents("https://v6.exchangerate-api.com/v6/".$API."/latest/".$from);
		
		if ($fgc) {
			$arr = json_decode($fgc, true);
			
			if ($arr['result'] == 'success') {
				$from = $arr['conversion_rates'][$from];

				$to = $arr['conversion_rates'][$to];
				$rate = $to / $from;
				$result = round($amount * $rate, 6);

				return $result;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}
?>