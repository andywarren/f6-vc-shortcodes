<?php
   /*
   Plugin Name: Foundation 6 Shortcodes for Visual Composer
   Plugin URI: https://www.402websites.com/downloads/foundation-6-shortcodes-visual-composer/
   Description: Add Foundation 6 elements as shortcodes in Visual Composer.
   Version: 1.0
   Author: Andy Warren
   Author URI: https://www.402websites.com/
   Text Domain: f6-vc-shortcodes
   */

// define constants
// path to this file's directory - includes the trailing slash
define('F6_VC_SHORTCODES_PATH', plugin_dir_path(__FILE__));

// URL to this file's directory - includes the trailing slash
define('F6_VC_SHORTCODES_URL', plugin_dir_url(__FILE__));

// add submenu page with settings
require_once F6_VC_SHORTCODES_PATH . 'f6-vc-submenu-page.php';

// Require Once each shortcode file
foreach (glob(F6_VC_SHORTCODES_PATH . 'shortcodes/*.php') as $file) {

    require_once $file;

}

// plugin action links
function f6_vc_plugin_action_links($links) {

   $f6VCactionLinks = array(

      '<a href="' . admin_url( 'themes.php?page=f6-vc-shortcodes/f6-vc-settings.php' ) . '">Settings</a>',
      '<a target="_blank" href="https://www.402websites.com/foundation-6-shortcodes-for-visual-composer-documentation/">Documentation</a>',

   );

   return array_merge($links, $f6VCactionLinks);

}

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'f6_vc_plugin_action_links');
  
// conditionally enqueue the Foundation 6 CSS & JS if the 
// option in Appearance > Foundation 6 Shortcodes is checked
function f6_vc_frontend_enqueue() {

   $enqueueOption = get_option('f6_vc_enqueue_files');

   if (!is_admin() && $enqueueOption) {

      // enqueue Foundation 6 CSS
      wp_enqueue_style('f6_vc_css', F6_VC_SHORTCODES_URL . 'foundation-6.4.1/foundation.min.css', array(), '6.4.1', 'all');

      // enqueue Foundation 6 JS & what-input.js
      wp_enqueue_script('f6_vc_js', F6_VC_SHORTCODES_URL . 'foundation-6.4.1/foundation.min.js', array('jquery'), '6.4.1', true);
      wp_enqueue_script('f6_vc_what_input_js', F6_VC_SHORTCODES_URL . 'foundation-6.4.1/what-input.js', array(), '4.2.0', true);

   }

}

add_action( 'wp_enqueue_scripts', 'f6_vc_frontend_enqueue' );

?>