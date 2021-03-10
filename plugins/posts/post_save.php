<?php
	if ($post->post_type == 'page' || $post->post_type == 'post' || $post->post_type == 'product') {
		global $wpdb;
		
		$_POST = nqs_clean_array($_POST);

		if ($post->post_type == 'product') {
			$buying_price = floatval($_POST['nqs_buying_price']);
			$selling_margin = floatval($_POST['nqs_selling_margin']);
			$package_volume = floatval($_POST['nqs_package_volume']);
			$package_volume_length = floatval($_POST['nqs_package_volume_length']);
			$package_volume_width = floatval($_POST['nqs_package_volume_width']);
			$package_volume_height = floatval($_POST['nqs_package_volume_height']);
			$package_weight = floatval($_POST['nqs_package_weight']);
			$days_to_table = intval($_POST['days_to_table']);
			$shipping_method = esc_attr($_POST['shipping_method']);
			$supplier_information = esc_attr($_POST['supplier_information']);
			
			update_post_meta($post->ID, 'nqs_buying_price', $buying_price);
			update_post_meta($post->ID, 'nqs_selling_margin', $selling_margin);
			update_post_meta($post->ID, 'nqs_package_volume', $package_volume);
			update_post_meta($post->ID, 'nqs_package_volume_length', $package_volume_length);
			update_post_meta($post->ID, 'nqs_package_volume_width', $package_volume_width);
			update_post_meta($post->ID, 'nqs_package_volume_height', $package_volume_height);
			update_post_meta($post->ID, 'nqs_package_weight', $package_weight);
			update_post_meta($post->ID, 'days_to_table', $days_to_table);
			update_post_meta($post->ID, 'shipping_method', $shipping_method);
			update_post_meta($post->ID, 'supplier_information', $supplier_information);
		}
	}
?>