<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheMediaGridSlider' ); ?>
<?php

switch ( $data->size ) {

	case ( 'portrait' ) :

		$grid_item_size_class = 'portrait';

		break;

	case ( 'large-landscape' ) :

		$grid_item_size_class = 'large';

		break;

	case ( 'large-portrait' ) :

		$grid_item_size_class = 'large portrait';

		break;

	default :

		$grid_item_size_class = '';

		break;

}

?>

<div
	id="grid-item-<?php echo esc_attr( $bid ); ?>"
	class="section-type-media-grid-slider grid-item <?php echo esc_attr( $grid_item_size_class ); ?>"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( ! empty( $loop->main->loop ) ) : ?>

		<div class="tm-slider-container content-slider project-4">
			<ul class="tms-slides">

				<?php while ( $item = $loop->next() ) : ?>

					<?php $item->view['data']['image_align_middle'] = $data->image_align_middle; ?>

					<?php $view->outputModule( $item->view ); ?>

				<?php endwhile; ?>

			</ul>
		</div>

	<?php endif; ?>

</div>