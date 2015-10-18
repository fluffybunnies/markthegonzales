<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheSplashParallax' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section section-builder section-type-splash-parallax fullscreen-sections-wrapper nav-dark"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( ! empty( $loop->main->loop ) ) : ?>

		<?php while ( $item = $loop->next() ) : ?>

			<?php $view->outputModule( $item->view ); ?>

		<?php endwhile; ?>

	<?php endif; ?>

</div>