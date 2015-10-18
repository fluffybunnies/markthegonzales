<?php

class PeThemeViewSliderVario extends PeThemeViewSliderVolo {

	public function name() {
		return __("Slider - Vario (CSS animations / video)",'nietzsche');
	}

	public function short() {
		return __("Vario",'nietzsche');
	}

	public function mbox() {
		$mbox = parent::mbox();

		$custom = 
			array(
				  "transition" =>
				  array(
						"label"=>__("Transition",'nietzsche'),
						"type"=>"Select",
						"description" => __("Transition type",'nietzsche'),
						"options" => 
						array(
							  __("Fade",'nietzsche') =>"fade",
							  __("Random",'nietzsche') =>"random",
							  __("Block Fade",'nietzsche') =>"blockfade",
							  __("Fall",'nietzsche') =>"fall",
							  __("Domino",'nietzsche') =>"domino",
							  __("Flip",'nietzsche') =>"flip",
							  __("Reveal Right",'nietzsche') =>"revealR",
							  __("Reveal Left",'nietzsche') =>"revealL",
							  __("Reveal Bottom",'nietzsche') =>"revealB",
							  __("Reveal Top",'nietzsche') =>"revealT",
							  __("Saw",'nietzsche') =>"saw",
							  __("Scale",'nietzsche') =>"scale",
							  __("Bars",'nietzsche') =>"bars",
							  __("Zoom",'nietzsche') =>"zoom",
							  __("Drop",'nietzsche') =>"drop"
							  ),
						"default"=>"fade"
						),
				  "bg" =>
				  array(
						"label"=>__("Background",'nietzsche'),
						"description" => __("Whether to use  slide images as background or a video.",'nietzsche'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Images",'nietzsche')=>"images",
							  __("Video",'nietzsche') => "video"
							  ),
						"default"=>"images"
						),
				  "video" =>
				  array(
						"label"=>__("Video",'nietzsche'),
						"type"=>"UploadLink",
						"description" => __("The video must be available in both ogv and mp4 formats, for instance, if the video is called 'background.mp4', then 'background.ogv' must also be uploaded.",'nietzsche'),
						"default"=>""
						),
				  "loop" =>
				  array(
						"label"=>__("Loop",'nietzsche'),
						"description" => __("Restart video once playback ends.",'nietzsche'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Enabled",'nietzsche')=>"enabled",
							  __("Disabled",'nietzsche') => ""
							  ),
						"default"=>""
						),
				  "fallback" =>
				  array(
						"label"=>__("Fallback",'nietzsche'),
						"type"=>"Upload",
						"description" => __("When a background video is set, the fallback image will be shown in browsers that lack native video support (like older version of MSIE).",'nietzsche'),
						"default"=>""
						)
				  );

		// insert custom fields after 1st one of the parent (delay)
		$mbox["content"] = array_merge($custom,$mbox["content"]);

		return $mbox;
		
	}

	public function template() {
		peTheme()->get_template_part("view","slider-vario");
	}
   
}

?>
