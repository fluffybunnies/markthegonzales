<?php
// Get theme options & set defaults
$theme_options = get_option('option_tree');
$omc_global_colour = get_option_tree('omc_global_colour', $theme_options, false);
$omc_global_transparent_layer = get_option_tree('omc_global_transparent_layer', $theme_options, false);
$omc_background_colour = get_option_tree('omc_background_colour', $theme_options, false);
$omc_background_preset = get_option_tree('omc_background_preset', $theme_options, false);
$omc_global_background = get_option_tree('omc_global_background', $theme_options, false);
$omc_background_css = get_option_tree('omc_background_css', $theme_options, false);
$omc_main_shadow = get_option_tree('omc_main_shadow', $theme_options, false);
$omc_header_font = get_option_tree('omc_header_font', $theme_options, false);
$omc_global_font_scale = get_option_tree('omc_global_font_scale', $theme_options, false);
$omc_custom_css = get_option_tree('omc_custom_css', $theme_options, false);
$omc_p_color = get_option_tree('omc_p_color', $theme_options, false);

global $wp_query;

//function to determine top level parent
function pa_category_top_parent_id ($catid) {
	while ($catid) {
	$cat = get_category($catid); // get the object for the catid
	$catid = $cat->category_parent; // assign parent ID (if exists) to $catid
	// the while loop will continue whilst there is a $catid
	// when there is no longer a parent $catid will be NULL so we can assign our $catParent
	$catParent = $cat->cat_ID;
	}
	return(isset($catParent)?$catParent:null);
}

// Setup variables 
$category_background_position = '';
$cat_trans_src ='';
$category_disable_transparent ='';
$trans_layer ='';
$category_src ='';


