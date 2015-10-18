<?php

class PeThemeViewLayoutModuleNietzscheTestimonialsSlider extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Testimonials Slider' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'name'       => $this->field( 'name' ),
			'css'        => $this->field( 'css' ),
			'bgcolor'    => $this->field( 'bgcolor' ),
			'bgimage'    => $this->field( 'bgimage' ),
			'color'      => $this->field( 'color' ),
			'navigation' => array(
				'label'       => __( 'Navigation style' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Choose between two navigation styles.' ,'nietzsche'),
				'options'     => array(
					__( 'Dark' ,'nietzsche')  => 'dark',
					__( 'Light' ,'nietzsche') => 'light',
				),
				'default'     => 'dark',
			),
		);

		return $fields;

	}

	public function allowed() {
		return 'testimonials-slider';
	}
	
	public function name() {
		return __( 'Testimonials Slider' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'testimonials-slider';
	}

	public function template() {

		$items = empty( $this->conf->items ) ? false : $this->conf->items;

		if ( ! is_array( $items ) ) {

			$items = array();

		}

		$t =& peTheme();

		$data = new StdClass();

		$i = 0;
		
		$instances = $this->instances;

		foreach ( $items as $item ) {

			$i++;
			$oitem = (object) $item;
			$oitem->view = $item;
			$oitem->data = (object) $oitem->data;
			$data->loop[] = $oitem;

		}

		$loop = $t->data->create( $data );

		$t->template->data( $this->data, $loop, $this->conf->bid );
		$t->get_template_part( 'viewmodule', $this->templateName() );

	}

	public function tooltip() {
		return __( 'Use this block to add a Testimonials Slider section.' ,'nietzsche');
	}

}

?>