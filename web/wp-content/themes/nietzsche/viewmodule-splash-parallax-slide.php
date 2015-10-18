<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheSplashParallaxSlide' ); ?>

<?php $ratio = explode( '/', $data->mobile_ratio ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section section-builder section-block section-type-splash-parallax-slide fullscreen-section background-fixed background-cover content-below-on-mobile no-overlay"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
	data-width="<?php echo absint( isset( $ratio[0] ) ? $ratio[0] : 16 ); ?>"
	data-height="<?php echo absint( isset( $ratio[1] ) ? $ratio[1] : 9 ); ?>"
>

	<div class="background-image-wrapper">
		<div
			class="background-image project-4-2"
			<?php esc__pe( $content->get_style( $data, 'background-image:image' ) ); ?>
		></div>
	</div>

	<?php if ( $data->title || $data->content ) : ?>

		<?php

		$column_class = 'width-3 right';

		if ( 'right' === $data->align_x ) {

			$column_class = 'width-3 push-9 left';

		} else if ( 'center' === $data->align_x ) {

			$column_class = 'width-4 push-4 center';

		}

		?>

		<div class="fullscreen-inner <?php echo sanitize_html_class( $data->color ); ?> background-on-mobile">
			<div class="row">
				<div class="column <?php echo esc_attr( $column_class ); ?>">

					<?php if ( $data->title ) : ?>

						<h6 class="weight-light"><?php esc__pe( $data->title ); ?></h6>

					<?php endif; ?>

					<?php if ( $data->content ) : ?>

						<?php esc__pe( do_shortcode( apply_filters( 'the_content', $data->content ) ) ); ?>

					<?php endif; ?>

				</div>
			</div>
		</div>

	<?php endif; ?>

</div>