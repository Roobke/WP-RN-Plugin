<?php
	add_meta_box('nqs_other', 'Other information', 'nqs_custom_info', 'product', 'side', 'low');

	function nqs_custom_info($post, $args)
	{
		global $wpdb;

		$nqs_info = get_option('nqs_info');
		$nqs_settings_all_lang = $nqs_info['all_lang']['settings'];
		$buying_price = get_post_meta($post->ID, 'nqs_buying_price', true);
		$selling_margin = get_post_meta($post->ID, 'nqs_selling_margin', true);
		$package_volume = get_post_meta($post->ID, 'nqs_package_volume', true);
		$package_volume_length = get_post_meta($post->ID, 'nqs_package_volume_length', true);
		$package_volume_width = get_post_meta($post->ID, 'nqs_package_volume_width', true);
		$package_volume_height = get_post_meta($post->ID, 'nqs_package_volume_height', true);
		$package_weight = get_post_meta($post->ID, 'nqs_package_weight', true);
		$days_to_table = get_post_meta($post->ID, 'days_to_table', true);
		$shipping_method = get_post_meta($post->ID, 'shipping_method', true);
		$supplier_information = get_post_meta($post->ID, 'supplier_information', true); ?>

		<table style="border: 1px solid #cecece;width: 100%;margin-bottom: 3px;">
			<tr>
				<td style="text-align: center;">Buying price (EUR):</td>
				<td style="text-align: center;">Selling margin (EUR):</td>
			</tr>
			<tr>
				<td style="text-align: center;"><input type="text" name="nqs_buying_price" value="<?=((!empty($buying_price)) ? floatval($buying_price) : '')?>" class="allownumericwithdecimal" style="width: 70px;text-align: center;"/></td>
				<td style="text-align: center;"><input type="text" name="nqs_selling_margin" value="<?=((!empty($selling_margin)) ? floatval($selling_margin) : '')?>" class="allownumericwithdecimal" style="width: 70px;text-align: center;"/></td>
			</tr>
		</table>
		<table style="border: 1px solid #cecece;width: 100%;margin-bottom: 3px;">
			<tr>
				<td style="text-align: center;">Package volume (m<sup>3</sup>):</td>
			</tr>
			<tr>
				<td style="text-align: center;"><input type="text" name="nqs_package_volume" value="<?=((!empty($package_volume)) ? floatval($package_volume) : '')?>" class="allownumericwithdecimal" style="width: 70px;text-align: center;"/></td>
			</tr>
			<tr>
				<td style="text-align: center;">or</td>
			</tr>
			<tr>
				<td style="text-align: center;">Dimensions (L×W×H) (cm):</td>
			</tr>
			<tr>
				<td style="text-align: center;">
					<input type="text" name="nqs_package_volume_length" value="<?=((!empty($package_volume_length)) ? floatval($package_volume_length) : '')?>" class="allownumericwithdecimal" style="width: 70px;;text-align: center;"/>
					<input type="text" name="nqs_package_volume_width" value="<?=((!empty($package_volume_width)) ? floatval($package_volume_width) : '')?>" class="allownumericwithdecimal" style="width: 70px;;text-align: center;"/>
					<input type="text" name="nqs_package_volume_height" value="<?=((!empty($package_volume_height)) ? floatval($package_volume_height) : '')?>" class="allownumericwithdecimal" style="width: 70px;;text-align: center;"/>
				</td>
			</tr>
		</table>
		<table style="border: 1px solid #cecece;width: 100%;margin-bottom: 3px;">
			<tr>
				<td style="text-align: center;">Package weight (kg):</td>
			</tr>
			<tr>
				<td style="text-align: center;"><input type="text" name="nqs_package_weight" value="<?=((!empty($package_weight)) ? floatval($package_weight) : '')?>" class="allownumericwithdecimal" style="width: 70px;text-align: center;"/></td>
			</tr>
		</table>
		<table style="border: 1px solid #cecece;width: 100%;margin-bottom: 3px;">
			<tr>
				<td style="text-align: center;">Days to table:</td>
				<td style="text-align: center;">Shipping method:</td>
			</tr>
			<tr>
				<td style="text-align: center;"><input type="text" name="days_to_table" value="<?=((!empty($days_to_table)) ? intval($days_to_table) : '')?>" style="width: 120px;text-align: center;"/></td>
				<td style="text-align: center;"><input type="text" name="shipping_method" value="<?=((!empty($shipping_method)) ? esc_attr($shipping_method) : '')?>" style="width: 120px;text-align: center;"/></td>
			</tr>
		</table>
		<table style="border: 1px solid #cecece;width: 100%;margin-bottom: 3px;">
			<tr>
				<td style="text-align: center;">Supplier information:</td>
			</tr>
			<tr>
				<td style="text-align: center;"><input type="text" name="supplier_information" value="<?=((!empty($supplier_information)) ? esc_attr($supplier_information) : '')?>" style="width: 100%;"/></td>
			</tr>
		</table>
		<input type="hidden" id="dhl_express_shipping_per_kg" value="<?=floatval($nqs_settings_all_lang['dhl_express_shipping_per_kg'])?>"/>
		<input type="hidden" id="dhl_cargo_shipping_per_kg" value="<?=floatval($nqs_settings_all_lang['dhl_cargo_shipping_per_kg'])?>"/>
		<input type="hidden" id="dsv_pallet_shipping_per_m3" value="<?=floatval($nqs_settings_all_lang['dsv_pallet_shipping_per_m3'])?>"/>
		<input type="hidden" id="kr_rate_of_exchange" value="<?=floatval($nqs_settings_all_lang['kr_rate_of_exchange'])?>"/>
	<?php }
?>