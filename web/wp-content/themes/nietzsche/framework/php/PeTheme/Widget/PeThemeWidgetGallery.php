<?php

class PeThemeWidgetGallery extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Gallery",'nietzsche');
		$this->description = __("Show a gallery",'nietzsche');
		$this->wclass = "widget_gallery";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget title",'nietzsche'),
									"default"=>"Gallery widget"
									),
							  "size" => 
							  array(
									"label"=>__("Size",'nietzsche'),
									"type"=>"Text",
									"description" => __("Gallery widget size",'nietzsche'),
									"default"=>"218x180"
									),
							  "id" => PeGlobal::$const->gallery->id
							  );

		parent::__construct();
	}


	public function widget($args,$instance) {
		$instance = $this->clean($instance);

		extract($instance);

		if (!@$id) return;
		$post = get_post($id);
		if (!$post) return;
		esc__pe($args["before_widget"]);
		if (isset($title)) echo "<h3>$title</h3>";
		list($w,$h) = explode("x",$size);
		echo "<div>";
		$t =& peTheme();
		$t->data->postSetup($post);
		$t->template->gallery_cover($w,$h);
		$t->data->postReset();
		$t->template->intro_gallery($id,90,74,"fullscreen");
		echo "</div>";
		esc__pe($args["after_widget"]);
	}


}
?>
