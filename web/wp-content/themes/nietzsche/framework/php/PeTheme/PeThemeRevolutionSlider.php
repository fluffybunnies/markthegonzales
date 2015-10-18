<?php

class PeThemeRevolutionSlider {

	public $master;

	public function __construct($master) {
		$this->master =& $master;

	}

	public function import($zips,$map) {

		if (!class_exists('RevSlider')) return;
		
		$slider = new RevSlider();
		foreach($zips as $zip){
			$slider->importSliderFromPost(true,true,$zip);  
		}

		$sliders = $slider->getArrSliders();
		
		foreach ($sliders as $slider) {
			$slides = $slider->getSlides();
			foreach ($slides as $slide) {
				$params = $slide->getParams();
				if (isset($params['image']) && isset($map[$params['image']])) {
					$slide->replaceImageUrls($params['image'],$map[$params['image']]);
				}
				$layers = $slide->getLayers();
				if (is_array($layers) && count($layers) > 0) {
					foreach($layers as $key=>$layer){
						$type =  UniteFunctionsRev::getVal($layer, "type");
						if(isset($layer['type']) && $layer['type'] == "image" && isset($layer['image_url']) && isset($map[$layer['image_url']])){
							$slide->replaceImageUrls($layer['image_url'],$map[$layer['image_url']]);
						}
					}
				}
			}
		}
	}


}

?>