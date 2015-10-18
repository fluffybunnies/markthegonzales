<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheStats' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-stats stats-<?php echo absint( $data->style ); ?>"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'color:color', 'css' ) ); ?>
>

	<?php if ( ! empty( $loop->main->loop ) ) : ?>

		<div class="row">
			<div class="column width-12">

				<?php $columns_count = absint( $data->content_columns ); ?>
				<?php $row = 1; ?>
				<?php $i = 1; ?>

				<?php $items_count = count( $loop->main->loop ); ?>
				<?php $items_left = $items_count; ?>

				<div class="row content-grid-<?php echo absint( $data->content_columns ); ?> equalize stats">

					<?php while ( $item = $loop->next() ) : ?>

						<?php $items_left--; ?>
						<?php $row_class = 'row-' . $row; ?>

						<div class="grid-item <?php echo sanitize_html_class( $row_class ); ?>">

							<?php $view->outputModule( $item->view ); ?>

						</div>

						<?php if ( $i === $columns_count ) : ?>

							<?php $row++; ?>

							<?php $i = 1; ?>

						<?php else : ?>
							
							<?php $i++; ?>

						<?php endif; ?>

					<?php endwhile; ?>


				</div>
			</div>
		</div>

	<?php endif; ?>

</section>