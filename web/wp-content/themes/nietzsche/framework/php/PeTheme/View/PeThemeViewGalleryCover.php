<?php

class PeThemeViewGalleryCover extends PeThemeViewGallery {


	public function name() {
		return __("Gallery - Cover (flare lightbox)",'nietzsche');
	}

	public function short() {
		return __("Cover",'nietzsche');
	}

	public function mbox() {
		$mbox = parent::mbox();
		unset($mbox["content"]["max"]);
		return $mbox;	
	}

	public function template() {
		peTheme()->get_template_part("view","gallery-cover");
	}


   
}

?>
