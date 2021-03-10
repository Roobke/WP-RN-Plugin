<?php 
	class NqsSettings
	{
		public function __construct()
		{
			global $wpdb;
			
			$this->nqs_info = get_option('nqs_info');
			$this->lang = ICL_LANGUAGE_CODE;
			$this->folder = 'settings';
			$this->name = ucfirst($this->folder);
			$this->pagename = 'nqs_'.$this->folder;
			$this->hook = 'admin.php';

			if (strpos($this->hook, '?') !== false) {
				$this->hook_end = '&';
			} else {
				$this->hook_end = '?';
			}

			$entry = NQS_SITE_URL.'wp-admin/'.$this->hook.$this->hook_end.'page=';
			$this->href = $entry.$this->pagename;
			
			add_action('admin_menu', array(&$this, 'admin_menu'));
			add_action('init', array(&$this, 'init'));
		}
		
		private function print_msg()
		{
			if (!isset($_GET['msg'])) {
				return;
			} else {
				echo '<div class="updated" id="message"><p>Settings updated.</p></div>';
			}
		}
		
		public function admin_menu()
		{
			$img = NQS_PLUGIN.'plugins/'.$this->folder.'/image.png';

			add_menu_page('Advanced settings',  'Advanced settings', 10, $this->pagename, array($this, 'admin_page'), $img);
		}
		
		public function init()
		{
			global $wpdb, $social_networks_arr;
			
			if (isset($_GET['page']) && ($_GET['page'] == 'nqs_settings')) include_once('init.php');
		}
		
		public function admin_page()
		{
			global $wpdb;
			
			wp_enqueue_media();
			
			include_once('admin_page.php');
		}
	}
	
	$NqsSettings = new NqsSettings();
?>