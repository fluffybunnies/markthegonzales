<?php

class PeThemeViewLayoutModuleNietzscheGoogleMap extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type' => __( 'Google Map' ,'nietzsche')
		);

	}

	public function fields() {

		$fields = array(
			'name'    => $this->field( 'name' ),
			'css'     => $this->field( 'css' ),
			'bgcolor' => $this->field( 'bgcolor' ),
			'bgimage' => $this->field( 'bgimage' ),
			'color'   => $this->field( 'color' ),
			'title'   => $this->field( 'title' ),
			'title_color' => array(
				'label'   => __( 'Title color' ,'nietzsche'),
				'type'    => 'Color',
				'default' => '',
			),
			'description' => $this->field( 'description' ),
			'zoom' => array(
				'label'       => __( 'Map zoom' ,'nietzsche'),
				'type'        => 'Text',
				'description' => __( 'Map zoom level. 0 is fully zoomed out.' ,'nietzsche'),
				'default'     => '12',
			),
		);

		return $fields;

	}

	public function allowed() {
		return 'google-map';
	}

	public function name() {
		return __( 'Google Map' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'google-map';
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
		return __( 'Add a Google Map section.' ,'nietzsche');
	}

}