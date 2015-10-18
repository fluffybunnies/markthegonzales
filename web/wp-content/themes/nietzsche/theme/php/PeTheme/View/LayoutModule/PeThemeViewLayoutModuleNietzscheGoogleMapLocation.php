<?php

class PeThemeViewLayoutModuleNietzscheGoogleMapLocation extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Location' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'lat' => array(
				'label'   => __( 'Latitude' ,'nietzsche'),
				'type'    => 'Text',
				'default' => '',
			),
			'lon' => array(
				'label'   => __( 'Longitude' ,'nietzsche'),
				'type'    => 'Text',
				'default' => '',
			),
			'marker' => array(
				'label'   => __( 'Marker' ,'nietzsche'),
				'type'    => 'Upload',
				'default' => '',
			),
			'description' => array(
				'label'   => __( 'Description' ,'nietzsche'),
				'type'    => 'Text',
				'default' => '',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Location' ,'nietzsche');
	}

	public function group() {
		return 'google-map';
	}

	public function templateName() {
		return 'google-map-location';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

}

?>