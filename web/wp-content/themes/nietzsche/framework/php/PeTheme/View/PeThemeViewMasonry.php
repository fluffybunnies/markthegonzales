<?php

class PeThemeViewMasonry extends PeThemeViewBlog {

	public function name() {
		return __("Masonry",'nietzsche');
	}
	
	public function short() {
		return __("Masonry",'nietzsche');
	}

	public function type() {
		return __("Blog",'nietzsche');
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
				  "video" => 
				  array(
						"label"=>__("Inline Videos",'nietzsche'),
						"type"=>"RadioUI",
						"description" => __("If enabled, display a video player for video format posts.",'nietzsche'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						),
				  "slider" => 
				  array(
						"label"=>__("Inline Sliders",'nietzsche'),
						"type"=>"RadioUI",
						"description" => __("If enabled, display a slider for gallery format posts.",'nietzsche'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						),
				  "width" =>
				  array(
						"label"=>__("Column Width",'nietzsche'),
						"type"=>"Number",
						"description" => __("Grid cell width.",'nietzsche'),
						"default"=>320
						),
				  "height" =>
				  array(
						"label"=>__("Image Height",'nietzsche'),
						"type"=>"Number",
						"description" => __("Slider images height.",'nietzsche'),
						"default"=>180
						),
				  "crop" => 
				  array(
						"label"=>__("Crop Featured Image",'nietzsche'),
						"type"=>"RadioUI",
						"description" => __("When 'Image Height' is set, only slider images are cropped, set this option to 'yes' to also crop featured images.",'nietzsche'),
						"options" => PeGlobal::$const->data->yesno,
						"default"=>"no"
						),
				  "gx" =>
				  array(
						"label"=>__("Horizontal Margin",'nietzsche'),
						"type"=>"Number",
						"description" => __("Horizontal margin between grid cells.",'nietzsche'),
						"default"=>10
						),
				  "gy" =>
				  array(
						"label"=>__("Vertical Margin",'nietzsche'),
						"type"=>"Number",
						"description" => __("Vertical margin between grid cells.",'nietzsche'),
						"default"=>10
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
			peTheme()->get_template_part("view","masonry");
		}
	}
}

?>
