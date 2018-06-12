<?php
// This is the Foundation 6 button shortcode
// Foundation Documentation: http://foundation.zurb.com/sites/docs/button.html

// build the [f6_button] shortcode
// full shortcode - [f6_button anchor="" url="" button-color="" hollow="" disabled="" text="" full-width="" size="" dropdown-arrow="" button-type="" custom-class=""] 
function f6_button_shortcode($atts) {
	
	$a = shortcode_atts(array(
		'anchor' => 'true',
		'url' => get_site_url(),
		'button-color' => 'primary',
		'hollow' => 'false',
		'disable' => 'false',
		'text' => 'I\'m a button!',
		'size' => 'medium',
		'full-width' => 'false',
		'dropdown-arrow' => 'false',
		'button-type' => 'button',
    'custom-class' => '',
	), $atts, 'f6_button');

	// set variable from the anchor shortcode attribute
	$useAnchor = filter_var($a['anchor'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the url shortcode attribute
	$url = $a['url'];

	// set variable from the button-color shortcode attribute
	$buttonColor = $a['button-color'];

	// set variable from the hollow shortcode attribute
	$hollow = filter_var($a['hollow'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the disabled shortcode attribute
	$disabled = filter_var($a['disable'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the text shortcode attribute
	$text = $a['text'];

	// set variable from the size shortcode attribute
	$size = $a['size'];

	// set variable from the dropdown-arrow shortcode attribute
	$dropdownArrow = filter_var($a['dropdown-arrow'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the button-type shortcode attribute
	$buttonType = filter_var($a['button-type'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the full-width shortcode attribute
	$fullWidth = filter_var($a['full-width'], FILTER_VALIDATE_BOOLEAN);

  // set variable from the custom-class shortcode attribute
  $customClass = $a['custom-class'];

	// build the foundation 6 button element
	if ($useAnchor) {

		$f6_button = '<a' . ($disabled ? ' aria-disabled' : '') . ' href="' . $url . '"';
	
	} else {

		$f6_button = '<button' . ($disabled ? ' disabled' : '') . ' type="' . ($buttonType ? 'button' : 'submit') . '"';

	}

	$f6_button .= ' class="button ' . $buttonColor . ($size != 'medium' ? ' ' . $size : '') . ($fullWidth ? ' expanded' : '') . ($hollow ? ' hollow' : '') . ($dropdownArrow ? ' dropdown' : '') . ($useAnchor && $disabled ? ' disabled' : '') . ($customClass != '' ? ' ' . $customClass : '') . '">';

	$f6_button .= $text;

	if ($useAnchor) {

		$f6_button .= '</a>';

	} else {

		$f6_button .= '</button>';

	}
	
	return $f6_button;

}

// Add shortcode [f6_button]
add_shortcode( 'f6_button', 'f6_button_shortcode' );

// map the shortcode to Visual Composer if Visual Composer exists
function f6_button_shortcode_vc() {

	if (defined('WPB_VC_VERSION')) {

		vc_map(array(
      		'name' => __('Foundation 6 Button', 'f6-vc-shortcodes'),
      		'base' => 'f6_button',
      		'class' => '',
      		'category' => __('Foundation 6', 'f6-vc-shortcodes'),
      		'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
      		'params' => array(
      			array(
            		'type' => 'textfield',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Button Text', 'f6-vc-shortcodes'),
            		'param_name' => 'text',        
            		'value' => 'I\'m a button!',
            		'description' => __('Enter the text to be displayed in the button.', 'f6-vc-shortcodes'),
                'admin_label' => true,
         		),
        		array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Anchor or Button Tag?', 'f6-vc-shortcodes'),
            		'param_name' => 'anchor',        
            		'value' => array(
                  __('Anchor (<a></a>)',  'f6-vc-shortcodes') => 'true',
            			__('Button (<button></button>)',  'f6-vc-shortcodes') => 'false',	
  					    ),
                'std' => 'true',
            		'description' => __('Choose to use either an anchor or button HTML tag. <a target="_blank" href="http://foundation.zurb.com/sites/docs/button.html#basics">Basics Reference</a>', 'f6-vc-shortcodes'),
         		),
         		array(
            		'type' => 'textfield',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Anchor URL', 'f6-vc-shortcodes'),
            		'param_name' => 'url',        
            		'value' => 'https://www.402websites.com',
            		'description' => __('Enter the fully qualified URL to be used in the anchor href.', 'f6-vc-shortcodes'),
            		'dependency' => array(
            			'element' => 'anchor',
            			'value' => 'true',
            		),
         		),
            array(
                'type' => 'dropdown',
                'holder' => '',
                'class' => '',
                'heading' => __('Button Type', 'f6-vc-shortcodes'),
                'param_name' => 'button-type',        
                'value' => array(
                  __('Button',  'f6-vc-shortcodes') => 'true',
                  __('Submit',  'f6-vc-shortcodes') => 'false',
                 ),
                'std' => 'button',
                'description' => __('Choose the button type. <a targer="_blank" href="http://foundation.zurb.com/sites/docs/button.html#basics">Foundation 6 Reference</a> - <a targer="_blank" href="https://www.w3schools.com/tags/att_button_type.asp">W3Schools Reference</a>', 'f6-vc-shortcodes'),
                'std' => 'button',
                'dependency' => array(
                  'element' => 'anchor',
                  'value' => 'false',
                ),
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
            		'description' => __('These are based on the color palette set in Foundation SCSS or CSS. <a target="_blank" href="http://foundation.zurb.com/sites/docs/global.html#colors">Color Reference</a>', 'f6-vc-shortcodes'),
         		),
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
            		'description' => __('These are based on the button sizing set in Foundation SCSS or CSS. <a target="_blank" href="http://foundation.zurb.com/sites/docs/button.html#sizing">Size Reference</a>', 'f6-vc-shortcodes'),
         		),
         		array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Full Width Button', 'f6-vc-shortcodes'),
            		'param_name' => 'full-width',        
            		'value' => array(
            			__('False',  'f6-vc-shortcodes') => 'false',
            			__('True',  'f6-vc-shortcodes') => 'true',
  					     ),
                'std' => 'false',
            		'description' => __('Make the button full width of the container its in.', 'f6-vc-shortcodes'),
         		),
            array(
                'type' => 'dropdown',
                'holder' => '',
                'class' => '',
                'heading' => __('Outline or Solid Color', 'f6-vc-shortcodes'),
                'param_name' => 'hollow',        
                'value' => array(
                  __('Solid',  'f6-vc-shortcodes') => 'false',
                  __('Outline',  'f6-vc-shortcodes') => 'true',
                ),
                'std' => 'false',
                'description' => __('Choose whether the button should have a color outline or be a solid color.', 'f6-vc-shortcodes'),
            ),
            array(
                'type' => 'dropdown',
                'holder' => '',
                'class' => '',
                'heading' => __('Dropdown Arrow', 'f6-vc-shortcodes'),
                'param_name' => 'dropdown-arrow',        
                'value' => array(
                  __('No Dropdown Arrow',  'f6-vc-shortcodes') => 'false',
                  __('Dropdown Arrow',  'f6-vc-shortcodes') => 'true',
                ),
                'std' => 'false',
                'description' => __('Choose whether to show a dropdown arrow on the button. <strong>Note:</strong> This does not make the button into a dropdown, go to <a target="_blank"href="http://foundation.zurb.com/sites/docs/button.html#dropdown-arrows">Dropdown Arrow Reference</a> for information on this.', 'f6-vc-shortcodes'),
            ),
            array(
                'type' => 'dropdown',
                'holder' => '',
                'class' => '',
                'heading' => __('Disable the Button', 'f6-vc-shortcodes'),
                'param_name' => 'disable',        
                'value' => array(
                  __('False',  'f6-vc-shortcodes') => 'false',
                  __('True',  'f6-vc-shortcodes') => 'true',
                ),
                'std' => 'false',
                'description' => __('Select "True" to disable the button from being clicked. <a target="_blank"http://foundation.zurb.com/sites/docs/button.html#disabled-buttons">Disabled Button Reference</a>', 'f6-vc-shortcodes'),
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

      		)

   		));

   	}

}

add_action( 'vc_before_init', 'f6_button_shortcode_vc' );

?>