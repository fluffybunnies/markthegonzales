<?php

class PeThemeViewLayoutModuleNietzscheStats extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Stats' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'name'            => $this->field( 'name' ),
			'css'             => $this->field( 'css' ),
			'bgcolor'         => $this->field( 'bgcolor' ),
			'bgimage'         => $this->field( 'bgimage' ),
			'color'           => $this->field( 'color' ),
			'content_columns' => array(
				'label'       => __( 'Content columns' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Number of columns for the main content of this section.' ,'nietzsche'),
				'options'     => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'default'     => '4',
			),
			'style' => array(
				'label'       => __( 'Style' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Choose between two different styles.' ,'nietzsche'),
				'options'     => array(
					'1' => '2',
					'2' => '3',
				),
				'default'     => '2',
			),
		);

		return $fields;

	}

	public function allowed() {
		return 'stats';
	}
	
	public function name() {
		return __( 'Stats' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'stats';
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
		return __( 'Use this block to add a Stats section.' ,'nietzsche');
	}

}

?>