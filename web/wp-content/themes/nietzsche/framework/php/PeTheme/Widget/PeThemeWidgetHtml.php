<?php

class PeThemeWidgetHtml extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Html",'nietzsche');
		$this->description = __("HTML Block",'nietzsche');

		$this->fields = array(
							  "content" => 
							  array(
									"label"=>__("HTML",'nietzsche'),
									"type"=>"Editor",
									"default"=>""
									)
							 
							  );

		parent::__construct();
	}

	public function &getContent(&$instance) {
		return $instance["content"];
	}


}
?>
