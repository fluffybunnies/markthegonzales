<?php

class PeThemeViewLayoutModuleNietzscheMediaGridVideo extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Video' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'video' => array(
				'label'       => __( 'Video' ,'nietzsche'),
				'type'        => 'Text',
				'description' => __( 'Video url, Vimeo or YouTube only.' ,'nietzsche'),
				'default'     => '',
			),
			'lightbox' => array(
				'label'       => __( 'Open in lightbox' ,'nietzsche'),
				'type'        => 'RadioUI',
				'options'     => array(
					__( 'Yes' ,'nietzsche') => 'yes',
					__( 'No' ,'nietzsche')  => 'no',
				),
				'default'  => 'no',
			),
			'image' => array(
				'label'       => __( 'Image' ,'nietzsche'),
				'type'        => 'Upload',
				'description' => __( 'Image displayed in the grid that opens the video lightbox on click.' ,'nietzsche'),
				'default'     => '',
			),
			'lightbox_captions' => array(
				'label'   => __( 'Lightbox captions' ,'nietzsche'),
				'type'    => 'Text',
				'default' => '',
			),
			'color' => array(
				'label'       => __( 'Lightbox trigger color' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Color of the icon that opens the video lightbox.' ,'nietzsche'),
				'options'     => array(
					__( 'Light' ,'nietzsche') => 'color-white border-white bkg-hover-charcoal',
					__( 'Dark' ,'nietzsche')  => 'color-charcoal border-charcoal bkg-hover-white',
				),
				'default' => 'color-white border-white bkg-hover-charcoal',
			),
			'size' => array(
				'label'   => __( 'Item size' ,'nietzsche'),
				'type'    => 'Select',
				'options' => array(
					__( 'Normal - landscape' ,'nietzsche') => 'landscape',
					__( 'Normal - portrait' ,'nietzsche')  => 'portrait',
					__( 'Large - landscape' ,'nietzsche')  => 'large-landscape',
					__( 'Large - portrait' ,'nietzsche')  => 'large-portrait',
				),
				'description' => __( 'Specify the size of this item in the media grid.' ,'nietzsche'),
				'default'     => 'landscape',
			),
		);

		return $fields;

	}

	public function conditions() {

		return array(
			'lightbox' => array(
				'yes' =>	array(
					'show' => 'image,lightbox_captions',
				),
				'no' =>	array(
					'hide' => 'image,lightbox_captions',
				),
			),
		);
	}

	public function allowed() {
		return 'media-grid-item-child';
	}
	
	public function name() {
		return __( 'Video' ,'nietzsche');
	}

	public function group() {
		return 'media-grid-item';
	}

	public function type() {
		return __( 'Content' ,'nietzsche');
	}

	public function templateName() {
		return 'media-grid-video';
	}

	public function template() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

	public function tooltip() {
		return __( 'Use this block to add a video to the media grid section.' ,'nietzsche');
	}

}

?>