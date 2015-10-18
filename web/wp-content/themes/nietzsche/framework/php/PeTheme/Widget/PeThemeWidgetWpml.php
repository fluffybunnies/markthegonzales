<?php

class PeThemeWidgetWpml extends PeThemeWidget {

	public $is_wpml_conditional = true;

	public function __construct() {
		$this->name = __("WPML - Conditional",'nietzsche');
		$this->description = __("Show/Hide widgets according to language",'nietzsche');

		$this->fields = array(
							  "lang" => 
							  array(
									"label"=>__("Language",'nietzsche'),
									"description" => __("Only show subsequent widgets when language match the above selection.",'nietzsche'),
									"type"=>"RadioUI",
									"options" => peTheme()->wpml->options(),
									"default"=>""
									)
							  );

		parent::__construct();
	}

	public function &getContent(&$instance) {
		$html = "";
		return $html;
	}


}
?>
