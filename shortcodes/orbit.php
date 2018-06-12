<?php
// This is the Foundation 6 Orbit shortcode
// Foundation Documentation: http://foundation.zurb.com/sites/docs/orbit.html

// build the [f6_orbit][/f6_orbit] shortcode
// full shortcode - [f6_orbit controls="" bullets=""][/f6_orbit]
function f6_orbit_shortcode($atts, $content = null) {

	$uniqueClass = 'f6_unique_orbit_' . uniqid();

	$a = shortcode_atts(array(
		'controls' => 'true',
		'bullets' => 'true',
		'left_in' => 'fade-in',
		'right_in' => 'fade-in',
		'left_out' => 'fade-out',
		'right_out' => 'fade-out',
		'custom-class' => ''
	), $atts, 'f6_orbit');

	// set variable from the controls shortcode attribute to a boolean value
	$controls = filter_var($a['controls'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the bullets shortcode attribute to a boolean value
	$bullets = filter_var($a['bullets'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the left_in shortcode attribute
	$leftIn = $a['left_in'];

	// set variable from the right_in shortcode attribute
	$rightIn = $a['right_in'];

	// set variable from the left_out shortcode attribute
	$leftOut = $a['left_out'];

	// set variable from the right_out shortcode attribute
	$rightOut = $a['right_out'];

	// set variable from the custom-class shortcode attribute
	$customClass = $a['custom-class'];

	$f6_orbit = '<div class="orbit ' . $customClass . '" title="' . $uniqueClass . '" role="region" aria-label="' . get_the_title() . ' Orbit Slideshow" data-orbit data-options="animInFromLeft:' . $leftIn . '; animInFromRight:' . $rightIn . '; animOutToLeft:' . $leftOut . '; animOutToRight:' . $rightOut . ';">';

	$f6_orbit .= '<div class="orbit-wrapper">';

	if ($controls) {

		$f6_orbit .= '<div class="orbit-controls"><button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button><button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button></div>';

	}

	$f6_orbit .= '<ul class="orbit-container">';

	// do the f6_orbit_slide shortcode to produce the slide content
	$f6_orbit .= do_shortcode($content);

	$f6_orbit .= '</ul>'; // end .orbit-container

	$f6_orbit .= '</div>'; // end .orbit-wrapper

	if ($bullets) {

		$f6_orbit_slideCount = substr_count($f6_orbit,'<li');
	
		$slideIndex = 1;
	
		$f6_orbit .= '<nav class="orbit-bullets">';
	
		$f6_orbit .= '<button class="is-active" data-slide="0"></button>';
	
		while ($slideIndex < $f6_orbit_slideCount) {
	
			$f6_orbit .= '<button class="" data-slide="' . $slideIndex . '"></button>';
	
			$slideIndex++;
	
		}
	
		$f6_orbit .= '</nav>';

	}

	$f6_orbit .= '</div>'; // end .orbit

	return $f6_orbit;

}

// Add shortcode [f6_orbit]
add_shortcode('f6_orbit', 'f6_orbit_shortcode');

// build the [f6_orbit_slide][/f6_orbit_slide] shortcode
// full shortcode - [f6_orbit_slide src="" alt=""][/f6_orbit_slide]
function f6_orbit_shortcode_slide($atts, $content = null) {

	$a = shortcode_atts(array(
		'src' => F6_VC_SHORTCODES_URL . 'img/zurb-6.png',
		'alt' => 'Add Image Alt Text'
	), $atts, 'f6_orbit_shortcode_slide');

	// set variable from the src shortcode attribute to be used in the slide image tag source attribute
	$slideImageSource = $a['src'];

	if (is_numeric($slideImageSource)) {

		$imgSrc = wp_get_attachment_image_src($slideImageSource, 'full')[0];

	} else {

		$imgSrc = $slideImageSource;

	}

	// set variable from the alt shortcode attribute to be used as the image alt text
	$slideImageAlt = $a['alt'];

	$f6_orbit_slide = '<li class="orbit-slide"><figure class="orbit-figure">';

	$f6_orbit_slide .= '<img class="orbit-image" src="' . $imgSrc . '" alt="' . $slideImageAlt . '">';

	$f6_orbit_slide .= '<figcaption class="orbit-caption">' . $content . '</figcaption>';

	$f6_orbit_slide .= '</figure></li>'; // end .orbit-slide

	return $f6_orbit_slide;

}

// Add shortcode [f6_orbit_slide]
add_shortcode('f6_orbit_slide', 'f6_orbit_shortcode_slide');

// map the shortcode to Visual Composer if Visual Composer exists
function f6_orbit_shortcode_vc() {

	if (defined('WPB_VC_VERSION')) {

		// map the F6 Orbit wrapper shortcode
		vc_map(array(
			'name' => __('Foundation 6 Orbit', 'f6-vc-shortcodes'),
			'base' => 'f6_orbit',
			'as_parent' => array('only' => 'f6_orbit_slide'),
			'js_view' => 'VcColumnView',
			'class' => '',
			'content_element' => true,
			'is_container' => true,
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'default_content' => '[f6_orbit_slide src="' . F6_VC_SHORTCODES_URL . 'img/zurb-6.png" alt="Foundation 6 Orbit Slide"][/f6_orbit_slide]',
			'show_settings_on_create' => true,
			'params' => array(
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Orbit Controls', 'f6-vc-shortcodes'),
            		'param_name' => 'controls',        
            		'value' => array(
                  		__('True',  'f6-vc-shortcodes') => 'true',
            			__('False',  'f6-vc-shortcodes') => 'false',
  					),
  					'std' => 'true',
  					'description' => __('Choose whether or not to show the Orbit controls. <a target="_blank" href="http://foundation.zurb.com/sites/docs/orbit.html#next-previous-arrows">Control Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Orbit Bullets', 'f6-vc-shortcodes'),
            		'param_name' => 'bullets',        
            		'value' => array(
                  		__('True',  'f6-vc-shortcodes') => 'true',
            			__('False',  'f6-vc-shortcodes') => 'false',
  					),
  					'std' => 'true',
  					'description' => __('Choose whether or not to show the Orbit bullets. <a target="_blank" href="http://foundation.zurb.com/sites/docs/orbit.html#bullets">Control Reference</a>', 'f6-vc-shortcodes'),
  				),
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('In From Left Animation', 'f6-vc-shortcodes'),
            		'param_name' => 'left_in',        
            		'value' => array(
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
  					'std' => 'fade-in',
  					'description' => __('Choose the "in from left" animation. <a target="_blank" href="http://foundation.zurb.com/sites/docs/orbit.html#using-animation">Orbit Animation Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('In From Right Animation', 'f6-vc-shortcodes'),
            		'param_name' => 'right_in',        
            		'value' => array(
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
  					'std' => 'fade-in',
  					'description' => __('Choose the "in from right" animation. <a target="_blank" href="http://foundation.zurb.com/sites/docs/orbit.html#using-animation">Orbit Animation Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Out From Left Animation', 'f6-vc-shortcodes'),
            		'param_name' => 'left_out',        
            		'value' => array(
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
  					'std' => 'fade-out',
  					'description' => __('Choose the "out from left" animation. <a target="_blank" href="http://foundation.zurb.com/sites/docs/orbit.html#using-animation">Orbit Animation Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Out From Right Animation', 'f6-vc-shortcodes'),
            		'param_name' => 'right_out',        
            		'value' => array(
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
  					'std' => 'fade-out',
  					'description' => __('Choose the "out from right" animation. <a target="_blank" href="http://foundation.zurb.com/sites/docs/orbit.html#using-animation">Orbit Animation Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Custom CSS Class', 'f6-vc-shortcodes'),
					'param_name' => 'custom-class',        
					'value' => '',
					'description' => __('Enter a custom CSS Class name here if you would like to.', 'f6-vc-shortcodes'),
				),
			),
		));

		// map the F6 Orbit Slide shortcode
		vc_map(array(
			'name' => __('Foundation 6 Orbit Slide', 'f6-vc-shortcodes'),
			'base' => 'f6_orbit_slide',
			'as_child' => array('only' => 'f6_orbit'),
			'class' => '',
			'content_element' => true,
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'params' => array(
				array(
                	'type' => 'attach_image',
                	'heading' => __('Orbit Slide Image', 'f6-vc-shortcodes'),
                	'holder' => '',
                	'class' => '',
                	'param_name' => 'src',
                	'description' => __('Upload the image to be used in the slide.', 'f6-vc-shortcodes')
            	),
            	array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Slide Image Alt Text', 'f6-vc-shortcodes'),
					'param_name' => 'alt',        
					'value' => '',
					'description' => __('Enter the alt text for the slide image.', 'f6-vc-shortcodes'),
				),
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Slide Caption Text', 'f6-vc-shortcodes'),
					'param_name' => 'content',        
					'value' => '',
					'description' => __('Enter a caption here. This is displayed as an overlay on the slide.', 'f6-vc-shortcodes'),
				),
			),

		));

	}

	if (class_exists('WPBakeryShortCodesContainer')) {

    		class WPBakeryShortCode_f6_orbit extends WPBakeryShortCodesContainer {}

		}

		if (class_exists('WPBakeryShortCode')) {

    		class WPBakeryShortCode_f6_orbit_slide extends WPBakeryShortCode {}

		}

}

add_action( 'vc_before_init', 'f6_orbit_shortcode_vc' );

?>