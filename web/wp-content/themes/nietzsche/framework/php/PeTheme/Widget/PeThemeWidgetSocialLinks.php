<?php

class PeThemeWidgetSocialLinks extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Social links",'nietzsche');
		$this->description = __("Link to social profiles",'nietzsche');
		$this->wclass = "widget_social";
		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget title",'nietzsche'),
									"default"=>"Social Media Widget"
									),
							  "links" => 
							  array(
									"label"=>__("Links",'nietzsche'),
									"type"=>"Links",
									"description" => __("Paste your social media profile links one at a time and hit the Add New button. The link will be added to a table below and the appropriate icon will be automatically selected based on the link's domain name",'nietzsche'),
									"sortable" => true,
									"default"=>""
									)
							 
							  );

		parent::__construct();
	}

	public function &getContent(&$instance) {
		extract($instance);
		$html = "";
		if (!isset($links)) return $html;
		$html = isset($title) ? "<h3>$title</h3>" : "";
		$html .= peTheme()->content->getSocialLinks($links);
		return $html;
	}


}
?>
