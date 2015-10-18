<?php

class PeThemeViewLayoutModulePricingColumn extends PeThemeViewLayoutModule {

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
						"description" => __("Table title. ",'nietzsche'),
						"default"=>__("Package One",'nietzsche')
						),
				  "price" => 	
				  array(
						"label"=>__("Price Box",'nietzsche'),
						"type"=>"Editor",
						"description" => __("Price box content, can be html.",'nietzsche'),
						"default"=>__("<h4>$99</h4><span>PER MONTH</span>",'nietzsche')
						),
				  "features" => 
				  array(
						"section" => "main",
						"label"=> __("Features",'nietzsche'),
						"description" => __("Add one or more features",'nietzsche'),
						"type"=>"Items",
						"description" => "",
						"button_label" => __("Add New",'nietzsche'),
						"sortable" => true,
						"auto" => __("Feature %",'nietzsche'),
						"unique" => false,
						"editable" => false,
						"legend" => false,
						"fields" => 
						array(
							  array(
									"type" => "empty",
									"width" => "186"
									),
							  array(
									"name" => "content",
									"type" => "text",
									"width" => "500",
									"default" => ""
									)
							  ),
						"default" => array(
										   array("content"=>__("Feature 1",'nietzsche')),
										   array("content"=>__("Feature 2",'nietzsche')),
										   array("content"=>__("Feature 3",'nietzsche'))
										   )
						),
				  "button_label" => 	
				  array(
						"label"=>__("Button Label",'nietzsche'),
						"type"=>"Text",
						"default"=>__("Sign Up Now",'nietzsche')
						),
				  "button_link" => 	
				  array(
						"label"=>__("Button Link",'nietzsche'),
						"type"=>"Text",
						"default"=>"#"
						)
				  );
		
	}

	public function name() {
		return __("Pricing Column",'nietzsche');
	}

	public function type() {
		return "Custom";
	}
	
	public function cssClass() {
		return "custom";
	}

	public function group() {
		return "pricingcolumn";
	}


	public function template() {
		peTheme()->get_template_part("viewmodule","pricingcolumn");
	}

	public function tooltip() {
		return __("Use this block to add another column of data to your pricing table layout.",'nietzsche');
	}

}

?>
