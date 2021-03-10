<?php
	$nqs_settings_all_lang = $this->nqs_info['all_lang']['settings'];
?>
<div class="wrap">
	<h1><?=nqs_esc_html(ucfirst($this->folder))?></h1>
	<?php $this->print_msg(); ?>
	<div class="nqs_white2">
		<h2>General</h2>
		<form action="" method="post">
			<table class="form-table">
				<tr>
					<th scope="row">Unnecessary menus hiding:</th>
					<td>
					<select name="nqs_info[all_lang][no_yes]">
						<option value="0"<?=(($nqs_settings_all_lang['no_yes'] == 0) ? 'selected="selected"' : '')?>>Off</option>
						<option value="1"<?=(($nqs_settings_all_lang['no_yes'] == 1) ? 'selected="selected"' : '')?>>On</option>
					</select>
					</td>
				</tr>
				<tr>
					<th scope="row">DHL express shipping cost per 1kg:</th>
					<td><input name="nqs_info[all_lang][dhl_express_shipping_per_kg]" type="text" value="<?=floatval($nqs_settings_all_lang['dhl_express_shipping_per_kg'])?>" class="regular-text" />
						<p class="description"><i>For example 10</i></p>
					</td>
				</tr>
				<tr>
					<th scope="row">DHL express delivery time:</th>
					<td><input name="nqs_info[all_lang][dhl_express_delivery_time]" type="text" value="<?=nqs_esc_attr($nqs_settings_all_lang['dhl_express_delivery_time'])?>" class="regular-text" />
						<p class="description"><i>For example 1-3</i></p>
					</td>
				</tr>
				<tr>
					<th scope="row">DHL cargo shipping cost per 1kg:</th>
					<td><input name="nqs_info[all_lang][dhl_cargo_shipping_per_kg]" type="text" value="<?=floatval($nqs_settings_all_lang['dhl_cargo_shipping_per_kg'])?>" class="regular-text" />
						<p class="description"><i>For example 10</i></p>
					</td>
				</tr>
				<tr>
					<th scope="row">DHL cargo delivery time:</th>
					<td><input name="nqs_info[all_lang][dhl_cargo_delivery_time]" type="text" value="<?=nqs_esc_attr($nqs_settings_all_lang['dhl_cargo_delivery_time'])?>" class="regular-text" />
						<p class="description"><i>For example 1-3</i></p>
					</td>
				</tr>
				<tr>
					<th scope="row">DSV pallet shipping cost per 1m<sup>3</sup>:</th>
					<td><input name="nqs_info[all_lang][dsv_pallet_shipping_per_m3]" type="text" value="<?=floatval($nqs_settings_all_lang['dsv_pallet_shipping_per_m3'])?>" class="regular-text" />
						<p class="description"><i>For example 10</i></p>
					</td>
				</tr>
				<tr>
					<th scope="row">DSV pallet delivery time:</th>
					<td><input name="nqs_info[all_lang][dsv_pallet_delivery_time]" type="text" value="<?=nqs_esc_attr($nqs_settings_all_lang['dsv_pallet_delivery_time'])?>" class="regular-text" />
						<p class="description"><i>For example 1-3 working days</i></p>
					</td>
				</tr>
				<tr>
					<th scope="row">Rate of exchange kr -&gt; €:</th>
					<td><input name="nqs_info[all_lang][kr_rate_of_exchange]" type="text" value="<?=floatval($nqs_settings_all_lang['kr_rate_of_exchange'])?>" class="regular-text" id="isk_rate_field"/> 
						<input class="button-primary" type="button" value="Get from Exchangerate-api.com + 5%" id="get_rate_api"/>
						<p class="description"><i>For example 155.82</i></p>
					</td>
				</tr>
				<tr>
					<td colspan="2"><input class="button-primary" type="submit" name="sl_obj_settings" value="Update"/></td>
				</tr>
			</table>
		</form>
	</div>
</div>