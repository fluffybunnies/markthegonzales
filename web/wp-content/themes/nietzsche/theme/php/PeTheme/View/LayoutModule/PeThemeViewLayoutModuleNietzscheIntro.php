<?php

class PeThemeViewLayoutModuleNietzscheIntro extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type' => __( 'Intro' ,'nietzsche')
		);

	}

	public function fields() {

		$fields = array(
			'name'    => $this->field( 'name' ),
			'css'     => $this->field( 'css' ),
			'bgcolor' => $this->field( 'bgcolor' ),
			'bgimage' => $this->field( 'bgimage' ),
			'color'   => $this->field( 'color' ),
			'title'   => $this->field( 'title' ),
			'content' => $this->field( 'content' ),
		);

		return $fields;

	}

	public function name() {
		return __( 'Intro' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'intro';
	}

	public function template() {

		$t =& peTheme();

		$t->template->data( $this->data, $this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );
		
	}

	public function tooltip() {
		return __( 'Add an Intro section.' ,'nietzsche');
	}

}