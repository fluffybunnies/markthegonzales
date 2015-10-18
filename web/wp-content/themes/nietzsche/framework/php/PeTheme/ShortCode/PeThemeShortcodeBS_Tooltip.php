<?php

class PeThemeShortcodeBS_Tooltip extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "tooltip";
		$this->group = __("UI",'nietzsche');
		$this->name = __("Tooltip",'nietzsche');
		$this->description = __("Add a tooltip",'nietzsche');
		$this->fields = array(
							  "position"=> 
							  array(
									"label" => __("Position",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the tooltip position.",'nietzsche'),
									"options" => 
									array(
										  __("Top",'nietzsche') => "top",
										  __("Bottom",'nietzsche') => "bottom",
										  __("Left",'nietzsche') => "left",
										  __("Right",'nietzsche') => "right"
										  ),
									"default" => "top"
									),
							  "url" =>
							  array(
									"label" => __("Url",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the destination url of the tooltip trigger",'nietzsche'),
									"default" => "#"
									),
							  "type"=> 
							  array(
									"label" => __("Button Type",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the type of button to use. The type determines the button color",'nietzsche'),
									"options" => 
									array(
										  __("No button, use normal text",'nietzsche') => "none",
										  __("Default",'nietzsche') => "default",
										  __("Primary",'nietzsche') => "primary",
										  __("Info",'nietzsche') => "info",
										  __("Success",'nietzsche') => "success",
										  __("Warning",'nietzsche') => "warning",
										  __("Danger",'nietzsche') => "danger",
										  __("Inverse",'nietzsche') => "inverse"
										  ),
									"default" => "none"
									),
							  "content" =>
							  array(
									"label" => __("Label",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the tooltip trigger label content here.",'nietzsche'),
									"default" => "Label content."
									),
							  "title" =>
							  array(
									"label" => __("Tooltip",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the tooltip content here.",'nietzsche'),
									"default" => "Tooltip content"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		if (!@$url || !@$title) return "";
		$class = (@$type && $type != "none") ? sprintf(' class="btn btn-%s" ',$type) : "";
		return sprintf('<a%s href="%s" data-rel="tooltip" data-position="%s" title="%s">%s</a>',$class,$url,$position,esc_attr($title),$this->parseContent($content));
	}


}

?>
