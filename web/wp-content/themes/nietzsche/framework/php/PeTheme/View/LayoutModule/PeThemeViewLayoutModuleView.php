<?php

class PeThemeViewLayoutModuleView extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => __("View",'nietzsche'),
				  "type" => __("View",'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
				  "id" => 
				  array(
						"label" => __("View",'nietzsche'),
						"description" => __("Select the view to be shown.",'nietzsche'),
						"type" => "Select",
						"groups" => true,
						"options" => peTheme()->view->option(),
						"editable" => admin_url('post.php?post=%0&action=edit')
						),
				  "margin" =>
				  array(
						"label" => __("Margins",'nietzsche'),
						"description" => __("When set to <b>no</b>, content will have no bottom margin.",'nietzsche'),
						"type"=>"RadioUI",
						"options" => PeGlobal::$const->data->yesno,
						"default"=> "yes"
						),
				  "width" =>
				  array(
						"label"=>__("Media Width",'nietzsche'),
						"type"=>"Number",
						"description" => __("Leave empty to use default width.",'nietzsche'),
						"default"=> ""
						),
				  "height" =>
				  array(
						"label"=>__("Media Height",'nietzsche'),
						"type"=>"Number",
						"description" => __("Leave empty to avoid image cropping. In this case, slider based views will require all the (original) images to have the same size to work correctly.",'nietzsche'),
						"default"=> ""
						)
				  );
		
	}

	public function name() {
		return __("View",'nietzsche');
	}

	public function option() {
		return "View";
	}

	public function output($conf) {
		$settings = (object) $conf["data"];
		$fullwidth = false;

		$view =& peTheme()->view;
		if (!empty($settings->id)) {
			$vconf = $view->conf($settings->id);
			if (!empty($vconf->settings->layout)) {
				$fullwidth = $vconf->settings->layout === "fullwidth";
			}
		}
		printf('<div class="pe-block%s%s">',($settings->margin === "no") ? " nomargin" : "",$fullwidth ? " pe-block-fullwidth" : "");
		$view->resize($settings);
		print("</div>");
	}

	public function tooltip() {
		return __("Use this block to add a component to your layout. Components are usually made of complex dynamic media such as portfolio grids or carousels. These components are created separately.",'nietzsche');
	}

}

?>
