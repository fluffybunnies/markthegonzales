<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $first = true; ?>

<?php while ( $content->looping() ) : ?>

	<?php $meta = $content->meta(); ?>
	<?php $post_permalink = get_permalink(); ?>
	<?php $hasFeatImage = $content->hasFeatImage(); ?>

	<div class="grid-item <?php echo sanitize_html_class( $first ? 'grid-sizer' : '' ); ?>">
		<article class="post">

			<div class="post-media">
			
				<?php switch( $content->format() ): case "gallery": // Gallery post ?>
			
					<?php $t->media->w( 1110 ); ?>
					<?php $t->media->h( 0 ); ?>
					<?php $t->gallery->output( $meta->gallery->ids, 'GalleryImages' ); ?>

				<?php break; case "video": // Video post ?>

					<?php $video = $meta->video->url; ?>

					<?php if ( $video ) : ?>

						<div class="video-container">

							<?php if ( false !== strpos( $video, 'youtu' ) ) : ?>

								<?php $video_id = $t->video->get_video_id( $video, 'youtube' ); ?>
								<?php if ( $video_id ) : ?>

									<iframe width="1280" height="720" src="//www.youtube.com/embed/<?php echo esc_attr( $video_id ); ?>?autohide=1&amp;modestbranding=1&amp;showinfo=0" class="fullwidth-video" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
								
								<?php endif; ?>

							<?php elseif ( false !== strpos( $video, 'vimeo' ) ) : ?>

								<?php $video_id = $t->video->get_video_id( $video, 'vimeo' ); ?>
								<?php if ( $video_id ) : ?>

									<iframe src="//player.vimeo.com/video/<?php echo esc_attr( $video_id ); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" class="fullwidth-video" width="1280" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
								
								<?php endif; ?>

							<?php endif; ?>

						</div>

					<?php endif; ?>

				<?php break; default: // Standard post ?>

					<?php if ( $hasFeatImage ): ?>

						<?php if ( has_tag() ) : ?>

							<div class="thumbnail overlay-slide-in-left" data-hover-easing="swing">
								<a class="overlay-link" href="<?php echo esc_url( $post_permalink ); ?>">
									<?php $content->img( 1110, 0 ); ?>
									<div class="overlay-info">
										<span>
											<span>
												<?php $terms = get_the_terms( get_the_id(), 'post_tag' ); ?>

												<?php if ( ! empty( $terms ) && is_array( $terms ) ) : ?>

													<span class="project-title"><?php 

														$output = '';

														foreach ( $terms as $term ) {

															$output .= $term->name . ', ';

														}

														$output = substr( $output, 0, -2 );

														echo $output;

													?>.</span><br>

												<?php endif; ?>
												<span class="project-description"><?php esc__pe( __( 'View Post' ,'nietzsche') ); ?></span>
											</span>
										</span>
									</div>
								</a>
							</div>

						<?php else : ?>

							<?php $content->img( 1110, 0 ); ?>

						<?php endif; ?>

					<?php endif; ?>

				<?php endswitch; ?>

			</div>

			<div class="post-content with-background">
				<h2 class="post-title"><a href="<?php echo esc_url( $post_permalink ); ?>"><?php $content->title(); ?></a></h2>
				<div class="post-info">
					<span class="post-date"><?php the_time( get_option( 'date_format' ) ); ?></span>/<span class="post-autor"><?php _e( 'By' ,'nietzsche'); ?> <?php the_author_posts_link(); ?></span>
				</div>

				<?php $content->excerpt(); ?>

				<div class="post-read-more">
					<a
						href="<?php echo esc_url( $post_permalink ); ?>"
						class="button bkg-charcoal bkg-hover-charcoal color-white color-hover-white read-more"
					><?php _e( 'Read More' ,'nietzsche'); ?></a>
				</div>
			</div>

		</article>
	</div>

	<?php $first = false; ?>

<?php endwhile; ?>