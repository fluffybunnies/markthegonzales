<?php

class PeThemeViewLayoutModuleNietzscheProjectsGrid extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type' => __( 'Projects Grid' ,'nietzsche')
		);

	}

	public function fields() {

		$fields = peTheme()->data->customPostTypeMbox( 'project' );
		$fields = $fields['content'];

		$fields = array_merge(
			array(
				'name'    => $this->field( 'name' ),
				'css'     => $this->field( 'css' ),
				'bgcolor' => $this->field( 'bgcolor' ),
				'bgimage' => $this->field( 'bgimage' ),
				'show_filters' => array(
					'label'       => __( 'Show filters' ,'nietzsche'),
					'type'        => 'RadioUI',
					'description' => __( 'Set to yes if you want to display tag based filters for the grid.' ,'nietzsche'),
					'options'     => array(
						__( 'Yes' ,'nietzsche') => 'yes',
						__( 'No' ,'nietzsche')  => 'no',
					),
					'default'     => 'yes',
				),
				'full_width' => array(
					'label'       => __( 'Full width' ,'nietzsche'),
					'type'        => 'RadioUI',
					'description' => __( 'Set to yes if you want grid to take up full width of the page.' ,'nietzsche'),
					'options'     => array(
						__( 'Yes' ,'nietzsche') => 'yes',
						__( 'No' ,'nietzsche')  => 'no',
					),
					'default'     => 'no',
				),
				'grid_spacing' => array(
					'label'       => __( 'Grid spacing' ,'nietzsche'),
					'type'        => 'RadioUI',
					'description' => __( 'Set to yes if you want grid items to have empty space around them.' ,'nietzsche'),
					'options'     => array(
						__( 'Yes' ,'nietzsche') => 'yes',
						__( 'No' ,'nietzsche')  => 'no',
					),
					'default'     => 'yes',
				),
				'columns' => array(
					'label'       => __( 'Columns' ,'nietzsche'),
					'type'        => 'RadioUI',
					'description' => __( 'Number of columns for the grid.' ,'nietzsche'),
					'options'     => array(
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
					),
					'default'     => '3',
				),
				'captions' => array(
					'label'       => __( 'Captions display' ,'nietzsche'),
					'type'        => 'RadioUI',
					'description' => __( 'Choose between three different captions displays.' ,'nietzsche'),
					'options'     => array(
						__( 'Slide in' ,'nietzsche') => 'slidein',
						__( 'Fade in' ,'nietzsche')  => 'fadein',
						__( 'Hide' ,'nietzsche')     => 'hide',
					),
					'default'     => 'slidein',
				),
			),
			$fields
		);

		unset( $fields['pager'] );

		return $fields;

	}

	public function name() {
		return __( 'Projects Grid' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'projects-grid';
	}

	public function template() {

		$t =& peTheme();

		if ( $loop = $t->data->customLoop( $this->data ) ) {

			$t->template->data( $this->data, $this->conf->bid );
			$t->get_template_part( 'viewmodule' , $this->templateName() );

			$t->content->resetLoop();

		}

	}

	public function tooltip() {
		return __( 'Add a Projects Grid section.' ,'nietzsche');
	}

}