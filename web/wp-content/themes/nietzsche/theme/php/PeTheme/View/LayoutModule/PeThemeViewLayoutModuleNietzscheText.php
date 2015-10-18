<?php

class PeThemeViewLayoutModuleNietzscheText extends PeThemeViewLayoutModuleText {

	public function fields() {

		$fields = array();
		$fields['css'] = $this->field( 'css' );
		$fields = array_merge( $fields, parent::fields() );

		unset( $fields['layout'] );

		return $fields;

	}

	public function group() {
		return 'column';
	}

	public function templateName() {
		return 'text';
	}

	public function render() {

		$t =& peTheme();

		$t->template->data( $this->data,$this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );

	}

}

?>