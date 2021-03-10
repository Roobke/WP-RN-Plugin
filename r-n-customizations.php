<?php
	/*
		Plugin Name: R.N. customizations
		Plugin URI: http://robertasn.lt
		Description: Plugin for some additional functions and options.
		Author: https://robertasn.lt
		Version: 1.0
		Author URI: http://robertasn.lt
	*/
	
	global $wpdb;
	
	@session_start();
	
	include_once("functions.php");
	include_once("constants.php");
	include_once("filters.php");
	include_once("ajax.php");
	
	register_activation_hook(__FILE__, 'r_n_customizations_install');
	register_deactivation_hook(__FILE__, 'r_n_customizations_uninstall');

	class NqsHelp
	{
		public function __construct()
		{
			global $wpml_request_handler;

			#Default nqs_info information:
			$nqs_info = get_option('nqs_info');
			$update = false;

			if (!defined('ICL_LANGUAGE_CODE')) {
				define('ICL_LANGUAGE_CODE', $wpml_request_handler->get_requested_lang());
			}

			if (!isset($nqs_info[ICL_LANGUAGE_CODE]['settings'])) {
				//$update = true;
				//$nqs_info[ICL_LANGUAGE_CODE]['settings'] = array('no_yes' => 0);
			}

			if (!isset($nqs_info['all_lang']['settings'])) {
				$update = true;
				$nqs_info['all_lang']['settings'] = array();
			}

			if ($update) update_option('nqs_info', $nqs_info);

			add_action('init', array(&$this, 'create_taxonomies'));
			add_action('admin_menu', array(&$this, 'remove_dashboard_widgets'));
			add_action('admin_head', array(&$this, 'admin_head'));
		    
		    if ($nqs_info['all_lang']['settings']['no_yes']) {
		  		add_action('admin_menu', array(&$this, 'remove_menus'));
			}

			add_action('wp_dashboard_setup', array(&$this, 'disable_browser_upgrade_warning'));
    		remove_action('welcome_panel', 'wp_welcome_panel');
		}

		public function admin_head() { ?>
			<link rel="stylesheet" href="<?=NQS_PLUGIN?>assets/css/custom_styles.css" type="text/css"/>
			<script type="text/javascript" src="<?=NQS_PLUGIN?>assets/js/custom_js.js?r=<?php echo rand(0, 9999999); ?>"></script>
		<?php }

		public function remove_menus()
		{
			global $menu;
			
			$restricted = array(__('Posts'), __('Authors'), __('Portfolio'), __('Testimonial'));
			
			end($menu);

			while (prev($menu)) {
				$value = explode(' ', $menu[key($menu)][0]);
				
				if (in_array($value[0] != NULL ? $value[0] : "", $restricted)) {
					unset($menu[key($menu)]);
				}
			}
		}
		
		public function remove_dashboard_widgets()
		{
			//remove_submenu_page('tools.php', 'bbp-repair');
			//remove_submenu_page('options-general.php', 'bbpress');
		}
		
		public function create_taxonomies()
		{

		}
		
		public function disable_browser_upgrade_warning()
		{
			remove_meta_box('dashboard_browser_nag', 'dashboard', 'normal');
		}
	}
	
	$obj_nqshelp = new NqsHelp();
	
	include_once("plugins/settings/__construct.php");
	include_once("plugins/posts/__construct.php");
?>