// if this is a post/attachment
if (is_single()) {

	$category = get_the_category(); 
	$category_ID =  $category[0]->cat_ID;		
	$category_parent = pa_category_top_parent_id ($category_ID);
	
	//get current category css 
	$category_color = get_tax_meta($category_ID,'omc_color_field_id');
	$category_background = get_tax_meta($category_ID,'omc_image_field_id');
	$category_background_position = get_tax_meta($category_ID,'omc_background_position');
	$category_transparent_layer = get_tax_meta($category_ID,'omc_transparent_layer');	
	$category_custom_css = get_tax_meta($category_ID,'omc_category_custom_css');
	
	//get parent category css 
	$category_parent_color = get_tax_meta($category_parent,'omc_color_field_id');
	$category_parent_background = get_tax_meta($category_parent,'omc_image_field_id');
	$category_parent_background_position = get_tax_meta($category_parent,'omc_background_position');
	$category_parent_transparent_layer = get_tax_meta($category_parent,'omc_transparent_layer');	
	$category_parent_custom_css = get_tax_meta($category_parent,'omc_category_custom_css');
	
	//if current category bg returns nothing then set to parent value
	if ($category_background == '') {
		$category_background = $category_parent_background;		
	}	
	
	//if current category bg position returns nothing then set to parent value
	if ($category_background_position == '') {
		$category_background_position = $category_parent_background_position;		
	}
	
	//if current category transparent layer returns nothing then set to parent value
	if ($category_transparent_layer == '') {
		$category_transparent_layer = $category_parent_transparent_layer;		
	}
	
	//if current category css returns nothing then set to parent value
	if ($category_custom_css == '') {
		$category_custom_css = $category_parent_custom_css;		
	}	
	
	// if current category returns no color then set to the value
	if (strlen($category_color) < 2) {
		$category_color = $category_parent_color;		
	}	
	
	// if there's no parent then use the global option
	if (strlen($category_color) < 2) {
		$category_color = $omc_global_colour;		
	}
	
	// Set the background css 
	if ($category_background_position === NULL) {$category_background_position = "";} 
	elseif ( $category_background_position === "tiled") {$category_background_position = "";} 
	elseif ( $category_background_position === "static") {$category_background_position = "no-repeat";} 
	elseif ( $category_background_position === "backstretch") { $category_background_position = "backstretch";	 }	

// if this is not a post/page/attachment i.e., a category then...
} else if (is_category()) {
	
	//get the current category id
	$category_ID = get_query_var('cat');
	$category_parent = pa_category_top_parent_id ($category_ID);
	
	//get current category css 
	$category_color = get_tax_meta($category_ID,'omc_color_field_id');
	$category_background = get_tax_meta($category_ID,'omc_image_field_id');
	$category_background_position = get_tax_meta($category_ID,'omc_background_position');
	$category_transparent_layer = get_tax_meta($category_ID,'omc_transparent_layer');	
	$category_disable_transparent = get_tax_meta($category_ID,'omc_disable_transparent');	
	$category_custom_css = get_tax_meta($category_ID,'omc_category_custom_css');
	
	//get parent category css 
	$category_parent_color = get_tax_meta($category_parent,'omc_color_field_id');
	$category_parent_background = get_tax_meta($category_parent,'omc_image_field_id');
	$category_parent_background_position = get_tax_meta($category_parent,'omc_background_position');
	$category_parent_transparent_layer = get_tax_meta($category_parent,'omc_transparent_layer');	
	$category_parent_disable_transparent = get_tax_meta($category_parent,'omc_disable_transparent');	
	$category_parent_custom_css = get_tax_meta($category_parent,'omc_category_custom_css');
	
	//if current category bg returns nothing then set to parent value
	if ($category_background == '') {
		$category_background = $category_parent_background;		
	}	
	
	//if current category bg position returns nothing then set to parent value
	if ($category_background_position == '') {
		$category_background_position = $category_parent_background_position;		
	}
	
	//if current category transparent layer returns nothing then set to parent value
	if ($category_transparent_layer == '') {
		$category_transparent_layer = $category_parent_transparent_layer;		
	}
	
	//if current category transparent on/off returns nothing then set to parent value
	if ($category_disable_transparent == '') {
		$category_disable_transparent = $category_parent_disable_transparent;		
	}
	
	//if current category css returns nothing then set to parent value
	if ($category_custom_css == '') {
		$category_custom_css = $category_parent_custom_css;		
	}	
	
	// if current category returns no color then set to the value
	if (strlen($category_color) < 2) {
		$category_color = $category_parent_color;		
	}	
	
	// if there's no parent then use the global option
	if (strlen($category_color) < 2) {
		$category_color = $omc_global_colour;		
	}
	
	// Set the background css 
	if ($category_background_position == NULL) {$category_background_position = "";} 
	elseif ( $category_background_position === "tiled") {$category_background_position = "";} 
	elseif ( $category_background_position === "static") {$category_background_position = "no-repeat";} 
	elseif ( $category_background_position === "backstretch") { $category_background_position = "backstretch";	 }	
	
} 


// Check to make sure the varialbe are set
if (isset($category_background) && $category_background !== '') { $category_src = $category_background['src']; }
if (isset($category_transparent_layer) && $category_transparent_layer !== '') { $cat_trans_src = $category_transparent_layer['src']; }


if (is_page() || is_search() || is_author() || is_tag() || is_home()) {
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$category_color = get_post_meta(get_the_ID(), 'omc_page_colour', true);
		if (strlen($category_color) < 2 || $category_color === NULL) {
		$category_color = $omc_global_colour;		
	}	
	endwhile; endif;
	
	// Set the background css 
	if ($omc_background_css === NULL) {$omc_background_css = "";} 
	elseif ( $omc_background_css === "Tiled") {$omc_background_css = "";} 
	elseif ( $omc_background_css === "Static") {$omc_background_css = "no-repeat ";} 
	elseif ( $omc_background_css === "jQuery Full Screen") { $omc_background_css = "backstretch"	 ;}	
}




//check if this cat/page/post inherits a backstretch image
$backstretch = '';

