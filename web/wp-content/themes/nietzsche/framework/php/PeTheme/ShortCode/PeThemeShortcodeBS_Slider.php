<?php

class PeThemeShortcodeBS_Slider extends PeThemeShortcode {

	public $instances = 0;

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "slider";
		$this->group = __("MEDIA",'nietzsche');
		$this->name = __("Slider",'nietzsche');
		$this->description = __("Slider",'nietzsche');

		$this->fields = array(
							  "id" => PeGlobal::$const->gallery->id,
							  "size" => 
							  array(
									"label"=>__("Size",'nietzsche'),
									"type"=>"Text",
									"description" => __("The size of the slider in pixels, written in the form WidthxHeight. Leave empty to use default values.",'nietzsche'),
									"default"=>""
									),
							  );

	}


	public function output($atts,$content=null,$code="") {

		extract(shortcode_atts(array('id'=>'','size'=>''),$atts));
		
		if (!$id) return "";

		$size = $size ? explode("x",$size) : false;


		$t =& peTheme();
		ob_start();
		if ($size) 	$t->media->size($size[0],isset($size[1]) ? $size[1] : null);
		$t->slider->output($id);
		if ($size) $t->media->size();
		$content =& ob_get_clean();
		return $content;

	}


}

?>
