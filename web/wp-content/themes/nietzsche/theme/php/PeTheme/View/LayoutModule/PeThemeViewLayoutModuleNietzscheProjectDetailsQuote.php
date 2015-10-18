<?php

class PeThemeViewLayoutModuleNietzscheProjectDetailsQuote extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Quote' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'quote' => array(
				'label'       => __( 'Quote' ,'nietzsche'),
				'type'        => 'TextArea',
				'default'     => '',
			),
			'author' => array(
				'label'       => __( 'Author' ,'nietzsche'),
				'type'        => 'Text',
				'default'     => '',
				'datatype'    => 'blocktitle',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Quote' ,'nietzsche');
	}

	public function group() {
		return 'project-details';
	}

	public function templateName() {
		return 'project-details-quote';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule', $this->templateName() );

	}

}

?>