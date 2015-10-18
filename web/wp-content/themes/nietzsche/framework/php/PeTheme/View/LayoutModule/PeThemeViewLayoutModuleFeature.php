<?php

class PeThemeViewLayoutModuleFeature extends PeThemeViewLayoutModule {

	public function name() {
		return __("Feature",'nietzsche');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Feature",'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
				  "title" =>
				  array( 
						"label" => __("Title",'nietzsche'),
						"type" => "Text",
						"description" => __("Title",'nietzsche'),
						"default" => 'Title'
						 ),
				  "content" =>
				  array( 
						"label" => __("Content",'nietzsche'),
						"type" => "Editor",
						"description" => __("Content",'nietzsche'),
						"default" => ''
						 ),
				  "label" =>
				  array( 
						"label" => __("Button Label",'nietzsche'),
						"type" => "Text",
						"description" => __("Button label, leave empty to hide.",'nietzsche'),
						"default" => 'Click Here'
						 ),
				  "link" =>
				  array( 
						"label" => __("Button Link",'nietzsche'),
						"type" => "Text",
						"description" => __("Button Link",'nietzsche'),
						"default" => '#'
						 ),
				  "layout" =>
				  array( 
						"label" => __("Media Position",'nietzsche'),
						"type" => "RadioUI",
						"options" => array(__('Left','nietzsche') => 'left',__('Bottom','nietzsche') => 'bottom',__('Right','nietzsche') => 'right',__('None','nietzsche') => 'none'),
						"description" => __("Position of the media block",'nietzsche'),
						"default" => 'left',
						 ),
				  "type" =>
				  array( 
						"label" => __("Media Type",'nietzsche'),
						"type" => "RadioUI",
						"options" => array(__('Image','nietzsche') => 'image',__('Video','nietzsche') => 'video',__('View','nietzsche') => 'view'),
						"description" => __("Position of the media block",'nietzsche'),
						"default" => 'image',
						 ),
				  "height" =>
				  array( 
						"label" => __("Media Height",'nietzsche'),
						"type" => "Number",
						"description" => __("Leave empty to avoid image cropping. In this case, slider based views will require all the (original) images to have the same size to work correctly.",'nietzsche'),
						"default" => '300'
						 ),
				  "image" =>
				  array( 
						"label" => __("Image",'nietzsche'),
						"type" => "Upload",
						"description" => __("Image",'nietzsche'),
						"default" => ''
						 ),
				  "video" => 
				  array(
						"label"=>__("Video",'nietzsche'),
						"type"=>"Select",
						"section"=>"main",
						"description" => __("Optional video",'nietzsche'),
						"options" => array_merge(array(__("None",'nietzsche')=>""),peTheme()->video->option()),
						"default"=>""
						),
				  "view" => 
				  array(
						"label" => __("View",'nietzsche'),
						"description" => __("Select the view to be shown.",'nietzsche'),
						"type" => "Select",
						"groups" => true,
						"options" => peTheme()->view->option(),
						"editable" => admin_url('post.php?post=%0&action=edit')
						),
				  );
		
	}

	public function blockClass() {
		return "nomargin";
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","feature");
	}

	public function tooltip() {
		return __("Use this block to add feature block to your layout. This consists of text content with an optional action button and a single image",'nietzsche');
	}


}

?>