if (is_page()) {	

	if ($omc_background_css === "backstretch" ) {$backstretch = '<script>jQuery(document).ready(function(){ jQuery.backstretch("'.$omc_global_background.'");	});</script>';}	
	echo $backstretch;
		
} elseif (is_single()) {

	if ($category_background_position == "backstretch" ) { $backstretch = '<script>jQuery(document).ready(function(){ jQuery.backstretch("'.$category_src.'");	});</script>';}
	elseif (strlen($category_src) < 2 && $omc_background_css === "jQuery Full Screen") {$backstretch = '<script>jQuery(document).ready(function(){ jQuery.backstretch("'.$omc_global_background.'");	});</script>';}
	echo $backstretch;
	
} elseif (is_category()) {

	if ($category_background_position == "backstretch" ) { $backstretch = '<script>jQuery(document).ready(function(){ jQuery.backstretch("'.$category_src.'");	});</script>';}
	elseif (strlen($category_src) < 2 && $omc_background_css === "jQuery Full Screen") {$backstretch = '<script>jQuery(document).ready(function(){ jQuery.backstretch("'.$omc_global_background.'");	});</script>';}
	echo $backstretch;
} else {

	if ($omc_background_css === "backstretch" ) {$backstretch = '<script>jQuery(document).ready(function(){ jQuery.backstretch("'.$omc_global_background.'");	});</script>';}	
	echo $backstretch;
	
}



// Fix the body color if enabled 
if ($backstretch !== "" ) {$backstretch_body = 'body {background:#000}';}
if (strlen($category_color) < 2 || $category_color === NULL) {$category_color = $omc_global_colour;	}


// if front page set to posts
$show_on_front = get_option('show_on_front');

if ($show_on_front === 'posts' && empty($category_color)) {$category_color = $omc_global_colour; }


