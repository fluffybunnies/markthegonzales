<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $project =& $t->project; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheProjectsGrid' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-projects-grid"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'css' ) ); ?>
>

	<?php if ( 'yes' === $data->show_filters ) : ?>

		<div class="section-block portfolio-filter-menu left">
			<div class="row">
				<div class="column width-12">
					<ul>
						<?php $project->filter(); ?>
					</ul>
				</div>
			</div>
		</div>

	<?php endif; ?>

	<?php $grid_width_class = 'yes' === $data->full_width ? 'full-width' : ''; ?>
	<?php $spacing_class = 'yes' === $data->grid_spacing ? 'small-margins' : 'no-margins'; ?>

	<div class="section-block portfolio-5 <?php echo sanitize_html_class( $grid_width_class ); ?> <?php echo sanitize_html_class( $spacing_class ); ?>">
		<div class="row">
			<div class="column width-12">
				<div class="row content-grid-<?php echo esc_attr( $data->columns ? $data->columns : 3 ); ?> masonry-grid">

					<?php $overlay_class = ''; ?>

					<?php if ( 'slidein' === $data->captions ) : ?>

						<?php $overlay_class = 'overlay-slide-in-left'; ?>

					<?php endif; ?>

					<?php while ( $content->looping() ) : ?>

						<?php $meta =& $content->meta(); ?>
						<?php $terms = get_the_terms( get_the_id(), 'prj-category' ); ?>

						<?php $grid_item_size = ( isset( $meta->grid ) && isset( $meta->grid->size ) ) ? $meta->grid->size : 'landscape'; ?>
						<?php

						switch ( $grid_item_size ) {

							case ( 'portrait' ) :

								$grid_item_size_class = 'portrait';

								break;

							case ( 'large-landscape' ) :

								$grid_item_size_class = 'large';

								break;

							case ( 'large-portrait' ) :

								$grid_item_size_class = 'large portrait';

								break;

							default :

								$grid_item_size_class = '';

								break;

						}

						?>

						<div class="grid-item <?php $project->filterClasses(); ?> <?php echo esc_attr( $grid_item_size_class ); ?>">
							<div class="thumbnail <?php echo sanitize_html_class( $overlay_class ); ?>" data-hover-easing="swing">
								<a class="overlay-link" href="<?php echo esc_url( get_permalink() ); ?>">
									
									<?php $content->img( 1700, 0 ); ?>

									<?php if ( 'hide' !== $data->captions ) : ?>

										<span class="overlay-info">
											<span>
												<span>

													<?php if ( ! empty( $terms ) && is_array( $terms ) ) : ?>

														<span class="project-title"><?php 

															$output = '';

															foreach ( $terms as $term ) {

																$output .= $term->name . ', ';

															}

															$output = substr( $output, 0, -2 );

															echo $output;

														?>.</span>

													<?php endif; ?>
													
													<span class="project-description"><?php $content->title(); ?></span>
												</span>
											</span>
										</span>

									<?php endif; ?>

								</a>
							</div>
						</div>

					<?php endwhile; ?>

				</div>
			</div>
		</div>
	</div>

</section>