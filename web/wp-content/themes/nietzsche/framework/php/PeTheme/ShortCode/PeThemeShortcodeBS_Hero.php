<?php

class PeThemeShortcodeBS_Hero extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "hero";
		$this->group = __("LAYOUT",'nietzsche');
		$this->name = __("Hero Unit",'nietzsche');
		$this->description = __("Add an Hero Unit",'nietzsche');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Hero Unit Type",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the type of hero unit required. the type determines the color",'nietzsche'),
									"options" => 
									array(
										  __("Default",'nietzsche') => "default",
										  __("Primary",'nietzsche') => "primary",
										  __("Info",'nietzsche') => "info",
										  __("Success",'nietzsche') => "success",
										  __("Warning",'nietzsche') => "warning",
										  __("Danger",'nietzsche') => "danger",
										  __("Inverse",'nietzsche') => "inverse"
										  ),
									"default" => "default"
									),
							 "title" =>
							  array(
									"label" => __("Title",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the title of the Hero Unit.",'nietzsche'),
									),
							  "content" =>
							  array(
									"label" => __("Content",'nietzsche'),
									"type" => "Editor",
									"description" => __("Enter the Hero Unit content here.",'nietzsche'),
									)
							  );

		peTheme()->shortcode->blockLevel[] = $this->trigger;
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
	
		$content = $content ? $this->parseContent($content) : '';
		$title = isset($title) ? "<h1>$title</h1>" : "";

		$html = <<< EOT
<div class="hero-unit well $type">
	$title
	<p>$content</p>
</div>
EOT;
        return trim($html);
	}


}

?>
