<?php

class PeThemeWidgetTabs extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Tabs",'nietzsche');
		$this->description = __("Tabbed content",'nietzsche');
		$this->wclass = "widget_tabs";
		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget title",'nietzsche'),
									"default"=>"Tabs Widget"
									),
							  "tab1head" => 
							  array(
									"label"=>__("Tab 1 Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Enter the tab title here",'nietzsche'),
									"sortable" => true,
									"default"=>"Tab 1"
									),
							  "tab1body" => 
							  array(
									"label"=>__("Tab 1 Content",'nietzsche'),
									"type"=>"TextArea",
									"description" => __("Enter the tab body content here",'nietzsche'),
									"sortable" => true,
									"default"=>"Content 1"
									),
							  "tab2head" => 
							  array(
									"label"=>__("Tab 2 Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Enter the tab title here",'nietzsche'),
									"sortable" => true,
									"default"=>"Tab 2"
									),
							  "tab2body" => 
							  array(
									"label"=>__("Tab 2 Content",'nietzsche'),
									"type"=>"TextArea",
									"description" => __("Enter the tab body content here",'nietzsche'),
									"sortable" => true,
									"default"=>"Content 2"
									),
							  "tab3head" => 
							  array(
									"label"=>__("Tab 3 Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Enter the tab title here",'nietzsche'),
									"sortable" => true,
									"default"=>""
									),
							  "tab3body" => 
							  array(
									"label"=>__("Tab 3 Content",'nietzsche'),
									"type"=>"TextArea",
									"description" => __("Enter the tab body content here",'nietzsche'),
									"sortable" => true,
									"default"=>""
									)
							 
							  );

		parent::__construct();
	}

	public function widget($args,$instance) {
		$wid = $args["widget_id"];
		$instance = $this->clean($instance);
		extract($instance);
		$html = $args["before_widget"];
		if (!isset($tab1head)) {
			$html .= $args["after_widget"];
			esc__pe($html);
			return;
		}
		$html .= isset($title) ? "<h3>$title</h3>" : "";
		$html .= '<ul class="nav nav-tabs">';
		$heads = array($tab1head,$tab2head,$tab3head);
		$bodies = array($tab1body,$tab2body,$tab3body);		
		$count = 0;
	    foreach ($heads as $head) {
			$count++;
			if (!$head) {
				continue;
			}
			$html .= sprintf('<li class="%s"><a href="#%s" data-toggle="tab">%s</a></li>',$count == 1 ? "active" : "","tab$wid-$count",$head);
		}
		$html .= '</ul>';
		$html .= '<div class="tab-content">';
		$count = 0;
	    foreach ($bodies as $body) {
			$count++;
			$html .= sprintf('<div class="tab-pane %s" id="%s"><p>%s</p></div>',$count == 1 ? "active" : "","tab$wid-$count",$body);
		}
		$html .= "</div>";
		$html .= $args["after_widget"];
		esc__pe($html);
	}


}
?>
