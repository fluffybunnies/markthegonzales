<?php

class PeThemeViewLayoutModuleTest extends PeThemeViewLayoutModule {

	public function registerAssets() {
		parent::registerAssets();
	}

	public function messages() {
		return
			array(
				  "title" => __("Content",'nietzsche'),
				  "type" => __("Test",'nietzsche')
				  );
	}

	public function fields() {

		$description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

		return
			array(
				  "radioui" => 
				  array(
						"label" => __("Radio UI Field",'nietzsche'),
						"type" => "RadioUI",
						"options" => array("one" => 1,"two" => 2 ,"three" => 3,'blah blah' => 4,'Longer Text Here' => 5),
						"description" => $description,
						"default" => 1
						),
				  "checkboxui" => 
				  array(
						"label" => __("Checkbox UI Field",'nietzsche'),
						"type" => "CheckboxUI",
						"options" => array("one" => 1,"two" => 2 ,"three" => 3),
						"description" => $description,
						"default" => 1
						),
				  "select" =>
				  array(
						"label" => __("Select",'nietzsche'),
						"type" => "Select",
						"options" => array("one" => 1,"two" => 2 ,"three" => 3,'blah blah' => 4,'Longer Text Here' => 5),
						"description" => $description,
						"default" => 1
						),
				  "links" =>
				  array(
						"label" => __("Links Field",'nietzsche'),
						"type" => "Links",
						"sortable" => true,
						"options" => array("one" => 1,"two" => 2 ,"three" => 3),
						"description" => $description,
						"default" => 1
						),
				  "color" =>
				  array(
						"label" => __("Color Field",'nietzsche'),
						"type" => "Color",
						"description" => $description,
						"default" => '#ff0000'
						),
				  "image" => 
				  array(
						"label" => __("Image Field",'nietzsche'),
						"type" => "Upload",
						"description" => $description,
						),
				  "editor" =>
				  array(
						"label" => __("Editor",'nietzsche'),
						"type" => "Editor",
						"noscript" => true,
						"description" => __("Content",'nietzsche'),
						"default" => ""
						),
				  "text" =>
				  array(
						"label" => __("Text",'nietzsche'),
						"type" => "Text",
						"description" => __("Content",'nietzsche'),
						"default" => ""
						)
				  );
	}

	public function name() {
		return __("Test",'nietzsche');
	}

	public function option() {
		return "Test";
	}

	public function output($conf) {
	}

	public function tooltip() {
		return __("A test block",'nietzsche');
	}

}

?>
