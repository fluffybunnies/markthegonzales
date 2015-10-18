<?php

class PeThemeShortcodeBS_Alert extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "alert";
		$this->group = __("LAYOUT",'nietzsche');
		$this->name = __("Alert Box",'nietzsche');
		$this->description = __("Add an Alert Box",'nietzsche');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Alert Box Type",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the type of Alert Box required. The alert type determines the color of the box and text",'nietzsche'),
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
							  "display"=> 
							  array(
									"label" => __("Alert Box Layout",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the layout based on what type of content the box will hold, inline content or block content",'nietzsche'),
									"options" => 
									array(
										  __("Block",'nietzsche') => "block",
										  __("Inline",'nietzsche') => "inline"
										  ),
									"default" => "block"
									),
							  "content" =>
							  array(
									"label" => __("Content",'nietzsche'),
									"type" => "TextArea",
									"description" => __("Enter the Alert Box content here ( Basic HTML supported ).",'nietzsche'),
									)
							  );
		// add block level cleaning
		peTheme()->shortcode->blockLevel[] = $this->trigger;
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$content = $content ? $this->parseContent($content) : '';
		$html = <<< EOT
<div class="alert alert-$type alert-$display fade in">
	$content
</div>
EOT;
        return trim($html);
	}


}

?>
