<?php

class PeThemeViewLayoutModuleNietzscheSplashParallaxSlide extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Slide' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'     => $this->field( 'css' ),
			'image'   => array(
				'label'   => __( 'Slide image' ,'nietzsche'),
				'type'    => 'Upload',
				'default' => '',
			),
			'title'   => $this->field( 'title' ),
			'content' => $this->field( 'content' ),
			'align_x' => array(
				'label'    => __( 'Captions alignment' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'  => array(
					__( 'Left' ,'nietzsche')   => 'left',
					__( 'Center' ,'nietzsche') => 'center',
					__( 'Right' ,'nietzsche')  => 'right',
				),
				'default'  => 'left',
			),
			'color' => array(
				'label'    => __( 'Captions color' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'  => array(
					__( 'Light' ,'nietzsche') => 'color-white',
					__( 'Dark' ,'nietzsche')  => 'color-charcoal',
				),
				'default'  => 'color-charcoal',
			),
			'mobile_ratio' => array(
				'label'       => __( 'Slide ratio' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Ratio used when this slide is displayed on mobile screens.' ,'nietzsche'),
				'options'     => array(
					__( 'Landscape' ,'nietzsche') => '16/9',
					__( 'Portrait' ,'nietzsche')  => '9/16',
					__( 'Square' ,'nietzsche')    => '1/1',
				),
				'default' => '16/9',
			),
		);

		return $fields;

	}

	public function name() {
		return __( 'Slide' ,'nietzsche');
	}

	public function group() {
		return 'splash-parallax-item';
	}

	public function type() {
		return __( 'Content' ,'nietzsche');
	}

	public function templateName() {
		return 'splash-parallax-slide';
	}

	public function template() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

	public function tooltip() {
		return __( 'Use this block to add a Slide to the Parallax slider.' ,'nietzsche');
	}

}

?>