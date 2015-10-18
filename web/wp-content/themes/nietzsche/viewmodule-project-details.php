<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheProjectDetails' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-project-details"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'css' ) ); ?>
>

	<div class="row">

		<?php if ( $data->project_image ) : ?>

			<?php $attachment_id = $t->image->get_attachment_id( $data->project_image ); ?>

			<?php if ( $attachment_id ) : ?>

				<?php $attachment_data = wp_prepare_attachment_for_js( $attachment_id ); ?>

			<?php else : ?>

				<?php $attachment_data = array(); ?>

			<?php endif; ?>

			<div class="column width-12">

				<div class="thumbnail overlay-slide-in-left" data-hover-easing="swing">

					<?php if ( ! empty( $attachment_data['title'] ) || ! empty( $attachment_data['caption'] ) ) : ?>

						<div class="caption-over-outer">
							<div class="caption-over-inner color-white">

								<?php if ( ! empty( $attachment_data['title'] ) ) : ?>

									<h6 class="weight-bold text-small no-margin-bottom">
										<?php esc__pe( $attachment_data['title'] ); ?>
									</h6>

								<?php endif; ?>

								<div class="clear"></div>

								<?php if ( ! empty( $attachment_data['caption'] ) ) : ?>

									<p class="weight-light font-alt-2 text-medium">
										<em><?php esc__pe( $attachment_data['caption'] ); ?></em>
									</p>

								<?php endif; ?>
								
							</div>
						</div>

					<?php endif; ?>

					<img
						src="<?php echo esc_url( $data->project_image ); ?>"

						<?php if ( ! empty( $attachment_data['alt'] ) ) : ?>

							alt="<?php echo esc_attr( $attachment_data['alt'] ); ?>"

						<?php else : ?>

							alt="<?php echo esc_attr( __( 'Project image' ,'nietzsche') ); ?>"

						<?php endif; ?>

					>

				</div>
				
			</div>

		<?php endif; ?>

		<?php if ( $data->project_title ) : ?>

			<div class="column width-12">
				<h3 class="no-margin-top"><?php esc__pe( $data->project_title ); ?></h3>
			</div>

		<?php endif; ?>

		<?php if ( 'horizontal' === $data->project_details_display && ! empty( $data->project_details ) ) : ?>

			<div class="column width-12">
				<div class="project-details">
					<ul class="list-horizontal">
						<li>

							<?php $i = 1; ?>
							<?php $count = count( $data->project_details ); ?>

							<?php foreach ( $data->project_details as $project_detail ) : ?>

								<strong><?php esc__pe( $project_detail['title'] ); ?> </strong><?php esc__pe( $project_detail['description'] ); ?>

								<?php if ( $i !== $count ) : ?>

									 / 

								<?php endif; ?>

								<?php $i++; ?>

							<?php endforeach; ?>

						</li>
					</ul>
				</div>
				<div class="separator"></div>
			</div>

		<?php endif; ?>

		<?php if ( ! empty( $loop->main->loop ) ) : ?>

			<?php $content_class = ( empty( $data->project_details ) || 'horizontal' === $data->project_details_display ) ? 'width-12' : 'width-8'; ?>

			<div class="column <?php echo sanitize_html_class( $content_class ); ?>">

				<?php $columns_count = absint( $data->content_columns ); ?>
				<?php $row = 1; ?>
				<?php $i = 1; ?>

				<?php $items_count = count( $loop->main->loop ); ?>
				<?php $items_left = $items_count; ?>

				<div class="row equalize">

					<?php while ( $item = $loop->next() ) : ?>

						<?php $items_left--; ?>

						<?php $column_class = 1 === $columns_count ? 'width-12' : 'width-6'; ?>
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

				<?php if ( 'show' === $data->display_share_links ) : ?>
					
					<hr>

				<?php endif; ?>

			</div>

		<?php endif; ?>

		<?php if ( 'vertical' === $data->project_details_display && ! empty( $data->project_details ) ) : ?>

			<div class="column width-4 portfolio-details">
				<div class="box xlarge">

					<?php foreach ( $data->project_details as $project_detail ) : ?>

						<h6><strong><?php esc__pe( $project_detail['title'] ); ?></strong></h6>
						<p><?php esc__pe( $project_detail['description'] ); ?></p>

					<?php endforeach; ?>

					<?php if ( $data->project_details_link_text ) : ?>

						<div class="divider"></div>
						<a href="<?php echo esc_url( $data->project_details_link_url ); ?>" class="weight-bold"><?php esc__pe( $data->project_details_link_text ); ?></a>

					<?php endif; ?>

				</div>
			</div>

		<?php endif; ?>

		<?php if ( 'show' === $data->display_share_links ) : ?>

			<div class="column width-12">
					<ul class="social-list list-horizontal">

						<?php if ( $data->share_links_text ) : ?>
						
							<li class="social-list-label"><?php esc__pe( $data->share_links_text ); ?></li>

						<?php endif; ?>

						<?php

						if ( ! empty( $attachment_data ) && ! empty( $attachment_data['title'] ) ) {

							$image_description = $attachment_data['title'];

						} else {

							$image_description = ( $data->project_title ) ? $data->project_title : '';

						}

						?>

						<li><a onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + '<?php echo esc_url( get_permalink() ); ?>', 'sharer', 'width=626,height=436');" href="javascript: void(0)" title="<?php echo esc_attr( __( 'Share on Facebook' ,'nietzsche') ); ?>">Facebook</a>/</li>
						<li><a onclick="popUp=window.open('https://twitter.com/share?url=<?php echo esc_url( get_permalink() ); ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript: void(0)" title="<?php echo esc_attr( __( 'Share on Twitter' ,'nietzsche') ); ?>">Twitter</a>/</li>
						<li><a onclick="popUp=window.open('http://pinterest.com/pin/create/button/?url=<?php echo esc_url( get_permalink() ); ?>&amp;media=<?php echo esc_url( $image = $data->project_image ); ?>&amp;description=<?php echo esc_attr( $image_description ); ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript: void(0)" title="<?php echo esc_attr( __( 'Pin on Pinterest' ,'nietzsche') ); ?>">Pinterest</a>/</li>
						<li><a onclick="popUp=window.open('https://plus.google.com/share?url=<?php echo esc_url( get_permalink() ); ?>', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false;" href="javascript: void(0)" title="<?php echo esc_attr( __( 'Share on Google Plus' ,'nietzsche') ); ?>">Google+</a></li>
					</ul>
				</div>

		<?php endif; ?>

	</div>

</section>