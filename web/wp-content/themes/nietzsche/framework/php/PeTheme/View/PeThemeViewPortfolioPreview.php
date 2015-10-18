<?php

class PeThemeViewPortfolioPreview extends PeThemeViewBlog {

	public function name() {
		return __("Portfolio Preview",'nietzsche');
	}
	
	public function short() {
		return __("Portfolio",'nietzsche');
	}

	public function type() {
		return __("Portfolio",'nietzsche');
	}

	public function mbox() {
		$mbox = parent::mbox();
		
		$mbox["content"] = 
			array(
				  "filterable" => 
				  array(
						"label"=>__("Filter by",'nietzsche'),
						"type"=>"Select",
						"description" => __("Show filters based on the selected criteria.",'nietzsche'),
						"options" => peTheme()->view->taxonomiesOptions(),
						"datatype" => "taxonomies",
						"default"=>""
						),
				  "lightbox" => 
				  array(
						"label"=>__("Use Lightbox",'nietzsche'),
						"type"=>"RadioUI",
						"description" => __("If set to 'yes', clicking on image thumbnail will open a lightbox window, 'no' will go directly to the item page.",'nietzsche'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"yes"
						),
				  "layout" =>
				  array(
						"label"=>__("Layout",'nietzsche'),
						"description" => __("Grid container layout.",'nietzsche'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Boxed",'nietzsche')=>"boxed",
							  __("Full Width",'nietzsche') => "fullwidth"
							  ),
						"default"=>"boxed"
						),				  
				  "width" =>
				  array(
						"label"=>__("Cell Width",'nietzsche'),
						"type"=>"Number",
						"description" => __("Grid cell width.",'nietzsche'),
						"default"=>320
						),
				  "height" =>
				  array(
						"label"=>__("Cell Height",'nietzsche'),
						"type"=>"Number",
						"description" => __("Grid cell height.",'nietzsche'),
						"default"=>240
						),
				  "clayout" =>
				  array(
						"label"=>__("Cell Layout",'nietzsche'),
						"description" => __("<b>Fixed</b>: all grid cell will have the same width/height.<br><b>Variable</b>: will use the cell layout defined in the project portfolio settings.",'nietzsche'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Fixed",'nietzsche') => "fixed",
							  __("Variable",'nietzsche')=>"variable",
							  ),
						"default"=>"variable"
						),
				  "gx" =>
				  array(
						"label"=>__("Horizontal Margin",'nietzsche'),
						"type"=>"Number",
						"description" => __("Horizontal margin between grid cells.",'nietzsche'),
						"default"=>1
						),
				  "gy" =>
				  array(
						"label"=>__("Vertical Margin",'nietzsche'),
						"type"=>"Number",
						"description" => __("Vertical margin between grid cells.",'nietzsche'),
						"default"=>1
						),
				  "sort" =>
				  array(
						"label"=>__("Sorting",'nietzsche'),
						"type"=>"RadioUI",
						"description" => __("'none' will preserve items natural order which is what you want when all grid cell have the same width/height. 'optimize layout' should only be used when mixing cells with different layouts.",'nietzsche'),
						"options" => 
						array(
							  __("none",'nietzsche') =>"none",
							  __("auto",'nietzsche') =>"auto"
							  ),
						"default"=>"none"
						),
				  "pager" => 
				  array(
						"label"=>__("Paged Result",'nietzsche'),
						"type"=>"RadioUI",
						"description" => __("Display a pager when more posts are found than specified in the 'Maximum' field. ",'nietzsche'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						),
				  "loadMore" => 
				  array(
						"label"=>__("Load More",'nietzsche'),
						"type"=>"RadioUI",
						"description" => __("When 'Paged Result' is active (and a value is set in the 'Maximum' field), enabling this option will replace the pager element with a single 'Load More' button. Once clicked, it will load new items in the background and add them to the current page.",'nietzsche'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						)
				  );

		return $mbox;	
	}

	public function template($type = "") {
		if ($type != "empty") {
			peTheme()->get_template_part("view","portfolio-preview");
		}
	}
}

?>
