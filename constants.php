<?php

	#Site URL:
	define('NQS_SITE_URL', home_url('/'));

	#R.N. customizations plugin URL:
	define('NQS_PLUGIN', site_url().'/wp-content/plugins/r-n-customizations/');

	#R.N. customizations plugin DIR:
	define('NQS_PLUGIN_DIR', ABSPATH.'wp-content/plugins/r-n-customizations/');

	#Theme URL:
	define('NQS_THEME_URL', site_url().'/wp-content/themes/bridge/');

	#Theme DIR:
	define('NQS_THEME_DIR', ABSPATH.'wp-content/themes/bridge/');

	#Uploaded files URL:
	define('NQS_UPLOADS', site_url().'/wp-content/uploads/');

	#Uploaded files DIR:
	define('NQS_UPLOADS_DIR', ABSPATH.'wp-content/uploads/');
	
	define('ICL_LANGUAGE_CODE', 'en');

	$link_parameters = $_SERVER['QUERY_STRING'];

	if (!empty($link_parameters)) $link_parameters = '/?'.$link_parameters;

	define('NQS_LINK_PARAMS', $link_parameters);
	define('NQS_LINK_PARAMS2', substr($link_parameters, 1));
	
	$s = substr(strtolower($_SERVER['SERVER_PROTOCOL']), 0, strpos($_SERVER['SERVER_PROTOCOL'], '/'));

	if (!empty($_SERVER["HTTPS"])) {
		$s .= ($_SERVER["HTTPS"] == "on") ? "s" : "";
	}

	$s .= '://'.$_SERVER['HTTP_HOST'];

	if (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != '80') {
		$s .= ':'.$_SERVER['SERVER_PORT'];
	}

	define('NQS_SELF_URL', $s.$_SERVER['REQUEST_URI']);

	if (strpos($_SERVER['REQUEST_URI'], '?')) {
		$temp = explode('?', $_SERVER['REQUEST_URI']);

		define('NQS_CURR_URL', $s.$temp[0]);
	} else {
		define('NQS_CURR_URL', $s.$_SERVER['REQUEST_URI']);
	}
	
	unset($s);
?>