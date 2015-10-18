<?php

class PeThemeWidgetFlickr extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Flickr",'nietzsche');
		$this->description = __("Displays Flickr Image Thumbnails",'nietzsche');
		$this->wclass = "widget_flickr";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget title.",'nietzsche'),
									"default"=>"Flickr Widget"
									),
							  "username" => 
							  array(
									"label"=>__("Username",'nietzsche'),
									"type"=>"Text",
									"description" => __("Flickr username ID Number from which to load images.",'nietzsche'),
									"default"=>"68880463@N03"
									),
							  "count" => 
							  array(
									"label"=>__("Number Of Images",'nietzsche'),
									"type"=>"Select",
									"description" => __("Select the number of images to be displayed.(3 per row)",'nietzsche'),
									"single" => true,
									"options" => range(1,10),
									"default"=>6
									)/*,
							  "cols" => 
							  array(
									"label"=>__("Columns",'nietzsche'),
									"type"=>"Select",
									"description" => __("Select the number of columns.",'nietzsche'),
									"single" => true,
									"options" => range(1,10),
									"default"=>3
									)*/
							  
							  );

		parent::__construct();
	}

	public function getContent(&$instance) {
		extract($instance);
		$cols = 3;
		$html = <<<EOL
<h3>$title</h3>
<div class="flickr" data-userID="$username" data-count="$count" data-cols="$cols"></div>
EOL;


		return $html;
	}


}
?>
