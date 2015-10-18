<?php

class PeThemeShortcodeWpml extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "lang";
		$this->group = __("CONTENT",'nietzsche');
		$this->name = __("WPML Language Block",'nietzsche');
		$this->description = __("WPML Language Block",'nietzsche');
		$langs = peTheme()->wpml->options();
		// drop "all" option
		array_shift($langs);
		$this->fields = array(
							  "code" => 
							  array(
									"label"=>__("Language",'nietzsche'),
									"description" => __("Only show content when language match the above selection.",'nietzsche'),
									"type"=>"RadioUI",
									"options" => $langs,
									"default"=>"en"
									),
							  "content" =>
							  array(
									"label" => __("Content",'nietzsche'),
									"type" => "Editor",
									"description" => __("Block content.",'nietzsche'),
									"default" => sprintf("%scontent%s","\n","\n")
									)
							  );

		peTheme()->shortcode->blockLevel[] = $this->trigger;

	}


	public function output($atts,$content=null,$code="") {
		extract(shortcode_atts(array('code'=> ''),$atts));
		if (empty($code)) {
			if (!empty($atts) && count($atts) > 0) {
				$code = $atts[0];
			}
		}

		$content = (!$code || ICL_LANGUAGE_CODE == $code) ? $this->parseContent($content) : "";

		
		return $content;

	}


}

?>
