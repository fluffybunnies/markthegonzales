<?php

class PeThemeViewLayoutModuleNietzscheMediaGridAudio extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Audio' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'audio' => array(
				'label'       => __( 'Audio' ,'nietzsche'),
				'type'        => 'Upload',
				'description' => __( 'Audio url, in mp3 format.' ,'nietzsche'),
				'default'     => '',
			),
			'image' => array(
				'label'       => __( 'Image' ,'nietzsche'),
				'type'        => 'Upload',
				'description' => __( 'Image displayed in the grid behind the audio player.' ,'nietzsche'),
				'default'     => '',
			),
			'color' => array(
				'label'   => __( 'Player color' ,'nietzsche'),
				'type'    => 'RadioUI',
				'options' => array(
					__( 'Light' ,'nietzsche') => 'mejs-minimal-player',
					__( 'Dark' ,'nietzsche')  => '',
				),
				'default' => 'mejs-minimal-player',
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
				'default'     => 'landscape',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Audio' ,'nietzsche');
	}

	public function group() {
		return 'media-grid-item';
	}

	public function type() {
		return __( 'Content' ,'nietzsche');
	}

	public function templateName() {
		return 'media-grid-audio';
	}

	public function template() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

	public function tooltip() {
		return __( 'Use this block to add an audio to the media grid section.' ,'nietzsche');
	}

}

?>