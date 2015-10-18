<?php

class PeThemeViewGallery extends PeThemeView {


	public function type() {
		return __("Gallery",'nietzsche');
	}

	public function supports($type) {
		return !in_array($type,array("post-ptable","content","layout"));
	}

	public function mbox() {
		$mbox = parent::mbox();
		$mbox["type"] = "GalleryPost";

		$mbox["content"] = 
			array(
				  "max" => 
				  array(
						"label"=>__("Thumbnails",'nietzsche'),
						"type"=>"Text",
						"description" => __("Maximum number of thumbnails to show in the main page. Regardless this setting, all gallery images would still be shown inside the lightbox window.",'nietzsche'),
						"default"=>"1000"
						),
				  "type" => 
				  array(
						"label"=>__("Lightbox Gallery Transition",'nietzsche'),
						"type"=>"Select",
						"description" => __("Choose image transition when viewed inside the lightbox: <strong>Slide</strong> Slides left/right. <strong>Shutter</strong> Black and white zoom effect.",'nietzsche'),
						"options" => 
						array(
							  __("Slide",'nietzsche')=>"default",
							  __("Shutter",'nietzsche')=>"shutter",
							  ),
						"default"=>"default"
						),
				  "bw" => 
				  array(
						"label"=>__("Black & White",'nietzsche'),
						"type"=>"RadioUI",
						"description" => __("Enable Black & White effect.",'nietzsche'),
						"options" => 
						array(
							  __("yes",'nietzsche')=>"yes",
							  __("no",'nietzsche')=>"no",
							  ),
						"default"=>"no"
						),
				  "scale" =>
				  array(
						"label"=>__("Scale Mode",'nietzsche'),
						"type"=>"Select",
						"section"=>__("General",'nietzsche'),
						"description" => __("This setting determins how the images are scaled / cropped when displayed in the browser window.\"<strong>Fit</strong>\" fits the whole image into the browser ignoring surrounding space.\"<strong>Fill</strong>\" fills the whole browser area by cropping the image if necessary. The Max version will also upscale the image.",'nietzsche'),
						"options" => array(
										   __("Fit",'nietzsche')=>"fit",
										   __("Fit (Max)",'nietzsche')=>"fitmax",
										   __("Fill",'nietzsche')=>"fill",
										   __("Fill (Max)",'nietzsche')=>"fillmax"
										   ),
						"default"=>"fit"
						)
				  );

		return $mbox;	
	}

	public function defaults() {

		$conf =& $this->conf;

		if (!isset($conf->settings)) {
			$conf->settings = new StdClass();
		}

		$settings =& $conf->settings;
		
		$settings->type = isset($settings->type) && $settings->type ? $settings->type : "default";
		$settings->max = isset($settings->max) ? intval($settings->max) : 0;
		$settings->scale = isset($settings->scale) && $settings->scale ? $settings->scale : "fit";
		$settings->bw = isset($settings->bw) && $settings->bw === "yes" && $settings->type === "shutter" ? true : false;

	}

	public function capability($cap) {
		return $cap === "captions";
	}

	public function output($conf) {

		parent::output($conf);

		$t =& peTheme();

		$loop = $t->view->getViewLoop($conf);

		if ($loop) {
			$t->template->data($conf,$loop);
			$this->template();
		}
	}

	public function template() {
	}   
}

?>
