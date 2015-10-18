<?php

class PeThemeShortcodeBS_Icon extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "icon";
		$this->group = __("UI",'nietzsche');
		$this->name = __("Icon",'nietzsche');
		$this->description = __("Select the cion type to add. See the help documentation for a link to the list of available icons",'nietzsche');
		$this->fields = array(
							  "type"=> PeGlobal::$const->data->fields->icon,
							  "color" =>
							  array(
									"label" => __("Color",'nietzsche'),
									"description" => __("Select color of the icon",'nietzsche'),
									"type" => "Select",
									"options" =>
									array(
										  __("White",'nietzsche') => "white",
										  __("Black",'nietzsche') => "black"
										  ),
									"default" => "white"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$html = sprintf('<i class="%s icon-%s"></i>',$type,$color);
        return trim($html);
	}


}

?>
