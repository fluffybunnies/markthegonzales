<?php

class PeThemeViewLayoutModuleFeaturedProject extends PeThemeViewLayoutModuleServices {

	public function name() {
		return __("Featured Project",'nietzsche');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Featured",'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
				  "id" =>
				  array(
						"label"=>__("Project",'nietzsche'),
						"type"=>"Select",
						"description" => __("Select the featured project.",'nietzsche'),
						"options" => peTheme()->project->option(),
						"default"=>""
						)
				  );
		
	}

	public function postType() {
		return "project";
	}

	public function blockClass() {
		return "";
	}

	public function templateName() {
		return "featured";
	}

	public function tooltip() {
		return __("Use this block to add featured project section to your layout. This section accepts one project, the content of which is displayed in this full width block.",'nietzsche');
	}

}

?>
