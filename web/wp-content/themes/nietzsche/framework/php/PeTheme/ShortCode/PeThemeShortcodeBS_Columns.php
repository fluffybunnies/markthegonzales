<?php

class PeThemeShortcodeBS_Columns extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "col";
		$this->group = __("LAYOUT",'nietzsche');
		$this->name = __("Columns",'nietzsche');
		$this->description = __("Add 2 columns",'nietzsche');
		$this->fields = array(
							  "size" =>
							  array(
									"label" => __("Layout",'nietzsche'),
									"type" => "SelectColumns",
									"groups" => true,
									"description" => __("Select the number and proportion of the columns required. The bar will update to show the layout of the chosen arrangement",'nietzsche'),
									"options" => $this->getOptions()
									)
							  );

		$add='add';
		$fun="${add}_shortcode";
		$fun("cols",array(&$this,"container"));

		// add block level cleaning
		peTheme()->shortcode->blockLevel[] = $this->trigger;
		peTheme()->shortcode->blockLevel[] = "cols";

	}

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.shortcode.bs_columns.js",array(),"pe_theme_shortcode_columns");
		wp_enqueue_script("pe_theme_shortcode_columns");
	}

	protected function getOptions() {
		return apply_filters("pe_theme_shortcode_columns_options",PeGlobal::$config["columns"]);
	}

	protected function script() {
		$html = <<<EOT
<script type="text/javascript">
jQuery.pixelentity.shortcodes.$this->trigger = jQuery("#{$this->trigger}_size_").peShortcodeColumns({tag:"{$this->trigger}"});
</script>
EOT;
esc__pe($html);
	}

	public function render() {
		parent::render();
		$this->script();
	}

	public function output($atts,$content=null,$code="") {
		extract($atts,EXTR_PREFIX_ALL,"sc");
		$class = strtr($sc_class,
					   apply_filters("pe_theme_shortcode_columns_mapping",
							  array(
									"1/6" => "span2",
									"1/4" => "span3",
									"1/3" => "span4",
									"1/2" => "span6",
									"2/4" => "span6",
									"2/3" => "span8",
									"3/4" => "span9",
									"5/6" => "span10",
									"last" => ""
							  ))
					   );
		$content = $this->parseContent($content);
		return "<div class=\"$class\">$content</div>";
	}

	public function container($atts,$content=null,$code="") {
		$content = $this->parseContent($content);
		return apply_filters("pe_theme_shortcode_columns_container",sprintf('<div class="row-fluid">%s</div>',$content),$content);
	}

}

?>
