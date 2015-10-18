<?php

class PeThemeViewLayoutModuleNietzscheSplashImageCaption extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Caption' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'  => $this->field( 'css' ),
			'text' => array(
				'label'    => __( 'Text' ,'nietzsche'),
				'type'     => 'Text',
				'default'  => '',
				'datatype' => 'blocktitle',
			),
			'font' => array(
				'label'    => __( 'Font' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'General' ,'nietzsche')     => '',
					__( 'Alternative' ,'nietzsche') => 'font-alt-2',
				),
				'default'  => '',
			),
			'size' => array(
				'label'    => __( 'Size' ,'nietzsche'),
				'type'     => 'Select',
				'options'     => array(
					__( 'Title small' ,'nietzsche')  => 'title-small',
					__( 'Title medium' ,'nietzsche') => 'title-medium',
					__( 'Title large' ,'nietzsche')  => 'title-large',
					__( 'Text small' ,'nietzsche')   => 'text-small',
					__( 'Text medium' ,'nietzsche')  => 'text-medium',
					__( 'Text large' ,'nietzsche')   => 'text-large',
				),
				'default'  => 'text-medium',
			),
			'weight' => array(
				'label'    => __( 'Weight' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'Light' ,'nietzsche')  => 'weight-light',
					__( 'Normal' ,'nietzsche') => '',
					__( 'Bold' ,'nietzsche')   => 'weight-bold',
				),
				'default'  => '',
			),
			'color' => array(
				'label'    => __( 'Color' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'Light' ,'nietzsche') => 'color-white',
					__( 'Dark' ,'nietzsche')  => '',
				),
				'default'  => 'color-white',
			),
			'element' => array(
				'label'    => __( 'Element' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'h1' ,'nietzsche')   => 'h1',
					__( 'p' ,'nietzsche')    => 'p',
					__( 'span' ,'nietzsche') => 'span',
				),
				'default'  => 'span',
			),
			'margin' => array(
				'label'    => __( 'Margin' ,'nietzsche'),
				'type'     => 'Select',
				'options'     => array(
					__( 'Normal' ,'nietzsche')           => '',
					__( 'No margins' ,'nietzsche')       => 'no-margins',
					__( 'No margin top' ,'nietzsche')    => 'no-margin-top',
					__( 'No margin bottom' ,'nietzsche') => 'no-margin-bottom',
				),
				'default'  => 'no-margin-bottom',
			),
		);

		return $fields;

	}

	public function conditions() {

		return array(
			'element' => array(
				'h1' =>	array(
					'show' => 'margin',
				),
				'p' =>	array(
					'show' => 'margin',
				),
				'span' =>	array(
					'hide' => 'margin',
				),
			),
		);
	}
	
	public function name() {
		return __( 'Caption' ,'nietzsche');
	}

	public function group() {
		return 'splash-image-caption';
	}

	public function templateName() {
		return 'splash-image-caption';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

}

?>