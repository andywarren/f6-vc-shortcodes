<form action='options.php' method='post'>

	<?php
		settings_fields('f6_vc_settings_group_1');
		do_settings_sections('f6-vc-shortcodes/f6-vc-settings.php');
		submit_button();
	?>

</form>