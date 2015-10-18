<?php

class PeThemeViewLayoutModuleNietzscheContact extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Contact' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'name'            => $this->field( 'name' ),
			'css'             => $this->field( 'css' ),
			'bgcolor'         => $this->field( 'bgcolor' ),
			'bgimage'         => $this->field( 'bgimage' ),
			'color'           => $this->field( 'color' ),
		);

		return $fields;

	}

	public function allowed() {
		return 'contact';
	}
	
	public function name() {
		return __( 'Contact' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'contact';
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
		return __( 'Use this block to add a Contact section.' ,'nietzsche');
	}

}

?>