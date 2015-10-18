<?php

class PeThemeShortcodeBS_Video extends PeThemeShortcode {

	public $instances = 0;

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "pevideo";
		$this->group = __("MEDIA",'nietzsche');
		$this->name = __("Video",'nietzsche');
		$this->description = __("Video",'nietzsche');
		$this->fields = array(
							  "id" => PeGlobal::$const->video->fields->id
							  );

		peTheme()->shortcode->blockLevel[] = $this->trigger;
	}

	public function output($atts,$content=null,$code="") {

		extract(shortcode_atts(array('id'=>''),$atts));
		
		if (!$id) return "";

		$t =& peTheme();
		
		ob_start();
		$t->video->output($id);
		$content = ob_get_clean();
		return $content;

	}


}

?>
