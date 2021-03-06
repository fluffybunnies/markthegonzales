<?php

class PeThemeViewLayoutModuleText extends PeThemeViewLayoutModule {

	public function name() {
		return __("Text",'nietzsche');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Text",'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
				  "layout" => 
				  array(
						"label" => __("Layout",'nietzsche'),
						"description" => __("Usually, text content has a maximum width set (which depends on the theme but usually around 940px) and gets centered. Use 'Full Width' settings if you want the block to fill the whole container, for instance to add full width content using a shortcode.",'nietzsche'),
						"type" => "RadioUI",
						"options" => array(__("Boxed",'nietzsche') => "boxed", __("Full Width",'nietzsche') => "fullwidth"),
						"default" => "boxed"
						),
				  "content" =>
				  array(
						"label" => "Content",
						"type" => "Editor",
						"noscript" => true,
						"description" => __("Content",'nietzsche'),
						"default" => ""
						)
				  );
		
	}

	public function render() {

		$data = (object) shortcode_atts(
										array(
											  'layout' => 'boxed',
											  'content' => ''
											  ),
										$this->conf->data
										);
		
		$boxed = $data->layout !== "fullwidth";
		$copen = $boxed ? '<div class="pe-container">' : '';
		$cclose = $boxed ? '</div>' : '';
		$cls = $boxed ? '' : 'pe-block-fullwidth';

		
 
		printf('<div class="pe-block %s pe-view-layout-block pe-view-layout-block-%s">%s%s%s</div>',
			   $cls,
			   $this->conf->bid,
			   $copen,
			   do_shortcode(apply_filters("the_content",$data->content)),
			   $cclose
			   );
	}

	public function tooltip() {
		return __("Use this block to add simple text content to your layout. Simple HTML markup is also supported. The WordPress editor may be used to create this text by clicking the 'Edit with the HTML Editor' link located just under the input field.",'nietzsche');
	}

}

?>
