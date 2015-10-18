<?php

class PeThemeSlide {

	protected $master;
	protected $fields;

	public function __construct(&$master) {
		$this->master =& $master;
	}

	public function registerAssets() {
		PeThemeAsset::addScript("framework/js/pe/jquery.pixelentity.utils.geom.js",array("jquery"),"pe_theme_utils_geom");
		PeThemeAsset::addScript("framework/js/pe/jquery.pixelentity.transform.js",array("jquery"),"pe_theme_transform");
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.slide.js",array("pe_theme_utils","pe_theme_utils_geom","pe_theme_transform","editor","json2"),"pe_theme_slide");
		
		// prototype.js alters JSON2 behaviour, it shouldn't be loaded in our admin page anyway but
		// if other plugins are forcing it in all wordpress admin pages, we get rid of it here.
		wp_deregister_script("prototype");
	}

	public function cpt() {
		$cpt = 
			array(
				  'labels' => 
				  array(
						'name'              => __("Slides",'nietzsche'),
						'singular_name'     => __("Slide",'nietzsche'),
						'add_new_item'      => __("Add New Slide",'nietzsche'),
						'search_items'      => __('Search Slides','nietzsche'),
						'popular_items' 	  => __('Popular Slides','nietzsche'),		
						'all_items' 		  => __('All Slides','nietzsche'),
						'parent_item' 	  => __('Parent Slide','nietzsche'),
						'parent_item_colon' => __('Parent Slide:','nietzsche'),
						'edit_item' 		  => __('Edit Slide','nietzsche'), 
						'update_item' 	  => __('Update Slide','nietzsche'),
						'add_new_item' 	  => __('Add New Slide','nietzsche'),
						'new_item_name' 	  => __('New Slide Name','nietzsche')
						),
				  'public' => true,
				  'has_archive' => false,
				  //"supports" => array("title","editor","thumbnail"),
				  "supports" => array("title","thumbnail"),
				  "taxonomies" => array("post_format")
				  );

		PeGlobal::$config["post_types"]["slide"] = $cpt;
		//PeGlobal::$config["post-formats-slide"] = array("gallery");

		$transitions = array("bounceIn", "bounceInDown", "bounceInLeft", "bounceInRight", "bounceInUp", "bounceOut", "bounceOutDown", "bounceOutLeft", "bounceOutRight", "bounceOutUp", "fadeIn", "fadeInDownBig", "fadeInDown", "fadeInLeftBig", "fadeInLeft", "fadeInRightBig", "fadeInRight", "fadeInUpBig", "fadeInUp", "fadeOut", "fadeOutDownBig", "fadeOutDown", "fadeOutLeftBig", "fadeOutLeft", "fadeOutRightBig", "fadeOutRight", "fadeOutUpBig", "fadeOutUp", "flash", "flip", "flipInX", "flipInY", "flipOutX", "flipOutY", "hinge", "lightSpeedIn", "lightSpeedOut", "pulse", "rollIn", "rollOut", "rotateIn", "rotateInDownLeft", "rotateInDownRight", "rotateInUpLeft", "rotateInUpRight", "rotateOut", "rotateOutDownLeft", "rotateOutDownRight", "rotateOutUpLeft", "rotateOutUpRight", "shake", "swing", "tada", "wiggle", "wobble");

		$transitions = apply_filters("pe_theme_slider_caption_transitions",$transitions);

		$mbox = 
			array(
				  "title" => __("Layers Builder",'nietzsche'),
				  "type" => "",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"layout" =>
						array(
							  "label"=>__("Layout",'nietzsche'),
							  "section" => "preview",

							  "description" => __("A boxed slider (default) behaves like a responsive image. A full width slider will always fill all the available width and upscale the image if smaller than slider area.",'nietzsche'),
							  "type"=>"RadioUI",
							  "options" => 
							  array(
									__("Boxed",'nietzsche')=>"boxed",
									__("Full Width",'nietzsche') => "fullwidth"
									),
							  "default"=>"boxed"
							  ),
						"preview" => 	
						array(
							  "section" => "preview",
							  "type"=>"LayersBuilder",
							  "default" => "940x300",
							  ),
						"captions" => 
						array(
							  "section" => "main",
							  "label"=>"",
							  "type"=>"Items",
							  "description" => "",
							  "button_label" => __("Add New Layer",'nietzsche'),
							  "sortable" => true,
							  "auto" => __("Layer",'nietzsche'),
							  "unique" => false,
							  "editable" => true,
							  "legend" => true,
							  "fields" => 
							  array(
									array(
										  "name" => "content",
										  "label" => __("Content",'nietzsche'),
										  "type" => "textimg",
										  "width" => 300,
										  "default" => ""
										  ),
									array(
										  "name" => "x",
										  "label" => __("x",'nietzsche'),
										  "type" => "text",
										  "width" => 40, 
										  "default" => "10"
										  ),
									array(
										  "name" => "y",
										  "label" => __("y",'nietzsche'),
										  "type" => "text",
										  "width" => 40,
										  "default" => "10"
										  ),
									array(
										  "name" => "delay",
										  "label" => __("Wait",'nietzsche'),
										  "type" => "text",
										  "width" => 30,
										  "default" => "0"
										  ),
									array(
										  "name" => "duration",
										  "label" => __("Duration",'nietzsche'),
										  "type" => "text",
										  "width" => 30,
										  "default" => "1"
										  ),
									array(
										  "name" => "style",
										  "type" => "hidden",
										  "default" => "pe-caption-white"
										  ),
									array(
										  "name" => "size",
										  "type" => "hidden",
										  "default" => "pe-caption-small"
										  ),
									array(
										  "name" => "transition",
										  "type" => "hidden",
										  "default" => "fadeIn"
										  ),
									array(
										  "name" => "color",
										  "type" => "hidden",
										  "default" => ""
										  ),
									array(
										  "name" => "bgcolor",
										  "type" => "hidden",
										  "default" => ""
										  ),
									array(
										  "name" => "bgcolorAlpha",
										  "type" => "hidden",
										  "default" => ""
										  ),
									array(
										  "name" => "custom",
										  "type" => "hidden",
										  "default" => ""
										  ),
									array(
										  "name" => "classes",
										  "type" => "hidden",
										  "default" => ""
										  )
									),
							  "default" => ""
							  ),
						"style" => 
						array(
							  "label"=>__("Theme",'nietzsche'),
							  "type"=>"Select",
							  "section"=>"edit",
							  "options"=> 
							  array(
									__("Light",'nietzsche') => "pe-caption-white",
									__("Dark",'nietzsche') => "pe-caption-style-black"
									),
							  "default"=>"pe-caption-white"
							  ),
						"size" => 
						array(
							  "label"=>__("Text",'nietzsche'),
							  "type"=>"Select",
							  "section"=>"edit",
							  "options"=> 
							  array(
									__("Small",'nietzsche') => "pe-caption-small",
									__("Medium",'nietzsche') => "pe-caption-medium",
									__("Large",'nietzsche') => "pe-caption-large",
									__("XLarge",'nietzsche') => "pe-caption-xlarge",
									__("Bold",'nietzsche') => "pe-caption-bold",
									__("Thick",'nietzsche') => "pe-caption-thick"
									),
							  "default"=>"pe-caption-white"
							  ),
						"transition" => 
						array(
							  "label"=>__("Transition",'nietzsche'),
							  "type"=>"Select",
							  "section"=>"edit",
							  "options"=> $transitions,
							  "single" => true,
							  "default"=>"fadeIn"
							  ),
						"color" =>
						array(
							  "label"=>__("Color",'nietzsche'),
							  "type"=>"Color",
							  "section"=>"edit",
							  "palette" => array("#ffffff","#222222"),
							  "default"=> ""
							  ),
						"bgcolorAlpha" =>
						array(
							  "label"=>__("Background",'nietzsche'),
							  "type"=>"Select",
							  "section"=>"edit",
							  "options"=>
							  array(
									__("No background",'nietzsche') => "",
									__("10%",'nietzsche') => "0.1",
									__("20%",'nietzsche') => "0.2",
									__("30%",'nietzsche') => "0.3",
									__("40%",'nietzsche') => "0.4",
									__("50%",'nietzsche') => "0.5",
									__("60%",'nietzsche') => "0.6",
									__("70%",'nietzsche') => "0.7",
									__("80%",'nietzsche') => "0.8",
									__("90%",'nietzsche') => "0.9",
									__("100%",'nietzsche') => "1",
									),
							  "default"=> ""
							  ),
						"bgcolor" =>
						array(
							  "label"=>__("BG Color",'nietzsche'),
							  "type"=>"Color",
							  "section"=>"edit",
							  "palette" => array("#ffffff","#222222"),
							  "default"=> ""
							  ),
						"classes" =>
						array(
							  "label"=>__("Classes",'nietzsche'),
							  "type"=>"Text",
							  "section"=>"edit",
							  "default"=> ""
							  ),
						"custom" =>
						array(
							  "label"=>__("Style",'nietzsche'),
							  "type"=>"TextArea",
							  "section"=>"edit",
							  "default"=> ""
							  )
						/*,
						"saveCaption" => 
						array(
							  "label"=>__("Save current layer",'nietzsche'),
							  "type"=>"Button",
							  "section"=>"edit",
							  "default"=> ""
							  )*/
						)
				  );

