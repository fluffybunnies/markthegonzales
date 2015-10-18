<?php

class PeThemeShortcodeBS_Blog extends PeThemeShortcode {

	public $instances = 0;

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "blog";
		$this->group = __("CONTENT",'nietzsche');
		$this->name = __("Blog",'nietzsche');
		$this->description = __("Blog",'nietzsche');

		$options =& peTheme()->content->getPagesOptionsByTemplate("blog");

		if (!$options) {
			$options = array();
		}

		$options =& array_merge(array(__("Default / All Posts",'nietzsche')=>""),$options);

		
		$this->fields = array(
							  "id" => 
							  array(
									"label" => __("Blog Options",'nietzsche'),
									"type" => "Select",
									"description" => __("Show all posts with default options or use custom settings of a blog page template.",'nietzsche'),
									"options" => $options
									),
							  "size" => 
							  array(
									"label"=>__("Media Size",'nietzsche'),
									"type"=>"Text",
									"description" => __("The size of the Media Area in pixels. Leave empty to use default values",'nietzsche'),
									"default"=>""
									),
							  );
	}

	public function output($atts,$content=null,$code="") {

		extract(shortcode_atts(array('id'=>'','size'=>''),$atts));
		
		$size = $size ? explode("x",$size) : false;

		$t =& peTheme();
		
		ob_start();
		if ($size) 	$t->media->size($size[0],$size[1]);
		$t->content->blog($id);
		if ($size) $t->media->size();
		$content =& ob_get_clean();
		return $content;

	}


}

?>
