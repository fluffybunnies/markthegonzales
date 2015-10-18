<?php

class PeThemeViewLayoutModuleNietzscheMediaGridSlider extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Slider' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'image_align_middle' => array(
				'label'   => __( 'Vertically center' ,'nietzsche'),
				'type'    => 'RadioUI',
				'options' => array(
					__( 'Yes' ,'nietzsche') => 'yes',
					__( 'No' ,'nietzsche')  => 'no',
				),
				'description' => __( 'If set to yes, images that are smaller than the height of the slider will be vertically aligned in the middle.' ,'nietzsche'),
				'default' => 'no',
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
				'default' => 'landscape',
			),
		);

		return $fields;

	}

	public function allowed() {
		return 'media-grid-slider-slide';
	}
	
	public function name() {
		return __( 'Slider' ,'nietzsche');
	}

	public function group() {
		return 'media-grid-item';
	}

	public function type() {
		return __( 'Content' ,'nietzsche');
	}

	public function templateName() {
		return 'media-grid-slider';
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
		return __( 'Use this block to add a slider to the media grid section.' ,'nietzsche');
	}

}

?>