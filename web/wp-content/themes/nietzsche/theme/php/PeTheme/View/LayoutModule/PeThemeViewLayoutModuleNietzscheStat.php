<?php

class PeThemeViewLayoutModuleNietzscheStat extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Stat' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'stats' => array(
				'label'        => __( 'Stats' ,'nietzsche'),
				'type'         => 'Items',
				'description'  => __( 'Add one or more statistics.' ,'nietzsche'),
				'button_label' => __( 'Add statistic' ,'nietzsche'),
				'sortable'     => true,
				'auto'         => 'Projects completed',
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
						'default' => 'Projects completed',
					),
					array(
						'label'   => 'Description',
						'name'    => 'description',
						'type'    => 'text',
						'width'   => 200, 
						'default' => '1,895',
					),
					array(
						'label'   => 'Suffix',
						'name'    => 'suffix',
						'type'    => 'text',
						'width'   => 50, 
						'default' => '+',
					),
					array(
						'label'   => 'From',
						'name'    => 'from',
						'type'    => 'text',
						'width'   => 100, 
						'default' => '1695',
					),
					array(
						'label'   => 'To',
						'name'    => 'to',
						'type'    => 'text',
						'width'   => 100, 
						'default' => '1895',
					),
				),
			),
			'size' => array(
				'label'       => __( 'Size' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Choose between two different font sizes.' ,'nietzsche'),
				'options'     => array(
					__( 'Normal' ,'nietzsche') => 'normal',
					__( 'Large' ,'nietzsche')  => 'large',
				),
				'default'     => 'normal',
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Stat' ,'nietzsche');
	}

	public function group() {
		return 'stats';
	}

	public function templateName() {
		return 'stat';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

}

?>