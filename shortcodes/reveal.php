<?php
// This is the Foundation 6 reveal shortcode
// Foundation Documentation: http://foundation.zurb.com/sites/docs/reveal.html

// build the [f6_reveal] shortcode
// full shortcode - [f6_reveal id="" size="" overlay="" in="" out="" open-button="" button-text="" custom-class=""]
function f6_reveal_shortcode($atts, $content = null) {

	$a = shortcode_atts(array(
		'id' => '',
		'size' => 'default-size',
		'overlay' => 'true',
		'in' => 'none',
		'out' => 'none',
		'open-button' => 'false',
		'button-text' => 'Click me for a modal',
		'custom-class' => '',
	), $atts, 'f6_reveal');

	// set variable from the id shortcode attribute
	$id = $a['id'];

	// set variable from the size shortcode attribute
	$size = $a['size'];

	// set variable from the overlay shortcode attribute
	$overlay = $a['overlay'];

	// set variable from the open-button shortcode attribute
	$openButton = filter_var($a['open-button'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the button-text shortcode attribute
	$buttonText = $a['button-text'];

	// set variable from the button-text shortcode attribute
	$in = $a['in'];

	// set variable from the button-text shortcode attribute
	$out = $a['out'];

	// set variable from the custom-class shortcode attribute
	$customClass = $a['custom-class'];

	// build the f6 reveal shortcode
	$f6_reveal = '<div class="f6-reveal reveal ' . $size . ' ' . $customClass . '" id="' . $id . '" data-reveal data-overlay="' . $overlay . '" data-animation-in="' . $in . '" data-animation-out="' . $out . '">';

	$f6_reveal .= $content;

	$f6_reveal .= '<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>';

	$f6_reveal .= '</div>'; // modal closing div

	if ($openButton) {

		$f6_reveal .= '<button class="button da-button da-secondary-button  da-medium-button" data-open="' . $id . '">' . $buttonText . '</button>';

	}

	return $f6_reveal;

}

// Add shortcode [f6_reveal]
add_shortcode( 'f6_reveal', 'f6_reveal_shortcode');

// map the shortcode to Visual Composer if Visual Composer exists
function f6_reveal_shortcode_vc() {

	if (defined('WPB_VC_VERSION')) {

		// map the F6 Callout wrapper shortcode
		vc_map(array(
			'name' => __('Foundation 6 Reveal', 'f6-vc-shortcodes'),
			'base' => 'f6_reveal',
			'class' => '',
			'content_element' => true,			
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'params' => array(
				array(
					'type' => 'textarea_html',
					'holder' => '',
					'class' => '',
					'heading' => __('Reveal Modal Content', 'f6-vc-shortcodes'),
					'param_name' => 'content',        
					'description' => __('Enter the modal content here.', 'f6-vc-shortcodes'),
				),
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('ID', 'f6-vc-shortcodes'),
					'param_name' => 'id',        
					'value' => '',
					'description' => __('Enter a unique HTML ID here. The modal will not work without this ID. Apply <strong>data-open="thisID"</strong> to any element to open the modal on click.', 'f6-vc-shortcodes'),
				),
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Reveal Modal Size', 'f6-vc-shortcodes'),
            		'param_name' => 'size',        
            		'value' => array(
                  		__('Tiny',  'f6-vc-shortcodes') => 'tiny',
            			__('Small',  'f6-vc-shortcodes') => 'small',
            			__('Default',  'f6-vc-shortcodes') => 'default-size',
            			__('Large',  'f6-vc-shortcodes') => 'large',
            			__('Full Screen',  'f6-vc-shortcodes') => 'full',
  					),
  					'std' => 'default-size',
  					'description' => __('Choose the size of the modal. <a target="_blank" href="http://foundation.zurb.com/sites/docs/reveal.html#sizing">Modal Size Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Show modal background overlay?', 'f6-vc-shortcodes'),
            		'param_name' => 'overlay',        
            		'value' => array(
                  		__('True',  'f6-vc-shortcodes') => 'true',
            			__('False',  'f6-vc-shortcodes') => 'false',            	
  					),
  					'std' => 'true',
  					'description' => __('Choose whether to show the background overlay when the modal is opened. <a target="_blank" href="http://foundation.zurb.com/sites/docs/reveal.html#no-overlay">No Overlay Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Open/In Transition', 'f6-vc-shortcodes'),
            		'param_name' => 'in',        
            		'value' => array(
            			__('None',  'f6-vc-shortcodes') => 'none',
                  		__('slide-in-down',  'f6-vc-shortcodes') => 'slide-in-down',
            			__('slide-in-left',  'f6-vc-shortcodes') => 'slide-in-left',
            			__('slide-in-up',  'f6-vc-shortcodes') => 'slide-in-up',
            			__('slide-in-right',  'f6-vc-shortcodes') => 'slide-in-right',            			
            			__('fade-in',  'f6-vc-shortcodes') => 'fade-in',            			
            			__('hinge-in-from-top',  'f6-vc-shortcodes') => 'hinge-in-from-top',
            			__('hinge-in-from-right',  'f6-vc-shortcodes') => 'hinge-in-from-right',
            			__('hinge-in-from-bottom',  'f6-vc-shortcodes') => 'hinge-in-from-bottom',
            			__('hinge-in-from-left',  'f6-vc-shortcodes') => 'hinge-in-from-left',
            			__('hinge-in-from-middle-x',  'f6-vc-shortcodes') => 'hinge-in-from-middle-x',
            			__('hinge-in-from-middle-y',  'f6-vc-shortcodes') => 'hinge-in-from-middle-y',            			
            			__('scale-in-up',  'f6-vc-shortcodes') => 'scale-in-up',
            			__('scale-in-down',  'f6-vc-shortcodes') => 'scale-in-down',            			
            			__('spin-in',  'f6-vc-shortcodes') => 'spin-in',            			
            			__('spin-in-ccw',  'f6-vc-shortcodes') => 'spin-in-ccw',            			
  					),
  					'std' => 'none',
  					'description' => __('Choose a transition to be used when the modal opens. <a target="_blank" href="http://foundation.zurb.com/sites/docs/reveal.html#animations">Animations Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Close/Out Transition', 'f6-vc-shortcodes'),
            		'param_name' => 'out',        
            		'value' => array(
            			__('None',  'f6-vc-shortcodes') => 'none',                  		
            			__('slide-out-down',  'f6-vc-shortcodes') => 'slide-out-down',
            			__('slide-out-left',  'f6-vc-shortcodes') => 'slide-out-left',
            			__('slide-out-up',  'f6-vc-shortcodes') => 'slide-out-up',
            			__('slide-out-right',  'f6-vc-shortcodes') => 'slide-out-right',            		
            			__('fade-out',  'f6-vc-shortcodes') => 'fade-out',            			
            			__('hinge-out-from-top',  'f6-vc-shortcodes') => 'hinge-out-from-top',
            			__('hinge-out-from-right',  'f6-vc-shortcodes') => 'hinge-out-from-right',
            			__('hinge-out-from-bottom',  'f6-vc-shortcodes') => 'hinge-out-from-bottom',
            			__('hinge-out-from-left',  'f6-vc-shortcodes') => 'hinge-out-from-left',
            			__('hinge-out-from-middle-x',  'f6-vc-shortcodes') => 'hinge-out-from-middle-x',
            			__('hinge-out-from-middle-y',  'f6-vc-shortcodes') => 'hinge-out-from-middle-y',            			
            			__('scale-out-up',  'f6-vc-shortcodes') => 'scale-out-up',
            			__('scale-out-down',  'f6-vc-shortcodes') => 'scale-out-down',
            			__('spin-out',  'f6-vc-shortcodes') => 'spin-out',
            			__('spin-out-ccw',  'f6-vc-shortcodes') => 'spin-out-ccw',
  					),
  					'std' => 'none',
  					'description' => __('Choose a transition to be used when the modal closes. <a target="_blank" href="http://foundation.zurb.com/sites/docs/reveal.html#animations">Animations Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Add a button to open the modal?', 'f6-vc-shortcodes'),
            		'param_name' => 'open-button',        
            		'value' => array(
            			__('False',  'f6-vc-shortcodes') => 'false',
                  		__('True',  'f6-vc-shortcodes') => 'true',            			            	
  					),
  					'std' => 'false',
  					'description' => __('This will include a button on the frontend in the location of this shortcode that will open the modal on click. If not used you must apply <strong>data-open="uniqueIDfromAbove"</strong> to an element to open the modal on click.', 'f6-vc-shortcodes'),
  				),
  				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Button Text', 'f6-vc-shortcodes'),
					'param_name' => 'button-text',        
					'value' => 'Click me for a modal',
					'description' => __('Enter the text to be displayed on the modal open button.', 'f6-vc-shortcodes'),
					'dependency' => array(
                  		'element' => 'open-button',
                  		'value' => 'true',
                	),
				),
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Custom CSS Class', 'f6-vc-shortcodes'),
					'param_name' => 'custom-class',        
					'value' => '',
					'description' => __('Enter a custom CSS Class name here if you would like to. This is applied to the modal container.', 'f6-vc-shortcodes'),
				),
			),
		));

	}

}

add_action('vc_before_init', 'f6_reveal_shortcode_vc');