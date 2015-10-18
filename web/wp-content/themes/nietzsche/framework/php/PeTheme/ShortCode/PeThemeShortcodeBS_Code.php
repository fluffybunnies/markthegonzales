<?php

class PeThemeShortcodeBS_Code extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "codehs";
		$this->group = __("LAYOUT",'nietzsche');
		$this->name = __("Code Block (Syntax Highlighting)",'nietzsche');
		$this->description = __("Add a Code Box",'nietzsche');
		$this->fields = array(
							  "lang"=> 
							  array(
									"label" => __("Language",'nietzsche'),
									"type" => "Select",
									"description" => __("Language type of code block.",'nietzsche'),
									"options" => 
									array(
										  __("HTML",'nietzsche') => "html",
										  __("CSS",'nietzsche') => "css",
										  __("Javascript",'nietzsche') => "js",
										  __("PHP",'nietzsche') => "php",
										  __("XML",'nietzsche') => "xml",
										  __("SQL",'nietzsche') => "sql"
										  ),
									"default" => "html"
									),
							  "options"=> 
							  array(
									"label" => __("Options",'nietzsche'),
									"type" => "CheckboxUI",
									"description" => __("Use vertical scrollbar / Show line numbers. If a vertical scrollbar is chosen, the code block's height is fixed as 350px",'nietzsche'),
									"options" => 
									array(
										  __("Scrollbar",'nietzsche') => "pre-scrollable",
										  __("Line Numbers",'nietzsche') => "linenums"
										  )
									),
							  
							  "content" =>
							  array(
									"label" => __("Content",'nietzsche'),
									"type" => "TextArea",
									"description" => __("Enter the content here.",'nietzsche'),
									)
							  );
	}

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.shortcode.code.js",array(),"pe_theme_shortcode_code");
		wp_enqueue_script("pe_theme_shortcode_code");
	}

	protected function script() {
		$html = <<<EOT
<script type="text/javascript">
jQuery.pixelentity.shortcodes.$this->trigger = jQuery("#{$this->trigger}_content_").peShortcodeCode({lang:jQuery("#{$this->trigger}_lang_"),options:jQuery('input[id^="{$this->trigger}_options_"]')});
</script>
EOT;
esc__pe($html);
	}

	public function render() {
		parent::render();
		$this->script();
	}

		// not used
	public function output($atts,$content=null,$code="") {
		extract($atts);
		$lines = $lines == "yes" ? "linenums" : "";
		$scroll = $scroll == "yes" ? "pre-scrollable" : "";
		$content = $content ? esc_attr($content) : '';
		$html = <<< EOT
<pre class="prettyprint $lines lang-$lang $scroll">$content</pre>
EOT;
        return trim($html);
	}


}

?>
