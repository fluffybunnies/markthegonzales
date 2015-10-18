<?php

class PeThemeViewLayoutModuleStaff extends PeThemeViewLayoutModuleServices {

	public function name() {
		return __("Staff",'nietzsche');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Staff",'nietzsche')
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
						"default" => __("Meet the Team",'nietzsche')
						),
				  "content" =>
				  array(
						"label" => __("Description",'nietzsche'),
						"type" => "Editor",
						"description" => __("Section description, leave empty to hide.",'nietzsche'),
						"default" => ""
						),
				  "textpos" =>
				  array(
						"label" => __("Text Position",'nietzsche'),
						"description" => __("Text content position in regards to image.",'nietzsche'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Next the image",'nietzsche') => "right",
							  __("Below the image",'nietzsche') => "bottom"
							  ),
						"default"=> "bottom"
						),
				  "id" => 
				  array(
						"label"=>__("Staff",'nietzsche'),
						"type"=>"Links",
						"description" => __("Add one or more staff member.",'nietzsche'),
						"options" => peTheme()->staff->option(),
						"sortable" => true,
						"default"=>""
						)
				  );
		
	}

	public function postType() {
		return "staff";
	}

	public function blockClass() {
		return "";
	}

	public function templateName() {
		return "staff";
	}

	public function tooltip() {
		return __("Use this block to add a staff member profile to your layout. Additional info about the staff member may be input here but staff member profile images, position titles and social media links are created separately. ",'nietzsche');
	}

}

?>
