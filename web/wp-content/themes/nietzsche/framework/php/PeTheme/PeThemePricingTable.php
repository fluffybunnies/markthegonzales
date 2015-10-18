<?php

class PeThemePricingTable {

	public $master;

	public $idx;
	public $current;
	public $popular;
	public $labels;
	public $starting;

	public $layouts = array("one-cols","two-cols","three-cols","four-cols","five-cols");

	public function __construct($master) {
		$this->master =& $master;
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Pricing Tables",'nietzsche'),
						'singular_name'     => __("Pricing Table",'nietzsche'),
						'add_new_item'      => __("Add New Pricing Table",'nietzsche'),
						'search_items'      => __('Search Pricing Tables','nietzsche'),
						'popular_items' 	  => __('Popular Pricing Tables','nietzsche'),		
						'all_items' 		  => __('All Pricing Tables','nietzsche'),
						'parent_item' 	  => __('Parent Pricing Table','nietzsche'),
						'parent_item_colon' => __('Parent Pricing Table:','nietzsche'),
						'edit_item' 		  => __('Edit Pricing Table','nietzsche'), 
						'update_item' 	  => __('Update Pricing Table','nietzsche'),
						'add_new_item' 	  => __('Add New Pricing Table','nietzsche'),
						'new_item_name' 	  => __('New Pricing Table Name','nietzsche')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title","editor"),
				  "taxonomies" => array("")
				  );

		PeGlobal::$config["post_types"]["ptable"] = $cpt;

		PeGlobal::$config["metaboxes-ptable"] = 
			array(
				  "table" => PeGlobal::$const->pricingTable->metabox
				  );
			
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>"ptable",
								 "posts_per_page"=>-1
								 )
						   );
		if (count($posts) > 0) {
			$options = array();
			foreach($posts as $post) {
				$options[$post->post_title] = $post->ID;
			}
		} else {
			$options = array(__("No pricing tables defined",'nietzsche')=>-1);
		}
		return $options;
	}

	public function getLoop() {
		$meta = $this->master->content->meta();
		if (empty($meta->tables->items)) return false;
		$conf =& $meta->tables;

		$cols = count($conf->items);
		$labels = ($cols > 1 && $conf->labels === "yes");
		
		$cols -= ($labels ? 1 : 0);
		$cols = min($cols,count($this->layouts));
		
		$popular = intval($conf->popular)-($labels ? 0 : 1);
		$starter = intval($conf->starter)-($labels ? 0 : 1);;

		$this->popular = $popular;
		$this->cols = $cols;
		$this->labels = $labels;
		$this->starter = $starter;
		
		return $this->master->content->customLoop("ptable",$cols+1,null,array("post__in" => $conf->items, "orderby" => "post__in"));
	}

	public function tableClasses() {
		if ($this->labels()) {
			$classes[] = "features-list";
		} else {
			if ($this->popular === $this->idx) {
				$classes[] = "level-max";
			} else if ($this->starter === $this->idx) {
				$classes[] = "level-one";
			} else {
				$classes[] = "";
			}
		}
		echo join(" ",$classes);
	}

	public function columnClasses() {
		$classes[] = $this->labels ? "pricing-table-extended" : "pricing-table-simple";
		$classes[] = $this->layouts[$this->cols-1];
		echo join(" ",$classes);
	}

	public function labels() {
		return $this->labels && ($this->idx === 0);
	}


	public function looping() {
		if (!$this->master->content->looping()) return false;
		$this->current =& $this->master->content->meta()->table;
		$this->idx = $this->master->content->idx();
		return true;
	}




}

?>