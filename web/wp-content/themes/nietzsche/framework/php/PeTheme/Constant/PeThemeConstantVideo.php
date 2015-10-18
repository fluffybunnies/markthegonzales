<?php

class PeThemeConstantVideo {

	public $all;
	public $metaboxPost;
	public $fields;


	public function __construct() {
		$this->all = peTheme()->video->option();

		$this->fields = new StdClass;

		$description = current($this->all) < 0 ? sprintf(__('<a href="%s">Create a new Video</a>','nietzsche'),admin_url('post-new.php?post_type=video')) : __("Select which video to use",'nietzsche');

		$this->fields->id = 
			array(
				  "label"=>__("Use video",'nietzsche'),
				  "type"=>"Select",
				  "description" => $description,
				  "options" => $this->all,
				  "editable" => admin_url('post.php?post=%0&action=edit'),
				  "default"=>""
				  );		

		$this->metaboxPost = 
			array(
				  "title" => __("Video Options",'nietzsche'),
				  "where" =>
				  array(
						"post" => "video"
						),
				  "content" =>
				  array(
						"id" => $this->fields->id
						)
				  );
	}
	
}

?>