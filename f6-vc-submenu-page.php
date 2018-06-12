<?php
/************************************
Register and add the F6 Shortcodes for VC
submenu page in the Appearance menu
************************************/
function f6_vc_submenu_page(){

   	add_theme_page(
    	__('Foundation 6 Shortcodes', 'f6-vc-shortcodes'),
        __('Foundation 6 Shortcodes', 'f6-vc-shortcodes'),
        'activate_plugins',
        'f6-vc-shortcodes/f6-vc-settings.php'
    );

}

add_action('admin_menu', 'f6_vc_submenu_page');

/************************************
Start building the settings for the plugin
************************************/

function f6_vc_settings() {

	register_setting('f6_vc_settings_group_1', 'f6_vc_enqueue_files');

	add_settings_section(
		'f6-vs-settings_group_1',
		__('Foundation 6 Shortcodes for Visual Composer', 'f6-vc-shortcodes' ),
		'f6_vs_settings_group_1_callback',
		'f6-vc-shortcodes/f6-vc-settings.php'
	);

	add_settings_field(
		'f6-vc-enqueue',
		'Foundation 6 CSS & JS',
		'f6_vc_enqueue_field_callback',
		'f6-vc-shortcodes/f6-vc-settings.php',
		'f6-vs-settings_group_1'
	);

}

function f6_vs_settings_group_1_callback() { 

	echo __('', 'f6-vc-shortcodes');

}

function f6_vc_enqueue_field_callback() { 

	$options = get_option('f6_vc_enqueue_files');

	echo  __('<p>Only check this box if you are sure your theme does <strong>NOT</strong> already enqueue Foundation 6 CSS & JS.</p><br/><input id="f6-vc-enqueue-checkbox" type="checkbox" name="f6_vc_enqueue_files"' . checked(1, get_option('f6_vc_enqueue_files'), false) . ' value="1"> <label for="f6-vc-enqueue-checkbox">Check to enqueue Foundation 6 CSS & JS files to the frontend.</label>', 'f6-vc-shortcodes');

}

add_action('admin_init', 'f6_vc_settings');

?>