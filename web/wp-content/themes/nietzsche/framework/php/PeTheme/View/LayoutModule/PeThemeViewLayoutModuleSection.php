<?php

class PeThemeViewLayoutModuleSection extends PeThemeViewLayoutModuleContainer {

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/layout/jquery.theme.layout.module.section.js",array("jquery","pe_theme_layout_module_standard"),"pe_theme_layout_module_section");
	}

	public function requireAssets() {
		parent::requireAssets();
		wp_enqueue_script("pe_theme_layout_module_section");
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Section",'nietzsche')
				  );
	}

	public function group() {
		return "section";
	}

	public function allowed() {
		return "default";
	}

	public function jsClass() {
		return "Section";
	}

	public function fields() {
		return 
			array(
				  "title" =>
				  array(
						"label" => __("Title",'nietzsche'),
						"type" => "Text",
						"description" => __("Section Title.",'nietzsche'),
						"default" => __("Title",'nietzsche')
						),
				  "name" =>
				  array(
						"label" => __("Link Name",'nietzsche'),
						"type" => "Text",
						"description" => __("Used when linking to the section in a page (eg, from the menu).",'nietzsche'),
						"default" => ""
						),
				  "style" =>
				  array(
						"label" => __("Style",'nietzsche'),
						"type" => "RadioUI",
						"description" => __("Section color style, use 'light' for light backgrounds (like white)",'nietzsche'),
						"options" => 
						array(
							  __("Light",'nietzsche') => "light",
							  __("Dark",'nietzsche') => "dark"
							  ),
						"default" => "light"
						),
				  "ptop" =>
				  array(
						"label" => __("Top Padding",'nietzsche'),
						"type" => "Number",
						"description" => __("Section top padding.",'nietzsche'),
						"default" => 60
						),
				  "pbottom" =>
				  array(
						"label" => __("Bottom Padding",'nietzsche'),
						"type" => "Number",
						"description" => __("Section bottom padding.",'nietzsche'),
						"default" => 60
						),
				  "bg" =>
				  array(
						"label" => __("Background",'nietzsche'),
						"type" => "RadioUI",
						"description" => __("Background type.",'nietzsche'),
						"options" => 
						array(
							  __("Default",'nietzsche') => "transparent",
							  __("Color",'nietzsche') => "color",
							  __("Image",'nietzsche') => "image",
							  __("Image + Color",'nietzsche') => "imagecolor"
							  ),
						"default" => "transparent"
						),
				  "color" =>
				  array(
						"label" => __("BG Color",'nietzsche'),
						"type" => "Color",
						"description" => __("Background color.",'nietzsche'),
						"default" => "#ffffff"
						),
				  "alpha" =>
				  array(
						"label" => __("BG Color Alpha",'nietzsche'),
						"type" => "Select",
						"single" => true,
						"description" => __("Background color transparency.",'nietzsche'),
						"options" => range(0,100),
						"default" => "100"
						),
				  "image" =>
				  array(
						"label" => __("BG Image",'nietzsche'),
						"type" => "Upload",
						"description" => __("Background image.",'nietzsche'),
						"default" => ''
						),
				  "imageh" =>
				  array(
						"label" => __("BG Horizontal Align",'nietzsche'),
						"type" => "RadioUI",
						"description" => __("Horizontal alignment of the background image.",'nietzsche'),
						"options" => 
						array(
							  __("Left",'nietzsche') => "left",
							  __("Center",'nietzsche') => "center",
							  __("Right",'nietzsche') => "right"
							  ),
						"default" => "center"
						),
				  "imagev" =>
				  array(
						"label" => __("BG Vertical Align",'nietzsche'),
						"type" => "RadioUI",
						"description" => __("Vertical alignment of the background image.",'nietzsche'),
						"options" => 
						array(
							  __("Top",'nietzsche') => "top",
							  __("Center",'nietzsche') => "center",
							  __("Bottom",'nietzsche') => "bottom",
							  __("Parallax",'nietzsche') => "parallax",
							  ),
						"default" => "center"
						),
				  "imager" =>
				  array(
						"label" => __("BG Repeat",'nietzsche'),
						"type" => "RadioUI",
						"description" => __("Sets if/how a background image will be repeated.",'nietzsche'),
						"options" => 
						array(
							  __("None",'nietzsche') => "no-repeat",
							  __("Repeat X",'nietzsche') => "repeat-x",
							  __("Repeat Y",'nietzsche') => "repeat-y",
							  __("Repeat Both",'nietzsche') => "repeat",
							  ),
						"default" => "no-repeat"
						),
				  
				  
				  
				  );
	}

	public function name() {
		return __("Section",'nietzsche');
	}

	public function type() {
		return __("Structure",'nietzsche');
	}

	public function render() {

		//$data = empty($this->conf->data) ? new StdClass() : (object) $this->conf->data;

		$data = (object) shortcode_atts(
										array(
											  'title' => '',
											  'name' => '',
											  'style' => 'light',
											  'ptop' => 60,
											  'pbottom' => 60,
											  'bg' => 'transparent',
											  'color' => '',
											  'alpha' => 100,
											  'image' => '',
											  'imageh' => 'center',
											  'imagev' => 'center',
											  'imager' => 'no-repeat'
										),
										$this->conf->data
										);
		$classes = $data->style === 'light' ? 'pe-style-light' : 'pe-style-dark';

		$style = sprintf('padding: %spx 0px %spx 0px; ',$data->ptop,$data->pbottom);

		if ($data->bg === 'color' || $data->bg === 'imagecolor') {

			$color = $data->color;
			$rgba = sprintf(
							"rgba(%s,%s,%s,%s)",
							hexdec(substr($color, 1, 2)),
							hexdec(substr($color, 3, 2)),
							hexdec(substr($color, 5, 2)),
							intval($data->alpha)/100);

			$style .= sprintf('background-color:%s;',$color);
			$style .= sprintf('background-color:%s;',$rgba);

		}

		if (($data->bg === 'image' || $data->bg === 'imagecolor') && $data->image) {
			$style .= sprintf('background-image:url(%s);',$data->image);

			$x = $data->imageh;
			
			$classes .= ' pe-bg-'.$x;

			$x = $x === 'left' ? "0" : ($x === 'right' ? '100%' : '50%' );
			$y = $data->imagev;
			$y = $y === 'top' || $y === 'parallax' ? "0" : ($y === 'bottom' ? '100%' : '50%' );

			$classes .= $data->imagev === 'parallax' ? ' pe-parallax' : '';

			$style .= sprintf('background-position: %s %s;',$x,$y);

		}

		if (($data->bg === 'image' || $data->bg === 'imagecolor')) {
			$style .= sprintf('background-repeat:%s;',$data->imager);
		}

		if ($style) {
			$style = sprintf(' style="%s"',$style);
		}

		$id = empty($data->name) ? __("section",'nietzsche').$this->conf->bid : $data->name;
		$id = strtr($id,array('#' => ''));

		echo sprintf('<section class="pe-main-section pe-view-layout-block pe-view-layout-block-%s %s" id="section-%s"%s>',$this->conf->bid,$classes,$id,$style);
		$this->template();
		echo '</section>';
	}

	public function setTemplateData() {
		$items = isset($this->conf->items) && is_array($this->conf->items) ? $this->conf->items : array();
		peTheme()->template->data($this->data,$items);
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","section");
	}

	public function tooltip() {
		return __("Use this block to add sections to the one page layout.",'nietzsche');
	}

}

?>
