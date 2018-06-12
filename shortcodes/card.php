<?php
// This is the Foundation 6 card shortcode
// Foundation Documentation: http://foundation.zurb.com/sites/docs/card.html

// build the [f6_card][/f6_card] shortcode
// full shortcode - [f6_card show-title="" title-text="" title-element="" img="" img-alt="" width="" custom-class=""][/f6_card]
function f6_card_shortcode($atts, $content = null) {
	
	$a = shortcode_atts(array(
		'show-title' => 'true',
		'title-text' => 'Card Title',
		'title-element' => 'h3',
		'img' => 'img',
		'img-alt' => 'Photo Alt Description Goes Here',
		'width' => '100%',
		'custom-class' => '',
	), $atts, 'f6_card');

	// set variable from the show-title shortcode attribute
	$showTitle = filter_var($a['show-title'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the title-text shortcode attribute
	$titleText = $a['title-text'];

	// set variable from the title-element shortcode attribute
	$titleElement = $a['title-element'];

	// set variable from the img shortcode attribute
	$img = $a['img'];

	if (is_numeric($img)) {

		$imgSrc = wp_get_attachment_image_src($img, 'full')[0];

	} else {

		$imgSrc = $img;

	}

	// set variable from the img-alt shortcode attribute
	$imgAlt = $a['img-alt'];

	// set variable from the width shortcode attribute
	$width = $a['width'];

	// set variable from the custom-class shortcode attribute
	$customClass = $a['custom-class'];

	// build the f6 card
	$f6_card = '<div class="card ' . $customClass . '" style="width: ' . $width . ';">';

	if ($showTitle) {

		$f6_card .= '<div class="card-divider"><' . $titleElement . '>' . $titleText . '</' . $titleElement . '></div>';

	}

	$f6_card .= '<img src="' . $imgSrc . '" alt="' . $imgAlt .'">';

	$f6_card .= '<div class="card-section">' . $content . '</div>';

	$f6_card .= '</div>';

	return $f6_card;

}

// Add shortcode [f6_card]
add_shortcode('f6_card', 'f6_card_shortcode');

// map the shortcode to Visual Composer if Visual Composer exists
function f6_card_shortcode_vc() {

	if (defined('WPB_VC_VERSION')) {

		// map the F6 Callout wrapper shortcode
		vc_map(array(
			'name' => __('Foundation 6 Card', 'f6-vc-shortcodes'),
			'base' => 'f6_card',
			'class' => '',
			'content_element' => true,			
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'params' => array(
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Show the card title?', 'f6-vc-shortcodes'),
            		'param_name' => 'show-title',        
            		'value' => array(
            			__('False',  'f6-vc-shortcodes') => 'false',
                  		__('True',  'f6-vc-shortcodes') => 'true',            			            	
  					),
  					'std' => 'false',
  					'description' => __('Select "true" to show the card-divider title section. <a target="_blank" href="http://foundation.zurb.com/sites/docs/card.html#basics">Basics Reference</a>', 'f6-vc-shortcodes'),
  				),
  				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Card Title', 'f6-vc-shortcodes'),
					'param_name' => 'title-text',        
					'value' => 'Card Title',
					'description' => __('Enter the text to be displayed as the card title', 'f6-vc-shortcodes'),
					'dependency' => array(
                  		'element' => 'show-title',
                  		'value' => 'true',
                	),
                	'std' => 'Enter the card title'
				),
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Title Element', 'f6-vc-shortcodes'),
            		'param_name' => 'title-element',        
            		'value' => array(
            			__('p',  'f6-vc-shortcodes') => 'p',
            			__('h1',  'f6-vc-shortcodes') => 'h1',
                  		__('h2',  'f6-vc-shortcodes') => 'h2',
                  		__('h3',  'f6-vc-shortcodes') => 'h3', 
                  		__('h4',  'f6-vc-shortcodes') => 'h4', 
                  		__('h5',  'f6-vc-shortcodes') => 'h5', 
                  		__('h6',  'f6-vc-shortcodes') => 'h6',
                  		__('span',  'f6-vc-shortcodes') => 'span',
  					),
  					'std' => 'h3',
  					'description' => __('Choose the element that will wrap the card title text.', 'f6-vc-shortcodes'),
  					'dependency' => array(
                  		'element' => 'show-title',
                  		'value' => 'true',
                	),
  				),
  				array(
                	'type' => 'attach_image',
                	'heading' => __('Card Image', 'f6-vc-shortcodes'),
                	'holder' => '',
                	'class' => '',
                	'param_name' => 'img',
                	'description' => __('Upload the image to be used in the card.', 'f6-vc-shortcodes')
            	),
            	array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Image Alt Text', 'f6-vc-shortcodes'),
					'param_name' => 'img-alt',        
					'value' => 'Photo Alt Description Goes Here',
					'description' => __('Enter the image alt text here.', 'f6-vc-shortcodes'),					
				),
				array(
					'type' => 'textarea_html',
					'holder' => '',
					'class' => '',
					'heading' => __('Card Content', 'f6-vc-shortcodes'),
					'param_name' => 'content',        
					'description' => __('Enter the card content here. This is displayed below the card image.', 'f6-vc-shortcodes'),
				),
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Card Width', 'f6-vc-shortcodes'),
					'param_name' => 'width',        
					'value' => '100%',
					'description' => __('Enter the card width here. Use either pixel or percent widths. Example: <strong>250px</strong> or <strong>85%</strong>. Be sure to include the "px" or "%".', 'f6-vc-shortcodes'),					
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

	}

}

add_action('vc_before_init', 'f6_card_shortcode_vc');

?>