<?php

class PeThemeShortcodeInfo extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "info";
		$this->group = __("ALERTS",'nietzsche');
		$this->name = __("Info",'nietzsche');
		$this->description = __("Add info box",'nietzsche');
		$this->fields = array(
							  "content" =>
							  array(
									"label" => __("Alert Text",'nietzsche'),
									"type" => "Text",
									"description" => __("Enter the text content of the alert box",'nietzsche'),
									)
							  );
	}

	public function output($atts,$content=null,$code="") {		
		if ($content) {
			$content = $this->parseContent($content);
		}
		$html = <<< EOT
<div class="alert note"><span class="sprite">Alert</span><p>$content</p></div>
EOT;
return trim($html);
	}


}

?>
