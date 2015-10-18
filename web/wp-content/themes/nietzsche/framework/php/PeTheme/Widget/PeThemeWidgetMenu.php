<?php

class PeThemeWidgetMenu extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Menu",'nietzsche');
		$this->description = __("Show a menu",'nietzsche');
		$this->wclass = "widget_menu";

		$menus = get_terms("nav_menu",array("hide_empty" => false));

		if ($menus) {
			foreach ( $menus as $menu ) {
				$options[$menu->name] = $menu->term_id;
			}
			$description = __("Select a menu",'nietzsche');
		} else {
			$options[__("No menus have been created yet",'nietzsche')] = -1;
			$description = sprintf(__('<a href="%s">Create a menu</a>','nietzsche'),admin_url('nav-menus.php'));
		}

		$this->fields = array(
							  "title" => 
							  array(
									"label"=>__("Title",'nietzsche'),
									"type"=>"Text",
									"description" => __("Widget title",'nietzsche'),
									"default"=>"Menu widget"
									),
							  "id" =>
							  array(
									"label" => __("Menu",'nietzsche'),
									"type" => "Select",
									"description" => $description,
									"options" => $options
									)
							  );

		parent::__construct();
	}


	public function widget($args,$instance) {
		$instance = $this->clean($instance);
		extract($instance);

		if (!@$id) return;		
		esc__pe($args["before_widget"]);
		if (isset($title)) echo "<h3>$title</h3>";
		echo '<div class="well">';
		peTheme()->menu->showID($id,"sidebar");
		echo "</div>";
		esc__pe($args["after_widget"]);
	}


}
?>
