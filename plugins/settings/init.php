<?php
	if (isset($_POST['sl_obj_settings'])) {
		$_POST = nqs_clean_array($_POST);
		
		$keys = array(
			'no_yes',
		);
		
		if (isset($_POST['nqs_info']['all_lang'])) {
			foreach ($_POST['nqs_info']['all_lang'] as $key => $value) {
				if (in_array($key, $keys)) {
					if ($key == 'no_yes') {
						$value = absint($value);

						if ($value > 1) $value = 0;
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