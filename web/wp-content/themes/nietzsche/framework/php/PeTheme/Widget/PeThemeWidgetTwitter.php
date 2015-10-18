<?php

class PeThemeWidgetTwitter extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Twitter",'nietzsche');
		$this->description = __("Displays the latest tweets",'nietzsche');
		$this->wclass = "widget_twitter";

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget title",'nietzsche'),
									"default"=>"Twitter"
									),
							  "username" => 
							  array(
									"label"=>__("Username",'nietzsche'),
									"type"=>"Text",
									"description" => __("Twitter username from which to load tweets",'nietzsche'),
									"default"=>"envato"
									),
							  "count" => 
							  array(
									"label"=>__("Number Of Tweets",'nietzsche'),
									"type"=>"RadioUI",
									"description" => __("Select the number of tweets to be displayed",'nietzsche'),
									"single" => true,
									"options" => range(1,10),
									"default"=>2
									),
							  
							  );

		parent::__construct();
	}

	public function getContent(&$instance) {
		extract($instance);
		$html = <<<EOL
<h3>$title <a class="followBtn" href="https://twitter.com/#!/$username"><span class="label">follow</span></a></h3>
<div class="twitter" data-topdate="false" data-count="$count" data-username="$username"></div>
EOL;


		return $html;
	}


}
?>
