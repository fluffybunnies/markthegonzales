<?php

class PeThemeViewLayoutModuleNietzscheSplashSliderSlideLightbox extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Video Lightbox' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'  => $this->field( 'css' ),
			'video' => array(
				'label'       => __( 'Video' ,'nietzsche'),
				'type'        => 'Text',
				'default'     => '',
				'description' => __( 'Will be displayed in the lightbox. Vimeo and YouTube supported.' ,'nietzsche'),
			),
			'color' => array(
				'label'    => __( 'Color' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'Light' ,'nietzsche') => 'color-white border-white bkg-hover-charcoal',
					__( 'Dark' ,'nietzsche')  => 'color-charcoal border-charcoal bkg-hover-white',
				),
				'default'  => 'color-white border-white bkg-hover-charcoal',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Lightbox' ,'nietzsche');
	}

	public function group() {
		return 'splash-slider-slide-caption';
	}

	public function templateName() {
		return 'splash-slider-slide-lightbox';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

}

?>