		$mboxFormat = 
			array(
				  "title" => __("Format",'nietzsche'),
				  "type" => "Plain",
				  "context" => "side",
				  "priority" => "core",
				  "where" =>
				  array(
						"post" => "all"
						),
				  "content" =>
				  array(
						"type" => 
						array(
							  "label"=>"",
							  "type"=>"RadioUI",
							  "options"=>
							  array(
									__("Normal",'nietzsche') => "normal",
									__("Layers",'nietzsche') => "layers"
									),
							  "default"=>"normal"
							  ),
						)
				  );

		PeGlobal::$config["metaboxes-slide"] = 
			array(
				  "layers" => $mbox,
				  //"format" => $mboxFormat
				  );
		
		add_action('add_meta_boxes_slide',array(&$this,'add_meta_boxes_slide'));
	}

	public function option() {
		$posts = get_posts(
						   array(
								 "post_type" => "slide",
								 "posts_per_page" => -1,
								 "suppress_filters" => 0
								 )
						   );
		if (count($posts) > 0) {
			$options = array();
			$options[__("No Slide",'nietzsche')] = 0;
			foreach($posts as $post) {
				$options[$post->post_title] = $post->ID;
			}
		} else {
			$options = array(__("No slides defined.",'nietzsche')=>-1);
		}
		return $options;
	}

	public function add_meta_boxes_slide() {
		// layer builder
		$this->registerAssets();
		wp_enqueue_script("pe_theme_slide");
	}

	public function caption($id) {
		$meta = $this->master->meta->get($id,"slide");
		return empty($meta->layers->captions) ? "" : $this->output($meta->layers->captions,$meta->layers->preview);
	}


	public function output($captions,$size = null) {
		$buffer = "";
		$image =& $this->master->image;

		$strip_line_breaks = array("\r"=>"","\n"=>"");
		$caption_defaults = array(
			"x" => 0,
			"y" => 0,
			"delay" => 0,
			"duration" => 1,
			"style" => "pe-caption-white",
			"size" => "pe-caption-small",
			"transition" => "fadeIn",
			"color" => "",
			"bgcolor" => "",
			"bgcolorAlpha" => 0,
			"custom" => "",
			"classes" => "",
			"content" => ""
		);

		if ($captions && is_array($captions)) {
			foreach ($captions as $caption) {
				$style = "";
				$caption = (object) shortcode_atts( $caption_defaults, $caption	);

				$style = "";

				if (!empty($caption->bgcolor) && floatval($caption->bgcolorAlpha) > 0) {
					$c = isset($caption->bgcolor) ? $caption->bgcolor : "#000000" ;
					$style = sprintf("background-color: %s;",$c);
					if (floatval($caption->bgcolorAlpha) < 1) {
						$style .= sprintf(
										  " background-color: rgba(%s,%s,%s,%s);",
										  hexdec(substr($c, 1, 2)),
										  hexdec(substr($c, 3, 2)),
										  hexdec(substr($c, 5, 2)),
										  $caption->bgcolorAlpha
										  );
					}
				}

				if (!empty($caption->color)) {
					$style .= sprintf("color: %s;",$caption->color);
				}


				//$style .= sprintf(" position:absolute;top:%spx;left:%spx;",$caption->y,$caption->x);
				
				if ($caption->custom) {
					$style .= sprintf(";%s;",strtr($caption->custom,$strip_line_breaks));
				}

				if ($style) {
					$style = "style=\"{$style}\"";
				}

				//$caption->content='<img src="1.png" /><img src=\'2.png\' />';

				if (preg_match_all("/<img[^<]+\/>/",$caption->content,$matches)) {
					if (!empty($matches[0])) {
						$replace = array();
						foreach ($matches[0] as $img) {
							preg_match('/src=("|\')(.+)\1/',$img,$src);
							if (!empty($src[2])) {
								$src = $src[2];
								$newimg = $image->get_retina($src);
								$newimg = str_replace('<img ','<img class="pe-lazyloading-forceload" ',$newimg);
								$replace[$img] = $newimg;
								//print_r(array($src,$newimg));
								// 
							}
						}
						if (!empty($replace)) {
							$caption->content = strtr($caption->content,$replace);
						}
					}
				}

				$buffer .= sprintf(
								   '<div class="%s %s %s %s" %s data-transition="%s" data-duration="%s" data-delay="%s" data-x="%s" data-y="%s">%s</div>',
								   "peCaptionLayer",
								   $caption->style,
								   $caption->size,
								   $caption->classes,
								   $style,
								   $caption->transition,
								   $caption->duration,
								   $caption->delay,
								   $caption->x,
								   $caption->y,
								   $caption->content
								   );
			}
		}

		if ($size) {
			$ret = new StdClass();
			$ret->size = $size;
			$ret->caption = $buffer;
			return $ret;
		}

		return $buffer;
	}

}

?>
