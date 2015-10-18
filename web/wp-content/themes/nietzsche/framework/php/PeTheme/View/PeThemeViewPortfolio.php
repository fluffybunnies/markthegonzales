<?php

class PeThemeViewPortfolio extends PeThemeViewBlog {

	public function name() {
		return __("Portfolio Columns",'nietzsche');
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
				  "layout" =>
				  array(
						"label"=>__("Layout",'nietzsche'),
						"type"=>"Select",
						"description" => __("Show filters based on the selected criteria.",'nietzsche'),
						"options" => apply_filters("pe_theme_portfolio_layouts",
												   array(
														 __("Single column (no grid)",'nietzsche')=>1,
														 __("2 Columns",'nietzsche')=>2,
														 __("3 Columns",'nietzsche')=>3,
														 __("4 Columns",'nietzsche')=>4,
														 __("6 Columns",'nietzsche')=>6
														 )),
						"default"=>apply_filters("pe_theme_portfolio_default_layout",3),
						),
				  "filterable" => 
				  array(
						"label"=>__("Filter by",'nietzsche'),
						"type"=>"Select",
						"description" => __("Specify if the filter keywords are shown in this page. ",'nietzsche'),
						"options" => peTheme()->view->taxonomiesOptions(),
						"datatype" => "taxonomies",
						"default"=>""
						),
				  "pager" => 
				  array(
						"label"=>__("Paged Result",'nietzsche'),
						"type"=>"RadioUI",
						"description" => __("Display a pager when more posts are found than specified in the 'Maximum' field. ",'nietzsche'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"yes"
						)
				  );

		return $mbox;	
	}

	public function template($type = "") {
		if ($type != "empty") {
			peTheme()->get_template_part("view","portfolio");
			//peTheme()->get_template_part("view","portfolio-masonary");
		}
	}
}

?>
