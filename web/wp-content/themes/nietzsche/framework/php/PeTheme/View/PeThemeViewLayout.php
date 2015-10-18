<?php

class PeThemeViewLayout extends PeThemeView {

	public function name() {
		return __("Layout - Manager",'nietzsche');
	}

	public function short() {
		return __("Layout Manager",'nietzsche');
	}

	public function type() {
		return __("Layout",'nietzsche');
	}

	public function supports($type) {
		return $type == "layout";
	}

	public function capability($cap) {
		return false;
	}

	public function mbox($config = 'default') {

		$views = array();

		// modules
		foreach (peTheme()->view->views($config) as $view) {
			if ($view->capability("layout")) {
				$type = $view->type();
				if ($type) {
					$views[$type][] = $view;
				}
			}
		}

		$mbox =
			array(
				  "title" => __("Layout Manager",'nietzsche'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"builder" =>
						array(
							  "type" => "Layout",
							  "views" => $views,
							  "groups" => true
							  )
						)
				  );		

		return $mbox;	
	}

	public function output($conf) {
		$v =& peTheme()->view;

		if (empty($conf->settings->builder["items"])) return;

		echo apply_filters("pe_theme_view_layout_open",sprintf('<div class="pe-block pe-view-layout pe-view-%s">',$conf->id),$conf->id);
		foreach($conf->settings->builder["items"] as $item) {
			$v->outputModule($item);
		}
		echo apply_filters("pe_theme_view_layout_close",'</div>',$conf->id);
			   
	}

}

?>
