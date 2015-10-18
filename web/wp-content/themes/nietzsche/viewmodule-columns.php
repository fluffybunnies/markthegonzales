<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheColumns' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-columns"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'css' ) ); ?>
>

	<?php if ( ! empty( $data->columns )  && ! empty( $loop->main->loop ) ) : ?>

		<?php $columns_config = explode( ' ', $data->columns ); ?>
		<?php $columns_count = count( $columns_config ); ?>
		<?php $row = 1; ?>
		<?php $i = 1; ?>

		<?php $items_count = count( $loop->main->loop ); ?>
		<?php $items_left = $items_count; ?>

		<div class="row equalize">

			<?php while ( $item = $loop->next() ) : ?>

				<?php $items_left--; ?>

				<?php $column_class = isset( $columns_config[ $i - 1 ] ) ? $columns_config[ $i - 1 ] : ''; ?>
				<?php $row_class = 'row-' . $row; ?>

				<div class="column <?php echo sanitize_html_class( $column_class ); ?> <?php echo sanitize_html_class( $row_class ); ?>">

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

	<?php endif; ?>

</section>