<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheMediaGridSliderSlide' ); ?>

<li
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section section-builder section-type-media-grid-slider-slide tms-slide"
	data-image
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( $data->image ) : ?>

		<?php if ( 'yes' === $data->image_align_middle ) : ?>

			<div class="tms-content">
				<div class="tms-content-inner">

		<?php endif; ?>

			<img data-src="<?php echo esc_url( $data->image ); ?>" alt=""/>

		<?php if ( 'yes' === $data->image_align_middle ) : ?>

				</div>
			</div>

		<?php endif; ?>

	<?php endif; ?>

	<?php if ( ! empty( $loop->main->loop ) ) : ?>

		<div class="tms-content thumbnail">
			<div class="caption-over-outer">
				<div class="tms-content-inner <?php echo sanitize_html_class( $data->align_x ); ?> <?php echo sanitize_html_class( $data->align_y ); ?> center-on-mobile">
					
					<?php while ( $item = $loop->next() ) : ?>

						<?php $view->outputModule( $item->view ); ?>

					<?php endwhile; ?>

				</div>
			</div>
		</div>

	<?php endif; ?>

</li>