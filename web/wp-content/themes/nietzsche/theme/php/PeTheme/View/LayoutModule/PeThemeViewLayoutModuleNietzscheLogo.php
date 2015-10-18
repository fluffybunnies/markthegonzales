<?php

class PeThemeViewLayoutModuleNietzscheLogo extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Logo' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'image' => array(
				'label'   => __( 'Image' ,'nietzsche'),
				'type'    => 'Upload',
				'default' => '',
			),
			'url' => array(
				'label'   => __( 'Url' ,'nietzsche'),
				'type'    => 'Text',
				'default' => '#',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Logo' ,'nietzsche');
	}

	public function group() {
		return 'logos';
	}

	public function templateName() {
		return 'logo';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule', $this->templateName() );

	}

}

?>