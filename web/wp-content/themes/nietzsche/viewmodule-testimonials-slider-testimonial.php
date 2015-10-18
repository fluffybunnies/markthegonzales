<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheTestimonialsSliderTestimonial' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section-builder section-type-testimonials-slider-testimonial tms-content"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<div class="tms-content-inner">
		<div class="row">
			<div class="column width-12">
				<blockquote class="left small avatar center large">

					<?php if ( $data->testimonial ) : ?>

						<p><?php esc__pe( $data->testimonial ); ?>

							<?php if ( $data->author ) : ?>

								<cite><?php esc__pe( $data->author ); ?></cite>

							<?php endif; ?>
						</p>

					<?php endif; ?>
					
				</blockquote>
			</div>
		</div>
	</div>

</div>