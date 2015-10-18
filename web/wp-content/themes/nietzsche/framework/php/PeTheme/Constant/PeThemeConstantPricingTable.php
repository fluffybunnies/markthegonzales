<?php

class PeThemeConstantPricingTable {
	public $all;
	public $fields;
	public $metabox;

	public function __construct() {
		$this->all = peTheme()->ptable->option();

		$this->metabox = 
			array(
				  "title" => __("Table Properties",'nietzsche'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"ptable" => "all"
						),
				  "content" =>
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
							  "type"=>"TextArea",
							  "description" => __("Price box content, can be html.",'nietzsche'),
							  "default"=>__("<h2><span>$199</span> Plus monthly free</h2>",'nietzsche')
							  ),
						"features" => 
						array(
							  "label"=>__("Features",'nietzsche'),
							  "type"=>"Links",
							  "description" => __("Add one or more features.",'nietzsche'),
							  "sortable" => true,
							  "unique" => false,
							  "default"=>array(__("Feature 1",'nietzsche'),__("Feature 2",'nietzsche'),__("Feature 3",'nietzsche'))
							  ),
						"button_label" => 	
						array(
							  "label"=>__("Button Label",'nietzsche'),
							  "type"=>"Text",
							  "default"=>__("Sign Up",'nietzsche')
							  ),
						"button_link" => 	
						array(
							  "label"=>__("Button Link",'nietzsche'),
							  "type"=>"Text",
							  "default"=>"#"
							  )
						)
				  
				  );

		$this->metaboxGroup =
			array(
				  "type" =>"",
				  "title" =>__("Pricing Tables",'nietzsche'),
				  "priority" => "core",
				  "where" => 
				  array(
						"page" => "page-pricing_table",
						),
				  "content"=>
				  array(
						"items" => 
						array(
							  "label"=>__("Tables",'nietzsche'),
							  "type"=>"Links",
							  "description" => __("Add one or more pricing tables.",'nietzsche'),
							  "sortable" => true,
							  "options"=> $this->all
							  ),
						"labels" =>				
						array(
							  "label"=>__("Show Labels",'nietzsche'),
							  "type"=>"RadioUI",
							  "description"=>__('If set to "YES", the first table will be used to show property labels.','nietzsche'),
							  "options" => Array(__("Yes",'nietzsche')=>"yes",__("No",'nietzsche')=>"no"),
							  "default"=>"no"
							  ),
						"starter" => 
						array(
							  "label"=>__("Starter",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __('Which table should be highlighted as "Starter" pack, "1" = highlight first table.','nietzsche'),
							  "options" => 
							  array(
									__("None",'nietzsche') => 0,
									"1" => 1,
									"2" => 2,
									"3" => 3,
									"4" => 4,
									"5" => 5,
									),
							  "default"=> 0
							  ),
						"popular" => 
						array(
							  "label"=>__("Popular",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __('Which table should be highlighted as "Popular" pack, "1" = highlight first table.','nietzsche'),
							  "options" => range(1,5),
							  "single" => true,
							  "default"=> 2
							  )
						)
				  
				  );

		

	}
	
}

?>