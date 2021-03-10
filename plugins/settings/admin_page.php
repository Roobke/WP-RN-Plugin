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
					<td colspan="2"><input class="button-primary" type="submit" name="sl_obj_settings" value="Update"/></td>
				</tr>
			</table>
		</form>
	</div>
</div>