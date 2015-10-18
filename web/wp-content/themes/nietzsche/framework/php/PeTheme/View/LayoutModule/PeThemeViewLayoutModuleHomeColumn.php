<?php

class PeThemeViewLayoutModuleHomeColumn extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Column",'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
				  "title" => 	
				  array(
						"label"=>__("Title",'nietzsche'),
						"type"=>"Text",
						"description" => __("Column title.",'nietzsche'),
						"default"=>__("Title",'nietzsche')
						),
				  "icon" => 	
				  array(
						"label"=>__("Icon",'nietzsche'),
						"type"=>"Icon",
						"description" => __("Column icon.",'nietzsche'),
						"default"=>"icon-bookmarks",
						),
				  "content" =>
				  array(
						"label" => "Content",
						"type" => "Editor",
						"description" => __("Column content.",'nietzsche'),
						"default" => 'Lorem ipsum dolor sit amet, consect tu era dipis cing elit. Donec odio. Quisque volut pat mattiois eros. Nullam males ua da erat ut turp is. Suspen disse urna tus nibh, viverra nonet, semper susci pi , pos uere a, pede. Sed eget estas, ante ettuli vulputate volutpat, eros pede.'
						),
				  "label" =>
				  array(
						"label"=>__("Link Label",'nietzsche'),
						"type"=>"Text",
						"description" => __("Column link label, leave empty to hide.",'nietzsche'),
						"default"=>__("LEARN MORE",'nietzsche')
						),
				  "url" =>
				  array(
						"label"=>__("Link Url",'nietzsche'),
						"type"=>"Text",
						"description" => __("Column link url, leave empty to hide.",'nietzsche'),
						"default"=>"#"
						)
				  );
		
	}

	public function name() {
		return __("Home Column",'nietzsche');
	}

	public function type() {
		return "Custom";
	}
	
	public function cssClass() {
		return "custom";
	}

	public function group() {
		return "homecolumn";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","homecolumn");
	}

	public function tooltip() {
		return __("Use this block to add an additional column of data to the home column module.",'nietzsche');
	}


}

?>
