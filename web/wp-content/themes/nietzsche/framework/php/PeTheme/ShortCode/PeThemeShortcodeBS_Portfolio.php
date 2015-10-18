<?php

class PeThemeShortcodeBS_Portfolio extends PeThemeShortcode {

	public $instances = 0;

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "portfolio";
		$this->group = __("CONTENT",'nietzsche');
		$this->name = __("Portfolio",'nietzsche');
		$this->description = __("Portfolio",'nietzsche');

		$options =& peTheme()->content->getPagesOptionsByTemplate("portfolio");

		if (!$options) {
			$options = array();
		}

		$options =& array_merge(array(__("Default / All Posts",'nietzsche')=>""),$options);

		
		$this->fields = array(
							  "id" => 
							  array(
									"label" => __("Portfolio Options",'nietzsche'),
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

		extract(shortcode_atts(array('id'=>''),$atts));
		
		$t =& peTheme();
		
		ob_start();
		$t->project->portfolio($id);
		$content =& ob_get_clean();
		return $content;

	}


}

?>
