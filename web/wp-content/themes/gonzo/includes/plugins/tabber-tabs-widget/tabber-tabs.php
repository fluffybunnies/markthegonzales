<?php
/**
Plugin Name: Tabber Tabs Widget
Plugin URI: http://slipfire.com
Description: Easily create a tabbed content area in your sidebar
Author: SlipFire LLC.
Version: 0.38
Author URI: http://slipfire.com/


// Copyright (c) 2010 SlipFire LLC., All rights reserved.
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// This is a plugin for WordPress
// http://wordpress.org/
//
// Based on the JavaScript tabifier by Patrick Fitzgerald
// Copyright (c) 2006 Patrick Fitzgerald
// http://www.barelyfitz.com/projects/tabber/
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************
**/

// Set constant path to the plugin directory.
define( 'TABBER_TABS_DIR', trailingslashit( get_template_directory() ) . 'includes/plugins/tabber-tabs-widget/' );




/**
 * Initializes the plugin and it's features.
 */
function tabber_tabs_plugin_init() {

	// Loads and registers the new widget.
	add_action( 'widgets_init', 'tabber_tabs_load_widget' );

	// Add Javascript if not admin area. No need to run in backend.
	if ( !is_admin() ) {
		
	};

	// Hide Tabber until page load 
	add_action( 'wp_head', 'tabber_tabs_temp_hide' );
		
	// Load css 
	add_action( 'wp_head', 'tabber_tabs_css' );
	
}
add_action( 'plugins_loaded', 'tabber_tabs_plugin_init' );

/**
 * Register the new widget area
 *
 * Load last so we don't effect other widget areas.
 */
function tabber_tabs_register_sidebar() {
	register_sidebar(
		array(
			'name' => __('Tabber Tabs Widget Area', 'slipfire'),
			'id' => 'tabber_tabs',
			'description' => __('Build your tabbed area by placing widgets here.  !! IMPORTANT: DO NOT PLACE THE TABBER TABS WIDGET IN THIS AREA.  BAD THINGS WILL HAPPEN !! Place the TABBER TABS widget in another widget area. ', 'slipfire'),
			'before_widget' => '<div id="%1$s" class="%2$s tabbertab"><div class="sdfsdf"></div>',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="widget-title section-title">',
			'after_title' => '</h3>'
		)
	);
}
// Load the widget area last so we don't effect other widget areas.
add_action( 'wp_loaded', 'tabber_tabs_register_sidebar' );
	


/**
 * Register the widget. 
 *
 * @uses register_widget() Registers individual widgets.
 * @link http://codex.wordpress.org/WordPress_Widgets_Api
 */
class Slipfire_Widget_Tabber extends WP_Widget {

	function Slipfire_Widget_Tabber() {
		$widget_ops = array( 'classname' => 'tabbertabs', 'description' => __('Place items in the TABBER TABS WIDGET AREA and have them show up here.', 'slipfire') );
		$control_ops = array( 'width' => 230, 'height' => 350, 'id_base' => 'slipfire-tabber' );
		$this->WP_Widget( 'slipfire-tabber', __('Tabber Tabs Widget', 'slipfire'), $widget_ops, $control_ops );
	}
	

	function widget( $args, $instance ) {
		extract( $args );
		
		$style = $instance['style']; // get the widget style from settings
		
		echo $before_widget;
?>		
		<div class="tabber <?php echo $style ?>">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('tabber_tabs') ); ?>
		</div>
		
<?php 	echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['style'] = $new_instance['style'];
		
		return $instance;
	}

	function form( $instance ) {

		//Defaults
		$defaults = array( 'title' => __('Tabber', 'slipfire'), 'style' => 'style1' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<div style="float:left;width:98%;"></div>
		<p>
		<?php _e('Place items in the TABBER TABS WIDGET AREA and have them show up here.', 'slipfire')?>
		</p>
		<div style="float:left;width:48%;">
		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e('Tab Style:', 'rolopress'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'style1' == $instance['style'] ) echo 'selected="selected"'; ?>>style1</option>
				<option <?php if ( 'style2' == $instance['style'] ) echo 'selected="selected"'; ?>>style2</option>
			</select>
		</p>
		
		</div>
		<div style="clear:both;">&nbsp;</div>
	<?php
	}
}


	// Register widget.
	register_widget( 'Slipfire_Widget_Tabber' );


/**
 * Tabber css
 */
function tabber_tabs_css(){
	echo '<link rel="stylesheet" type="text/css" media="screen" href="' . TABBER_TABS_DIR . 'tabber.css" />';
}

/**
 * Temporarily hide the "tabber" class so it does not "flash"
 * on the page as plain HTML. After tabber runs, the class is changed
 * to "tabberlive" and it will appear.
 */
function tabber_tabs_temp_hide(){
	echo '<script type="text/javascript">document.write(\'<style type="text/css">.tabber{display:none;}<\/style>\');</script>';
}

/**
 * Admin notice
 */

// Function to check if there are widgets in the Tabber Tabs widget area
// Thanks to Themeshaper: http://themeshaper.com/collapsing-wordpress-widget-ready-areas-sidebars/
function is_tabber_tabs_area_active( $index ){
  global $wp_registered_sidebars;

  $widgetcolums = wp_get_sidebars_widgets();
		 
  if ($widgetcolums[$index]) return true;
  
	return false;
}



?>