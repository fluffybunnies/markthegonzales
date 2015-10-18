<?php

class PeThemeViewLayoutModuleTabsItemContainer extends PeThemeViewLayoutModuleContainer {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Tab",'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
				  "title" =>
				  array(
						"label" => __("Title",'nietzsche'),
						"type" => "Text",
						"description" => __("Item Title.",'nietzsche'),
						"default" => __("Title",'nietzsche')
						)
				  );
		
	}

	public function type() {
		return "Tabs";
	}

	public function cssClass() {
		return "custom";
	}
	
	public function group() {
		return "tabs";
	}

	public function tooltip() {
		return __("Use this block to add more complex content to your tabbed item. This block basically acts as a container into which further blocks may be inserted.",'nietzsche');
	}

}

?>
