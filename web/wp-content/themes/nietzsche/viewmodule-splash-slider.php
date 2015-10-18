<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheSplashSlider' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section section-builder section-type-splash-slider tm-slider-container <?php echo sanitize_html_class( $data->scale ); ?>"
	<?php esc__pe( $content->get_style( $data, 'background-color:bgcolor', 'css' ) ); ?>
>

	<?php if ( ! empty( $loop->main->loop ) ) : ?>

		<ul class="tms-slides">

			<?php while ( $item = $loop->next() ) : ?>

				<?php $view->outputModule( $item->view ); ?>

			<?php endwhile; ?>

		</ul>

	<?php endif; ?>

</div>