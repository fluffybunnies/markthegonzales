<?php

class PeThemeViewLayoutModuleNietzscheSplashImageVideo extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Video' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'css'  => $this->field( 'css' ),
			'url' => array(
				'label'    => __( 'Video url' ,'nietzsche'),
				'type'     => 'Text',
				'description' => __( 'Video url, Vimeo or YouTube only.' ,'nietzsche'),
				'default'  => '',
				'datatype' => 'blocktitle',
			),
		);

		return $fields;

	}

	public function conditions() {

		return array(
			'element' => array(
				'h1' =>	array(
					'show' => 'margin',
				),
				'p' =>	array(
					'show' => 'margin',
				),
				'span' =>	array(
					'hide' => 'margin',
				),
			),
		);
	}
	
	public function name() {
		return __( 'Video' ,'nietzsche');
	}

	public function group() {
		return 'splash-image-caption';
	}

	public function templateName() {
		return 'splash-image-video';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

}

?>