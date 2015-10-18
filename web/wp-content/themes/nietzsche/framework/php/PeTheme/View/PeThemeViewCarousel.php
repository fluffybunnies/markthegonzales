<?php

class PeThemeViewCarousel extends PeThemeViewBlog {

	public function name() {
		return __("Carousel",'nietzsche');
	}

	public function short() {
		return __("Carousel",'nietzsche');
	}

	public function type() {
		return __("Carousel",'nietzsche');
	}

	public function mbox() {
		$mbox = parent::mbox();

		$custom = 
			array(
				  "delay" => 
				  array(
						"label" => __("Delay",'nietzsche'),
						"type" => "Select",
						"description" => __("Time in seconds before the slider rotates to next slide.",'nietzsche'),
						"options" => PeGlobal::$const->data->delay,
						"default" => 0
						),
				  "layout" =>
				  array(
						"label"=>__("Layout",'nietzsche'),
						"type"=>"RadioUI",
						"description" => __("Number of items to show simultaneously.",'nietzsche'),
						"options" => 
						array(
							  __("1",'nietzsche') =>1,
							  __("2",'nietzsche') =>2,
							  __("3",'nietzsche') =>3,
							  __("4",'nietzsche') =>4,
							  __("5",'nietzsche') =>5
							  ),
						"default"=>4
						),
				  "style" =>
				  array(
						"label"=>__("Style",'nietzsche'),
						"type"=>"RadioUI",
						"description" => __("Carousel style.",'nietzsche'),
						"options" => 
						array(
							  __("Default",'nietzsche') =>"",
							  __("Testimonials",'nietzsche') =>"testimonials",
							  __("Logos",'nietzsche') => "logos",
							  __("With More Button",'nietzsche') => "more"
							  ),
						"default"=>""
						),
				  "height" =>
				  array(
						"label"=>__("Image Height",'nietzsche'),
						"type"=>"Number",
						"description" => __("Image height.",'nietzsche'),
						"default"=>195
						),
				  "title" =>
				  array(
						"label"=>__("Title",'nietzsche'),
						"type"=>"Text",
						"description" => __("Carousel Title.",'nietzsche'),
						"default"=>__("Carousel Title",'nietzsche')
						),
				  "subtitle" =>
				  array(
						"label"=>__("Subtitle",'nietzsche'),
						"type"=>"Text",
						"description" => __("Carousel Subtitle.",'nietzsche'),
						"default"=>'<a href="#">Go to portfolio</a>'
						),
				  "description" =>
				  array(
						"label"=>__("Description",'nietzsche'),
						"type"=>"Text",
						"description" => __("Carousel Description.",'nietzsche'),
						"default"=>'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna.'
						),
				  "chars" =>
				  array(
						"label"=>__("Excerpt",'nietzsche'),
						"type"=>"Number",
						"description" => __("Excerpt length, in chars.",'nietzsche'),
						"default"=>60
						),
				 
				  
				  );

		// insert custom fields after 1st one of the parent (delay)
		$mbox["content"] = $custom;

		return $mbox;		
	}

	public function defaults() {

		$conf =& $this->conf;

		$t =& peTheme();

		if (!isset($conf->settings)) {
			$conf->settings = new StdClass();
		}

		$settings =& $conf->settings;

		if (empty($settings->height)) {
			$settings->height = 195;
		}

		if (empty($settings->delay)) {
			$settings->delay = 0;
		}

		if (empty($settings->style)) {
			$settings->style = "default";
		}

		$sw = array(940,350,314,240,180); 
		$iw = array(940,460,420,420,420); 
		$rw = array(940,460,300,220,172);

		$idx = min(5,max(1,absint($settings->layout)))-1; 
		$iw = $iw[$idx];
		$sw = $sw[$idx];
		$rw = $rw[$idx];
		$h = $t->view->resized ? $t->media->h : $settings->height;
		$h = round($h*($iw/$rw));

		$settings->sw = $sw;
		$settings->w = $iw;
		$settings->h = $h;

	}


	public function template($type = '') {

		if ( 'empty' == $type ) return;

		print('<div class="pe-container pe-block">');
		peTheme()->get_template_part("view","carousel");
		print('</div>');
	}
   
}

?>