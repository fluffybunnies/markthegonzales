<?php

class PeThemeConstantImage {
	public $scale;
	public $align;
	public $fields;
	public $metabox;

	public function __construct() {
		$this->scale = 
			array(
				  __("FILL",'nietzsche')=>"fill",
				  __("FIT",'nietzsche')=>"fit"
				  );

		$this->align =
			array(
				  __("Top Left",'nietzsche')=>"top,left",
				  __("Top Center",'nietzsche')=>"top,center",
				  __("Top Right",'nietzsche')=>"top,right",
				  __("Center Left",'nietzsche')=>"center,left",
				  __("Center Center",'nietzsche')=>"center,center",
				  __("Center Right",'nietzsche')=>"center,right",
				  __("Bottom Left",'nietzsche')=>"bottom,left",
				  __("Bottom Center",'nietzsche')=>"bottom,center",
				  __("Bottom Right",'nietzsche')=>"bottom,right",
				  );

		$this->fields = new stdClass();

		$this->fields->scale = 
			array(
				  "label"=>__("Scale Mode",'nietzsche'),
				  "type"=>"RadioUI",
				  "section"=>__("General",'nietzsche'),
				  "description" => __("This setting determins how the images are scaled / cropped when displayed in the browser window.\"<strong>Fit</strong>\" fits the whole image into the browser ignoring surrounding space.\"<strong>Fill</strong>\" fills the whole browser area by cropping the image if necessary",'nietzsche'),
				  "options" => $this->scale,
				  "default"=>"fill"
				  );

		$this->fields->align = 							  
			array(
				  "label"=>__("Image Alignment",'nietzsche'),
				  "type"=>"Select",
				  "section"=>__("General",'nietzsche'),
				  "description" => __("Specify the alignment to be used in the event of the image being cropped. Use this to ensure that important parts of the image can be always seen.",'nietzsche'),
				  "options" => $this->align,
				  "default"=>"center,center"
				  );

		$this->metabox = 
			array(
				  "type" =>"",
				  "title" =>__("Image Options",'nietzsche'),
				  "where" => 
				  array(
						"post" => "image,video",
						"page" => "all"
						/*
						  format: "taxonomy" => "value1,value2"
						 */
						),
				  "content"=>
				  array(
						"scale" => $this->fields->scale,
						"align" => $this->fields->align
						)
				  );

		$this->metaboxScale = 
			array(
				  "type" =>"",
				  "title" =>__("Image Options",'nietzsche'),
				  "where" => 
				  array(
						"post" => "image",
						),
				  "content"=>
				  array(
						"scale" => $this->fields->scale
						)
				  );
	}
	
}

?>