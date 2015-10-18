<?php

class PeThemeShortcodeBS_Feature extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "feature";
		$this->group = __("LAYOUT",'nietzsche');
		$this->name = __("Feature",'nietzsche');
		$this->description = __("Add a Feature Box",'nietzsche');
		$this->fields = array(
							  "icon"=> 
							  array(
									"label" => __("Icon",'nietzsche'),
									"type" => "Select",
									"description" => __("Select an icon for this feature. See the help docs for a list of the available icons. ",'nietzsche'),
									"options" => 
									array(
										  __("Cloud",'nietzsche')=>"icon-feature-cloud",
										  __("Minus",'nietzsche')=>"icon-feature-minus",
										  __("Plus",'nietzsche')=>"icon-feature-plus",
										  __("Quote",'nietzsche')=>"icon-feature-quote",
										  __("Eye",'nietzsche')=>"icon-feature-eye",
										  __("Info",'nietzsche')=>"icon-feature-info",
										  __("Heart",'nietzsche')=>"icon-feature-heart",
										  __("Lightbulb",'nietzsche')=>"icon-feature-bulb",
										  __("Rss",'nietzsche')=>"icon-feature-rss",
										  __("Award",'nietzsche')=>"icon-feature-award",
										  __("Stats",'nietzsche')=>"icon-feature-stat",
										  __("Star",'nietzsche')=>"icon-feature-star",
										  __("Shield",'nietzsche')=>"icon-feature-shield",
										  __("Film",'nietzsche')=>"icon-feature-film",
										  __("Lock",'nietzsche')=>"icon-feature-locked",
										  __("Ribbon",'nietzsche')=>"icon-feature-ribbon",
										  __("Share",'nietzsche')=>"icon-feature-share",
										  __("Location",'nietzsche')=>"icon-feature-location",
										  __("User",'nietzsche')=>"icon-feature-user",
										  __("List",'nietzsche')=>"icon-feature-list",
										  __("Grid",'nietzsche')=>"icon-feature-grid",
										  __("Comment",'nietzsche')=>"icon-feature-comment",
										  __("Map",'nietzsche')=>"icon-feature-map",
										  __("Graph",'nietzsche')=>"icon-feature-graph",
										  __("Settings",'nietzsche')=>"icon-feature-settings",
										  __("Tag",'nietzsche')=>"icon-feature-tag",
										  __("Calendar",'nietzsche')=>"icon-feature-calendar",
										  __("Mail",'nietzsche')=>"icon-feature-mail",
										  __("Clock",'nietzsche')=>"icon-feature-clock",
										  __("Lightening",'nietzsche')=>"icon-feature-lightening",
										  __("Camera",'nietzsche')=>"icon-feature-camera",
										  __("Zoom",'nietzsche')=>"icon-feature-zoom-in",
										  __("Close",'nietzsche')=>"icon-feature-close",
										  __("Tic",'nietzsche')=>"icon-feature-tic",
										  __("CircleTic",'nietzsche')=>"icon-feature-tic2",
										  __("CircleClose",'nietzsche')=>"icon-feature-close2",
										  __("Document",'nietzsche')=>"icon-feature-doc",
										  __("Article",'nietzsche')=>"icon-feature-article",
										  __("Next",'nietzsche')=>"icon-feature-next",
										  __("Prev",'nietzsche')=>"icon-feature-prev",
										  __("Down",'nietzsche')=>"icon-feature-down",
										  __("Up",'nietzsche')=>"icon-feature-up",
										  __("UpRight",'nietzsche')=>"icon-feature-up-right",
										  __("DownLeft",'nietzsche')=>"icon-feature-down-left"
										  ),
									"default" => "icon-feature-tic"
									),
							  "content" =>
							  array(
									"label" => __("Content",'nietzsche'),
									"type" => "TextArea",
									"description" => __("Enter the feature box text content here. Simple HTML tags are supported.",'nietzsche'),
									"default" => sprintf('<h3>Title</h3>%s<p>Description</p>',"\n")
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$content = $content ? $this->parseContent($content) : '';
		$html = sprintf('<div class="feature"><span class="featureIcon"><i class="%s"></i></span><div class="featureContent">%s</div></div>',$icon,$content);
        return trim($html);
	}


}

?>
