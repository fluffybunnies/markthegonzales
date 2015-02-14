<?php
/*
Plugin Name: Demo Tax meta class
Plugin URI: http://en.bainternet.info
Description: Tax meta class usage demo
Version: 1.2
Author: Bainternet, Ohad Raz
Author URI: http://en.bainternet.info
*/

//include the main class file
require_once("Tax-meta-class.php");
if (is_admin()){
	/* 
	 * prefix of meta keys, optional
	 * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
	 *  you also can make prefix empty to disable it
	 * 
	 */
	$prefix = 'omc_';
	/* 
	 * configure your meta box
	 */
	$config = array(
		'id' => 'demo_meta_box',					// meta box id, unique per meta box
		'title' => 'Demo Meta Box',					// meta box title
		'pages' => array('category'),				// taxonomy name, accept categories, post_tag and custom taxonomies
		'context' => 'normal',						// where the meta box appear: normal (default), advanced, side; optional
		'fields' => array(),						// list of meta fields (can be added by field arrays)
		'local_images' => false,					// Use local or hosted images (meta box images for add/remove)
		'use_with_theme' => true					//change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
	);
	
	
	/*
	 * Initiate your meta box
	 */
	$my_meta =  new Tax_Meta_Class($config);
	
	/*
	 * Add fields to your meta box
	 */
	

	//Add Category Color
	$my_meta->addColor($prefix.'color_field_id',array('name'=> 'Colour'));
	
	//Add Background Image
	$my_meta->addImage($prefix.'image_field_id',array('name'=> 'Background '));

	//Background position
	$my_meta->addSelect($prefix.'background_position',array('tiled'=>'Tiled','static'=>'Static','backstretch'=>'jQuery Full Screen'),array('name'=> 'Background Position', 'std'=> array('tiled')));
	
	//Add transparent Layer
	$my_meta->addImage($prefix.'transparent_layer',array('name'=> 'Transparent Layer '));
	
	//Disable Transparent Layer
	$my_meta->addSelect($prefix.'disable_transparent',array('No'=>'No','Yes'=>'Yes'),array('name'=> 'Disable Transparent Layer?', 'std'=> array('No')));
	
	//Custom CSS
	$my_meta->addTextarea($prefix.'category_custom_css',array('name'=> 'Custom CSS for this category'));
	
	// Add Featured Slider
	$my_meta->addCheckbox($prefix.'featured_slider',array('name'=> 'Enable Featured Slider'));
	
	//select field
	$my_meta->addSelect($prefix.'blog_style',array('blog-style-1'=>'Blog Style 1 (Traditional)','blog-style-2'=>'Blog Style 2 (Half Width)','shortcodes'=>'Use Standard Shortcodes to build the Category'),array('name'=> 'Category Layout Style', 'std'=> array('blog-style-2')));	
	
	//wysiwyg field
	$my_meta->addWysiwyg($prefix.'content_field_id',array('name'=> 'Category wysiwyg Editor '));
	
	
	/*
	 * Don't Forget to Close up the meta box decleration
	 */
	//Finish Meta Box Decleration
	$my_meta->Finish();
}