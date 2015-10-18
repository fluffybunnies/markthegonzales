<?php

class PeThemeViewLayoutModuleNietzscheContactForm extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Contact Form' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'title' => $this->field( 'title' ),
			'title_color' => array(
				'label'       => __( 'Title color' ,'nietzsche'),
				'type'        => 'Color',
				'default'     => '',
			),
			'msgOK' => array(
				'label'       => __( 'Mail Sent Message' ,'nietzsche'),
				'type'        => 'TextArea',
				'description' => __( 'Message shown when form message has been sent without errors' ,'nietzsche'),
				'default'     => '<strong>Yay!</strong> Message sent.',
			),
			'msgKO' => array(
				'label'       => __( 'Form Error Message' ,'nietzsche'),
				'type'        => 'TextArea',
				'description' => __( 'Message shown when form message encountered errors' ,'nietzsche'),
				'default'     => '<strong>Error!</strong> Please validate your fields.',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Contact Form' ,'nietzsche');
	}

	public function group() {
		return 'contact';
	}

	public function templateName() {
		return 'contact-form';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule', $this->templateName() );

	}

	public function tooltip() {
		return __( 'Use this block to add a Contact Form.' ,'nietzsche');
	}

}

?>