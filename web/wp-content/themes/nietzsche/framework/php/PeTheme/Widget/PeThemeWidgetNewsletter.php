<?php

class PeThemeWidgetNewsletter extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Newsletter",'nietzsche');
		$this->description = __("Newsletter subscribe form",'nietzsche');
		$this->wclass = "widget_newsletter";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget title",'nietzsche'),
									"default"=>"Newsletter"
									),
							  "subscribe" => 
							  array(
									"label"=>__("Subscribe Address",'nietzsche'),
									"type"=>"Text",
									"description" => __("The email address to which subscribers details are sent.",'nietzsche'),
									"default"=>"newsletter@yourdomain.com"
									),
							  "top" => 
							  array(
									"label"=>__("Intro Text",'nietzsche'),
									"type"=>"TextArea",
									"description" => __("Text content located before the subscribe field",'nietzsche'),
									"default"=>"Lorem ipsum dolor sit amet, consec tetue adipiscing elit. Donec odio. Quis que vol utpat mattis eros. Nullam mal."
									),
							  "bottom" => 
							  array(
									"label"=>__("Outro Text",'nietzsche'),
									"type"=>"TextArea",
									"description" => __("Text content located after the subscribe field",'nietzsche'),
									"default"=>"Don't worry, your details are safe with us. For more info. read our <a href=\"#\">privacy policy</a>"
									)
							  
							  );

		parent::__construct();
	}

	public function widget($args,$instance) {
		$wid = $args["widget_id"];
		$instance = $this->clean($instance);
		extract($instance);

		$html = "";
		if (isset($title)) $html .= "<h3>$title</h3>";
		if (isset($top)) $html .= "<p>$top</p>";

		$html .= <<<EOL
<form class="form-inline newsletter" id="newsletterform" method="get" data-subscribed="Thank You" data-instance="$wid">
    <div class="control-group">
        <div class="input-append">
            <input type="text" name="email" class="input-medium span2"  placeholder="Newsletter.."/>
            <button class="btn" type="submit">Signup</button>
        </div>
    </div>
</form>
EOL;

		if (isset($bottom)) $html .= "<p class=\"outro\">$bottom</p>";
		
		esc__pe($args["before_widget"]);
		esc__pe($html);
		esc__pe($args["after_widget"]);
	}


}
?>
