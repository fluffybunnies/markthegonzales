<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheSplashImage' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section section-builder section-type-splash-image <?php echo esc_attr( ! empty( $data->image_position ) ? $data->image_position : 'parallax fake-parallax no-parallax' ); ?> <?php echo sanitize_html_class( $data->scale  ); ?>"
	data-src="<?php echo esc_url( $data->image ); ?>"
	data-retina
	<?php esc__pe( $content->get_style( $data, 'background-color:bgcolor', 'css' ) ); ?>
>

	<div class="tmp-content">
		<div class="tmp-content-inner <?php echo sanitize_html_class( $data->align_x ); ?> <?php echo sanitize_html_class( $data->align_y ); ?> center-on-mobile">
			<div class="row">
				<div class="column width-12 color-white">

					<?php if ( ! empty( $loop->main->loop ) ) : ?>

						<?php while ( $item = $loop->next() ) : ?>

							<?php $view->outputModule( $item->view ); ?>

						<?php endwhile; ?>

					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>

</div>