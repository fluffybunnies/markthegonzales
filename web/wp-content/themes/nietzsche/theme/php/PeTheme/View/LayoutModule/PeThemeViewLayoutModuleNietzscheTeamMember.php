<?php

class PeThemeViewLayoutModuleNietzscheTeamMember extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Team Member' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'   => $this->field( 'css' ),
			'name' => array(
				'label'    => __( 'Name' ,'nietzsche'),
				'type'     => 'Text',
				'default'  => '',
				'datatype' => 'blocktitle',
			),
			'role' => array(
				'label'    => __( 'Role' ,'nietzsche'),
				'type'     => 'Text',
				'default'  => '',
			),
			'image' => array(
				'label'   => __( 'Image' ,'nietzsche'),
				'type'    => 'Upload',
				'default' => '',
			),
			'signature' => array(
				'label'   => __( 'Signature' ,'nietzsche'),
				'type'    => 'Upload',
				'default' => '',
			),
			'description' => array(
				'label'   => __( 'Description' ,'nietzsche'),
				'type'    => 'TextArea',
				'default' => '',
			),
			'social_icons' => array(
				'label'       => __( 'Social icons' ,'nietzsche'),
				'type'         => 'Items',
				'button_label' => __( 'Add Icon' ,'nietzsche'),
				'sortable'     => true,
				'auto'         => 'icon-facebook',
				'unique'       => false,
				'editable'     => false,
				'legend'       => false,
				'fields'       => 
				array(
					array(
						'label'   => 'Icon',
						'name'    => 'icon',
						'type'    => 'icon',
						'width'   => 200, 
						'default' => 'icon-facebook',
					),
					array(
						'label'   => 'Url',
						'name'    => 'url',
						'type'    => 'text',
						'width'   => 300, 
						'default' => '#',
					),
				),
			),
		);

		return $fields;

	}
	
	public function name() {
		return __( 'Team Member' ,'nietzsche');
	}

	public function group() {
		return 'team';
	}

	public function templateName() {
		return 'team-member';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

}

?>