<?php

class PeThemeViewLayoutModuleNietzscheSplashSlider extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Splash Slider' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'     => $this->field( 'css' ),
			'bgcolor' => $this->field( 'bgcolor' ),
			'scale'   => array(
				'label'    => __( 'Scale' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'Fullscreen' ,'nietzsche') => 'fullscreen',
					__( 'Fit' ,'nietzsche')        => 'full-width-slider',
				),
				'default'  => 'fullscreen',
			),
		);

		return $fields;

	}

	public function allowed() {
		return 'splash-slider-slide';
	}
	
	public function name() {
		return __( 'Splash Slider' ,'nietzsche');
	}

	public function group() {
		return 'splash';
	}

	public function create() {
		return 'NietzscheSplashSliderSlide';
	}

	public function force() {
		return 'NietzscheSplashSliderSlide';
	}

	public function type() {
		return __( 'Content' ,'nietzsche');
	}

	public function templateName() {
		return 'splash-slider';
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
		return __( 'Use this block to add a Slider to the Splash section.' ,'nietzsche');
	}

}

?>