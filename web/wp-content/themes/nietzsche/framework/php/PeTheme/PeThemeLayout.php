<?php

class PeThemeLayout {

	public $master;
	public $mbox;
	public $def;
	public $force;

	public function __construct($master) {
		$this->master =& $master;

		$this->mbox =
			array(
				  "title" => __('Page Layout','nietzsche'),
				  "type" => 'Layout',
				  "priority" => "core",
				  "context" => "side",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"fullscreen" =>
						array(
							  "label" => __("Fullscreen",'nietzsche'),
							  "type"=>"RadioUI",
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=> "no"
							  ),
						"title" =>
						array(
							  "label" => __("Title",'nietzsche'),
							  "type"=>"RadioUI",
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=> "yes"
							  ),
						"headerMargin" =>
						array(
							  "label" => __("Header Margin",'nietzsche'),
							  "type"=>"RadioUI",
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=> "yes"
							  ),
						"content" =>
						array(
							  "label" => __("Content Area",'nietzsche'),
							  "type"=>"RadioUI",
							  "options" => 
							  array(
									__("Boxed",'nietzsche')=>"boxed",
									__("Full Width",'nietzsche') => "fullwidth"
									),
							  "default"=> "boxed"
							  ),
						"sidebar" =>
						array(
							  "label" => __("Sidebar",'nietzsche'),
							  "type"=>"RadioUI",
							  "options" => 
							  array(
									__("None",'nietzsche')=>"",
									__("Right",'nietzsche') => "right"
									),
							  "default"=> is_single() || is_page() ? "" : "right"
							  ),
						"widgets" =>
						array(
							  "label"=>__("Widgets",'nietzsche'),
							  "type"=>"Select",
							  "options" => $this->master->sidebar->option(),
							  "default"=> "default"
							  ),
						"footerMargin" =>
						array(
							  "label" => __("Footer Margin",'nietzsche'),
							  "type"=>"RadioUI",
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=> "yes"
							  ),
						"footerStyle" =>
						array(
							  "label"=>__("Footer Style",'nietzsche'),
							  "type"=>"RadioUI",
							  "options" => 
							  array(
									__("Default",'nietzsche') => "",
									__("Small",'nietzsche') => "small"
									),
							  "default"=> ""
							  )
						)
				  );

		
		$this->def = new stdClass();
		$this->force = new stdClass();
		
		foreach ($this->mbox["content"] as $option=>$data) {
			$this->def->$option = isset($data["default"]) ? $data["default"] : null;
		}

	}

	public function __get($what) {

		$ret = false;

		if (isset($this->force->$what)) {
			return $this->force->$what;
		} else {

			$meta = $this->master->content->meta();
			
			$layout = isset($meta) && isset($meta->layout) ? $meta->layout : $this->def;
			$layout = apply_filters("pe_theme_page_layout",$layout);

			if (isset($layout->$what)) {
				$ret = $layout->$what;
			}
		}

		return apply_filters("pe_theme_page_layout_$what",$ret);

	}

	public function __set($what,$value) {
		$this->force->$what = $value;
	}


}

?>