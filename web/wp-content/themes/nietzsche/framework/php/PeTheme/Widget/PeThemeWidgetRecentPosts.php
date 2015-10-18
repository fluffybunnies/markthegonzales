<?php

class PeThemeWidgetRecentPosts extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Recent posts",'nietzsche');
		$this->description = __("The most recent posts on your site",'nietzsche');
		$this->wclass = "pe_widget widget_recent_entries";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget title",'nietzsche'),
									"default"=>"Recent Posts"
									),
							  "link" => 
							  array(
									"label"=>__("Blog Link",'nietzsche'),
									"type"=>"Text",
									"description" => __("Blog link text. If empty, no link will be shown.",'nietzsche'),
									"default"=>"Visit The Blog"
									),
							  "url" => 
							  array(
									"label"=>__("Blog Link Url",'nietzsche'),
									"type"=>"Text",
									"description" => __("Blog url. If empty, theme will try to autodetect.",'nietzsche'),
									"default"=>""
									),
							  "count" => 
							  array(
									"label"=>__("Number Of Posts",'nietzsche'),
									"type"=>"RadioUI",
									"description" => __("Select the number of recent posts to show in this widget.",'nietzsche'),
									"single" => true,
									"options" => range(1,10),
									"default"=>2
									),
							  "chars" => 
							  array(
									"label"=>__("Excerpt Length",'nietzsche'),
									"type"=>"Text",
									"description" => __("Excerpt lenght in characters. This number is then rounded so as not to cut a word.",'nietzsche'),
									"default"=>130
									)
							 
							  );
		

		parent::__construct();
	}

	public function getContent(&$instance) {
		$t =& peTheme();
		$t->template->data((object) $instance);
		$loop = $t->content->customLoop("post",empty($instance["count"]) ? 1 : intval($instance["count"]));
		$t->get_template_part("widget","recentposts");
		if ($loop) {
			$t->content->resetLoop();
		}

	}


}
?>
