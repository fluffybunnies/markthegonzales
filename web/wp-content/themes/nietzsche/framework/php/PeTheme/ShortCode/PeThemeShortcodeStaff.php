<?php

class PeThemeShortcodeStaff extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "staff";
		$this->group = __("CONTENT",'nietzsche');
		$this->name = __("Staff Member",'nietzsche');
		$this->description = __("Staff Member",'nietzsche');
		$this->fields = array(
							  "id" =>
							  array(
									"label" => __("Staff Member",'nietzsche'),
									"type" => "Select",
									"description" => __("Select staff member to show.",'nietzsche'),
									"options" => peTheme()->staff->option(),
									"default" => ""
									)
							  );

	}


	public function output($atts,$content=null,$code="") {

		$content =& peTheme()->content;
		
		if ($content->customLoop("staff",1,null,array("post__in" => array($atts["id"])))) {
			ob_start();
			while ($content->looping()) {
				get_template_part("shortcode","staff");
			}
			$html =& ob_get_contents();
			ob_end_clean();
			$content->resetLoop();
		} else {
			$html = "";
		}
		

		return $html;

	}


}

?>
