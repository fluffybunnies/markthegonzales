<?php

class PeThemeWidgetProject extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Projects",'nietzsche');
		$this->description = __("Show projects",'nietzsche');
		$this->wclass = "widget_portfolio widget_featured";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget title",'nietzsche'),
									"default"=> __("Featured Work",'nietzsche')
									),
							  "id" => 
							  array(
									"label"=>__("Project",'nietzsche'),
									"type"=>"Links",
									"description" => __("Add one or more projects.",'nietzsche'),
									"sortable" => true,
									"options"=> PeGlobal::$const->project->all
									)
							 
							  );

		parent::__construct();
	}

	public function &getContent(&$instance) {
		$html = "";

		$settings = shortcode_atts(array('title'=>'','id'=>array(),"template" => "widget-projects"),$instance);
		extract($settings);

		$settings = (object) $settings;

		if (isset($title)) {
			$html .= "<h3>$title</h3>";
		}

		// if no project manually added, just show last 2
		if (count($id) == 0) {
			$settings->count = 2;
		}

		$t =& peTheme();
		
		ob_start();
		$t->project->portfolio($settings);
		$html .= ob_get_clean();

		return $html;
	}



}
?>
