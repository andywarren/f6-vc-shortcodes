<?php
// This is the Foundation 6 Menu shortcode
// Foundation Documentation: http://foundation.zurb.com/sites/docs/menu.html

// build the [f6_menu][/f6_menu] shortcode
// full shortcode - [f6_menu][/f6_menu]
function f6_menu_shortcode($atts, $content = null) {

	$a = shortcode_atts(array(
		'align' => 'align-left',
		'vertical' => 'false'
	), $atts, 'f6_menu');

	// set variable from the text shortcode attribute
	$align = $a['align'];

	// set variable from the vertical shortcode attribute to a boolean value
	$vertical = filter_var($a['vertical'], FILTER_VALIDATE_BOOLEAN);

	$f6_menu = '<ul class="menu ' . ($vertical ? 'vertical ' : '') . $align . '">';

	$f6_menu .= do_shortcode($content);

	$f6_menu .= '</ul>';

	return $f6_menu;

}

// Add shortcode [f6_slider]
add_shortcode('f6_menu', 'f6_menu_shortcode');

// build the [f6_menu_item][/f6_menu_item] shortcode
// full shortcode - [f6_menu_item][/f6_menu_item]
function f6_menu_item_shortcode($atts, $content = null) {

	$a = shortcode_atts(array(
		'text' => 'Link Text',
		'href' => 'https://www.402websites.com/',
		'target' => '_self',
		'active' => 'false'
	), $atts, 'f6_menu_item');

	// set variable from the text shortcode attribute
	$text = $a['text'];

	// set variable from the text shortcode attribute
	$href = $a['href'];

	// set variable from the text shortcode attribute
	$target = $a['target'];

	// set variable from the active shortcode attribute to a boolean value
	$active = filter_var($a['active'], FILTER_VALIDATE_BOOLEAN);

	$f6_menu_item = '<li class="' . ($active ? 'is-active' : '') . '"><a href="' . $href . '" target="' . $target . '">' . $text . '</a></li>';

	return $f6_menu_item;

}

// Add shortcode [f6_slider]
add_shortcode('f6_menu_item', 'f6_menu_item_shortcode');

// map the shortcode to Visual Composer if Visual Composer exists
function f6_menu_shortcode_vc() {

	if (defined('WPB_VC_VERSION')) {

		// map the F6 Orbit wrapper shortcode
		vc_map(array(
			'name' => __('Foundation 6 Menu', 'f6-vc-shortcodes'),
			'base' => 'f6_menu',
			'as_parent' => array('only' => 'f6_menu_item'),
			'js_view' => 'VcColumnView',
			'class' => '',
			'content_element' => true,
			'is_container' => true,
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'default_content' => '[f6_menu_item text="Link Text Goes Here" href="https://www.402websites.com/" target="_self" active="false"]',
			'show_settings_on_create' => true,
			'admin_enqueue_css' => F6_VC_SHORTCODES_URL . 'css/menu.css',
			'params' => array(				
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Menu Alignment', 'f6-vc-shortcodes'),
            		'param_name' => 'align',        
            		'value' => array(
                  		__('Align Left',  'f6-vc-shortcodes') => 'align-left',
            			__('Align Center',  'f6-vc-shortcodes') => 'align-center',
            			__('Align Right',  'f6-vc-shortcodes') => 'align-right',
  					),
  					'std' => 'align-left',
  					'description' => __('Choose the alignment of the menu. <a target="_blank" href="http://foundation.zurb.com/sites/docs/menu.html#item-alignment">Menu Alignment Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Menu Layout', 'f6-vc-shortcodes'),
            		'param_name' => 'vertical',        
            		'value' => array(
            			__('Horizontal',  'f6-vc-shortcodes') => 'false',
                  		__('Vertical',  'f6-vc-shortcodes') => 'true',            			
  					),
  					'std' => 'false',
  					'description' => __('Choose to have a horizontal or vertical menu. <a target="_blank" href="http://foundation.zurb.com/sites/docs/menu.html#vertical-menu">Vertical Menu Reference</a>', 'f6-vc-shortcodes'),
  				),   				
			),
		));

		// map the F6 Orbit Slide shortcode
		vc_map(array(
			'name' => __('Foundation 6 Menu Item', 'f6-vc-shortcodes'),
			'base' => 'f6_menu_item',
			'as_child' => array('only' => 'f6_menu'),
			'class' => '',
			'content_element' => true,
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'params' => array(
            	array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Link Text', 'f6-vc-shortcodes'),
					'param_name' => 'text',        
					'value' => 'Link Text Goes Here',
					'description' => __('Enter the link text here for the menu item.', 'f6-vc-shortcodes'),
					'admin_label' => true,
				),
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Link URL', 'f6-vc-shortcodes'),
					'param_name' => 'href',        
					'value' => 'https://www.402websites.com/',
					'description' => __('Enter the fully qualified url to be used in the menu item link. Can contain page anchors (#elementID).', 'f6-vc-shortcodes'),
					'admin_label' => true,
				),
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Anchor Target', 'f6-vc-shortcodes'),
            		'param_name' => 'target',        
            		'value' => array(
            			__('_self',  'f6-vc-shortcodes') => '_self',
                  		__('_blank',  'f6-vc-shortcodes') => '_blank',
                  		__('_parent',  'f6-vc-shortcodes') => '_parent',
                  		__('_top',  'f6-vc-shortcodes') => '_top',
  					),
  					'std' => '_self',
  					'description' => __('Choose the link target. <a target="_blank" href="https://www.w3schools.com/tags/att_a_target.asp">Link Target Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Active Menu Item', 'f6-vc-shortcodes'),
            		'param_name' => 'active',        
            		'value' => array(
            			__('False',  'f6-vc-shortcodes') => 'false',
                  		__('True',  'f6-vc-shortcodes') => 'true',
  					),
  					'std' => 'false',
  					'description' => __('Choose whether or not to apply the "active" styling to the menu item. <a target="_blank" href="http://foundation.zurb.com/sites/docs/menu.html#active-state">Active State Reference</a>', 'f6-vc-shortcodes'),
  				),
			),

		));

	}

	if (class_exists('WPBakeryShortCodesContainer')) {

    		class WPBakeryShortCode_f6_menu extends WPBakeryShortCodesContainer {}

		}

		if (class_exists('WPBakeryShortCode')) {

    		class WPBakeryShortCode_f6_menu_item extends WPBakeryShortCode {}

		}

}

add_action( 'vc_before_init', 'f6_menu_shortcode_vc' );