<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheMediaGridImage' ); ?>
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
	class="section-type-media-grid-image grid-item <?php echo esc_attr( $grid_item_size_class ); ?>"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php $overlay_class = ''; ?>

	<?php if ( 'slidein' === $data->captions ) : ?>

		<?php $overlay_class = 'overlay-slide-in-left'; ?>

	<?php endif; ?>

	<div class="thumbnail <?php echo $overlay_class; ?>" data-hover-easing="swing">

		<?php if ( 'yes' === $data->lightbox ) : ?>

			<?php $lightbox_link = $data->lightbox_image ? $data->lightbox_image : $data->image; ?>

			<a data-group="lightbox-<?php echo esc_attr( $bid ); ?>" data-caption="<?php echo esc_attr( $data->lightbox_captions ); ?>" class="overlay-link lightbox-link" href="<?php echo esc_url( $lightbox_link ); ?>">
			
		<?php elseif ( $data->link ) : ?>

			<a href="<?php echo esc_url( $data->link ); ?>">

		<?php endif; ?>


		<?php if ( $data->image ) : ?>

			<img src="<?php echo esc_url( $data->image ); ?>" alt="<?php echo esc_attr( $data->lightbox_captions ); ?>">

		<?php endif; ?>

			<?php if ( ! empty( $loop->main->loop ) && 'hide' !== $data->captions ) : ?>

				<?php if ( 'always' !== $data->captions ) : ?>

					<div class="overlay-info">

				<?php endif; ?>

					<div class="caption-over-outer">
						<div class="caption-over-inner <?php echo sanitize_html_class( $data->align_x ); ?> <?php echo sanitize_html_class( $data->align_y ); ?>">
							
							<?php while ( $item = $loop->next() ) : ?>

								<?php $view->outputModule( $item->view ); ?>

							<?php endwhile; ?>

						</div>
					</div>

				<?php if ( 'always' !== $data->captions ) : ?>

					</div>

				<?php endif; ?>

			<?php endif; ?>

		<?php if ( 'yes' === $data->lightbox || $data->link ) : ?>

			</a>
		
		<?php endif; ?>
	
	</div>

</div>