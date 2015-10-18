<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheServices' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-services"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'color:color', 'css' ) ); ?>
>

	<div class="row">

		<?php if ( $data->title || $data->subtitle || $data->description ) : ?>

			<div class="column width-4">

				<?php if ( $data->title ) : ?>

					<h3 class="weight-light"><?php esc__pe( $data->title ); ?></h3>

				<?php endif; ?>

				<?php if ( $data->subtitle ) : ?>

					<p class="lead"><?php esc__pe( $data->subtitle ); ?></p>

				<?php endif; ?>

				<?php if ( $data->description ) : ?>

					<?php esc__pe( do_shortcode( apply_filters( 'the_content', $data->description ) ) ); ?>

				<?php endif; ?>

				<div class="separator"></div>
			</div>

		<?php endif; ?>

		<?php if ( ! empty( $loop->main->loop ) ) : ?>

			<?php $content_class = ( empty( $data->title ) && empty( $data->subtitle ) && empty( $data->description ) ) ? 'width-12' : 'width-8'; ?>

			<div class="column <?php echo sanitize_html_class( $content_class ); ?>">

				<?php $columns_count = absint( $data->content_columns ); ?>
				<?php $column_class = 1 === $columns_count ? 'width-12' : 'width-6'; ?>
				<?php $row = 1; ?>
				<?php $i = 1; ?>

				<div class="row equalize">

					<?php while ( $item = $loop->next() ) : ?>

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

			</div>

		<?php endif; ?>

	</div>

</section>