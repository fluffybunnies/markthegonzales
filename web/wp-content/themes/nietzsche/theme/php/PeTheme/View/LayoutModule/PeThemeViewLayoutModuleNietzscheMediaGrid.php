<?php

class PeThemeViewLayoutModuleNietzscheMediaGrid extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Media Grid' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'name'            => $this->field( 'name' ),
			'css'             => $this->field( 'css' ),
			'bgcolor'         => $this->field( 'bgcolor' ),
			'bgimage'         => $this->field( 'bgimage' ),
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
				'default'     => 'no',
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
		);

		return $fields;

	}

	public function allowed() {
		return 'media-grid-item';
	}
	
	public function name() {
		return __( 'Media Grid' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'media-grid';
	}

	public function template() {

		$items = empty( $this->conf->items ) ? false : $this->conf->items;

		if ( ! is_array( $items ) ) {

			$items = array();

		}

		$t =& peTheme();

		$data = new StdClass();

		$i = 0;
		
		$instances = $this->instances;

		foreach ( $items as $item ) {

			$i++;
			$oitem = (object) $item;
			$oitem->view = $item;
			$oitem->data = (object) $oitem->data;
			$data->loop[] = $oitem;

		}

		$loop = $t->data->create( $data );

		$t->template->data( $this->data, $loop, $this->conf->bid );
		$t->get_template_part( 'viewmodule', $this->templateName() );

	}

	public function tooltip() {
		return __( 'Use this block to add a Media Grid section.' ,'nietzsche');
	}

}

?>