<?php

class PeThemeViewLayoutModuleNietzscheColumns extends PeThemeViewLayoutModuleNietzscheContainer {

	public $translate = array(
		'1/1'  => 'width-12',
		'1/2'  => 'width-6',
		'1/3'  => 'width-4',
		'1/4'  => 'width-3',
		'1/6'  => 'width-2',
		'2/4'  => 'width-6',
		'2/3'  => 'width-8',
		'3/4'  => 'width-9',
		'5/6'  => 'width-10',
		'last' => '',
	);

	public function __construct() {

		parent::__construct();

		add_filter( 'pe_theme_shortcode_columns_options', array( $this, 'add_single_column_layout' ) );
		add_filter( 'pe_theme_shortcode_columns_options', array( $this, 'translate_column_widths' ) );

	}

	public function add_single_column_layout( $columns_groups ) {

		if ( empty( $columns_groups ) || ! is_array( $columns_groups ) ) {

			return $columns_groups;

		}

		$single_column_layout = array(
			__( '1 Column layout' ,'nietzsche') => array(
				__( '1/1' ,'nietzsche') => '1/1',
			),
		);

		$columns_groups = array_merge( $single_column_layout, $columns_groups );

		return $columns_groups;

	}

	public function translate_column_widths( $columns_groups ) {

		if ( empty( $columns_groups ) || ! is_array( $columns_groups ) ) {

			return $columns_groups;

		}

		foreach ( $columns_groups as $column_group_index => $column_group ) {

			if ( empty( $column_group ) || ! is_array( $column_group ) ) {

				continue;

			}

			foreach ( $column_group as $label => $value ) {

				$columns_groups[ $column_group_index ][ $label ] = str_replace( array_keys( $this->translate ), array_values( $this->translate ), $columns_groups[ $column_group_index ][ $label ] );

			}

		}

		return $columns_groups;

	}

	public function messages() {

		return array(
			'title' => '',
			'type'  => __( 'Columns' ,'nietzsche'),
		);

	}

	public function fields() {

		$fields = array(
			'name'    => $this->field( 'name' ),
			'css'     => $this->field( 'css' ),
			'bgcolor' => $this->field( 'bgcolor' ),
			'bgimage' => $this->field( 'bgimage' ),
			'columns' => array(
				'label'       => __( 'Layout' ,'nietzsche'),
				'description' => __( 'Select the columns layout' ,'nietzsche'),
				'type'        => 'Select',
				'groups'      => true,
				'options'     => apply_filters( 'pe_theme_shortcode_columns_options', PeGlobal::$config['columns'] ),
			),
		);

		return $fields;

	}

	public function name() {
		return __( 'Columns' ,'nietzsche');
	}

	public function create() {
		return 'NietzscheText';
	}

	public function force() {
		return 'NietzscheText';
	}

	public function allowed() {
		return 'column';
	}

	public function group() {
		return 'section';
	}
	
	public function type() {
		return __( 'Section' ,'nietzsche');
	}

	public function templateName() {
		return 'columns';
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
		return __( 'Use this block to add columns of content to your layout.' ,'nietzsche');
	}

}

?>