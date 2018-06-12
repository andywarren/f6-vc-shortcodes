<?php
// This is the Foundation 6 Tabs shortcodes
// Foundation Documentation: http://foundation.zurb.com/sites/docs/tabs.html

// set global variables to pass
// data between functions/shortcodes
$f6_tab_incrementer = 1;
$tabsID;
$tabTitles = array();

// build the [f6_tabs][/f6_tabs] shortcode
// full shortcode - [f6_tabs id="" vertical=""][/f6_tabs]
function f6_tabs_shortcode($atts, $content = null) {

	global $f6_tab_incrementer, $tabsID, $tabTitles;

	$a = shortcode_atts(array(
		'id' => 'f6_unique_tabs_' . uniqid(),
		'vertical' => 'false'
	), $atts, 'f6_tabs');

	// set variable from the id shortcode attribute
	$tabsID = $a['id'];

	// set variable from the bullets shortcode attribute to a boolean value
	$vertical = filter_var($a['vertical'], FILTER_VALIDATE_BOOLEAN);

	$f6_tabs = '';

	if ($vertical) {

		$f6_tabs .= '<div class="medium-9 columns">';

	}

	$f6_tabs .= '<div class="tabs-content" data-tabs-content="' . $tabsID . '">';

	// do the f6_tab shortcode to produce the slide content
	$f6_tabs .= do_shortcode($content);

	$f6_tabs .= '</div>'; // end .tabs-content

	if ($vertical) {

		$f6_tabs .= '</div></div>'; // end .medium-9 columns

	}

	$f6_tabs_count = substr_count($f6_tabs,'tabs-panel');

	$tabIndex = 2;

	$tabTitlesIndex = 1;

	$f6_tabs_ul = '';

	if ($vertical) {

		$f6_tabs_ul .= '<div class="row collapse"><div class="medium-3 columns">';

	}
	
	$f6_tabs_ul .= '<ul class="tabs' . ($vertical ? ' vertical' : '') . '" data-tabs id="' . $tabsID . '">';
	
	$f6_tabs_ul .= '<li class="tabs-title is-active"><a href="#' . $tabsID . '-panel1" aria-selected="true">' . $tabTitles[0] . '</a></li>';

	while ($tabIndex <= $f6_tabs_count) {
	
		$f6_tabs_ul .= '<li class="tabs-title"><a href="#' . $tabsID . '-panel' . $tabIndex . '" aria-selected="">' . $tabTitles[$tabTitlesIndex] . '</a></li>';
	
		$tabIndex++;

		$tabTitlesIndex++;
	
	}

	$f6_tabs_ul .= '</ul>'; //end .tabs

	if ($vertical) {

		$f6_tabs_ul .= '</div>'; // end .medium-3 columns

	}

	$f6_tabs_combined = $f6_tabs_ul . $f6_tabs;

	$tabTitles = array();

	$f6_tab_incrementer = 1;

	return $f6_tabs_combined;

}

// Add shortcode [f6_tabsf6_tabs]
add_shortcode('f6_tabs', 'f6_tabs_shortcode');

// build the [f6_tab][/f6_tab] shortcode
// full shortcode - [f6_tab][/f6_tab]
function f6_tab_shortcode($atts, $content = null) {

	global $f6_tab_incrementer, $tabsID, $tabTitles;

	$tabPanelID = $f6_tab_incrementer++;

	$a = shortcode_atts(array(
		'title' => 'Title Attribute ' . $tabPanelID,
	), $atts, 'f6_tab');

	// set variable from the title shortcode attribute
	$tabTitle = $a['title'];

	array_push($tabTitles, $tabTitle);
	
	$f6_tab = '<div class="tabs-panel ' . ($tabPanelID === 1 ? 'is-active' : '') . '" id="' . $tabsID . '-panel' . $tabPanelID . '">';

	$f6_tab .= $content;

	$f6_tab .= '</div>'; // end .tabs-panel	

	return $f6_tab;

}

// Add shortcode [f6_tab]
add_shortcode('f6_tab', 'f6_tab_shortcode');

// map the shortcode to Visual Composer if Visual Composer exists
function f6_tabs_shortcode_vc() {

	if (defined('WPB_VC_VERSION')) {

		// map the F6 Orbit wrapper shortcode
		vc_map(array(
			'name' => __('Foundation 6 Tabs', 'f6-vc-shortcodes'),
			'base' => 'f6_tabs',
			'as_parent' => array('only' => 'f6_tab'),
			'js_view' => 'VcColumnView',
			'class' => '',
			'content_element' => true,
			'is_container' => true,
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'default_content' => '[f6_tab][/f6_tab]',
			'show_settings_on_create' => true,
			'params' => array(
  				array(
					'type' => 'textfield',
					'holder' => '',
					'class' => '',
					'heading' => __('Unique ID', 'f6-vc-shortcodes'),
					'param_name' => 'id',        
					'value' => '',
					'description' => __('Enter a unique ID here, or leave blank to have one auto-generated.', 'f6-vc-shortcodes'),
				),
				array(
            		'type' => 'dropdown',
            		'holder' => '',
            		'class' => '',
            		'heading' => __('Vertical Tabs', 'f6-vc-shortcodes'),
            		'param_name' => 'vertical',        
            		'value' => array(
            			__('False',  'f6-vc-shortcodes') => 'false',
                  		__('True',  'f6-vc-shortcodes') => 'true',            			
  					),
  					'std' => 'false',
  					'description' => __('Choose whether or not to vertically stack the tabs located side by side with the panels. <a target="_blank" href="http://foundation.zurb.com/sites/docs/tabs.html#vertical-tabs">Vertical Tabs Reference</a>', 'f6-vc-shortcodes'),
  				),
			),
		));

		// map the F6 Orbit Slide shortcode
		vc_map(array(
			'name' => __('Foundation 6 Individual Tab', 'f6-vc-shortcodes'),
			'base' => 'f6_tab',
			'as_child' => array('only' => 'f6_tabs'),
			'class' => '',
			'content_element' => true,
			'category' => __('Foundation 6', 'f6-vc-shortcodes'),
			'icon' => F6_VC_SHORTCODES_URL . 'img/foundation.png',
			'params' => array(
				array(
                	'type' => 'textfield',
                	'heading' => __('Tab Title', 'f6-vc-shortcodes'),
                	'holder' => '',
                	'class' => '',
                	'param_name' => 'title',
                	'description' => __('Enter the title of the tab here.', 'f6-vc-shortcodes'),
                	'admin_label' => true,
            	),
            	array(
					'type' => 'textarea_html',
					'holder' => '',
					'class' => '',
					'heading' => __('Tab Content', 'f6-vc-shortcodes'),
					'param_name' => 'content',        
					'value' => '',
					'description' => __('Enter the content to be displayed in this tab.', 'f6-vc-shortcodes'),
				),				
			),

		));

	}

	if (class_exists('WPBakeryShortCodesContainer')) {

    		class WPBakeryShortCode_f6_tabs extends WPBakeryShortCodesContainer {}

		}

		if (class_exists('WPBakeryShortCode')) {

    		class WPBakeryShortCode_f6_tab extends WPBakeryShortCode {}

		}

}

add_action( 'vc_before_init', 'f6_tabs_shortcode_vc' );

?>