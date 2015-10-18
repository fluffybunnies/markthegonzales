<?php

class PeThemeShortcodeLink extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "link";
		$this->group = __("ALERTS",'nietzsche');
		$this->name = __("Link",'nietzsche');
		$this->description = __("Add link box",'nietzsche');
		$this->fields = array(
							  "content" =>
							  array(
									"label" => __("Content",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the text content of the alert box",'nietzsche'),
									),
							  "url" =>
							  array(
									"label" => __("Url",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the destination url of the alert box when clicked",'nietzsche'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {		
		if ($content) {
			$content = $this->parseContent($content);
		}
		$html = <<< EOT
<a href="{$atts['url']}"><div class="alert link"><span class="sprite"></span><p>$content</p></div></a>
EOT;
return trim($html);
	}


}

?>
