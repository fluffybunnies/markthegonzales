<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheMediaGridAudio' ); ?>
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
	class="section-type-media-grid-audio grid-item <?php echo esc_attr( $grid_item_size_class ); ?>"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( $data->audio ) : ?>

			<div class="thumbnail">

				<?php if ( $data->image ) : ?>

					<img src="<?php echo esc_url( $data->image ); ?>" alt="">

				<?php endif; ?>

			</div>

			<div class="mejs-container <?php echo sanitize_html_class( $data->color ); ?>">
				<audio controls="" preload="none" src="<?php echo esc_url( $data->audio ); ?>"></audio>
			</div>

	<?php endif; ?>

</div>