<?php

class PeThemeShortcodeBS_Badge extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "badge";
		$this->group = __("UI",'nietzsche');
		$this->name = __("Badge",'nietzsche');
		$this->description = __("Add a badge",'nietzsche');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Badge Type",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the type of badge required. The badge type determines the bodge color",'nietzsche'),
									"options" => 
									array(
										  __("Default",'nietzsche') => "default",
										  __("Info",'nietzsche') => "info",
										  __("Success",'nietzsche') => "success",
										  __("Warning",'nietzsche') => "warning",
										  __("Important",'nietzsche') => "important",
										  __("Inverse",'nietzsche') => "inverse"
										  ),
									"default" => "default"
									),
							  "url" =>
							  array(
									"label" => __("Url",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the destination url of the badge. Leave this field blank if the badge is not required to be a clickable link",'nietzsche'),
									),
							  "content" =>
							  array(
									"label" => __("Label",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the badge's text content here.",'nietzsche'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$type = $atts["type"];
		if (!isset($url)) $url = false;
		$content = $content ? $this->parseContent($content) : '';
		if ($url) {
			$html = sprintf('<a href="%s" class="badge badge-%s">%s</a>',$url,$type,$content);
		} else {
			$html = sprintf('<span class="badge badge-%s">%s</span>',$type,$content);
		}
        return trim($html);
	}


}

?>
