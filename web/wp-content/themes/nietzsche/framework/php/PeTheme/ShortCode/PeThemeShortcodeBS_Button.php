<?php

class PeThemeShortcodeBS_Button extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "button";
		$this->group = __("UI",'nietzsche');
		$this->name = __("Button",'nietzsche');
		$this->description = __("Add a button",'nietzsche');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Button Type",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the type of button required. The button type determines the boton's color",'nietzsche'),
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
							  "size"=> 
							  array(
									"label" => __("Button Size",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the size of button",'nietzsche'),
									"options" => 
									array(
										  __("Small",'nietzsche') => "small",
										  __("Medium",'nietzsche') => "medium",
										  __("Large",'nietzsche') => "large"
										  ),
									"default" => "small"
									),
							  "url" =>
							  array(
									"label" => __("Url",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the destination url of the button",'nietzsche'),
									),
							  "content" =>
							  array(
									"label" => __("Optional Label",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the button label here. If no text is entered the button will have no label and so will require an icon or something else to be inserted. This can be done using the icon shortcode once this button shortcode has been added to the editor",'nietzsche'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$type = $atts["type"];
		if (!isset($url)) $url = "#";
		$content = $content ? $this->parseContent($content) : '';
		$html = <<< EOT
<a href="$url" target="_blank" class="btn btn-$size btn-$type">$content</a>
EOT;
        return trim($html);
	}


}

?>
