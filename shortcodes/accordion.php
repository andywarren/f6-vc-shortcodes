<?php
// This is the Foundation 6 accordion shortcode
// Foundation Documentation: http://foundation.zurb.com/sites/docs/accordion.html

// build the [f6_accordion][/f6_accordion] shortcode
// full shortcode - [f6_accordion accordion-class=""][/f6_accordion]
function f6_accordion_shortcode($atts, $content = null) {
	
	$a = shortcode_atts(array(
		'accordion-class' => '',
	), $atts, 'f6_accordion');

	// set variable from the sectionCustomClass shortcode attribute
	$accordionClass = $a['accordion-class'];

	// build the Foundation 6 accordion wrapper
	$f6_accordion = '<ul class="accordion' . ($accordionClass != '' ? ' ' . $accordionClass : '') . '" data-accordion data-multi-expand="true">';

	$f6_accordion .= do_shortcode($content);

	$f6_accordion .= '</ul>';

	return $f6_accordion;

}

// Add shortcode [f6_accordion]
add_shortcode('f6_accordion', 'f6_accordion_shortcode');

// build the [f6_accordion_panel][/f6_accordion_panel] shortcode
// full shortcode - [f6_accordion_panel panel-class="" panel-title="" active-on-load=""][/f6_accordion_panel]
function f6_accordion_panel_shortcode($atts, $content = null) {
	
	$a = shortcode_atts(array(
		'panel-class' => '',
		'panel-title' => 'Enter Title Here',
		'active-on-load' => 'false',
	), $atts, 'f6_accordion_panel');

	// set variable from the panel-class shortcode attribute
	$panelClass = $a['panel-class'];

	// set variable from the panel-title shortcode attribute
	$panelTitle = $a['panel-title'];

	// set variable from the active-on-load shortcode attribute
	$activeOnLoad = filter_var($a['active-on-load'], FILTER_VALIDATE_BOOLEAN);

	// build the Foundation 6 accordion sections
	$f6_accordion_panel = '<li class="accordion-item' . ($activeOnLoad ? ' is-active' : '') .  ($panelClass != '' ? ' ' . $panelClass : '') . '" data-accordion-item>';

	$f6_accordion_panel .= '<a href="#" class="accordion-title">' . $panelTitle . '</a>';

	$f6_accordion_panel .= '<div class="accordion-content" data-tab-content>' . $content . '</div>';

	$f6_accordion_panel .= '</li>';

	return $f6_accordion_panel;

}

// Add shortcode [f6_accordion_panel]
add_shortcode('f6_accordion_panel', 'f6_accordion_panel_shortcode');

// map the shortcode to Visual Composer if Visual Composer exists
function f6_accordion_shortcode_vc() {

	if (defined('WPB_VC_VERSION')) {

		// map the F6 Accordion wrapper shortcode
		vc_map(array(
			'name' => __('Foundation 6 Accordion', 'f6-vc-shortcodes'),
			'base' => 'f6_accordion',
			'as_parent' => array('only' => 'f6_accordion_panel'),
			'js_view' => 'VcColumnView',
			'class' => '',
			'content_element' => true,
			'is_container' => true,
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'default_content' => '[f6_accordion_panel panel-title="' . __('First Panel Title - Edit This or add more panels!', 'f6-vc-shortcodes') . '"][/f6_accordion_panel]',
			'show_settings_on_create' => false,
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Custom CSS Class', 'f6-vc-shortcodes'),
					'param_name' => 'accordion-class',        
					'value' => '',
					'description' => __('Enter a custom CSS Class name here if you would like to. This is applied to the accordion container.', 'f6-vc-shortcodes'),
				),
			),
		));

		// map the F6 Accordion panel shortcode
		vc_map(array(
			'name' => __('Foundation 6 Accordion Panel', 'f6-vc-shortcodes'),
			'base' => 'f6_accordion_panel',
			'as_child' => array('only' => 'f6_accordion'),
			'class' => '',
			'content_element' => true,
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'show_settings_on_create' => true,
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Panel Title', 'f6-vc-shortcodes'),
					'param_name' => 'panel-title',        
					'value' => '',
					'description' => __('Enter the title for the accordion panel here.', 'f6-vc-shortcodes'),
					'admin_label' => true,
				),
				array(
					'type' => 'textarea_html',
					'holder' => '',
					'class' => '',
					'heading' => __('Panel Content', 'f6-vc-shortcodes'),
					'param_name' => 'content',        
					'value' => '',
					'description' => __('Enter the content for the accordion panel here.', 'f6-vc-shortcodes'),
				),
				array(
					'type' => 'checkbox',
					'holder' => '',
					'class' => '',
					'heading' => __('Open Panel On Page Load', 'f6-vc-shortcodes'),
					'param_name' => 'active-on-load',        
					'value' => '',
					'std' => 'false',
					'description' => __('Check the box to make this accordion panel be open on page load.', 'f6-vc-shortcodes'),
				),
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Custom CSS Class', 'f6-vc-shortcodes'),
					'param_name' => 'panel-class',        
					'value' => '',
					'description' => __('Enter a custom CSS Class name here if you would like to. This is applied to the accordion panel.', 'f6-vc-shortcodes'),
				),
			),

		));

		if (class_exists('WPBakeryShortCodesContainer')) {

    		class WPBakeryShortCode_f6_accordion extends WPBakeryShortCodesContainer {}

		}

		if (class_exists('WPBakeryShortCode')) {

    		class WPBakeryShortCode_f6_accordion_panel extends WPBakeryShortCode {}

		}	

	}

}

add_action( 'vc_before_init', 'f6_accordion_shortcode_vc' );

?>