<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheSplashSliderSlide' ); ?>

<li
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section section-builder section-type-splash-slider-slide tms-slide"
	
	<?php if ( $data->video ) : ?>

		data-force-fit
		data-video-bkg

	<?php else : ?>

		data-image

	<?php endif; ?>

	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<div class="tms-content">
		<div class="tms-content-inner <?php echo sanitize_html_class( $data->align_x ); ?> <?php echo sanitize_html_class( $data->align_y ); ?> center-on-mobile">
			<div class="row">
				<div class="column width-12">

					<?php if ( ! empty( $loop->main->loop ) ) : ?>

						<?php while ( $item = $loop->next() ) : ?>

							<?php $view->outputModule( $item->view ); ?>

						<?php endwhile; ?>

					<?php endif; ?>

				</div>
			</div>
		</div>
	</div>

	<?php if ( $data->video ) : ?>

		<video>
			<source type="video/mp4" src="<?php echo esc_url( $data->video ); ?>" />
		</video>

	<?php endif; ?>

	<?php if ( $data->image ) : ?>

		<img data-src="<?php echo esc_url( $data->image ); ?>" alt="" src="<?php echo esc__pe( $t->image->blank( 1, 1 ) ); ?>"/>

	<?php endif; ?>

</li>