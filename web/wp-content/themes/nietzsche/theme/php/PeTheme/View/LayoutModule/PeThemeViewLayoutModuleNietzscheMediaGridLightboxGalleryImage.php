<?php

class PeThemeViewLayoutModuleNietzscheMediaGridLightboxGalleryImage extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Image' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'image' => array(
				'label'       => __( 'Image' ,'nietzsche'),
				'type'        => 'Upload',
				'default'     => '',
			),
			'lightbox_captions' => array(
				'label'       => __( 'Captions' ,'nietzsche'),
				'type'        => 'Text',
				'default'     => '',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Image' ,'nietzsche');
	}

	public function group() {
		return 'media-grid-lightbox-gallery-image';
	}

	public function type() {
		return __( 'Content' ,'nietzsche');
	}

	public function templateName() {
		return 'media-grid-lightbox-gallery-image';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

	public function tooltip() {
		return __( 'Use this block to add an image to the lightbox gallery.' ,'nietzsche');
	}

}

?>