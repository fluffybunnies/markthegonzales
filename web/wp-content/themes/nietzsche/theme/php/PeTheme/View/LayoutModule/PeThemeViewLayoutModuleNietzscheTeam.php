<?php

class PeThemeViewLayoutModuleNietzscheTeam extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Team' ,'nietzsche'),
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
			'description'     => $this->field( 'description' ),
			'content'         => $this->field( 'content' ),
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
				'default'     => '3',
			),
			'style' => array(
				'label'       => __( 'Style' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Choose between three different display styles for team members.' ,'nietzsche'),
				'options'     => array(
					__( 'Grid 1' ,'nietzsche')   => '1',
					__( 'Grid 2' ,'nietzsche')   => '2',
					__( 'Carousel' ,'nietzsche') => '3',
				),
				'default'     => '1',
			),
			'overlay' => array(
				'label'       => __( 'Overlay display' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Choose between two different overlays displays.' ,'nietzsche'),
				'options'     => array(
					__( 'Slide in' ,'nietzsche') => 'slidein',
					__( 'Fade in' ,'nietzsche')  => 'fadein',
				),
				'default'     => 'slidein',
			),
		);

		return $fields;

	}

	public function conditions() {

		return array(
			'style' => array(
				'1' =>	array(
					'hide' => 'overlay',
				),
				'2' =>	array(
					'show' => 'overlay',
				),
				'3' =>	array(
					'hide' => 'overlay',
				),
			),
		);
	}

	public function allowed() {
		return 'team';
	}
	
	public function name() {
		return __( 'Team' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'team';
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
		return __( 'Use this block to add a Team section.' ,'nietzsche');
	}

}

?>