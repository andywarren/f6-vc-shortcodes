<?php
// This is the Foundation 6 Slider shortcode
// Foundation Documentation: http://foundation.zurb.com/sites/docs/slider.html
// Does not include http://foundation.zurb.com/sites/docs/slider.html#two-handles or http://foundation.zurb.com/sites/docs/slider.html#data-binding

// build the [f6_slider][/f6_slider] shortcode
// full shortcode - [f6_slider start="" end="" vertical="" disabled="" step_size=""][/f6_slider]
function f6_slider_shortcode($atts, $content = null) {

	$a = shortcode_atts(array(
		'start' => '0',
		'end' => '100',
		'vertical' => 'false',
		'disabled' => 'false',
		'step_size' => '1'	
	), $atts, 'f6_slider');

	// set variable from the start shortcode attribute
	$start = $a['start'];

	// set variable from the end shortcode attribute
	$end = $a['end'];

	// set variable from the vertical shortcode attribute to a boolean value
	$vertical = filter_var($a['vertical'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the disabled shortcode attribute to a boolean value
	$disabled = filter_var($a['disabled'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the step_size shortcode attribute
	$stepSize = $a['step_size'];

	$f6_slider = '<div class="slider' . ($vertical ? ' vertical' : '') . ($disabled ? ' disabled' : '') . '" data-slider data-initial-start="' . $start . '" data-end="' . $end . '"' . ($vertical ? ' data-vertical="true"' : '') . ' data-step="' . $stepSize . '">';

	$f6_slider .= '<span class="slider-handle"  data-slider-handle role="slider" tabindex="1"></span>';

	$f6_slider .= '<span class="slider-fill" data-slider-fill></span>';

	$f6_slider .= '<input type="hidden">';

	$f6_slider .= '</div>';

	return $f6_slider;

}

// Add shortcode [f6_slider]
add_shortcode('f6_slider', 'f6_slider_shortcode');

// map the shortcode to Visual Composer if Visual Composer exists
function f6_slider_shortcode_vc() {

	if (defined('WPB_VC_VERSION')) {

		// map the F6 Callout wrapper shortcode
		vc_map(array(
			'name' => __('Foundation 6 Slider', 'f6-vc-shortcodes'),
			'base' => 'f6_slider',
			'class' => '',
			'content_element' => true,			
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'params' => array(
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Starting Digit', 'f6-vc-shortcodes'),
					'param_name' => 'start',        
					'value' => '1',
					'description' => __('Enter the numerical digit that should be the starting point for the slider. <a target="_blank" href="http://foundation.zurb.com/sites/docs/slider.html#basics">Slide Basics Reference</a>', 'f6-vc-shortcodes'),					
				),
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Ending Digit', 'f6-vc-shortcodes'),
					'param_name' => 'end',        
					'value' => '100',
					'description' => __('Enter the numerical digit that should be the ending point for the slider. <a target="_blank" href="http://foundation.zurb.com/sites/docs/slider.html#basics">Slide Basics Reference</a>', 'f6-vc-shortcodes'),
				),
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Slider Layout', 'f6-vc-shortcodes'),
            		'param_name' => 'vertical',        
            		'value' => array(
            			__('Horizontal',  'f6-vc-shortcodes') => 'false',
                  		__('Vertical',  'f6-vc-shortcodes') => 'true',            			            	
  					),
  					'std' => 'false',
  					'description' => __('Choose either horizontal or verical layout for the slider. <a target="_blank" href="http://foundation.zurb.com/sites/docs/slider.html#vertical">Vertical Slider Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Disabled Slider', 'f6-vc-shortcodes'),
            		'param_name' => 'disabled',        
            		'value' => array(            			
            			__('False',  'f6-vc-shortcodes') => 'false',
            			__('True',  'f6-vc-shortcodes') => 'true',
  					),
  					'std' => 'false',
  					'description' => __('Choose if the slider should be disabled. <a target="_blank" href="http://foundation.zurb.com/sites/docs/slider.html#disabled">Disabled Slider Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Step Size', 'f6-vc-shortcodes'),
					'param_name' => 'step_size',        
					'value' => '1',
					'description' => __('Enter a numerical digit. This is the size of the step each tick of the slider is. Default is 1.', 'f6-vc-shortcodes'),					
				),
			),
		));

	}
}

add_action('vc_before_init', 'f6_slider_shortcode_vc');