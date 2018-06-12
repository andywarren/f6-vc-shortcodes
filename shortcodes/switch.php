<?php
// This is the Foundation 6 switch shortcode
// Foundation Documentation: http://foundation.zurb.com/sites/docs/switch.html

// build the [f6_switch] shortcode
// full shortcode - [f6_switch type="" checked="" size="" radio-group="" screen-reader-text="" custom-class=""]
function f6_switch_shortcode($atts) {

	$a = shortcode_atts(array(
		'type' => 'checkbox',
    	'checked' => 'false',
    	'size' => 'small',
    	'radio-group' => '',
    	'screen-reader-text' => 'On/Off Switch',
    	'inner-label' => 'false',
    	'on-label' => 'On', // three character size limit
    	'off-label' => 'Off', // three character size limit
    	'custom-class' => '',
	), $atts, 'f6_switch');

	// set variable with unique value to be used as id, name, and for
	$id = uniqid('f6_switch_');

	// set variable from the size shortcode attribute
	$radioGroup = $a['radio-group'];

	if (empty($radioGroup)) {

		$name = $id;

	} else {

		$name = $radioGroup;

	}

	// set variable from the type shortcode attribute
	$inputType = $a['type'];

	// set variable from the checked shortcode attribute
	$checked = filter_var($a['checked'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the size shortcode attribute
	$switchSize = $a['size'];

	// set variable from the type shortcode attribute
	$screenReaderText = $a['screen-reader-text'];

	// set variable from the inner-label shortcode attribute
	$innerLabel = filter_var($a['inner-label'], FILTER_VALIDATE_BOOLEAN);

	// set variable from the on-label shortcode attribute
	$onLabel = $a['on-label'];

	// set variable from the off-label shortcode attribute
	$offLabel = $a['off-label'];

	// set variable from the size shortcode attribute
	$customClass = $a['custom-class'];

  // build the f6 switch
	$f6_switch = '<div class="switch ' . $switchSize . ($customClass != '' ? ' ' . $customClass : '') . '">';

	$f6_switch .= '<input' . ($checked ? ' checked' : '') . ' class="switch-input" id="' . $id . '" type="' . $inputType . '" name="' . $name . '">';

	$f6_switch .= '<label class="switch-paddle" for="' . $id . '"><span class="show-for-sr">' . $screenReaderText . '</span>';

	if ($innerLabel) {

		$f6_switch .= '<span class="switch-active" aria-hidden="true">' . $onLabel . '</span><span class="switch-inactive" aria-hidden="true">' . $offLabel . '</span>';

	}

	$f6_switch .= '</label></div>';

	return $f6_switch;


}

// Add shortcode [f6_switch]
add_shortcode( 'f6_switch', 'f6_switch_shortcode');

// map the shortcode to Visual Composer if Visual Composer exists
function f6_switch_shortcode_vc() {

	if (defined('WPB_VC_VERSION')) {

		vc_map(array(
      		'name' => __('Foundation 6 Switch', 'f6-vc-shortcodes'),
      		'base' => 'f6_switch',
      		'class' => '',
      		'category' => __('Foundation 6', 'f6-vc-shortcodes'),
      		'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
      		'params' => array(
        		array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Checkbox or Radio Group?', 'f6-vc-shortcodes'),
            		'param_name' => 'type',        
            		'value' => array(
                  		__('Checkbox',  'f6-vc-shortcodes') => 'checkbox',
            			__('Radio',  'f6-vc-shortcodes') => 'radio',	
  					),
                	'std' => 'checkbox',
            		'description' => __('Choose to have a single switch (checkbox), or a group of switches (radio). If radio is chosen, add more switches with the same group name. <a target="_blank" href="http://foundation.zurb.com/sites/docs/switch.html#radio-switch">Radio Switch Reference</a>', 'f6-vc-shortcodes'),
         		),
         		array(
					   'type' => 'textfield',
					   'holder' => '',
					   'class' => '',
					   'heading' => __('Radio Group Name', 'f6-vc-shortcodes'),
					   'param_name' => 'radio-group',        
					   'value' => '',
					   'description' => __('Enter a name here for the radio group if you are adding a radio group of switches instead of a single checkbox switch. <a target="_blank" href="http://foundation.zurb.com/sites/docs/switch.html#radio-switch">Radio Switch Reference</a>', 'f6-vc-shortcodes'),
					   'dependency' => array(
                'element' => 'type',
                'value' => 'radio',
              ),
				    ),
         		array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('On/Checked by Default', 'f6-vc-shortcodes'),
            		'param_name' => 'checked',        
            		'value' => array(
                  		__('False',  'f6-vc-shortcodes') => 'false',
            			__('True',  'f6-vc-shortcodes') => 'true',	
  					),
                	'std' => 'false',
            		'description' => __('Set to true to make the switch on/checked by default.', 'f6-vc-shortcodes'),
         		),
         		array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Switch Size', 'f6-vc-shortcodes'),
            		'param_name' => 'size',        
            		'value' => array(
                  		__('Tiny',  'f6-vc-shortcodes') => 'tiny',
            			__('Small',  'f6-vc-shortcodes') => 'small',
            			__('Large',  'f6-vc-shortcodes') => 'large',	
  					),
                	'std' => 'small',
            		'description' => __('Select the size of the switch. <a target="_blank" href="http://foundation.zurb.com/sites/docs/switch.html#sizing-classes">Switch Size Reference</a>', 'f6-vc-shortcodes'),
         		),         		
				    array(
				    	'type' => 'textfield',
				    	'holder' => '',
				    	'class' => '',
				    	'heading' => __('Screen Read Text', 'f6-vc-shortcodes'),
				    	'param_name' => 'screen-reader-text',        
				    	'value' => 'On/Off Switch',
				    	'description' => __('Enter the text to be read aloud on screen readers for accesibility. <a target="_blank" href="http://foundation.zurb.com/sites/    docs/switch.html#basics">Screen Reader Reference</a>', 'f6-vc-shortcodes'),
				    ),
				    array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Inner Switch Labels', 'f6-vc-shortcodes'),
            		'param_name' => 'inner-label',        
            		'value' => array(
                  		__('False',  'f6-vc-shortcodes') => 'false',
            			__('True',  'f6-vc-shortcodes') => 'true',	
  					),
                	'std' => 'false',
            		'description' => __('Select true to show inner labels in the switch (three character limit per label). <a target="_blank" href="http://foundation.zurb.com/sites/docs/switch.html#inner-labels">Inner Label Reference</a>', 'f6-vc-shortcodes'),
         		),
         		array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Switch On Label', 'f6-vc-shortcodes'),
					'param_name' => 'on-label',        
					'value' => 'On',
					'description' => __('Enter the text to be shown in the On inner label (three character limit per label). <a target="_blank" href="http://foundation.zurb.com/sites/docs/switch.html#inner-labels">Inner Label Reference</a>', 'f6-vc-shortcodes'),
					'dependency' => array(
                  		'element' => 'inner-label',
                  		'value' => 'true',
                	),
				),
				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Switch Off Label', 'f6-vc-shortcodes'),
					'param_name' => 'off-label',        
					'value' => 'Off',
					'description' => __('Enter the text to be shown in the Off inner label (three character limit per label). <a target="_blank" href="http://foundation.zurb.com/sites/docs/switch.html#inner-labels">Inner Label Reference</a>', 'f6-vc-shortcodes'),
					'dependency' => array(
                  		'element' => 'inner-label',
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
                	'description' => __('Enter a custom CSS Class name here if you would like to.', 'f6-vc-shortcodes'),
            	),          		
        	)
   		));

   	}

}

add_action('vc_before_init', 'f6_switch_shortcode_vc');