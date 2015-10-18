<?php

class PeThemeShortcodeLightbox extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "lightbox";
		$this->group = __("MEDIA",'nietzsche');
		$this->name = __("Lightbox",'nietzsche');
		$this->description = __("Lightbox",'nietzsche');
		$this->fields = array(
							  "type" => 
							  array(
									"label"=>__("Media Type",'nietzsche'),
									"type"=>"Select",
									"description" => __("Select the type of media to be displayed in the lightbox",'nietzsche'),
									"options" =>
									array(
										  __("Image",'nietzsche')=>"image",
										  __("Youtube",'nietzsche')=>"youtube",
										  __("Vimeo",'nietzsche')=>"vimeo",
										  __("Local video",'nietzsche')=>"local",
										  __("Vid.ly",'nietzsche')=>"vidly"
										  ),
									"default"=>"image"
									),
							  "poster" => PeGlobal::$const->video->fields->poster,
							  "image" => 
							  array(
									"label"=>__("Image",'nietzsche'),
									"type"=>"Upload",
									"description" => __("This is the large image which will be opened inside the lightbox",'nietzsche')
									),
							  "video" => PeGlobal::$const->video->fields->url,
							  "size" => 
							  array(
									"label"=>__("Video window",'nietzsche'),
									"type"=>"Text",
									"description" => __("The size at which the video will be displayed. For best results these values should match the original file's resolution and/or aspect ratio.",'nietzsche'),
									"default"=>"720x405"
									),
							  "formats" => PeGlobal::$const->video->fields->formats,
							  "title" => 
							  array(
									"label"=>__("Title (Optional)",'nietzsche'),
									"type"=>"Text",
									"description" => __("Title to be displayed in the lightbox",'nietzsche'),
									"default"=>""
									),
							  "content" => 
							  array(
									"label"=>__("Description (Optional)",'nietzsche'),
									"type"=>"TextArea",
									"description" => __("Text description to be displayed in the lightbox",'nietzsche'),
									"default"=>""
									)
							  );
	}

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.shortcode.lightbox.js",array(),"pe_theme_shortcode_lightbox");
		wp_enqueue_script("pe_theme_shortcode_lightbox");
	}

	protected function script() {
		$html = <<<EOT
<script type="text/javascript">
jQuery("#{$this->trigger}").peShortcodeLightbox({tag:"{$this->trigger}"});
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
		
		if (!isset($sc_poster)) return "";
		if ($sc_type == "image") {
			if (isset($sc_image)) {
				$url = $sc_image;
			} else {
				return "";
			}
		} else {
			if (isset($sc_video)) {
				$url = $sc_video;
			} else {
				return "";
			}
		}

		$attr = "href=\"$url\"";

		$img = "<img src=\"$sc_poster\"/>";

		if ($sc_type == "local" && isset($sc_poster)) $attr .= " data-poster=\"$sc_poster\"";
		if (isset($sc_formats)) $attr .= " data-formats=\"$sc_formats\"";
		if (isset($sc_size)) $attr .= " data-size=\"$sc_size\"";
		if (isset($sc_title)) {
			$sc_title = esc_attr($sc_title);
			$attr .= " title=\"$sc_title\"";
		}
		if (isset($content)) {
			$content = esc_attr($this->parseContent($content));
			$attr .= " data-description=\"$content\"";
		}


		$html = "<a class=\"influx-over\" data-target=\"prettyphoto\" $attr>$img</a>";
		return $html;
	}


}

?>
