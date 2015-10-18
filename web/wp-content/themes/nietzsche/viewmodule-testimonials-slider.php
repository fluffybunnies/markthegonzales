<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheTestimonialsSlider' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-testimonials-slider testimonial-5"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'color:color', 'css' ) ); ?>
>

	<?php if ( ! empty( $loop->main->loop ) ) : ?>

		<div class="testimonial-slider tm-slider-container navigation-<?php echo sanitize_html_class( $data->navigation ); ?>">
			<ul class="tms-slides">

				<?php while ( $item = $loop->next() ) : ?>

					<li class="tms-slide" data-image>

						<?php $view->outputModule( $item->view ); ?>

					</li>

				<?php endwhile; ?>

			</ul>
		</div>

	<?php endif; ?>

</section>