<?php
// This is the Foundation 6 button group shortcode
// Foundation Documentation: http://foundation.zurb.com/sites/docs/button-group.html

// build the [f6_button_group][/f6_button_group] shortcode
// full shortcode - [f6_button_group size="" button-color="" even-width="" stacked="" group-class=""][/f6_button_group]
// stacked will not work if full-width is true
// split buttons not included in shortcode - http://foundation.zurb.com/sites/docs/button-group.html#split-buttons
function f6_button_group_shortcode($atts, $content = null) {
	
	$a = shortcode_atts(array(
		'size' => 'medium',
		'button-color' => 'primary',
		'even-width' => 'false',
		'stacked' => '',
		'group-class' => '',
	), $atts, 'f6_button_group');

	// set variable from the size shortcode attribute
	$size = $a['size'];

	// set variable from the button-color shortcode attribute
	$buttonColor = $a['button-color'];

	// set variable from the full-width shortcode attribute
	$evenWidth = filter_var($a['even-width'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the stacked shortcode attribute
	$stacked = $a['stacked'];

	// set variable from the group-class shortcode attribute
	$groupClass = $a['group-class'];

	// build the Foundation 6 button group wrapper
	$f6_button_group = '<div class="button-group ' . $buttonColor . ($size != 'medium' ? ' ' . $size : '') . ($evenWidth ? ' expanded' : '') . ((!$evenWidth) && ($stacked != '') ? ' ' . $stacked : '') . ($groupClass != '' ? ' ' . $groupClass : '') . '">';

	$f6_button_group .= do_shortcode($content);

	$f6_button_group .= '</div>';

	return $f6_button_group;

}

// Add shortcode [f6_button_group]
add_shortcode('f6_button_group', 'f6_button_group_shortcode');

// // build the [f6_button_group_button][/f6_button_group_button] shortcode
function f6_button_group_button_shortcode($atts, $content = null) {

	$a = shortcode_atts(array(
		'button-url' => 'Enter Button URL Here',
		'new-window' => 'false',
		'button-class' => '',
	), $atts, 'f6_button_group_button');

	// set variable from the button-url shortcode attribute
	$buttonURL = $a['button-url'];

	// set variable from the new-window shortcode attribute
	$newWindow = filter_var($a['new-window'], FILTER_VALIDATE_BOOLEAN);;

	// set variable from the button-class shortcode attribute
	$buttonClass = $a['button-class'];

	// build the Foundation 6 button group buttons
	$f6_button_group_button = '<a href="' . $buttonURL . '" ' . ($newWindow ? ' target="_blank"' : '') .' class="button' . ($buttonClass != '' ? ' ' . $buttonClass : '') . '">';

	$f6_button_group_button .= $content;

	$f6_button_group_button .= '</a>';

	return $f6_button_group_button;

}

// Add shortcode [f6_button_group_button][/f6_button_group_button]
add_shortcode('f6_button_group_button', 'f6_button_group_button_shortcode');

// map the shortcode to Visual Composer if Visual Composer exists
function f6_button_group_shortcode_vc() {

	if (defined('WPB_VC_VERSION')) {

		// map the F6 Button Group wrapper shortcode
		// http://foundation.zurb.com/sites/docs/button-group.html
		vc_map(array(
			'name' => __('Foundation 6 Button Group', 'f6-vc-shortcodes'),
			'base' => 'f6_button_group',
			'as_parent' => array('only' => 'f6_button_group_button'),
			'js_view' => 'VcColumnView',
			'class' => '',
			'content_element' => true,
			'is_container' => true,
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'admin_enqueue_css' => F6_VC_SHORTCODES_URL . 'css/f6-vc-button-group.css',
			'default_content' => '[f6_button_group_button]' . __('First Button Title - Edit this or add more buttons!', 'f6-vc-shortcodes') . '[/f6_button_group_button]',
			'params' => array(
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Button Size', 'f6-vc-shortcodes'),
            		'param_name' => 'size',        
            		'value' => array(
            			__('Tiny',  'f6-vc-shortcodes') => 'tiny',
    					__('Small',  'f6-vc-shortcodes') => 'small',
    					__('Medium',  'f6-vc-shortcodes') => 'medium',
    					__('Large',  'f6-vc-shortcodes') => 'large',
  					),
                	'std' => 'medium',
            		'description' => __('These are based on the button sizing set in Foundation SCSS or CSS. <a target="_blank" href="http://foundation.zurb.com/sites/docs/button-group.html#sizing">Size Reference</a>', 'f6-vc-shortcodes'),
				),
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Button Color', 'f6-vc-shortcodes'),
            		'param_name' => 'button-color',        
            		'value' => array(
            			__('Primary Color',  'f6-vc-shortcodes') => 'primary',
    					__('Secondary Color',  'f6-vc-shortcodes') => 'secondary',
    					__('Success Color',  'f6-vc-shortcodes') => 'success',
    					__('Alert Color',  'f6-vc-shortcodes') => 'alert',
    					__('Warning Color',  'f6-vc-shortcodes') => 'warning',
  					),
                	'std' => 'primary',
            		'description' => __('These are based on the color palette set in Foundation SCSS or CSS. <a target="_blank" href="http://foundation.zurb.com/sites/docs/button-group.html#coloring">Color Reference</a>', 'f6-vc-shortcodes'),
         		),
         		array(
                	'type' => 'dropdown',
                	'holder' => '',
                	'class' => '',
                	'heading' => __('Even Width Buttons', 'f6-vc-shortcodes'),
                	'param_name' => 'even-width',        
                	'value' => array(
                		__('False',  'f6-vc-shortcodes') => 'false',
                	    __('True',  'f6-vc-shortcodes') => 'true',
                	),
                	'std' => 'false',
                	'description' => __('Choose whether each button should be an even width and fill the container width. <a target="_blank" href="http://foundation.zurb.com/sites/docs/button-group.html#even-width-group">Even-width Reference</a>', 'f6-vc-shortcodes'),
            	),
            	array(
                	'type' => 'dropdown',
                	'holder' => '',
                	'class' => '',
                	'heading' => __('Stacked Buttons', 'f6-vc-shortcodes'),
                	'param_name' => 'stacked',        
                	'value' => array(
                		__('Not Stacked',  'f6-vc-shortcodes') => '',
                		__('Stacked On All Screen Sizes',  'f6-vc-shortcodes') => 'stacked',
                	    __('Stacked On Small Screens Only',  'f6-vc-shortcodes') => 'stacked-for-small',
                	    __('Stacked On Small and Medium Screens Only',  'f6-vc-shortcodes') => 'stacked-for-medium',
                	),
                	'std' => '',
                	'description' => __('Choose whether the buttons should be stacked on top of each other. <a target="_blank" href="http://foundation.zurb.com/sites/docs/button-group.html#stacking">Stacked Reference</a>', 'f6-vc-shortcodes'),
            	),
            	array(
                	'type' => 'textfield',
                	'holder' => '',
                	'class' => '',
                	'heading' => __('Custom CSS Class', 'f6-vc-shortcodes'),
                	'param_name' => 'group-class',        
                	'value' => '',
                	'description' => __('Enter a custom CSS Class name here if you would like to.', 'f6-vc-shortcodes'),
            	),	
			),
		));

		// map the F6 Button Group Button shortcode
		vc_map(array(
			'name' => __('Foundation 6 Button Group Button', 'f6-vc-shortcodes'),
			'base' => 'f6_button_group_button',
			'as_child' => array('only' => 'f6_button_group'),
			'class' => '',
			'content_element' => true,
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Button Text', 'f6-vc-shortcodes'),
					'param_name' => 'content',        
					'value' => '',
					'description' => __('Enter the text to be displayed on the button.', 'f6-vc-shortcodes'),
					'admin_label' => true,
				),
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Button URL', 'f6-vc-shortcodes'),
					'param_name' => 'button-url',        
					'value' => '',
					'description' => __('Enter the fully qualified URL the button will link to.', 'f6-vc-shortcodes'),
					'admin_label' => true,
				),
				array(
                	'type' => 'dropdown',
                	'holder' => '',
                	'class' => '',
                	'heading' => __('Open Link in New Window', 'f6-vc-shortcodes'),
                	'param_name' => 'new-window',        
                	'value' => array(
                		__('False',  'f6-vc-shortcodes') => 'false',
                	    __('True',  'f6-vc-shortcodes') => 'true',
                	),
                	'std' => 'false',
                	'description' => __('Choose if the link is opened in a new window/tab when clicked.', 'f6-vc-shortcodes'),
            	),
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Custom CSS Class', 'f6-vc-shortcodes'),
					'param_name' => 'button-class',        
					'value' => '',
					'description' => __('Enter a custom CSS Class name here if you would like to. This is applied to the individual button.', 'f6-vc-shortcodes'),
				),
			),

		));

		if (class_exists('WPBakeryShortCodesContainer')) {

    		class WPBakeryShortCode_f6_button_group extends WPBakeryShortCodesContainer {}

		}

		if (class_exists('WPBakeryShortCode')) {

    		class WPBakeryShortCode_f6_button_group_button extends WPBakeryShortCode {}

		}

	}

}

add_action( 'vc_before_init', 'f6_button_group_shortcode_vc' );

?>