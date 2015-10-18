<?php

class PeThemeShortcodeLine extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "line";
		$this->group = __("DIVIDERS",'nietzsche');
		$this->name = __("Line",'nietzsche');
		$this->description = __("Add a line",'nietzsche');
		$this->fields = array(
							  "type" =>
							  array(
									"label" => __("Line Type",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the line type of the divider",'nietzsche'),
									"options" => 
									array(
										  __("Solid",'nietzsche') => "solid",
										  __("Dotted",'nietzsche') => "dotted"
										  )
									),
							  "top" =>
							  array(
									"label"=>__("Back to top link",'nietzsche'),
									"type"=>"RadioUI",
									"description" => __("Select whether the line will contain a button which allows the user to scroll back to the top of the page",'nietzsche'),
									"options" => Array(__("Yes",'nietzsche')=>"yes",__("No",'nietzsche')=>"no"),
									"default"=>"no"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		if (@$atts["top"] != "yes") {
			$html = <<< EOT
<div class="divider {$atts['type']} clearfix"><span></span></div>
EOT;
		} else {
			$top = __("top &uarr;",'nietzsche');
			$html = <<< EOT
	<div class="divider topBtn {$atts['type']} clearfix"><span></span><a href="#top" title="Go to top">$top</a></div>
EOT;
		}
		return trim($html);

	}



}

?>
