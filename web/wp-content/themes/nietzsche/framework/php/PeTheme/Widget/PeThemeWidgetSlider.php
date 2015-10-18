<?php

class PeThemeWidgetSlider extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Slider",'nietzsche');
		$this->description = __("Show a slider",'nietzsche');
		$this->wclass = "widget_slider";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget title",'nietzsche'),
									"default"=>"Slider Widget"
									),
							  "size" => 
							  array(
									"label"=>__("Slider Size",'nietzsche'),
									"type"=>"Text",
									"description" => __("The size of the slider in pixels. Written in the form widthxheight",'nietzsche'),
									"default"=>"218x180"
									),
							  );

		$this->fields = array_merge($this->fields,PeGlobal::$const->gallery->metaboxSlider["content"]);

		parent::__construct();
	}


	public function widget($args,$instance) {
		$instance = $this->clean($instance);
		extract($instance);

		if (!@$id) return;		
		esc__pe($args["before_widget"]);
		if (isset($title)) echo "<h3>$title</h3>";
		list($w,$h) = explode("x",$size);
		echo "<div>";

		$config = new StdClass();

		foreach ($instance as $key => $value) {
			$config->{$key} = $value;
		}
		
		$loop = peTheme()->gallery->getSliderLoop($id,$w,$h,4,"span4",array("config"=>$config));
		$loop->main->link = false;

		peTheme()->template->slider_volo($loop); 
		echo "</div>";
		esc__pe($args["after_widget"]);
	}


}
?>
