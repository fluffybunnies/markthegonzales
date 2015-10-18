<?php

class PeThemeViewLayoutModuleNietzscheContactDetails extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Contact Details' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'name'            => $this->field( 'name' ),
			'css'             => $this->field( 'css' ),
			'bgcolor'         => $this->field( 'bgcolor' ),
			'bgimage'         => $this->field( 'bgimage' ),
			'color'           => $this->field( 'color' ),
			'title'           => $this->field( 'title' ),
			'title_color' => array(
				'label'       => __( 'Title color' ,'nietzsche'),
				'type'        => 'Color',
				'default'     => '',
			),
			'subtitle'        => $this->field( 'subtitle' ),
			'description'     => $this->field( 'description' ),
			'details' => array(
				'label'        => __( 'Details' ,'nietzsche'),
				'type'         => 'Items',
				'description'  => __( 'Add one or more details.' ,'nietzsche'),
				'button_label' => __( 'Add detail' ,'nietzsche'),
				'sortable'     => true,
				'auto'         => 'Email',
				'unique'       => false,
				'editable'     => false,
				'legend'       => false,
				'fields'       => 
				array(
					array(
						'label'   => 'Title',
						'name'    => 'title',
						'type'    => 'text',
						'width'   => 200,
						'default' => 'Email:',
					),
					array(
						'label'   => 'Description',
						'name'    => 'description',
						'type'    => 'text',
						'width'   => 400,
						'default' => '<a class="color-hover-white" href="mailto:#">info@nietzsche.com</a>',
					),
				),
			),
			'padding' => array(
				'label'       => __( 'Padding' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Set to yes if you specified custom background color for this block.' ,'nietzsche'),
				'options'     => array(
					__( 'Yes' ,'nietzsche') => 'yes',
					__( 'No' ,'nietzsche')  => 'no',
				),
				'default'     => 'no',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Contact Details' ,'nietzsche');
	}

	public function group() {
		return 'contact';
	}

	public function templateName() {
		return 'contact-details';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule', $this->templateName() );

	}

	public function tooltip() {
		return __( 'Use this block to add a Contact Details.' ,'nietzsche');
	}

}

?>