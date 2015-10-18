<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheLogos' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-logos logos-<?php echo absint( $data->style ); ?>"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'color:color', 'css' ) ); ?>
>

	<div class="row">

		<?php if ( $data->title ) : ?>

			<div class="column width-12">
				<h5 <?php esc__pe( $content->get_style( $data, 'color:title_color' ) ); ?>><?php esc__pe( $data->title ); ?></h5>

				<?php if ( 'show' === $data->divider ) : ?>

					<div class="divider"></div>

				<?php endif; ?>

			</div>

		<?php endif; ?>

		<?php if ( $data->description || $data->content ) : ?>

			<div class="column width-4">


				<?php if ( $data->description ) : ?>

					<?php esc__pe( str_replace( '<p>', '<p class="lead">', do_shortcode( apply_filters( 'the_content', $data->description ) ) ) ); ?>

				<?php endif; ?>

				<?php if ( $data->content ) : ?>

					<?php esc__pe( do_shortcode( apply_filters( 'the_content', $data->content ) ) ); ?>

				<?php endif; ?>

			</div>

		<?php endif; ?>

		<?php if ( ! empty( $loop->main->loop ) ) : ?>

			<?php $content_class = ( empty( $data->description ) && empty( $data->content ) ) ? 'width-12' : 'width-8'; ?>

			<div class="column <?php echo sanitize_html_class( $content_class ); ?>">

				<div class="row content-grid-<?php echo absint( $data->content_columns ); ?>">

					<?php while ( $item = $loop->next() ) : ?>

						<div class="grid-item">

							<?php $view->outputModule( $item->view ); ?>

						</div>

					<?php endwhile; ?>

				</div>

			</div>

		<?php endif; ?>

	</div>

</section>