<?php

$fscb_base_dir = get_template_directory_uri() .'/includes/shortcodes/';



// jQuery Show/Hide

function show_hide($atts, $content = null) {
	
	return '<div class="omc-toggle"><a class="show_hide">+ '.$atts['title'].'</a><div class="jq_show_hide">'.do_shortcode($content).'</div></div>';
}
add_shortcode('show_hide', 'show_hide');




// registers the buttons for use
function register_friendly_toggles($buttons) {
	// inserts a separator between existing buttons and our new one
	// "friendly_button" is the ID of our button
	array_push($buttons, "friendly_toggle");
	return $buttons;
}

// filters the tinyMCE buttons and adds our custom buttons
function friendly_shortcode_toggles() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	 
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		// filter the tinyMCE buttons and add our own
		add_filter("mce_external_plugins", "add_friendly_tinymce_plugin_toggles");
		add_filter('mce_buttons', 'register_friendly_toggles');
	}
}
// init process for button control
add_action('init', 'friendly_shortcode_toggles');

// add the button to the tinyMCE bar
function add_friendly_tinymce_plugin_toggles($plugin_array) {
	global $fscb_base_dir;
	$plugin_array['friendly_toggle'] = $fscb_base_dir . 'toggle-shortcode.js';
	return $plugin_array;
}
 

?>