<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheContact' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-contact"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'color:color', 'css' ) ); ?>
>

	<div class="row">

		<?php if ( ! empty( $loop->main->loop ) ) : ?>

			<?php while ( $item = $loop->next() ) : ?>

				<?php $view->outputModule( $item->view ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

	</div>

</section>