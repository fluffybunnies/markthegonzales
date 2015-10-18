<?php

class PeThemeShortcodeBS_Divider extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "divider";
		$this->group = __("LAYOUT",'nietzsche');
		$this->name = __("Divider",'nietzsche');
		$this->description = __("Add a divider",'nietzsche');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Divider Type",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the type of divider required.",'nietzsche'),
									"options" => 
									array(
										  __("Solid",'nietzsche') => "solid",
										  __("Dotted",'nietzsche') => "dotted"
										  ),
									"default" => "solid"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$html =<<<EOL
<div class="row-fluid">
    <div class="span12">
        <div class="divider $type clearfix"><span></span></div>
    </div>
</div>
EOL;
        return trim($html);
	}


}

?>
