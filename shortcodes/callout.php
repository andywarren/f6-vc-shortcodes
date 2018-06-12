<?php
// This is the Foundation 6 callout shortcode
// Foundation Documentation: http://foundation.zurb.com/sites/docs/callout.html

// build the [f6_callout] shortcode
// full shortcode - [f6_callout color="" size="" closable="" custom-class=""]
function f6_callout_shortcode($atts, $content = null) {

	$a = shortcode_atts(array(
		'color' => 'default', // http://foundation.zurb.com/sites/docs/callout.html#coloring
		'size' => 'default', // http://foundation.zurb.com/sites/docs/callout.html#sizing
		'closable' => 'false', //http://foundation.zurb.com/sites/docs/callout.html#making-closable
		'custom-class' => ''
	), $atts, 'f6_callout');

	// set variable from the color shortcode attribute
	$color = $a['color'];

	// set variable from the size shortcode attribute
	$size = $a['size'];

	// set variable from the close shortcode attribute
	$closable = filter_var($a['closable'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the custom-class shortcode attribute
	$customClass = $a['custom-class'];

	// build the f6 callout
	$f6_callout = '<div class="callout ' . $size . ' ' . $color . ($customClass != '' ? ' ' . $customClass : '') .'"' . ($closable ? ' data-closable' : '') . '>';

	$f6_callout .= $content;

	if ($closable) {

		$f6_callout .= '<button class="close-button" aria-label="Dismiss alert" type="button" data-close><span aria-hidden="true">&times;</span></button>';

	}

	$f6_callout .= '</div>';

	return $f6_callout;

}

// Add shortcode [f6_callout]
add_shortcode( 'f6_callout', 'f6_callout_shortcode');

// map the shortcode to Visual Composer if Visual Composer exists
function f6_callout_shortcode_vc() {

	if (defined('WPB_VC_VERSION')) {

		// map the F6 Callout wrapper shortcode
		vc_map(array(
			'name' => __('Foundation 6 Callout', 'f6-vc-shortcodes'),
			'base' => 'f6_callout',
			'class' => '',
			'content_element' => true,			
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'params' => array(
				array(
					'type' => 'textarea_html',
					'holder' => '',
					'class' => '',
					'heading' => __('Callout Content', 'f6-vc-shortcodes'),
					'param_name' => 'content',        
					'description' => __('Enter the callout content here.', 'f6-vc-shortcodes'),
				),
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Callout Background Color', 'f6-vc-shortcodes'),
            		'param_name' => 'color',        
            		'value' => array(
                  		__('Default',  'f6-vc-shortcodes') => 'default',
            			__('Primary',  'f6-vc-shortcodes') => 'primary',
            			__('Secondary',  'f6-vc-shortcodes') => 'secondary',
            			__('Success',  'f6-vc-shortcodes') => 'success',
            			__('Warning',  'f6-vc-shortcodes') => 'warning',
            			__('alert',  'f6-vc-shortcodes') => 'alert',	
  					),
  					'std' => 'default',
  					'description' => __('Choose the callout background color. These are based on the Foundation color palette. <a target="_blank" href="https://foundation.zurb.com/sites/docs/callout.html#coloring">Color Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Callout Size', 'f6-vc-shortcodes'),
            		'param_name' => 'size',        
            		'value' => array(
                  		__('Default',  'f6-vc-shortcodes') => 'default',
            			__('Small',  'f6-vc-shortcodes') => 'small',
            			__('Large',  'f6-vc-shortcodes') => 'large',	
  					),
  					'std' => 'default',
  					'description' => __('Choose the callout size. <a target="_blank" href="https://foundation.zurb.com/sites/docs/callout.html#sizing">Size Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Allow Callout to be closed', 'f6-vc-shortcodes'),
            		'param_name' => 'closable',        
            		'value' => array(
                  		__('False',  'f6-vc-shortcodes') => 'false',
            			__('True',  'f6-vc-shortcodes') => 'true',            	
  					),
  					'std' => 'false',
  					'description' => __('Choose whether the callout should be closable. <a target="_blank" href="https://foundation.zurb.com/sites/docs/callout.html#making-closable">Closable Reference</a>', 'f6-vc-shortcodes'),
  				),
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

	}

}

add_action('vc_before_init', 'f6_callout_shortcode_vc');