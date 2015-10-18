<?php

class PeThemeConstantPortfolio {
	public $metabox;

	public function __construct() {
		$this->metabox = 
			array(
				  "title" =>__("Portfolio",'nietzsche'),
				  "priority" => "core",
				  "where" => 
				  array(
						"page" => "page-portfolio",
						),
				  "content"=>
				  array(
						"columns" =>
						array(
							  "label"=>__("Columns",'nietzsche'),
							  "type"=>"Select",
							  "description" => __("Specify the layout arrangement of columns for the project items. ",'nietzsche'),
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
							  "label"=>__("Allow Filtering",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __("Specify if the project filter keywords are shown in this page. ",'nietzsche'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"count" =>
						array(
							  "label" => __("Max Project",'nietzsche'),
							  "type" => "Text",
							  "description" => __("Maximum number of project to show, leave empty for unlimited.",'nietzsche'),
							  "default" => "",
							  ),
						"pager" => 
						array(
							  "label"=>__("Paged Result",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __("Display a pager when more posts are found than specified in the 'Maximum' field. ",'nietzsche'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"no"
							  ),
						"id" => 
						array(
							  "label"=>__("Selection",'nietzsche'),
							  "type"=>"Links",
							  "description" => __("Using this control, you can manually pick individual projects to be included in the portfolio. If you also want projects to be shown in the same order as listed here, make sure no 'tag' is selected in the next field.",'nietzsche'),
							  "sortable" => true,
							  "options"=> peTheme()->project->option()
							  ),
						"tags" =>
						array(
							  "label" => __("Only Include Projects With The Following Tags",'nietzsche'),
							  "type" => "Tags",
							  "taxonomy" => "prj-category",
							  "description" => __("Only include projects in this page based on specific keywords/tags. ",'nietzsche'),
							  "default" => ""
							  ),
						)
				  );
	}
	
}

?>