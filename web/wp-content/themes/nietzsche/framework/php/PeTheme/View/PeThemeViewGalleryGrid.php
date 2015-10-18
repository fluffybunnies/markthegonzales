<?php

class PeThemeViewGalleryGrid extends PeThemeViewGallery {


	public function name() {
		return __("Gallery - Grid (flare lightbox)",'nietzsche');

	}

	public function short() {
		return __("Images",'nietzsche');
	}

	public function mbox() {
		$mbox = parent::mbox();
		$content =& $mbox["content"];

		unset($content["max"]);

		$fields = 
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
				  "width" =>
				  array(
						"label"=>__("Thumbnail Width",'nietzsche'),
						"type"=>"Number",
						"description" => __("Image thumbnail width.",'nietzsche'),
						"default"=>""
						),
				  "height" =>
				  array(
						"label"=>__("Thumbnail Height",'nietzsche'),
						"type"=>"Number",
						"description" => __("Image thumbnail height, leave empty to avoid image cropping (masonry layout)",'nietzsche'),
						"default"=>192
						),
				  "gx" =>
				  array(
						"label"=>__("Horizontal Margin",'nietzsche'),
						"type"=>"Number",
						"description" => __("Horizontal margin between image thumbnails.",'nietzsche'),
						"default"=>4
						),
				  "gy" =>
				  array(
						"label"=>__("Vertical Margin",'nietzsche'),
						"type"=>"Number",
						"description" => __("Vertical margin between image thumbnails.",'nietzsche'),
						"default"=>4
						),
				  );

		$content = array_merge($fields,$content);

		return $mbox;	
	}

	public function template() {
		peTheme()->get_template_part("view","gallery-grid");
	}


   
}

?>
