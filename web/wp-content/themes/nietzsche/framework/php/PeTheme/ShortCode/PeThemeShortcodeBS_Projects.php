<?php

class PeThemeShortcodeBS_Projects extends PeThemeShortcode {

	public $instances = 0;
	public $count;
	public $custom;

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "projects";
		$this->group = __("CONTENT",'nietzsche');
		$this->name = __("Projects",'nietzsche');
		$this->description = __("Projects",'nietzsche');
		$this->fields = array(
							  "count" =>
							  array(
									"label" => __("Max Projects",'nietzsche'),
									"type" => "Text",
									"description" => __("Maximum number of projects to display.",'nietzsche'),
									"default" => 10,
									),
							  "tag" =>
							  array(
									"label" => __("Project Tag",'nietzsche'),
									"type" => "Select",
									"description" => __("Only display projects from a specific project tag.",'nietzsche'),
									"options" => array_merge(array(__("All",'nietzsche')=>""),peTheme()->data->getTaxOptions("prj-category")),
									"default" => ""
									)
							  );

	}

	
	public function output($atts,$content=null,$code="") {

		$defaults = apply_filters("pe_theme_shortcode_projects_defaults",array('count'=>3,'tag'=> ''),$atts);
		$conf = (object) shortcode_atts($defaults,$atts);

		$t =& peTheme();
		$content = "";

		if ($loop =& $t->project->customLoop($conf->count,$conf->tag,false)) {

			ob_start();
			$t->template->data($conf,$loop);
			$t->get_template_part("shortcode","projects");
			$content =& ob_get_clean();
			$t->content->resetLoop();

		}

		return $content;

	}


}

?>
