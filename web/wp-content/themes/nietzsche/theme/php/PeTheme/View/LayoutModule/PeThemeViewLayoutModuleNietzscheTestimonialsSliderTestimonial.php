<?php

class PeThemeViewLayoutModuleNietzscheTestimonialsSliderTestimonial extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Testimonial' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'testimonial' => array(
				'label'    => __( 'Testimonial' ,'nietzsche'),
				'type'     => 'TextArea',
				'default'  => '',
			),
			'author' => array(
				'label'   => __( 'Author' ,'nietzsche'),
				'type'    => 'Text',
				'default' => '',
				'datatype' => 'blocktitle',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Testimonial' ,'nietzsche');
	}

	public function group() {
		return 'testimonials-slider';
	}

	public function templateName() {
		return 'testimonials-slider-testimonial';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

}

?>