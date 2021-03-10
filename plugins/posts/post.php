<?php
	//add_meta_box('nqs_other', 'Other information', 'nqs_custom_info', 'product', 'side', 'low');

	function nqs_custom_info($post, $args)
	{
		global $wpdb;

		$nqs_info = get_option('nqs_info');
		$nqs_settings_all_lang = $nqs_info['all_lang']['settings'];
		$supplier_information = get_post_meta($post->ID, 'supplier_information', true); ?>

		<table style="border: 1px solid #cecece;width: 100%;margin-bottom: 3px;">
			<tr>
				<td style="text-align: center;">Supplier information:</td>
			</tr>
			<tr>
				<td style="text-align: center;"><input type="text" name="supplier_information" value="<?=((!empty($supplier_information)) ? esc_attr($supplier_information) : '')?>" style="width: 100%;"/></td>
			</tr>
		</table>
		<input type="hidden" id="kr_rate_of_exchange" value="<?=floatval($nqs_settings_all_lang['kr_rate_of_exchange'])?>"/>
	<?php }
?>