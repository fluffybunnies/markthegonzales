<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheMediaGrid' ); ?>

<?php $grid_width_class = 'yes' === $data->full_width ? 'full-width' : ''; ?>
<?php $spacing_class = 'yes' === $data->grid_spacing ? 'small-margins' : 'no-margins'; ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-media-grid portfolio-5 masonry-set-dimensions <?php echo sanitize_html_class( $grid_width_class ); ?> <?php echo sanitize_html_class( $spacing_class ); ?>"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'css' ) ); ?>
>

	<?php if ( ! empty( $loop->main->loop ) ) : ?>

		<div class="row">
			<div class="column width-12">
				<div class="row content-grid-<?php echo esc_attr( $data->columns ? $data->columns : 3 ); ?> masonry-grid">

					<?php while ( $item = $loop->next() ) : ?>

						<?php $view->outputModule( $item->view ); ?>
						
					<?php endwhile; ?>

				</div>
			</div>
		</div>

	<?php endif; ?>

</section>