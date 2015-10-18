<?php

class PeThemeViewLayoutModuleNietzscheSplashImage extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Splash Image' ,'nietzsche'),
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
					__( 'Fit' ,'nietzsche')        => 'fixed-height',
				),
				'default'  => 'fullscreen',
			),
			'image' => array(
				'label'       => __( 'Splash image' ,'nietzsche'),
				'type'        => 'Upload',
				'default'     => '',
			),
			'image_position' => array(
				'label'       => __( 'Image position' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'Parallax' ,'nietzsche') => 'parallax',
					__( 'Fixed' ,'nietzsche')    => 'fake-parallax background-fixed',
					__( 'Normal' ,'nietzsche')   => '',
				),
				'default'  => 'parallax',
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
		);

		return $fields;

	}

	public function allowed() {
		return 'splash-image-caption';
	}
	
	public function name() {
		return __( 'Splash Image' ,'nietzsche');
	}

	public function group() {
		return 'splash';
	}

	public function create() {
		return 'NietzscheSplashImageCaption';
	}

	public function type() {
		return __( 'Content' ,'nietzsche');
	}

	public function templateName() {
		return 'splash-image';
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
		return __( 'Use this block to add an Image to the Splash section.' ,'nietzsche');
	}

}

?>