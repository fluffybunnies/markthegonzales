<?php

$fscb_base_dir = get_template_directory_uri() .'/includes/shortcodes/';


// Tabs shortcode

add_shortcode( 'tabgroup', 'etdc_tab_group' );
function etdc_tab_group( $atts, $content ){
$GLOBALS['tab_count'] = 0;
$random_num = rand(1, 1000);

do_shortcode( $content );

$counter_x = 0;

if( is_array( $GLOBALS['tabs'] ) ){
foreach( $GLOBALS['tabs'] as $tab ){ $counter_x++;
$tabs[] = '<li><a href="#'.$random_num.'tab'.$counter_x.'">'.$tab['title'].'</a></li>';
$panes[] = '<div id="'.$random_num.'tab'.$counter_x.'" class="omc-tab-content">'.do_shortcode($tab['content']).'</div>';

}
$return = "\n".'<!-- the tabs --></p><ul class="omc-tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="omc-tab-container"><span class="omc-tabs-dropshadow"></span>'.implode( "\n", $panes ).'</div>'."\n";
}
return $return;
}

add_shortcode( 'tab', 'etdc_tab' );
function etdc_tab( $atts, $content ){
extract(shortcode_atts(array(
'title' => 'Tab %d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

$GLOBALS['tab_count']++;
}



// registers the buttons for use
function register_friendly_tabs($buttons) {
	// inserts a separator between existing buttons and our new one
	// "friendly_button" is the ID of our button
	array_push($buttons, "friendly_tab");
	return $buttons;
}

// filters the tinyMCE buttons and adds our custom buttons
function friendly_shortcode_tabs() {
	// Don't bother doing this stuff if the current user lacks permissions
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;
	 
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		// filter the tinyMCE buttons and add our own
		add_filter("mce_external_plugins", "add_friendly_tinymce_plugin_tabs");
		add_filter('mce_buttons', 'register_friendly_tabs');
	}
}
// init process for button control
add_action('init', 'friendly_shortcode_tabs');

// add the button to the tinyMCE bar
function add_friendly_tinymce_plugin_tabs($plugin_array) {
	global $fscb_base_dir;
	$plugin_array['friendly_tab'] = $fscb_base_dir . 'tabs-shortcode.js';
	return $plugin_array;
}
 

?>