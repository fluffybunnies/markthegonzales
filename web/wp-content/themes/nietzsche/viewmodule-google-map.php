<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheGoogleMap' ); ?>

<?php $has_overlay = ( ! empty( $data->title ) || ! empty( $data->description ) ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-google-map <?php echo esc_attr( $has_overlay ? 'hero-7 left hero-7-contact' : 'map-wrapper' ); ?>"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'color:color', 'css' ) ); ?>
>

	<?php if ( ! empty( $loop->main->loop ) ) : ?>

		<?php while ( $item = $loop->next() ) : ?>

			<?php $view->outputModule( $item->view ); ?>

		<?php endwhile; ?>

	<?php endif; ?>

	<?php if ( $has_overlay ) : ?>

		<div class="row background-cover" data-bg-image="<?php echo esc_url( $data->bgimage ); ?>">
			<div class="column width-6">
				<div class="hero-content split-hero-content">
					<div class="hero-content-inner">

						<?php if ( $data->title ) : ?>

							<h6 <?php esc__pe( $content->get_style( $data, 'color:title_color' ) ); ?> class="no-margin-top"><?php esc__pe( $data->title ); ?></h6>

						<?php endif; ?>

						<?php if ( $data->description ) : ?>

							<?php esc__pe( str_replace( '<p>', '<p class="lead">', do_shortcode( apply_filters( 'the_content', $data->description ) ) ) ); ?>

						<?php endif; ?>

					</div>
				</div>
			</div>
			<div class="column width-6 media-column">
				<div class="map-container">
					<div class="map-canvas" data-zoom="<?php echo absint( $data->zoom ); ?>"></div>
				</div>
			</div>
		</div>

	<?php else : ?>

		<div class="row collapse full-width">
			<div class="column width-12">
				<div class="map-container">
					<div class="map-canvas" data-zoom="<?php echo absint( $data->zoom ); ?>"></div>
				</div>
			</div>
		</div>

	<?php endif; ?>

</section>