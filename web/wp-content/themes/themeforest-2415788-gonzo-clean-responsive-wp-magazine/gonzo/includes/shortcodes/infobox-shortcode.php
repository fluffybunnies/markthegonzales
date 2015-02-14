<?php

$fscb_base_dir = get_template_directory_uri() .'/includes/shortcodes/';


function alert($atts, $content = null) {
	return '<div class="omc-alert-box '.$atts['type'].'">'.$content.'</div>';
}
add_shortcode('alert', 'alert');



// registers the buttons for use
function register_friendly_infoboxs($buttons) {
	// inserts a separator between existing buttons and our new one
	// "friendly_button" is the ID of our button
	array_push($buttons, "friendly_infobox");
	return $buttons;
}

// filters the tinyMCE buttons and adds our custom buttons
function friendly_shortcode_infoboxs() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	 
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		// filter the tinyMCE buttons and add our own
		add_filter("mce_external_plugins", "add_friendly_tinymce_plugin_infoboxs");
		add_filter('mce_buttons', 'register_friendly_infoboxs');
	}
}
// init process for button control
add_action('init', 'friendly_shortcode_infoboxs');

// add the button to the tinyMCE bar
function add_friendly_tinymce_plugin_infoboxs($plugin_array) {
	global $fscb_base_dir;
	$plugin_array['friendly_infobox'] = $fscb_base_dir . 'infobox-shortcode.js';
	return $plugin_array;
}
 

?>