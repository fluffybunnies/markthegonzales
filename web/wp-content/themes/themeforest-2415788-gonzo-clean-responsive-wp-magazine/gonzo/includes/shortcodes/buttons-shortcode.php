<?php
 
// plugin root folder
$fscb_base_dir = get_template_directory_uri() .'/includes/shortcodes/';


// setup the shortcode for use
function friendly_button_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
      'color' => 'blue',
	  'size' => 'medium',
      'style' => 'round',
      'align' => 'none',
      'text' => '',
      'url' => '',
      ), $atts ) );
		
	if($url) {
      return '<div class="friendly_button friendly_button_' . $size . ' friendly_button_' . $color . ' friendly_button_' . $style . ' friendly_button_' . $align . '"><a href="' . $url . '">' . $text . $content . '</a></div>';
	} else {
		return '<div class="friendly_button friendly_button_' . $size . ' friendly_button_' . $color . ' friendly_button_' . $style . ' friendly_button_' . $align . '">' . $text . $content . '</div>';
	}
}
add_shortcode('button', 'friendly_button_shortcode');



// registers the buttons for use
function register_friendly_buttons2($buttons) {
	// inserts a separator between existing buttons and our new one
	// "friendly_button" is the ID of our button
	array_push($buttons, "friendly_button");
	return $buttons;
}

// filters the tinyMCE buttons and adds our custom buttons
function friendly_shortcode_buttons2() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	 
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		// filter the tinyMCE buttons and add our own
		add_filter("mce_external_plugins", "add_friendly_tinymce_plugin2");
		add_filter('mce_buttons', 'register_friendly_buttons2');
	}
}
// init process for button control
add_action('init', 'friendly_shortcode_buttons2');

// add the button to the tinyMCE bar
function add_friendly_tinymce_plugin2($plugin_array) {
	global $fscb_base_dir;
	$plugin_array['friendly_button'] = $fscb_base_dir . 'buttons-shortcode.js';
	return $plugin_array;
}
 

?>