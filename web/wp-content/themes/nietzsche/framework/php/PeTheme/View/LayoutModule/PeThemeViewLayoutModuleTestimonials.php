<?php

class PeThemeViewLayoutModuleTestimonials extends PeThemeViewLayoutModuleServices {

	public function name() {
		return __("Testimonials",'nietzsche');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Testimonials",'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
				  "title" =>
				  array(
						"label" => __("Title",'nietzsche'),
						"type" => "Text",
						"description" => __("Section title, leave empty to hide.",'nietzsche'),
						"default" => __("What Others Are Saying",'nietzsche')
						),
				  "content" =>
				  array(
						"label" => __("Description",'nietzsche'),
						"type" => "Editor",
						"description" => __("Section description, leave empty to hide.",'nietzsche'),
						"default" => ""
						),
				  "id" => 
				  array(
						"label"=>__("Testimonials",'nietzsche'),
						"type"=>"Links",
						"description" => __("Add one or more testimonial. If none selected, all available testimonials will be shown.",'nietzsche'),
						"options" => peTheme()->testimonial->option(),
						"sortable" => true,
						"default"=>""
						)
				  );
		
	}

	public function postType() {
		return "testimonial";
	}

	public function blockClass() {
		return "";
	}

	public function templateName() {
		return "testimonials";
	}

	public function tooltip() {
		return __("Use this block to add a testimonial module to your layout, testimonial items are created separately.",'nietzsche');
	}

}

?>
