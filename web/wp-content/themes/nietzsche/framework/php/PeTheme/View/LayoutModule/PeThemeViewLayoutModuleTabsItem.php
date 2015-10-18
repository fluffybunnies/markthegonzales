<?php

class PeThemeViewLayoutModuleTabsItem extends PeThemeViewLayoutModule {

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
						),
				  "content" =>
				  array(
						"label" => __("Content",'nietzsche'),
						"type" => "Editor",
						"description" => __("Item text content.",'nietzsche'),
						"default" => __("Content",'nietzsche')
						)
				  );
		
	}

	public function name() {
		return __("Text",'nietzsche');
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

	public function template() {
		esc__pe($this->data->content);
	}

	public function tooltip() {
		return __("Use this block to add an additional tab to your tabbed content module.",'nietzsche');
	}

}

?>
