<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheSplash' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-splash featured-media"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( ! empty( $loop->main->loop ) ) : ?>

		<?php $view->outputModule( $loop->next()->view ); ?>

	<?php endif; ?>

</section>