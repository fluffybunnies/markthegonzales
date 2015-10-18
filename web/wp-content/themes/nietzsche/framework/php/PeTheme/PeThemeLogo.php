<?php

class PeThemeLogo {

	public $master;

	public function __construct($master) {
		$this->master =& $master;
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Logos",'nietzsche'),
						'singular_name'     => __("Logo",'nietzsche'),
						'add_new_item'      => __("Add New Logo",'nietzsche'),
						'search_items'      => __('Search Logos','nietzsche'),
						'popular_items' 	  => __('Popular Logos','nietzsche'),		
						'all_items' 		  => __('All Logos','nietzsche'),
						'parent_item' 	  => __('Parent Logo','nietzsche'),
						'parent_item_colon' => __('Parent Logo:','nietzsche'),
						'edit_item' 		  => __('Edit Logo','nietzsche'), 
						'update_item' 	  => __('Update Logo','nietzsche'),
						'add_new_item' 	  => __('Add New Logo','nietzsche'),
						'new_item_name' 	  => __('New Logo Name','nietzsche')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title","thumbnail"),
				  "taxonomies" => array("")
				  );

		PeGlobal::$config["post_types"]["logo"] = $cpt;
		add_action('pe_theme_metabox_config_logo',array(&$this,'pe_theme_metabox_config_logo'));
	}

	public function pe_theme_metabox_config_logo() {

		$mbox = 
			array(
				  "title" => __("Link",'nietzsche'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"logo" => "all"
						),
				  "content" =>
				  array(
						"url" => 	
						array(
							  "label"=>__("Url",'nietzsche'),
							  "type"=>"Text",
							  "default"=>"#"
							  )
						)
				  
				  );

		PeGlobal::$config["metaboxes-logo"] = 
			array(
				  "info" => $mbox
				  );
			
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>"logo",
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
			$options = array(__("No logo defined.",'nietzsche')=>-1);
		}
		return $options;
	}

}

?>