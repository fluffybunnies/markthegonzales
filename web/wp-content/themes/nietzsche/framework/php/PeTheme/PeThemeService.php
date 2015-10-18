<?php

class PeThemeService {

	public $master;

	public function __construct($master) {
		$this->master =& $master;
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Services",'nietzsche'),
						'singular_name'     => __("Service",'nietzsche'),
						'add_new_item'      => __("Add New Service",'nietzsche'),
						'search_items'      => __('Search Services','nietzsche'),
						'popular_items' 	  => __('Popular Services','nietzsche'),		
						'all_items' 		  => __('All Services','nietzsche'),
						'parent_item' 	  => __('Parent Service','nietzsche'),
						'parent_item_colon' => __('Parent Service:','nietzsche'),
						'edit_item' 		  => __('Edit Service','nietzsche'), 
						'update_item' 	  => __('Update Service','nietzsche'),
						'add_new_item' 	  => __('Add New Service','nietzsche'),
						'new_item_name' 	  => __('New Service Name','nietzsche')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title","editor"),
				  "taxonomies" => array("")
				  );

		PeGlobal::$config["post_types"]["service"] = $cpt;
		add_action('pe_theme_metabox_config_service',array(&$this,'pe_theme_metabox_config_service'));
	}

	public function pe_theme_metabox_config_service() {

		$mbox = 
			array(
				  "title" => __("Service Info",'nietzsche'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"service" => "all"
						),
				  "content" =>
				  array(
						"icon" => 	
						array(
							  "label"=>__("Icon",'nietzsche'),
							  "type"=>"Icon",
							  "default"=>"icon-user"
							  ),
						"features" => 
						array(
							  "label"=>__("Features",'nietzsche'),
							  "type"=>"Links",
							  "description" => __("Add one or more service features.",'nietzsche'),
							  "sortable" => true,
							  "default"=>""
							  )
						)
				  
				  );

		PeGlobal::$config["metaboxes-service"] = 
			array(
				  "info" => $mbox
				  );
			
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>"service",
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
			$options = array(__("No service defined.",'nietzsche')=>-1);
		}
		return $options;
	}

}

?>