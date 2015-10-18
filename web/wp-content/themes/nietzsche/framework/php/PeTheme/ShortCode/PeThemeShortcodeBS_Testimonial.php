<?php

class PeThemeShortcodeBS_Testimonial extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "testimonial";
		$this->group = __("LAYOUT",'nietzsche');
		$this->name = __("Testimonial",'nietzsche');
		$this->description = __("Add a testimonial block",'nietzsche');
		$this->fields = array(
							  "content" => 
							  array(
									"label"=>__("Testimonial Content",'nietzsche'),
									"type"=>"TextArea",
									"description" => __("Block content HTML. The 'blockquote' tag contains the quoted content. The 'cite' tag contains the citation for the quoted content.",'nietzsche'),
									"default"=>sprintf('<blockquote>Text here</blockquote>%s<cite>citation</cite>',"\n")
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		$t =& peTheme();
		$content = isset($content) ? sprintf('<div class="content">%s</div>',$this->parseContent($content)) : "";
		$html =<<<EOL
<div class="row-fluid">
    <div class="span12">
        <div class="testimonial"><div class="speech"></div>$content</div>
    </div>
</div>
EOL;
        return trim($html);
	}


}

?>
