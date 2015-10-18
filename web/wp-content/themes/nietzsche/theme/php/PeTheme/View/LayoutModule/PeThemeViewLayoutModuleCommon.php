<?php

class PeThemeViewLayoutModuleCommon {

	public static function fields() {
		return array(
			'name' => array(
				'label'       => __( 'Link Name' ,'nietzsche'),
				'type'        => 'Text',
				'description' => __( 'Used when linking to the block in a page (eg, from the menu).' ,'nietzsche'),
				'default'     => '',
				'datatype'    => 'blocktitle'
			),
			'css' => array(
				'label'       => __( 'Block style' ,'nietzsche'),
				'type'        => 'Text',
				'description' => __( 'You can enter here your custom css which will be applied to this block only through the use of style attribute.' ,'nietzsche'),
				'default'     => '',
			),
			'bgcolor' => array(
				'label'       => __( 'Background color' ,'nietzsche'),
				'type'        => 'Color',
				'description' => __( 'Background color of the block.' ,'nietzsche'),
				'default'     => '',
			),
			'bgimage' => array(
				'label'       => __( 'Background image' ,'nietzsche'),
				'type'        => 'Upload',
				'description' => __( 'Background image of the block.' ,'nietzsche'),
				'default'     => '',
			),
			'color' => array(
				'label'       => __( 'Text color' ,'nietzsche'),
				'type'        => 'Color',
				'description' => __( 'Text color of the block.' ,'nietzsche'),
				'default'     => '',
			),
			'title' => array(
				'label'       => __( 'Title' ,'nietzsche'),
				'type'        => 'Text',
				'description' => __( 'Block title.' ,'nietzsche'),
				'default'     => '',
				'datatype'    => 'blocktitle',
			),
			'subtitle' => array(
				'label'       => __( 'Subtitle' ,'nietzsche'),
				'type'        => 'Text',
				'description' => __( 'Block subtitle.' ,'nietzsche'),
				'default'     => '',
			),
			'content' => array(
				'label'       => __( 'Content' ,'nietzsche'),
				'type'        => 'TextArea',
				'description' => __( 'Block content.' ,'nietzsche'),
				'default'     => '',
			),
			'description' => array(
				'label'       => __( 'Description' ,'nietzsche'),
				'type'        => 'TextArea',
				'description' => __( 'Block description.' ,'nietzsche'),
				'default'     => '',
			),
		);
	}
}

?>
