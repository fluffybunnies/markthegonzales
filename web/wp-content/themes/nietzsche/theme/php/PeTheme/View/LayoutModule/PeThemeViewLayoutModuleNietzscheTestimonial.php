<?php

class PeThemeViewLayoutModuleNietzscheTestimonial extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type' => __( 'Testimonial' ,'nietzsche')
		);

	}

	public function fields() {

		$fields = array(
			'name'    => $this->field( 'name' ),
			'css'     => $this->field( 'css' ),
			'bgcolor' => $this->field( 'bgcolor' ),
			'bgimage' => $this->field( 'bgimage' ),
			'color'   => $this->field( 'color' ),
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
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'testimonial';
	}

	public function template() {

		$t =& peTheme();

		$t->template->data( $this->data, $this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );
		
	}

	public function tooltip() {
		return __( 'Add an Testimonial section.' ,'nietzsche');
	}

}