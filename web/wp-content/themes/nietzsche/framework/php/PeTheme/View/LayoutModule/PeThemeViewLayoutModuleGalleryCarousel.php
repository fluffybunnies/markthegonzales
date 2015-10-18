<?php

class PeThemeViewLayoutModuleGalleryCarousel extends PeThemeViewLayoutModule {

	public function name() {
		return __("Carousel",'nietzsche');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Carousel",'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
				  "id" =>
				  array(
						"label" => __("Gallery",'nietzsche'),
						"description" => __("Select the gallery.",'nietzsche'),
						"type" => "Select",
						"options" => peTheme()->gallery->option(),
						"editable" => admin_url('post.php?post=%0&action=edit')
						),
				  "columns" =>
				  array(
						"label" => __("Columns",'nietzsche'),
						"description" => __("Number of columns to use for the layout.",'nietzsche'),
						"type" => "RadioUI",
						"options" => array("1" => 1,"2" => 2,"3" => 3,"4" => 4),
						"default" => 2
						),
				  "caption" =>
				  array(
						"label" => __("Show Caption",'nietzsche'),
						"description" => __("Whether to show title/description under the image/video or not.",'nietzsche'),
						"type" => "RadioUI",
						"options" => array(__("Yes",'nietzsche') => "yes", __("No",'nietzsche') => ""),
						"default" => ""
						)
				  );
		
	}

	public function blockClass() {
		return "";
	}

	public function templateName() {
		return "gallerycarousel";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule",$this->templateName());
	}

	public function tooltip() {
		return __("Use this block to show a gallery as a Carousel.",'nietzsche');
	}

}

?>
