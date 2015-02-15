<?php

$fscb_base_dir = get_template_directory_uri() .'/includes/shortcodes/';
// setup the shortcode for use
function friendly_loop_shortcode( $atts, $content = null ) {
     extract( shortcode_atts( array(
         'category' => '',
         'module' => ''
     ), $atts ) );

     ob_start();
     include(locate_template('loop-module-'.$module.'.php'));
     $output = ob_get_clean();
     //print $output; // debug
     return $output;
}

if (!is_admin()) {
     add_shortcode('loop', 'friendly_loop_shortcode' );
}


// registers the buttons for use
function register_friendly_loops($buttons) {
	// inserts a separator between existing buttons and our new one
	// "friendly_button" is the ID of our button
	array_push($buttons, "friendly_loop");
	return $buttons;
}

// filters the tinyMCE buttons and adds our custom buttons
function friendly_shortcode_loops() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	 
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		// filter the tinyMCE buttons and add our own
		add_filter("mce_external_plugins", "add_friendly_tinymce_plugin_loops");
		add_filter('mce_buttons', 'register_friendly_loops');
	}
}
// init process for button control
add_action('init', 'friendly_shortcode_loops');

// add the button to the tinyMCE bar
function add_friendly_tinymce_plugin_loops($plugin_array) {
	global $fscb_base_dir;
	$plugin_array['friendly_loop'] = $fscb_base_dir . 'loops-shortcode.js';
	return $plugin_array;
}
 

?>