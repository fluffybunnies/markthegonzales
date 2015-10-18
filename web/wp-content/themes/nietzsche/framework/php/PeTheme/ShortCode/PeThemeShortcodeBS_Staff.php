<?php

class PeThemeShortcodeBS_Staff extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "staff";
		$this->group = __("LAYOUT",'nietzsche');
		$this->name = __("Staff",'nietzsche');
		$this->description = __("Add a staff block",'nietzsche');
		$this->fields = array(
							  "layout"=> 
							  array(
									"label" => __("Layout",'nietzsche'),
									"type" => "Select",
									"description" => __("Select position of main image.",'nietzsche'),
									"options" => 
									array(
										  __("Left",'nietzsche') => "left",
										  __("Right",'nietzsche') => "right"
										  ),
									"default" => "left"
									),
							  "image" => 
							  array(
									"label"=>__("Image",'nietzsche'),
									"type"=>"Upload",
									"description" => __("Upload the large image. 400x320px aprox. ",'nietzsche')
									),
							  "thumb" => 
							  array(
									"label"=>__("Thumbnail",'nietzsche'),
									"type"=>"Upload",
									"description" => __("Upload the small Image. 110x130px aprox. Leave this field blank if no small images is required.",'nietzsche')
									),
							  "content" => 
							  array(
									"label"=>__("Content",'nietzsche'),
									"type"=>"TextArea",
									"description" => __("Description content. Simple HTML tags and buttons are supported.",'nietzsche'),
									"default" => sprintf('<h3>Full Name <span>Position</span></h3>%s<p>Description</p>',"\n")
									)
							  );
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		$t =& peTheme();
		$content = isset($content) ? sprintf('<div class="span7"><div class="innerSpacer">
			<div class="content">%s</div>
		</div></div>',$this->parseContent($content)) : "";
		
		$thumb = isset($thumb) ? sprintf('<div class="thumb">%s</div>',$t->image->resizedImg($thumb,110,130)) : "";
		$image = isset($image) ? sprintf('<div class="span5 clearfix"><div class="image">%s</div>%s</div>',$t->image->resizedImg($image,420,300),$thumb) : "";

		$content = isset($layout) && $layout == "left" ? "$image $content" : "$content $image";

		$html =<<<EOL
<div class="row-fluid">
    <div class="span12">
        <div class="staff clearfix $layout"><div class="row-fluid">$content</div></div>
    </div>
</div>
EOL;
        return trim($html);
	}


}

?>
