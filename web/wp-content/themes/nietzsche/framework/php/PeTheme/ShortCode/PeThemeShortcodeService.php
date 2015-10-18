<?php

class PeThemeShortcodeService extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "service";
		$this->group = __("CONTENT",'nietzsche');
		$this->name = __("Service",'nietzsche');
		$this->description = __("Service",'nietzsche');
		$this->fields = array(
							  "id" =>
							  array(
									"label" => __("Service",'nietzsche'),
									"type" => "Select",
									"description" => __("Select a service to show.",'nietzsche'),
									"options" => peTheme()->service->option(),
									"default" => ""
									)
							  );

		// add block level cleaning
		peTheme()->shortcode->blockLevel[] = $this->trigger;

	}


	public function output($atts,$content=null,$code="") {
		
		$content =& peTheme()->content;

		if ($content->customLoop("service",1,null,array("post__in" => array($atts["id"])))) {
			ob_start();
			while ($content->looping()) {
				get_template_part("shortcode","service");
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
