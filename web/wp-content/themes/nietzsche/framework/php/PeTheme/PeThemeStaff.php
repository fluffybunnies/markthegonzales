<?php

class PeThemeStaff {

	public $master;

	public function __construct($master) {
		$this->master =& $master;
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Staff Members",'nietzsche'),
						'singular_name'     => __("Staff Member",'nietzsche'),
						'add_new_item'      => __("Add New Staff Member",'nietzsche'),
						'search_items'      => __('Search Staff Members','nietzsche'),
						'popular_items' 	  => __('Popular Staff Members','nietzsche'),		
						'all_items' 		  => __('All Staff Members','nietzsche'),
						'parent_item' 	  => __('Parent Staff Member','nietzsche'),
						'parent_item_colon' => __('Parent Staff Member:','nietzsche'),
						'edit_item' 		  => __('Edit Staff Member','nietzsche'), 
						'update_item' 	  => __('Update Staff Member','nietzsche'),
						'add_new_item' 	  => __('Add New Staff Member','nietzsche'),
						'new_item_name' 	  => __('New Staff Member Name','nietzsche')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title","editor","thumbnail"),
				  "taxonomies" => array("")
				  );

		PeGlobal::$config["post_types"]["staff"] = $cpt;
		add_action('pe_theme_metabox_config_staff',array(&$this,'pe_theme_metabox_config_staff'));
	}

	public function pe_theme_metabox_config_staff() {

		$mbox = 
			array(
				  "title" => __("Personal Info",'nietzsche'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"staff" => "all"
						),
				  "content" =>
				  array(
						"position" => 	
						array(
							  "label"=>__("Position",'nietzsche'),
							  "type"=>"Text",
							  "default"=>__("Founder/Partner",'nietzsche')
							  ),
						"social" => 
						array(
							  "label"=>__("Social Links",'nietzsche'),
							  "type"=>"Items",
							  "description" => __("Add one or more links to social networks.",'nietzsche'),
							  "button_label" => __("Add Social Link",'nietzsche'),
							  "sortable" => true,
							  "auto" => __("Layer",'nietzsche'),
							  "unique" => false,
							  "editable" => false,
							  "legend" => false,
							  "fields" => 
							  array(
									array(
										  "label" => __("Social Network",'nietzsche'),
										  "name" => "icon",
										  "type" => "select",
										  "options" => apply_filters('pe_theme_social_icons',array()),
										  "width" => 185,
										  "default" => ""
										  ),
									array(
										  "name" => "url",
										  "type" => "text",
										  "width" => 300, 
										  "default" => "#"
										  )
									),
							  "default" => ""
							  )
						)
				  
				  );

		PeGlobal::$config["metaboxes-staff"] = 
			array(
				  "info" => $mbox
				  );
			
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>"staff",
								 "suppress_filters"=>false,
								 "posts_per_page"=>-1
								 )
						   );
		if (count($posts) > 0) {
			$options = array();
			foreach($posts as $post) {
				$options[$post->post_title] = $post->ID;
			}
		} else {
			$options = array(__("No staff member defined.",'nietzsche')=>-1);
		}
		return $options;
	}

}

?>