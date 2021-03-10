<?php
	class NqsPosts
	{
		public function __construct()
		{
			global $wpdb;
			
			add_action('admin_menu', array(&$this, 'addMetaboxes'));
			add_action('save_post', array(&$this, 'savePost'));
			add_action('edit_attachment', array(&$this, 'savePost'));
		}

		public function addMetaboxes() 
		{
			global $wpdb;
			
			if (function_exists('add_meta_box')) {
				include_once NQS_PLUGIN_DIR.'plugins/posts/post.php';
			}
		}
		
		public function savePost($post_id)
		{
			global $post, $wpdb, $current_user, $states_list;

			if (empty($post)) return $post_id;

			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;

			if (!current_user_can('edit_post', $post_id)) return $post_id;
			
			include_once NQS_PLUGIN_DIR.'plugins/posts/post_save.php';
			
			return $post_id;
		}
	}

	$obj_nqspp = new NqsPosts();
?>