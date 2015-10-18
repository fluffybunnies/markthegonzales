<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheMediaGridLightboxGallery' ); ?>
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
	class="section-type-media-grid-lightbox-gallery grid-item <?php echo esc_attr( $grid_item_size_class ); ?>"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>
	
	<?php $is_first_slide = true; ?>
	<?php $first_slide_url = ''; ?>
	<?php $first_slide_captions = ''; ?>

	<?php if ( ! empty( $loop->main->loop ) ) : ?>

		<div class="hide">

			<?php while ( $item = $loop->next() ) : ?>

				<?php if ( 'NietzscheMediaGridLightboxGalleryImage' === $item->type ) : ?>

					<?php if ( $is_first_slide ) : ?>

						<?php $is_first_slide = false; ?>
						<?php $first_slide_url = $item->data->image; ?>
						<?php $first_slide_captions = $item->data->lightbox_captions; ?>

						<?php continue; ?>

					<?php endif; ?>

					<?php $item->view['data']['lightbox_group'] = 'lightbox-' . esc_attr( $bid ); ?>

					<?php $view->outputModule( $item->view ); ?>

				<?php endif; ?>

			<?php endwhile; ?>

			<?php $loop->rewind(); ?>

		</div>

	<?php endif; ?>

	<?php $overlay_class = ''; ?>

	<?php if ( 'slidein' === $data->captions ) : ?>

		<?php $overlay_class = 'overlay-slide-in-left'; ?>

	<?php endif; ?>

	<div class="thumbnail <?php echo $overlay_class; ?>" data-hover-easing="swing">

		<?php if ( $first_slide_url ) : ?>

			<a data-group="lightbox-<?php echo esc_attr( $bid ); ?>" data-caption="<?php echo esc_attr( $first_slide_captions ); ?>" class="overlay-link lightbox-link" href="<?php echo esc_url( $first_slide_url ); ?>">

		<?php endif; ?>

			<?php if ( $data->image ) : ?>

				<img src="<?php echo esc_url( $data->image ); ?>" alt="">

			<?php endif; ?>

			<?php if ( ! empty( $loop->main->loop ) && 'hide' !== $data->captions ) : ?>

				<?php if ( 'always' !== $data->captions ) : ?>

					<div class="overlay-info">

				<?php endif; ?>

					<div class="caption-over-outer">
						<div class="caption-over-inner <?php echo sanitize_html_class( $data->align_x ); ?> <?php echo sanitize_html_class( $data->align_y ); ?>">
							
							<?php while ( $item = $loop->next() ) : ?>

								<?php if ( 'NietzscheMediaGridLightboxGalleryCaption' === $item->type ) : ?>

									<?php $view->outputModule( $item->view ); ?>

								<?php endif; ?>

							<?php endwhile; ?>

						</div>
					</div>

				<?php if ( 'always' !== $data->captions ) : ?>

					</div>

				<?php endif; ?>

			<?php endif; ?>

		<?php if ( $first_slide_url ) : ?>

			</a>

		<?php endif; ?>

	</div>

</div>