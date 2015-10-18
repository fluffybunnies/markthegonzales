<?php

class PeThemeViewLayoutModuleNietzscheService extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Service' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'title' => array(
				'label'    => __( 'Title' ,'nietzsche'),
				'type'     => 'Text',
				'default'  => '',
				'datatype' => 'blocktitle',
			),
			'content' => array(
				'label'   => __( 'Content' ,'nietzsche'),
				'type'    => 'TextArea',
				'default' => '',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Service' ,'nietzsche');
	}

	public function group() {
		return 'services';
	}

	public function templateName() {
		return 'service';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

}

?>