<?php

class PeThemeShortcodeBS_Share extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "share";
		$this->group = __("UI",'nietzsche');
		$this->name = __("Share",'nietzsche');
		$this->description = __("Add a social share button",'nietzsche');
		$this->fields = array(
							  "type"=> 
							  array(
									"label" => __("Social Network",'nietzsche'),
									"type" => "Select",
									"description" => __("Select the social network on which to share content.",'nietzsche'),
									"options" => 
									array(
										  __("Facebook",'nietzsche') => "facebook",
										  __("Twitter",'nietzsche') => "twitter",
										  __("Google +1",'nietzsche') => "google",
										  __("Pinterest",'nietzsche') => "pinterest"
										  ),
									"default" => "facebook"
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$html = sprintf('<button class="share %s"></button>',$type);
        return trim($html);
	}


}

?>
