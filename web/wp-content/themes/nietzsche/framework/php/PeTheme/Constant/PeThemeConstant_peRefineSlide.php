<?php

class PeThemeConstant_peRefineSlide {
	public $options;

	public function __construct() {
		$this->options = 
			array(
				  "transition" =>
				  array(
						"label"=>__("Transition",'nietzsche'),
						"type"=>"Select",
						"description" => __("Transition type",'nietzsche'),
						"options" => 
						array(
							  __("Random",'nietzsche') => "random",
							  __("Cube Horizontal",'nietzsche') => "cubeH",
							  __("Cube Vertical",'nietzsche') => "cubeV",
							  __("Fade",'nietzsche') => "fade",
							  __("Slice Horizontal",'nietzsche') => "sliceH",
							  __("Slice Vertical",'nietzsche') => "sliceV",
							  __("Slide Horizontal",'nietzsche') => "slideH",
							  __("Slide Vertical",'nietzsche') => "slideV",
							  __("Scale",'nietzsche') => "scale",
							  __("Block scale",'nietzsche') => "blockScale",
							  __("Kaleidoscope",'nietzsche') => "kaleidoscope",
							  __("Fan",'nietzsche') => "fan",
							  __("Blind Horizontal",'nietzsche') => "blindH",
							  __("Blind Vertical",'nietzsche') => "blindV"
							  ),
						"default"=>"random"
						)
				  );
	}
	
}

?>
