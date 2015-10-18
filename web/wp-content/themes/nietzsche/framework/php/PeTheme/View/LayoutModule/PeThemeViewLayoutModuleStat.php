<?php

class PeThemeViewLayoutModuleStat extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Stat",'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
				  "title" => 	
				  array(
						"label"=>__("Title",'nietzsche'),
						"type"=>"Text",
						"description" => __("Stat title.",'nietzsche'),
						"default"=>__("Title",'nietzsche')
						),
				  "image" => 	
				  array(
						"label"=>__("Image",'nietzsche'),
						"type"=>"upload",
						"description" => __("Stat image.",'nietzsche'),
						"default"=>"",
						),
				  "content" =>
				  array(
						"label" => "Content",
						"type" => "Editor",
						"description" => __("Stat content.",'nietzsche'),
						"default" => 'Lorem ipsum dolor sit amet.'
						)
				  );
		
	}

	public function name() {
		return __("Stat",'nietzsche');
	}

	public function type() {
		return "Custom";
	}
	
	public function cssClass() {
		return "custom";
	}

	public function group() {
		return "stat";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","stat");
	}

	public function tooltip() {
		return __("Use this block to add an additional stat column of data to the stats module.",'nietzsche');
	}


}

?>
