<?php

class PeThemeViewLayoutModuleNietzscheProjectDetailsText extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Text' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'title' => array(
				'label'       => __( 'Title' ,'nietzsche'),
				'type'        => 'Text',
				'default'     => '',
				'datatype'    => 'blocktitle',
			),
			'content' => array(
				'label'       => __( 'Content' ,'nietzsche'),
				'type'        => 'TextArea',
				'default'     => '',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Text' ,'nietzsche');
	}

	public function group() {
		return 'project-details';
	}

	public function templateName() {
		return 'project-details-text';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule', $this->templateName() );

	}

}

?>