<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit: 
 * @link http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'omc_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'review',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Review Controls',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'post', 'slider' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'low',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> 'Enable Review?',
			'id'		=> $prefix . 'review_enable',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'std'		=> false
		),
		array(
			'name'		=> 'Enable User Ratings?',
			'id'		=> $prefix . 'user_ratings_visibility',
		
			'type'		=> 'checkbox',
			'std'		=> false
		),
		// CRITERIA ONE
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 1:</span> Description',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_add_criteria1 omc_c1 ",
			'id'		=> "{$prefix}c1_description",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 1:</span> Rating <em id=omc_preview_rating_1></em>',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_c1",
			'id'		=> "{$prefix}c1_rating",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		//CRITERIA TWO
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 2:</span> Description',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_add_criteria2  omc_c2",
			'id'		=> "{$prefix}c2_description",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 2:</span> Rating <em id=omc_preview_rating_2></em>',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_c2",
			'id'		=> "{$prefix}c2_rating",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		//CRITERIA THREE
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 3:</span> Description',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_add_criteria3  omc_c3",
			'id'		=> "{$prefix}c3_description",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 3:</span> Rating <em id=omc_preview_rating_3></em>',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_c3",
			'id'		=> "{$prefix}c3_rating",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		//CRITERIA FOUR
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 4:</span> Description',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_add_criteria4  omc_c4",
			'id'		=> "{$prefix}c4_description",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 4:</span> Rating  <em id=omc_preview_rating_4></em>',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_c4",
			'id'		=> "{$prefix}c4_rating",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		//CRITERIA FIVE
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 5:</span> Description',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_add_criteria5  omc_c5",
			'id'		=> "{$prefix}c5_description",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 5:</span> Rating <em id=omc_preview_rating_5></em>',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_c5",
			'id'		=> "{$prefix}c5_rating",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		//CRITERIA SIX
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 6:</span> Description',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_add_criteria6  omc_c6",
			'id'		=> "{$prefix}c6_description",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		array(
			'name'		=> '<span class="omc_get_bold">Criteria 6:</span> Rating <em id=omc_preview_rating_6></em>',
			'desc'		=> "",
			'class'		=> "omc_review_hide omc_c6",
			'id'		=> "{$prefix}c6_rating",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),		
		array(
			'name'		=> 'Rating Type',
			'id'		=> "{$prefix}review_type",
			'class'		=> "omc_review_hide omc_clear_that_thang",
			'type'		=> 'radio',
			// Array of 'key' => 'value' pairs for radio options.
			// Note: the 'key' is stored in meta field, not the 'value'
			'options'	=> array(
				'stars'	  => 'Stars',
				'percent' => 'Percentage'
			),
			'std'		=> 'stars',
			'desc'		=> ''
		),
		array(
			'name'		=> 'Final Score',
			'desc'		=> "Total of <em>__</em>% will be displayed if percentage is selected",
			'class'		=> "omc_review_hide ",
			'id'		=> "{$prefix}final_score",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "1"
		),
		array(
			'name'		=> 'Criteria Header',
			'desc'		=> "Leave empty if you don't want it",
			'class'		=> "omc_review_hide ",
			'id'		=> "{$prefix}criteria_header",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "4"
		),
		array(
			'name'		=> 'Brief Summary',
			'desc'		=> "Just one or two words",
			'class'		=> "omc_review_hide ",
			'id'		=> "{$prefix}brief_summary",
			'type'		=> 'text',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "4"
		),
		array(
			'name'		=> 'Longer Summary',
			'desc'		=> "Just a paragraph will do",
			'class'		=> "omc_review_hide ",
			'id'		=> "{$prefix}longer_summary",
			'type'		=> 'textarea',
			'std'		=> "",
			'cols'		=> "50",
			'rows'		=> "4"
		),
		array(
			'name'		=> 'Criteria Display',
			'id'		=> "{$prefix}criteria_display",
			'type'		=> 'radio',
			// Array of 'key' => 'value' pairs for radio options.
			// Note: the 'key' is stored in meta field, not the 'value'
			'options'	=> array(
				'n'			=> 'No',
				't'			=> 'Top (Half Width)',
				'b'			=> 'Bottom (Full Width)'
			),
			'std'		=> 'n',
			'desc'		=> 'Where in the post do you want it to display?'
		)
		
	)
);


// 3rd meta box
$meta_boxes[] = array(
	'id'		=> 'post_extension',
	'title'		=> 'Single Post Options',
	'pages'		=> array( 'post' ),

	'fields'	=> array(

		array(
			'name'		=> 'Featured Post?',
			'id'		=> $prefix . 'featured_post',
			'clone'		=> false,
			'type'		=> 'checkbox',
			'std'		=> false
		),
		array(
			'name'		=> 'Create Sidebar',
			'id'		=> $prefix . 'page_sidebar',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'		=> 'Type in a word or two to create a sidebar',
			'std'		=> false
		),
		array(
			'name'		=> 'Video Embed Code',
			'id'		=> $prefix . 'video_encode',
			'clone'		=> false,
			'type'		=> 'textarea',
			'desc'		=> 'Paste in the iframe in here',
			'std'		=> false
		),				
		array(
			'name'		=> 'Comment Type',
			'id'		=> "{$prefix}comment_type",
			'class'		=> "",
			'type'		=> 'radio',
			'options'	=> array(
				'fb'	  => 'Facebook Comments ',
				'wp' => 'WP Comments ',
				'both' => 'Both ',
				'none' => 'None'
			),
			'std'		=> 'wp',
			'desc'		=> ''
		)
	)
);


// 3rd meta box
$meta_boxes[] = array(
	'id'		=> 'page_extension',
	'title'		=> 'Page Options',
	'pages'		=> array( 'page' ),

	'fields'	=> array(

		
		array(
			'name'	=> 'Page Colour',
			'desc'	=> '',
			'id'	=> "{$prefix}page_colour",
			'type'	=> 'color'
		),
		array(
			'name'		=> 'Create Sidebar',
			'id'		=> $prefix . 'page_sidebar',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'		=> 'Type in a word or two to create a sidebar',
			'std'		=> false
		),				
		array(
			'name'		=> 'Comment Type',
			'id'		=> "{$prefix}comment_type_page",
			'class'		=> "",
			'type'		=> 'radio',
			'options'	=> array(
				'fb'	  => 'Facebook Comments ',
				'wp' => 'WP Comments ',
				'both' => 'Both ',
				'none' => 'None'
			),
			'std'		=> 'wp',
			'desc'		=> ''
		)
	)
);




// 3rd meta box
$meta_boxes[] = array(
	'id'		=> 'review_page_extension',
	'title'		=> 'Best Reviews Page Controls',
	'pages'		=> array( 'page' ),

	'fields'	=> array(
			
		array(
			'name'		=> 'Comment Type',
			'id'		=> "{$prefix}review_loop",
			'class'		=> "",
			'type'		=> 'radio',
			'options'	=> array(
				'small'	  => 'Small Reviews ',
				'blog_one' => 'Blog Style 1 ',
				'blog_two' => 'Blog Style 2 '
			),
			'std'		=> 'small',
			'desc'		=> ''
		),
		array(
			'name'		=> 'Category Slug',
			'id'		=> $prefix . 'review_category',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'		=> 'Eg, the category slug of "World News" is "world-news"',
			'std'		=> false
		),
		array(
			'name'		=> 'Number of Reviews',
			'id'		=> $prefix . 'review_count',
			'clone'		=> false,
			'type'		=> 'text',
			'desc'		=> '',
			'std'		=> 10
		)
	)
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded
//  before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );