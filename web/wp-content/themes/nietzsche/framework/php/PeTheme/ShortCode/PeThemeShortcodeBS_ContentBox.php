<?php

class PeThemeShortcodeBS_ContentBox extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "contentbox";
		$this->group = __("LAYOUT",'nietzsche');
		$this->name = __("Content Box",'nietzsche');
		$this->description = __("Add Content Box",'nietzsche');

		$this->fields = array(
							  "background"=> 
							  array(
									"label" => __("Background Color",'nietzsche'),
									"type" => "Color",
									"description" => __("Select background color for the content box.",'nietzsche'),
									"default" => ""
									),
							  "padding"=> 
							  array(
									"label" => __("Content Padding",'nietzsche'),
									"type" => "Text",
									"description" => __("Content padding: Top, Right, Bottom, Left.",'nietzsche'),
									"default" => "10px 10px 10px 10px"
									),
							  "content" =>
							  array(
									"label" => __("Box Content",'nietzsche'),
									"type" => "TextArea",
									"description" => __("Enter the box content here. Basic HTML tags are supported.",'nietzsche'),
									"default" =>" content "
									)
							  );

		// add block level cleaning
		peTheme()->shortcode->blockLevel[] = $this->trigger;

	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$content = $content ? $this->parseContent($content) : '';
		$style = "";
		$style .= (isset($background) && $background) ? "background-color:$background;" : "";
		$style .= (isset($padding) && $padding) ? "padding:$padding;\"" : "";
		if ($style) $style = "style=\"$style";

		$html = sprintf('<div class="contentBox" %s>%s</div>',$style,$content);
        return trim($html);
	}


}

?>
