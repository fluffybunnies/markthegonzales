<?php

class PeThemeViewContent extends PeThemeView {

	public function name() {
		return __("Content",'nietzsche');
	}

	public function short() {
		return __("Content",'nietzsche');
	}

	public function type() {
		return "Content";
	}

	public function supports($type) {
		return $type == "content";
	}

	public function capability($cap) {
		return false;
	}

	public function mbox() {


		$mbox = parent::mbox();

		$mbox["content"] = 
			array(
				  "delay" => 
				  array(
						"label" => __("Delay",'nietzsche'),
						"type" => "Select",
						"description" => __("Time in seconds before the slider rotates to next slide",'nietzsche'),
						"options" => PeGlobal::$const->data->delay,
						"default" => 0
						),
				  );

		return $mbox;	
	}

	public function output($conf) {
		$t =& peTheme();

		$loop = $t->slider->getSliderLoop($conf);

		if ($loop) {
			$t->template->data($conf,$loop);
			$this->template();
		}
	}

	public function template() {
		peTheme()->get_template_part("slider","volo");
	}


   
}

?>
