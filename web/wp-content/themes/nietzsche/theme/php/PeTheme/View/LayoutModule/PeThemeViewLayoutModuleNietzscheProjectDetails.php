<?php

class PeThemeViewLayoutModuleNietzscheProjectDetails extends PeThemeViewLayoutModuleContainer {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Project Details' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'name'          => $this->field( 'name' ),
			'css'           => $this->field( 'css' ),
			'bgcolor'       => $this->field( 'bgcolor' ),
			'bgimage'       => $this->field( 'bgimage' ),
			'project_image' => array(
				'label'       => __( 'Project image' ,'nietzsche'),
				'type'        => 'Upload',
				'description' => __( 'Image representing the project.' ,'nietzsche'),
				'default'     => '',
			),
			'project_title' => array(
				'label'       => __( 'Project title' ,'nietzsche'),
				'type'        => 'Text',
				'description' => __( 'Title of the project.' ,'nietzsche'),
				'default'     => '',
			),
			'project_details' => array(
				'label'        => __( 'Project details' ,'nietzsche'),
				'type'         => 'Items',
				'description'  => __( 'Add one or more details.' ,'nietzsche'),
				'button_label' => __( 'Add detail' ,'nietzsche'),
				'sortable'     => true,
				'auto'         => 'Client',
				'unique'       => false,
				'editable'     => false,
				'legend'       => false,
				'fields'       => 
				array(
					array(
						'label'   => 'Title',
						'name'    => 'title',
						'type'    => 'text',
						'width'   => 200,
						'default' => 'Client',
					),
					array(
						'label'   => 'Description',
						'name'    => 'description',
						'type'    => 'text',
						'width'   => 400,
						'default' => 'Angular Art Store.',
					),
				),
			),
			'project_details_display' => array(
				'label'       => __( 'Details display' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Choose between two different display modes for the project details.' ,'nietzsche'),
				'options'     => array(
					__( 'Horizontal' ,'nietzsche') => 'horizontal',
					__( 'Vertical' ,'nietzsche')   => 'vertical',
				),
				'default'     => 'vertical',
			),
			'project_details_link_text' => array(
				'label'       => __( 'Link text' ,'nietzsche'),
				'description' => __( 'Text for an optional link displayed below the project details.' ,'nietzsche'),
				'type'        => 'Text',
				'default'     => 'Launch Site',
			),
			'project_details_link_url' => array(
				'label'   => __( 'Link url' ,'nietzsche'),
				'type'    => 'Text',
				'default' => '#',
			),
			'display_share_links' => array(
				'label'       => __( 'Share links' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'If set to yes, share links for popular social networks will be displayed at the bottom of this section.' ,'nietzsche'),
				'options'     => array(
					__( 'Show' ,'nietzsche') => 'show',
					__( 'Hide' ,'nietzsche') => 'hide',
				),
				'default'     => 'show',
			),
			'share_links_text' => array(
				'label'       => __( 'Share text' ,'nietzsche'),
				'description' => __( 'Text displayed next to the share links.' ,'nietzsche'),
				'type'        => 'Text',
				'default'     => 'Share:',
			),
			'content_columns' => array(
				'label'       => __( 'Content columns' ,'nietzsche'),
				'type'        => 'RadioUI',
				'description' => __( 'Number of columns for the main content of this section.' ,'nietzsche'),
				'options'     => array(
					'1' => '1',
					'2' => '2',
				),
				'default'     => '2',
			),
		);

		return $fields;

	}

	public function conditions() {

		return array(
			'project_details_display' => array(
				'horizontal' =>	array(
					'hide' => 'project_details_link_text,project_details_link_url',
				),
				'vertical' =>	array(
					'show' => 'project_details_link_text,project_details_link_url',
				),
			),
			'display_share_links' => array(
				'show' =>	array(
					'show' => 'share_links_text',
				),
				'hide' =>	array(
					'hide' => 'share_links_text',
				),
			),
		);
	}

	public function allowed() {
		return 'project-details';
	}
	
	public function name() {
		return __( 'Project Details' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'project-details';
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
		return __( 'Use this block to add a Project Details section.' ,'nietzsche');
	}

}

?>