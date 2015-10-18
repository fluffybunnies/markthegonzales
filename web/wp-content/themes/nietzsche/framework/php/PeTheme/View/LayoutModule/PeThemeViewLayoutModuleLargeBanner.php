<?php

class PeThemeViewLayoutModuleLargeBanner extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  'title' => '',
				  'type' => __( 'Large Banner' ,'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
				'title' => array(
					'label'       => 'Title',
					'type'        => 'Text',
					'description' => __( 'Content' ,'nietzsche'),
					'default'     => ''
				),
				'content' => array(
					'label'       => 'Content',
					'type'        => 'TextArea',
					'description' => __( 'Content' ,'nietzsche'),
					'default'     => ''
				),
				'button_text' => array(
					'label'       => __( 'Button text' ,'nietzsche'),
					'description' => __( 'Text for optional button. Leave empty to not use the button.' ,'nietzsche'),
					'type'        => 'Text',
					'default'     => '',
				),
				'button_url' => array(
					'label'       => __( 'Button url' ,'nietzsche'),
					'description' => __( 'Url button will link to.' ,'nietzsche'),
					'type'        => 'Text',
					'default'     => '',
				),
				'button_target' => array(
					'label'       => __( 'Open in new window' ,'nietzsche'),
					'type'        => 'Select',
					'description' => __( 'Should the url be opened in new window?' ,'nietzsche'),
					'options'   => array(
						__( 'Yes' ,'nietzsche') => 'yes',
						__( 'No' ,'nietzsche')  => 'no',
					),
					'default'     => 'no',
				),
			);
	}

	public function name() {
		return __( 'Large Banner' ,'nietzsche');
	}

	public function setTemplateData() {
		$t =& peTheme();
		peTheme()->template->data( $this->data, $this->conf->bid );
	}

	public function template() {
		peTheme()->get_template_part( 'viewmodule', 'large-banner' );
	}

	public function tooltip() {
		return __( 'Add a Large banner section.' ,'nietzsche');
	}

}