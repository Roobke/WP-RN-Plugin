<?php
	if ($post->post_type == 'page' || $post->post_type == 'post' || $post->post_type == 'product') {
		$_POST = nqs_clean_array($_POST);

		if ($post->post_type == 'product') {
			//$supplier_information = esc_attr($_POST['supplier_information']);
			
			//update_post_meta($post->ID, 'supplier_information', $supplier_information);
		}
	}
?>