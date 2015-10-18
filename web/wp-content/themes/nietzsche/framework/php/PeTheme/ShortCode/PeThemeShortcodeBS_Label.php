<?php

class PeThemeShortcodeBS_Label extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "label";
		$this->group = __("UI",'nietzsche');
		$this->name = __("Label",'nietzsche');
		$this->description = __("Add a label",'nietzsche');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Label Type",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the type of label required. The type determines the label color",'nietzsche'),
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
									"description" => __("Enter the destination url of the label. Leave this field blank if the label is not a clickable link",'nietzsche'),
									),
							  "content" =>
							  array(
									"label" => __("Label",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the label content here.",'nietzsche'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$type = $atts["type"];
		if (!isset($url)) $url = false;
		$content = $content ? $this->parseContent($content) : '';
		if ($url) {
			$html = sprintf('<a href="%s" class="label label-%s">%s</a>',$url,$type,$content);
		} else {
			$html = sprintf('<span class="label label-%s">%s</span>',$type,$content);
		}
        return trim($html);
	}


}

?>
