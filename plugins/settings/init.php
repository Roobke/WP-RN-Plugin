<?php
	if (isset($_POST['sl_obj_settings'])) {
		$_POST = nqs_clean_array($_POST);
		
		$keys = array(
			'no_yes',
			'dhl_express_shipping_per_kg',
			'dhl_express_delivery_time',
			'dhl_cargo_shipping_per_kg',
			'dhl_cargo_delivery_time',
			'dsv_pallet_shipping_per_m3',
			'dsv_pallet_delivery_time',
			'kr_rate_of_exchange',
		);
		
		if (isset($_POST['nqs_info']['all_lang'])) {
			foreach ($_POST['nqs_info']['all_lang'] as $key => $value) {
				if (in_array($key, $keys)) {
					if ($key == 'no_yes') {
						$value = absint($value);

						if ($value > 1) $value = 0;
					} else if ($key == 'dhl_express_shipping_per_kg' || $key == 'dhl_cargo_shipping_per_kg' || $key == 'dsv_pallet_shipping_per_m3' || $key == 'kr_rate_of_exchange') {
						$value = floatval($value);

						if ($value < 0) $value = 0;
					}

					$this->nqs_info['all_lang']['settings'][$key] = $value;
				}
			}
		}
		
		update_option('nqs_info', $this->nqs_info);
		
		$file_prefix = 'wp-cache-';
		
		if (function_exists('wp_cache_clean_cache')) {
			wp_cache_clean_cache('wp-cache-');
		} else if (function_exists('w3tc_flush_all')) {
			w3tc_flush_all();
		}
		
		header("Location: ".$this->href."&msg=1");

		exit;
	}
?>