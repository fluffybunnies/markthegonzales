<?php

$fscb_base_dir = get_template_directory_uri() .'/includes/shortcodes/';

remove_shortcode('video');

function video_embed($atts, $content=null){

	extract(shortcode_atts( array('id' => '', 'site' => ''), $atts));

	$return = $content;
	
	
		if ($site === 'youtube') {
			
			$return .= "<br /><br />";

			$return .= '<div class="omc-video-container" style="margin-top:20px;"><iframe width="560" height="349" src="http://www.youtube.com/embed/' . $id . '" frameborder="0" allowfullscreen></iframe></div>';

			return $return; 
		
		 } elseif ($site === 'vimeo') {
		
			$return .= "<br /><br />";

			$return .= '<div class="omc-video-container" style="margin-top:20px;"><iframe width="560" height="349" src="http://player.vimeo.com/video/' . $id . '" frameborder="0" allowfullscreen></iframe></div>';

			return $return; 
		
		}
		
		
		
		
		
}
add_shortcode('video', 'video_embed');


// registers the buttons for use
function register_friendly_embeds($buttons) {
	// inserts a separator between existing buttons and our new one
	// "friendly_button" is the ID of our button
	array_push($buttons, "friendly_embed");
	return $buttons;
}

// filters the tinyMCE buttons and adds our custom buttons
function friendly_shortcode_embeds() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	 
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		// filter the tinyMCE buttons and add our own
		add_filter("mce_external_plugins", "add_friendly_tinymce_plugin_embeds");
		add_filter('mce_buttons', 'register_friendly_embeds');
	}
}
// init process for button control
add_action('init', 'friendly_shortcode_embeds');

// add the button to the tinyMCE bar
function add_friendly_tinymce_plugin_embeds($plugin_array) {
	global $fscb_base_dir;
	$plugin_array['friendly_embed'] = $fscb_base_dir . 'embed-shortcode.js';
	return $plugin_array;
}
 

?>