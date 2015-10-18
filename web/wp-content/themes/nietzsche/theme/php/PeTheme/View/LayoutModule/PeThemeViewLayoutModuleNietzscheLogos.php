<?php

class PeThemeViewLayoutModuleNietzscheLogos extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Logos' ,'nietzsche'),
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
			'divider' => array(
				'label'       => __( 'Divider' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Set to Show if you want to display the divider between the section title and the rest of the content.' ,'nietzsche'),
				'options'     => array(
					__( 'Show' ,'nietzsche') => 'show',
					__( 'Hide' ,'nietzsche') => 'hide',
				),
				'default'     => 'show',
			),
			'description'     => $this->field( 'description' ),
			'content'         => $this->field( 'content' ),
			'content_columns' => array(
				'label'       => __( 'Content columns' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Number of columns for the logos grid.' ,'nietzsche'),
				'options'     => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'default'     => '4',
			),
			'style' => array(
				'label'       => __( 'Style' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Choose between different logos display styles.' ,'nietzsche'),
				'options'     => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'default'     => '1',
			),
		);

		return $fields;

	}

	public function allowed() {
		return 'logos';
	}
	
	public function name() {
		return __( 'Logos' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'logos';
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
		return __( 'Use this block to add a Logos section.' ,'nietzsche');
	}

}

?>