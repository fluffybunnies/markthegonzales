<?php

class PeThemeViewLayoutModuleNietzscheSplashSliderSlide extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Slide' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'image' => array(
				'label'       => __( 'Slide image' ,'nietzsche'),
				'type'        => 'Upload',
				'default'     => '',
			),
			'align_x' => array(
				'label'    => __( 'Horizontal captions alignment' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'Left' ,'nietzsche')   => 'left',
					__( 'Center' ,'nietzsche') => 'center',
					__( 'Right' ,'nietzsche')  => 'right',
				),
				'default'  => 'left',
			),
			'align_y' => array(
				'label'    => __( 'Vertical captions alignment' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'Top' ,'nietzsche')    => 'v-align-top',
					__( 'Middle' ,'nietzsche') => '',
					__( 'Bottom' ,'nietzsche') => 'v-align-bottom',
				),
				'default'  => '',
			),
			'video' => array(
				'label'       => __( 'Slide Video (mp4)' ,'nietzsche'),
				'type'        => 'Upload',
				'default'     => '',
			),
		);

		return $fields;

	}

	public function allowed() {
		return 'splash-slider-slide-caption';
	}
	
	public function name() {
		return __( 'Slide' ,'nietzsche');
	}

	public function group() {
		return 'splash-slider-slide';
	}

	public function create() {
		return 'NietzscheSplashSliderSlideCaption';
	}

	public function type() {
		return __( 'Content' ,'nietzsche');
	}

	public function templateName() {
		return 'splash-slider-slide';
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
		return __( 'Use this block to add a Slide to the Slider.' ,'nietzsche');
	}

}

?>