<?php

class PeThemeViewLayoutModuleNietzscheMediaGridLightboxGallery extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Lightbox Gallery' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'image' => array(
				'label'       => __( 'Image' ,'nietzsche'),
				'type'        => 'Upload',
				'description' => __( 'Image displayed in the grid that opens the lightbox on click.' ,'nietzsche'),
				'default'     => '',
			),
			'captions' => array(
				'label'       => __( 'Captions display' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Choose between four different captions displays.' ,'nietzsche'),
				'options'     => array(
					__( 'Always' ,'nietzsche')   => 'always',
					__( 'Slide in' ,'nietzsche') => 'slidein',
					__( 'Fade in' ,'nietzsche')  => 'fadein',
					__( 'Hide' ,'nietzsche')     => 'hide',
				),
				'default'     => 'fadein',
			),
			'align_x' => array(
				'label'   => __( 'Horizontal captions alignment' ,'nietzsche'),
				'type'    => 'RadioUI',
				'options' => array(
					__( 'Left' ,'nietzsche')   => 'left',
					__( 'Center' ,'nietzsche') => 'center',
					__( 'Right' ,'nietzsche')  => 'right',
				),
				'default'  => 'left',
			),
			'align_y' => array(
				'label'   => __( 'Vertical captions alignment' ,'nietzsche'),
				'type'    => 'RadioUI',
				'options' => array(
					__( 'Top' ,'nietzsche')    => 'v-align-top',
					__( 'Middle' ,'nietzsche') => '',
					__( 'Bottom' ,'nietzsche') => 'v-align-bottom',
				),
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
		return 'media-grid-lightbox-gallery-image';
	}
	
	public function name() {
		return __( 'Lightbox Gallery' ,'nietzsche');
	}

	public function group() {
		return 'media-grid-item';
	}

	public function type() {
		return __( 'Content' ,'nietzsche');
	}

	public function templateName() {
		return 'media-grid-lightbox-gallery';
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
		return __( 'Use this block to add a lightbox gallery to the media grid section.' ,'nietzsche');
	}

}

?>