<?php

class PeThemeViewSliderVista extends PeThemeViewSliderVolo {

	public function name() {
		return __("Slider - Vista (Pan/Zoom effect)",'nietzsche');
	}

	public function short() {
		return __("Vista",'nietzsche');
	}

	public function mbox() {
		$mbox = parent::mbox();

		$custom = 
			array(
				  "transition" =>
				  array(
						"label"=>__("Transition",'nietzsche'),
						"type"=>"Select",
						"description" => __("Transition type.",'nietzsche'),
						"options" => 
						array(
							  __("Pan / Zoom",'nietzsche') =>"pz",
							  __("Fade",'nietzsche') =>"fade"
							  ),
						"default"=>"pz"
						),
				  "fade" =>
				  array(
						"label"=>__("Fade Duration",'nietzsche'),
						"type"=>"Number",
						"step"=>"0.1",
						"description" => __("Duration (in seconds) of the crossfade transition.",'nietzsche'),
						"default"=>"2"
						),
				  "speed" =>
				  array(
						"label"=>__("Animation Time",'nietzsche'),
						"type"=>"Number",
						"description" => __("Duration (in seconds) of the pan/zoom animation, lower values increase animation speed. ",'nietzsche'),
						"default"=>"10"
						)
				  );

		// insert custom fields after 1st one of the parent (delay)
		$mbox["content"] = array_merge($custom,$mbox["content"]);

		return $mbox;
		
	}

	public function template() {
		peTheme()->get_template_part("view","slider-vista");
	}
   
}

?>
