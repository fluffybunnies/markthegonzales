<?php

class PeThemeShortcodeClearfix extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "clear";
		$this->group = __("LAYOUT",'nietzsche');
		$this->name = __("Clear",'nietzsche');
		$this->description = __("Description",'nietzsche');
	}

	public function output($atts,$content=null,$code="") {		
		$html = <<< EOT
<div class="clearfix"></div>
EOT;
return trim($html);
	}


}

?>
