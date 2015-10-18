<?php

class PeThemeConstantSidebar {
	public $all;
	public $fields;
	public $metabox;

	public function __construct() {
		$this->all = array_merge(peTheme()->sidebar->option());

		$this->fields = new stdClass();

		$this->fields->sidebar = 
			array(
				  "label"=>__("Sidebar",'nietzsche'),
				  "type"=>"SelectPlain",
				  "section"=>__("General",'nietzsche'),
				  "description" => __("Select which sidebar to use",'nietzsche'),
				  "options" => $this->all,
				  "default"=>"default"
				  );


		$this->metabox = 
			array(
				  "type" =>"Plain",
				  "title" =>__("Sidebar",'nietzsche'),
				  "context" => "side",
				  "priority" => "core",
				  "where" => 
				  array(
						"post" => "all"
						),
				  "content"=>
				  array(
						"value" => $this->fields->sidebar
						)
				  );
		
		$this->metaboxFooter = 
			array(
				  "title" => __("Footer",'nietzsche')
				  );

		$this->metaboxFooter = array_merge($this->metabox,$this->metaboxFooter);
		$this->metaboxFooter["content"]["value"]["options"] = peTheme()->sidebar->option();
		$this->metaboxFooter["content"]["value"]["default"] = "footer";

	}
	
}

?>