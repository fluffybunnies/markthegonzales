<?php

class PeThemeWidgetLogo extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Logo",'nietzsche');
		$this->description = __("Logo, info, social links",'nietzsche');
		$this->wclass = "widget_info";

		$content = <<<EOL
<p>15 Block 8/c, Hll Street,<br/>San Francisco, CA.</p>
<span class="phone">+353 (0) 123 456 78</span>
<a href="#">hello@emailaddress.com</a>
EOL;

$this->fields = array(
							  "logo" => 
							  array(
									"label"=>__("Logo/Image",'nietzsche'),
									"type"=>"Upload",
									"section"=>__("General",'nietzsche'),
									"description" => __("Logo/Image to be used as the widget title",'nietzsche'),
									"default"=> PE_THEME_URL."/img/skin/logo.png"
									),
							  "content" => 
							  array(
									"label"=>__("Statistics",'nietzsche'),
									"type"=>"TextArea",
									"description" => __("Info section",'nietzsche'),
									"default"=>$content
									),
							  "social" => 
							  array(
									"label"=>__("Social Profile Links",'nietzsche'),
									"type"=>"Items",
									"section"=>__("Header",'nietzsche'),
									"description" => __("Add one or more links to social networks.",'nietzsche'),
									"button_label" => __("Add Social Link",'nietzsche'),
									"sortable" => true,
									"auto" => __("Layer",'nietzsche'),
									"unique" => false,
									"editable" => false,
									"legend" => false,
									"fields" => 
									array(
										  array(
												"label" => __("Social Network",'nietzsche'),
												"name" => "icon",
												"type" => "select",
												"options" => apply_filters('pe_theme_social_icons',array()),
												"width" => 100,
												"default" => ""
												),
										  array(
												"name" => "url",
												"type" => "text",
												"width" => 190, 
												"default" => "#"
												)
										  ),
									"default" => ""
									)
							  
							  );

		parent::__construct();
	}

	public function getContent(&$instance) {
		$t =& peTheme();
		$t->template->data((object) $instance);
		$t->get_template_part("widget","logo");
	}


}
?>
