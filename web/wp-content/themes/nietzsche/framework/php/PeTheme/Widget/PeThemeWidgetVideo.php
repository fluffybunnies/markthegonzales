<?php

class PeThemeWidgetVideo extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Video",'nietzsche');
		$this->description = __("Show a video",'nietzsche');
		$this->wclass = "widget_video";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget title",'nietzsche'),
									"default"=>"Video Widget"
									),
							  "id" => PeGlobal::$const->video->fields->id
							  );

		parent::__construct();
	}


	public function widget($args,$instance) {
		$instance = $this->clean($instance);
		extract($instance);

		if (!@$id) return;		
		esc__pe($args["before_widget"]);
		if (isset($title)) echo "<h3>$title</h3>";
		echo "<div>";
		peTheme()->video->show($id);
		echo "</div>";
		esc__pe($args["after_widget"]);
	}


}
?>
