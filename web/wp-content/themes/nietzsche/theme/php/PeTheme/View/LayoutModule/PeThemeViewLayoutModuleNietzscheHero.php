<?php

class PeThemeViewLayoutModuleNietzscheHero extends PeThemeViewLayoutModule {

	public function messages() {

		return array(
			'title' => '',
			'type' => __( 'Hero' ,'nietzsche')
		);

	}

	public function fields() {

		$fields = array(
			'name'    => $this->field( 'name' ),
			'css'     => $this->field( 'css' ),
			'bgcolor' => $this->field( 'bgcolor' ),
			'bgimage' => $this->field( 'bgimage' ),
			'color'   => $this->field( 'color' ),
			'column_1_bgcolor' => array(
				'label'       => __( 'Column #1 Bg Color' ,'nietzsche'),
				'type'        => 'Color',
				'default'     => '',
			),
			'column_1_bgimage' => array(
				'label'       => __( 'Column #1 Bg Image' ,'nietzsche'),
				'type'        => 'Upload',
				'default'     => '',
			),
			'column_1_bgopacity' => array(
				'label'    => __( 'Column #1 Bg Opacity' ,'nietzsche'),
				'type'     => 'Select',
				'options'     => array(
					'1'   => '1',
					'0.9' => '0.9',
					'0.8' => '0.8',
					'0.7' => '0.7',
					'0.6' => '0.6',
					'0.5' => '0.5',
					'0.4' => '0.4',
					'0.3' => '0.3',
					'0.2' => '0.2',
					'0.1' => '0.1',
				),
				'default'  => '1',
			),
			'column_1_color' => array(
				'label'       => __( 'Column #1 Color' ,'nietzsche'),
				'type'        => 'Color',
				'default'     => '',
			),
			'column_1_form' => array(
				'label'    => __( 'Column #1 Show Contact Form' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'Yes' ,'nietzsche') => 'yes',
					__( 'No' ,'nietzsche')  => 'no',
				),
				'default'  => 'no',
			),
			'column_1_msgOK' => array(
				'label'       => __( 'Mail Sent Message' ,'nietzsche'),
				'type'        => 'TextArea',
				'description' => __( 'Message shown when form message has been sent without errors' ,'nietzsche'),
				'default'     => '<strong>Yay!</strong> Message sent.',
			),
			'column_1_msgKO' => array(
				'label'       => __( 'Form Error Message' ,'nietzsche'),
				'type'        => 'TextArea',
				'description' => __( 'Message shown when form message encountered errors' ,'nietzsche'),
				'default'     => '<strong>Error!</strong> Please validate your fields.',
			),
			'column_1_image' => array(
				'label'       => __( 'Column #1 Image' ,'nietzsche'),
				'type'        => 'Upload',
				'default'     => '',
			),
			'column_1_content' => array(
				'label'       => __( 'Column #1 Content' ,'nietzsche'),
				'type'        => 'TextArea',
				'default'     => '',
			),
			'column_1_video' => array(
				'label'       => __( 'Column #1 Video' ,'nietzsche'),
				'type'        => 'Text',
				'default'     => '',
				'description' => __( 'Will be displayed in the lightbox. Vimeo and YouTube supported.' ,'nietzsche'),
			),
			'column_1_video_text' => array(
				'label'       => __( 'Column #1 Video Button Text' ,'nietzsche'),
				'type'        => 'Text',
				'default'     => 'Play Reel',
				'description' => __( 'Text of the button that launches the lightbox.' ,'nietzsche'),
			),
			'column_1_align' => array(
				'label'    => __( 'Column #1 Content alignment' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'Left' ,'nietzsche')   => 'left',
					__( 'Center' ,'nietzsche') => 'center',
					__( 'Right' ,'nietzsche')  => 'right',
				),
				'default'  => 'left',
			),
			'column_2_bgcolor' => array(
				'label'       => __( 'Column #2 Bg Color' ,'nietzsche'),
				'type'        => 'Color',
				'default'     => '',
			),
			'column_2_bgimage' => array(
				'label'       => __( 'Column #2 Bg Image' ,'nietzsche'),
				'type'        => 'Upload',
				'default'     => '',
			),
			'column_2_bgopacity' => array(
				'label'    => __( 'Column #2 Bg Opacity' ,'nietzsche'),
				'type'     => 'Select',
				'options'     => array(
					'1'   => '1',
					'0.9' => '0.9',
					'0.8' => '0.8',
					'0.7' => '0.7',
					'0.6' => '0.6',
					'0.5' => '0.5',
					'0.4' => '0.4',
					'0.3' => '0.3',
					'0.2' => '0.2',
					'0.1' => '0.1',
				),
				'default'  => '1',
			),
			'column_2_color' => array(
				'label'       => __( 'Column #2 Color' ,'nietzsche'),
				'type'        => 'Color',
				'default'     => '',
			),
			'column_2_form' => array(
				'label'    => __( 'Column #2 Show Contact Form' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'Yes' ,'nietzsche') => 'yes',
					__( 'No' ,'nietzsche')  => 'no',
				),
				'default'  => 'no',
			),
			'column_2_msgOK' => array(
				'label'       => __( 'Mail Sent Message' ,'nietzsche'),
				'type'        => 'TextArea',
				'description' => __( 'Message shown when form message has been sent without errors' ,'nietzsche'),
				'default'     => '<strong>Yay!</strong> Message sent.',
			),
			'column_2_msgKO' => array(
				'label'       => __( 'Form Error Message' ,'nietzsche'),
				'type'        => 'TextArea',
				'description' => __( 'Message shown when form message encountered errors' ,'nietzsche'),
				'default'     => '<strong>Error!</strong> Please validate your fields.',
			),
			'column_2_image' => array(
				'label'       => __( 'Column #2 Image' ,'nietzsche'),
				'type'        => 'Upload',
				'default'     => '',
			),
			'column_2_content' => array(
				'label'       => __( 'Column #2 Content' ,'nietzsche'),
				'type'        => 'TextArea',
				'default'     => '',
			),
			'column_2_video' => array(
				'label'       => __( 'Column #2 Video' ,'nietzsche'),
				'type'        => 'Text',
				'default'     => '',
				'description' => __( 'Will be displayed in the lightbox. Vimeo and YouTube supported.' ,'nietzsche'),
			),
			'column_2_video_text' => array(
				'label'       => __( 'Column #2 Video Button Text' ,'nietzsche'),
				'type'        => 'Text',
				'default'     => 'Play Reel',
				'description' => __( 'Text of the button that launches the lightbox.' ,'nietzsche'),
			),
			'column_2_align' => array(
				'label'    => __( 'Column #2 Content alignment' ,'nietzsche'),
				'type'     => 'RadioUI',
				'options'     => array(
					__( 'Left' ,'nietzsche')   => 'left',
					__( 'Center' ,'nietzsche') => 'center',
					__( 'Right' ,'nietzsche')  => 'right',
				),
				'default'  => 'left',
			),
		);

		return $fields;

	}

	public function conditions() {

		return array(
			'column_1_form' => array(
				'yes' =>	array(
					'show' => 'column_1_msgOK,column_1_msgKO',
					'hide' => 'column_1_image,column_1_content,column_1_video,column_1_video_text,column_1_align,column_2_form',
				),
				'no' =>	array(
					'show' => 'column_1_image,column_1_content,column_1_video,column_1_video_text,column_1_align,column_2_form',
					'hide' => 'column_1_msgOK,column_1_msgKO',
				),
			),
			'column_2_form' => array(
				'yes' =>	array(
					'show' => 'column_2_msgOK,column_2_msgKO',
					'hide' => 'column_2_image,column_2_content,column_2_video,column_2_video_text,column_2_align,column_1_form',
				),
				'no' =>	array(
					'show' => 'column_2_image,column_2_content,column_2_video,column_2_video_text,column_2_align,column_1_form',
					'hide' => 'column_2_msgOK,column_2_msgKO',
				),
			),
		);
	}

	public function name() {
		return __( 'Hero' ,'nietzsche');
	}

	public function group() {
		return 'section';
	}

	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'hero';
	}

	public function template() {

		$t =& peTheme();

		$t->template->data( $this->data, $this->conf->bid );
		$t->get_template_part( 'viewmodule' , $this->templateName() );
		
	}

	public function tooltip() {
		return __( 'Add a Hero section.' ,'nietzsche');
	}

}