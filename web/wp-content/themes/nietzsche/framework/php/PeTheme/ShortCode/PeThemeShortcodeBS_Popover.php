<?php

class PeThemeShortcodeBS_Popover extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "popover";
		$this->group = __("UI",'nietzsche');
		$this->name = __("Popover",'nietzsche');
		$this->description = __("Add a popover",'nietzsche');
		$this->fields = array(
							  "position"=> 
							  array(
									"label" => __("Position",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the position for the popover",'nietzsche'),
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
									"description" => __("Enter the destination url of the popover trigger object",'nietzsche'),
									"default" => "#"
									),
							  "type"=> 
							  array(
									"label" => __("Button Type",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the type of button to use as the trigger object",'nietzsche'),
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
									"description" => __("Enter the popover trigger button's text label here.",'nietzsche'),
									"default" => "Hover for popover."
									),
							  "title" =>
							  array(
									"label" => __("Title",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the popover title here.",'nietzsche'),
									"default" => "Popover Title"
									),
							  "body" =>
							  array(
									"label" => __("Content",'nietzsche'),
									"type" => "TextArea",
									"description" => __("Enter the popover content here.",'nietzsche'),
									"default" => "Popover content"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		if (!@$url || !@$title || !@$body) return "";
		$class = (@$type && $type != "none") ? sprintf(' class="btn btn-%s"',$type) : "";
		return sprintf('<a%s href="%s" data-placement="%s" data-rel="popover" data-content="%s" title="%s">%s</a>',$class,$url,$position,esc_attr($body),esc_attr($title),$this->parseContent($content));
	}


}

?>
