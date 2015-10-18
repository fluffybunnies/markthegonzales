<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheTestimonial' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-testimonial"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'color:color', 'css' ) ); ?>
>
	
	<div class="row medium">
		<div class="column width-11">
			<blockquote class="left small font-alt-2">

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

</section>