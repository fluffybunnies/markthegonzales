<?php

class PeThemeShortcodeBS_PriceBox extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "pricetable";
		$this->group = __("LAYOUT",'nietzsche');
		$this->name = __("Price Table",'nietzsche');
		$this->description = __("Add an Price Box",'nietzsche');

		$html = <<<EOL
<ul class="unstyled">
    <li><i class="icon-ok icon-white"></i>Includes stuff</li>
    <li><i class="icon-ok icon-white"></i>Other great items</li>
    <li><i class="icon-ok icon-white"></i>Yep that too</li>
</ul>
EOL;

		$this->fields = array(
							  "color"=> 
							  array(
									"label" => __("Background Color",'nietzsche'),
									"type" => "Color",
									"description" => __("Select background color.",'nietzsche'),
									"default" => "#666666"
									),
							 "title" =>
							  array(
									"label" => __("Title",'nietzsche'),
									"type" => "Text",
									"description" => __("Price table title.",'nietzsche'),
									"default" => "Like a Player",
									),
							  "price" =>
							  array(
									"label" => __("Price",'nietzsche'),
									"type" => "Text",
									"description" => __("Price table price.",'nietzsche'),
									"default" => "$19<span>99 /m</span>",
									),
							  "content" =>
							  array(
									"label" => __("Features",'nietzsche'),
									"type" => "TextArea",
									"description" => __("Enter the pricing tables features, one per line.",'nietzsche'),
									"default" => $html
									),
							  "button_type"=> 
							  array(
									"label" => __("Button Type",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the type of button required. The type determines the button color",'nietzsche'),
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
							  "button_url" =>
							  array(
									"label" => __("Button Url",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the destination url of the button",'nietzsche'),
									"default" => "#"
									),
							  "button_label" =>
							  array(
									"label" => __("Button Label",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the button label here. Leave this field blank to hide the button",'nietzsche'),
									"default" => "Sign Up" 
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$content = $content ? $this->parseContent($content) : '';
		$html = sprintf('<div class="hero-unit price warning well" style="background-color: %s;">',$color);
		if (@$title) $html .= sprintf('<p class="type">%s</p>',$title);
		if (@$price) $html .= sprintf('<h1>%s</h1>',$price);
		if (@$content) $html .= $content;
		if (@$button_label) $html .= sprintf('<br/><p><a href="%s" class="btn btn-%s">%s</a></p>',$button_url,$button_type,$button_label);
		$html .= "</div>";
        return trim($html);
	}


}

?>
