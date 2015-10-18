<?php

class PeThemeConstantBackground {
	public $fields;
	public $options;
	public $metabox;

	public function __construct() {

		$this->fields = new stdClass();

		$this->fields->image = 							  
			array(
				  "label"=>__("Image",'nietzsche'),
				  "type"=>"Upload",
				  "description" => __("Select a background image.",'nietzsche'),
				  "default"=>""
				  );

		$this->metabox = 
			array(
				  "type" =>"Background",
				  "title" =>__("Background",'nietzsche'),
				  "where" => 
				  array(
						"post" => "all",
						"page" => "all"
						/*
						  format: "taxonomy" => "value1,value2"
						 */
						),
				  "content"=>
				  array(
						"type" => 
						array(
							  "label"=>__("Background",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __("This option controls the backgrounds type.<br/><span><strong>Default</strong> uses global setting (defined in theme options).<br/></span><strong>Custom</strong> means use custom settings and <br/><strong>None</strong> disables the custom background component.",'nietzsche'),
							  //"options" => Array(__("Default",'nietzsche')=>"default",__("Color",'nietzsche')=>"color",__("Black&White",'nietzsche')=>"bw",__("None",'nietzsche')=>"none"),
							  "options" => Array(__("Default",'nietzsche')=>"default",__("Custom",'nietzsche')=>"color",__("None",'nietzsche')=>"none"),
							  "default"=>"default"
							  ),
						"resource" => 
						array(
							  "label"=>__("Type",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __("<strong>Image</strong> means you can select a static image,<br/><strong>Slider</strong> means a background image will be set according to the current slide as shown in the first slider of that page,<br/><strong>Gallery</strong> means a slideshow is displayed of a selected gallery's images.<br/>These may be overwritten on a page by page basis by setting different background options in specific pages.",'nietzsche'),
							  "options" => 
							  array(
									__("Image",'nietzsche') => "image",
									__("Slider",'nietzsche') => "slider",
									__("Gallery",'nietzsche') => "gallery"
),
							  "default"=>"image"
							  ),
						"image" => $this->fields->image,
						"gallery" => PeGlobal::$const->gallery->id,
						"mobile" => 
						array(
							  "label"=>__("Mobile",'nietzsche'),
							  "type"=>"Upload",
							  "description" => __("Static image for mobile.",'nietzsche'),
							  "default"=>""
							  ),
						"overlay" => 
						array(
							  "label"=>__("Overlay",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __("This option allows a tiled pattern overlay to be applied to the background.",'nietzsche'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"overlayImage" =>
						array(
							  "label"=>__("Pattern",'nietzsche'),
							  "type"=>"Upload",
							  "description" => __("Select a background pattern tile.",'nietzsche'),
							  "default"=> PE_THEME_URL."/img/skin/pat.png"
							  )
						)
				  );

		foreach ($this->metabox["content"] as $key => $value) {
			$value["section"] = __("Background",'nietzsche');
			if ($key == "type") {
				//unset($value["options"][__("Default",'nietzsche')]);
				$value["options"] = Array(__("Enabled",'nietzsche')=>"color",__("Disabled",'nietzsche')=>"none");
				$value["default"] = "none";
				$value["description"] = __("This option controls the default background.",'nietzsche');
					//preg_replace("/<span>.*<\/span>/","",$value["description"]);
			} 
			$this->options["background_".$key] = $value;
		}

	}
	
}

?>