<?php

class PeThemeConstantBlog {
	public $metabox;

	public function __construct() {
		$this->metabox = 
			array(
				  "title" =>__("Blog",'nietzsche'),
				  "priority" => "core",
				  "where" => 
				  array(
						"page" => "page-blog",
						),
				  "content"=>
				  array(
						"layout" =>
						array(
							  "label"=>__("Layout",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __("Select the required post layout. 'Full' - denotes a full width normal blog layout. 'Compact' - denotes a full width list style layout. 'Mini' - denotes a compressed layout with small post thumbnails.",'nietzsche'),
							  "options" => PeGlobal::$config["blog"],
							  "default"=>""
							  ),
						"count" =>
						array(
							  "label" => __("Max Posts",'nietzsche'),
							  "type" => "Text",
							  "description" => __("Maximum number of posts to show.",'nietzsche'),
							  "default" => get_option("posts_per_page"),
							  ),
						"media" => 
						array(
							  "label"=>__("Show Media",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __("Specify if the post's image/video/gallery media is displayed.",'nietzsche'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"pager" => 
						array(
							  "label"=>__("Paged Result",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __("Display a pager when more posts are found than specified in the 'Maximum' field. ",'nietzsche'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"sticky" => 
						array(
							  "label"=>__("Include Sticky Posts",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __("Include sticky posts in the displayed list.",'nietzsche'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"category" =>
						array(
							  "label" => __("Category",'nietzsche'),
							  "type" => "Select",
							  "description" => __("Only show posts from a specific category.",'nietzsche'),
							  "options" => array_merge(array(__("All",'nietzsche')=>""),peTheme()->data->getTaxOptions("category")),
							  "default" => ""
							  ),
						"tag" =>
						array(
							  "label" => __("Tag",'nietzsche'),
							  "type" => "Select",
							  "description" => __("Only show posts with a specific tag.",'nietzsche'),
							  "options" => array_merge(array(__("All",'nietzsche')=>""),peTheme()->data->getTaxOptions("post_tag")),
							  "default" => ""
							  ),
						"format" =>
						array(
							  "label" => __("Post Format",'nietzsche'),
							  "type" => "Select",
							  "description" => __("Only show posts of a specific format.",'nietzsche'),
							  "options" => array_merge(array(__("All",'nietzsche')=>""),array_combine(PeGlobal::$config["post-formats"],PeGlobal::$config["post-formats"])),
							  "default" => ""
							  )
						)
				  );
		if (count(PeGlobal::$config["blog"]) < 2) {
			unset($this->metabox["content"]["layout"]);
		}
	}
	
}

?>