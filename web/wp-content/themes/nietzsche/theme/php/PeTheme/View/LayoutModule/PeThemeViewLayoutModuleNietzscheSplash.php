<?php

class PeThemeViewLayoutModuleNietzscheSplash extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Splash' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'name' => $this->field( 'name' ),
			'css'  => $this->field( 'css' ),
		);

		return $fields;

	}

	public function allowed() {
		return 'splash';
	}
	
	public function name() {
		return __( 'Splash' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	// only a single instance of this block is allowed
	public function unique() {
		return true;
	}

	// add block on top of the list
	public function prepend() {
		return true;
	}

	public function sortable() {
		return false;
	}

	public function templateName() {
		return 'splash';
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
		return __( 'Use this block to add a Splash section.' ,'nietzsche');
	}

}

?>