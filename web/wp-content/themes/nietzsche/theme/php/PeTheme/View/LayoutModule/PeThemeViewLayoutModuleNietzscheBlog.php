<?php

class PeThemeViewLayoutModuleNietzscheBlog extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Blog' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = peTheme()->data->customPostTypeMbox( 'post' );
		$fields = $fields['content'];

		$fields = array_merge(
			array(
				'name'    => $this->field( 'name' ),
				'css'     => $this->field( 'css' ),
				'bgcolor' => $this->field( 'bgcolor' ),
				'bgimage' => $this->field( 'bgimage' ),
				'sidebar' => array(
					'label'       => __( 'Sidebar' ,'nietzsche'),
					'type'        => 'RadioUI',
					'description' => __( 'Number of columns for the grid.' ,'nietzsche'),
					'options'     => array(
						__( 'Left' ,'nietzsche')  => 'left',
						__( 'Right' ,'nietzsche') => 'right',
						__( 'Hide' ,'nietzsche')  => 'hide',
					),
					'default'     => 'right',
				),
			),
			$fields
		);

		return $fields;

	}

	public function name() {
		return __( 'Blog' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'blog';
	}

	public function template() {
		$t =& peTheme();

		if ( $loop = $t->data->customLoop( $this->data ) ) {

			$t->template->data( $this->data, $this->conf->bid );
			$t->get_template_part( 'viewmodule', $this->templateName() );
			$t->content->resetLoop();
			
		}
	}

	public function tooltip() {
		return __( 'Add a Blog section showing posts in a standard blog list format.' ,'nietzsche');
	}

}

?>