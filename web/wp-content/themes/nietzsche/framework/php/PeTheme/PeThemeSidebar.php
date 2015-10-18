<?php

class PeThemeSidebar {

	protected $master;
	protected $sidebars;
	protected $forcedID = false;

	public function __construct(&$master) {
		$this->master =& $master;
	}

	protected function build() {
		if (isset($this->sidebars)) return;
		// get theme sidebars
		$sidebars = PeGlobal::$config["sidebars"];
		$dyn = $this->master->options->get("sidebars");

		$description = __("Dynamic sidebar",'nietzsche');
		// get user defined sidebars
		if (is_array($dyn)) {
			$count = 1;
			foreach ($dyn as $sidebar) {
				$sidebars[$sidebar] = "$description $count";
			}
		}

		$this->sidebars =& $sidebars;
	}

	public function &all() {
		$this->build();
		return $this->sidebars;
	}

	public function &option() {
		$this->build();
		$option = array();
		if ($this->sidebars) {
			foreach (array_keys($this->sidebars) as $name) {
				$option[$name] = $name;
			}
		}
		return $option;
	}


	public function register() {
		$this->build();
		$sidebars =& $this->sidebars;
		if (isset($sidebars) && count($sidebars) > 0) {
			$i = 1;
			foreach ($sidebars as $name=>$description) {
				register_sidebar(
					array(
						"name"          => $name,
						"description"   => $description,
						"before_widget" => '<div class="widget %2$s">',
						"after_widget"  => "</div>",
						"before_title"  => "<h3>",
						"after_title"   => "</h3>",
						'id'            => 'sidebar-' . $i,
					)
				);
				$i++;
			}
		}
	}

	public function exists($key) {
		return isset($this->sidebars[$key]);
	}


	public function show( $name ) {

		if ( ! ( is_home() || is_archive() || is_category() || is_search() || is_tag() ) ) {

			$custom = $this->master->layout->widgets;

			if ( null === $custom ) {

				if ( is_active_sidebar( $name ) ) {

					dynamic_sidebar( $name );

				}

			} else {

				if ( 'default' === $custom ) {

					$custom = 'sidebar-1';

				}

				if ( is_active_sidebar( $custom ) ) {

					dynamic_sidebar( $custom );

				}

			}

		} else {

			if ( is_active_sidebar( $name ) ) {

				dynamic_sidebar( $name );

			}

		}

	}


}

?>