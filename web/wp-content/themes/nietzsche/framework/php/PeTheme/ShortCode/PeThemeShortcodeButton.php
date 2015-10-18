<?php

class PeThemeShortcodeButton extends PeThemeShortcode {

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
									"description" => __("Select the type of button required. The button type determines the icon displayed on the button",'nietzsche'),
									"options" => 
									array(
										  __("Download",'nietzsche') => "download",
										  __("Link",'nietzsche') => "link",
										  __("Info",'nietzsche') => "info",
										  __("Thumbs",'nietzsche') => "thumbs",
										  __("Vcard",'nietzsche') => "vcard",
										  __("Love",'nietzsche') => "love",
										  __("Warning",'nietzsche') => "warning",
										  __("Tweet",'nietzsche') => "tweet",
										  __("Like",'nietzsche') => "like",
										  __("Note",'nietzsche') => "note"
										  ),
									"default" => "download"
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
									"description" => __("Enter the button label here. If no text is entered the button will consist of an icon only",'nietzsche'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		$type = $atts["type"];
		$class = $content ? "content " : "";
		$content = $content ? '<span class="content">'.$this->parseContent($content).'</span>' : '';
		$html = <<< EOT
<a href="{$atts['url']}" class="btn $class$type"><span class="sprite"></span>$content</a>
EOT;
        return trim($html);
	}


}

?>
