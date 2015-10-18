<?php

class PeThemeViewLayoutModuleServices extends PeThemeViewLayoutModule {

	public $loop = false;

	public function name() {
		return __("Services",'nietzsche');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Services",'nietzsche')
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
						"default" => __("Our Services",'nietzsche')
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
						"label"=>__("Services",'nietzsche'),
						"type"=>"Links",
						"description" => __("Add one or more service. If none selected, all available services will be shown.",'nietzsche'),
						"options" => peTheme()->service->option(),
						"sortable" => true,
						"default"=>""
						)
				  );
		
	}

	public function blockClass() {
		return "";
	}

	public function postType() {
		return "service";
	}

	public function templateName() {
		return "services";
	}

	public function setTemplateData() {

		$t =& peTheme();

		$id = false;

		$settings = 
			array(
				  "post_type" => $this->postType(),
				  );

		if (!empty($this->data->id)) {
			$id = $this->data->id;

			if (!is_array($id)) {
				$id = array($id);
			}

			$settings["id"] = $id;
		}

		$this->loop = $t->data->customLoop((object) $settings);
		$t->template->data($this->data);
	}


	public function template() {
		if ($this->loop) {
			$t =& peTheme();
			$t->get_template_part("viewmodule",$this->templateName());
			$t->content->resetLoop();
		}
	}

	public function tooltip() {
		return __("Use this block to add a services module to your layout, service items are created separately.",'nietzsche');
	}


}

?>
