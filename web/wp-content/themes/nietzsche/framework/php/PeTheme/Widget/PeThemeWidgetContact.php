<?php

class PeThemeWidgetContact extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Contact",'nietzsche');
		$this->description = __("Contact Info",'nietzsche');
		$this->wclass = "widget_contact";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget Title.",'nietzsche'),
									"default"=>__("Contact Info",'nietzsche')
									),
							  "info" => 
							  array(
									"label"=>__("Details",'nietzsche'),
									"type"=>"Items",
									"section"=>__("Header",'nietzsche'),
									"description" => __("Add one or more contact info to the widget.",'nietzsche'),
									"button_label" => __("Add New Contact Info",'nietzsche'),
									"sortable" => true,
									"auto" => "icon-info-circled",
									"unique" => false,
									"editable" => false,
									"legend" => false,
									"fields" => 
									array(
										  array(
												"label" => __("Icon",'nietzsche'),
												"name" => "icon",
												"type" => "icon",
												"width" => 100,
												"default" => "icon-bookmarks"
												),
										  array(
												"name" => "content",
												"type" => "textarea",
												"width" => 190,
												"height" => 60,
												"default" => "Mon-Fri: 9:00-18:00"
												)
										  ),
									"default" => ""
									)
							  
							  );

		parent::__construct();
	}

	public function getContent(&$instance) {
		$t =& peTheme();
		$t->template->data((object) $instance);
		$t->get_template_part("widget","contact");
	}


}
?>