?><style><?php // echo out the category styles
	
	
	// Echo out the colours
	if (!empty($category_color)) { echo('#back-top a:hover span, input.omc-header-search-button, .widget_calendar thead>tr>th, a.omc-blog-one-anchor, span.omc-module-a-stars-over, span.leading-article.omc-module-a-stars-over, span.omc-blog-two-stars-over, span.omc-featured-stars-over, .flex-direction-nav li .prev:hover, .flex-direction-nav li .next:hover, a.omc-social-small:hover, .flex-control-nav li a.flex-active {background-color:'.$category_color.';}

	.widget_categories > ul > li > a:hover, a#omc-main-navigation ul li.current-menu-item a, nav#omc-main-navigation ul li.current-category-ancestor a, nav#omc-main-navigation ul li.current-menu-parent a, nav#omc-main-navigation ul li.current-post-ancestor a, a.omc-featured-label, a.omc-flex-category, h1.omc-half-width-label a,	a.omc-title-category-context, div.omc-category-block a, span.omc-criteria-percentage, div.omc-authorbox p a, h3.omc-default-widget-header, div.search-button, h3.widgettitle, h3.widgettitle span, 	.widget_categories > ul > li > a:hover, .flex-control-nav li a:hover, .flex-control-nav li a.active, .style1 ul.tabbernav li.tabberactive a, h3.omc-blog-two-cat a, h2.omc-quarter-width-label a, .pagination span, h3.omc-blog-one-cat a, nav#omc-main-navigation ul.sub-menu,  nav#omc-main-navigation ul.sub-menu,  .omc-footer-widget .tagcloud a:hover, input.search_button_sidebar, nav#omc-main-navigation ul li.current-menu-item a, nav#omc-main-navigation ul li.current-category-ancestor a, nav#omc-main-navigation ul li.current-menu-parent a, nav#omc-main-navigation ul li.current-post-ancestor a, a.omc-mobile-back-to-top, h3#comments-title   {background:'.$category_color.';}

	::-moz-selection {background:'.$category_color.';}
	::selection {background:'.$category_color.';}

	div.omc-featured-overlay h1 a:hover, h5.omc-also-in a, table#wp-calendar>tbody>tr>td>a, tfoot>tr>td>a, tfoot>tr>td>a:link, tfoot>tr>td>a:visited, tfoot>tr>td>a:hover, tfoot>tr>td>a:active {color:'.$category_color.';} 

	.flickr_badge_image:hover, .widget_nav_menu ul li a:hover, .widget_pages ul li a:hover, .widget_recent_entries ul li a:hover, .widget_archive ul li a:hover {border-color:'.$category_color.';}

	div.omc-cat-top  {border-top-color:'.$category_color.'; !important}     
	
	li.comment > div {border-bottom-color:'.$category_color.'; !important}
	
	');}
	
	// Echo out the background colour
	if ($omc_background_colour !== NULL) {echo('body {background-image:none; background-color:'.$omc_background_colour.';}');}
	
	// Echo out the background preset
	if ($omc_background_preset !== NULL && $omc_background_preset !== "tasky_pattern") {echo('body {background:url('. get_template_directory_uri().'/images/backgrounds/'.$omc_background_preset.'.png) scroll transparent;} ');}
	
	//If custom upload echo, set the background 
	if ($omc_background_css !== "backstretch" ) { 
		
		if ($omc_background_css === "Static") { $omc_background_css = "no-repeat"; }
		
		if ($omc_global_background !== NULL) {
			
			echo('body 	{background-image: url('.$omc_global_background.'); background-color:'.$omc_background_colour.'; background-repeat:'.$omc_background_css.'; background-position:top center; }');		
			
			}  
		
	}
	
	//Override the global background with the category value
	if (!empty($category_src)) { echo('body {background:url('.$category_src.') '.$category_background_position.';}'); } 
	
	//Override the global transparent layer with the category value
	if ($omc_global_transparent_layer !== NULL) { $trans_layer = '#omc-transparent-layer {background:url('.$omc_global_transparent_layer.') scroll transparent no-repeat top center;}';}		
	if (!empty($cat_trans_src) && isset($cat_trans_src)) { $trans_layer ='#omc-transparent-layer {background:url('.$cat_trans_src.') scroll transparent no-repeat top center;}'; } 	
	if ($category_disable_transparent === 'Yes') {$trans_layer = '';}	
	echo $trans_layer;
	
	
	
	// Adjust main container's box shadow
	if ($omc_main_shadow === 'None') {echo('#omc-container {box-shadow:0px 0px 0px rgba(0, 0, 0, 0); -moz-box-shadow:0px 0px 0px rgba(0, 0, 0, 0);}');} elseif ($omc_main_shadow === 'Light') {echo('#omc-container {box-shadow:0px 0px 10px rgba(0, 0, 0, 0.1); -moz-box-shadow:0px 0px 10px rgba(0, 0, 0, 0.1);}');} elseif ($omc_main_shadow === 'Medium') {echo('#omc-container {box-shadow:0px 0px 10px rgba(0, 0, 0, 0.3); -moz-box-shadow:0px 0px 10px rgba(0, 0, 0, 0.3);}');} elseif ($omc_main_shadow === 'Strong') {echo('#omc-container {box-shadow:0px 0px 10px rgba(0, 0, 0, 0.5); -moz-box-shadow:0px 0px 10px rgba(0, 0, 0, 0.5);}');}
	
	// Paste the custom css from the theme options 
	
	echo $omc_custom_css;
	
	// Check if there is custom css for this category 
	if (isset($category_custom_css) && $category_custom_css !== '') { echo ($category_custom_css.' '); }
	
	
	echo $backstretch_body;
?>

@media only screen and (max-width: 480px) { /*Remove background for 320px displays*/
	div#omc-transparent-layer {background:none;}
	body {background-color:#000;}
	#omc-container {box-shadow: none}
}

<?php
// Echo out the typography options

if ($omc_header_font !== NULL) { 
	echo("body {font-family:".$omc_header_font.", sans-serif;}") ;
	
}
echo("body {font-size:".$omc_global_font_scale.";}");

if ($omc_p_color !== NULL) {echo ('article#omc-full-article p {color:'.$omc_p_color.'}'); }
 
 



 
?>

</style>
