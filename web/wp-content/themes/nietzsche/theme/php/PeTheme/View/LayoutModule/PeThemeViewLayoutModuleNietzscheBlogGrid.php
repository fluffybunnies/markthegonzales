<?php

class PeThemeViewLayoutModuleNietzscheBlogGrid extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Blog Grid' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = peTheme()->data->customPostTypeMbox( 'post' );
		$fields = $fields['content'];

		$fields = array_merge(
			array(
				'name'       => $this->field( 'name' ),
				'css'        => $this->field( 'css' ),
				'bgcolor'    => $this->field( 'bgcolor' ),
				'bgimage'    => $this->field( 'bgimage' ),
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
			),
			$fields
		);

		return $fields;

	}

	public function name() {
		return __( 'Blog Grid' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'blog-grid';
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
		return __( 'Add a Blog section showing posts in a grid format.' ,'nietzsche');
	}

}

?>