<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php list( $settings ) = $t->template->data(); ?>
<?php $isSingle = is_single(); ?>
<?php while ( $content->looping() ) : ?>

	<?php $meta = $content->meta(); ?>
	<?php $link = get_permalink(); ?>
	<?php $type = $content->type(); ?>
	<?php $hasFeatImage = $content->hasFeatImage(); ?>
	<?php $classes = is_sticky() ? 'post post-single sticky' : 'post post-single'; ?>

	<?php 

	$width = 825;

	if ( is_singular( 'project' ) && ! empty( $meta->content->type ) && 'editor' === $meta->content->type ) {

		$width = 1110;

	}

	?>

	<div class="blog-post <?php echo esc_attr( $classes ); ?>">

		<div class="post-title">
			<h4>

				<?php if ( $isSingle ) : ?>

					<?php $content->title(); ?>

				<?php else : ?>
					
					<a href="<?php echo esc_url( $link ); ?>"><?php $content->title() ?></a>

				<?php endif; ?>

			</h4>
			<div class="post-meta">
					
					<?php if ( ! $isSingle ): ?>

						<span class="date">

							<a href="<?php echo esc_url( $link ); ?>">

								<?php the_time( 'd' ); ?> <?php the_time( 'M' ); ?>

							</a>

						</span>

					<?php else: ?>

						<span class="date">
							<?php the_time( 'd' ); ?> <?php the_time( 'M' ); ?> 

						</span>

					<?php endif; ?>
					<span class="slash">&#47;</span>
					<?php _e("BY ",'nietzsche'); ?>
					<?php the_author_posts_link(); ?> 

					<?php if ( 'post' === $type ): ?>

						<span class="slash">&#47;</span>
						<?php $content->category(); ?>
						
					<?php endif; ?>

			</div>
		</div>

		<?php if ( ! post_password_required( $post->ID ) ): ?>

			<div class="post-media">

				<?php switch( $content->format() ): case "gallery": // Gallery post ?>
				
						<?php $t->media->w( $width ); ?>
						<?php $t->media->h( 0 ); ?>
						<?php $t->gallery->output($meta->gallery->ids, 'GalleryImages' ); ?>

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

							<?php $content->img( $width, 0 ); ?>

						<?php endif; ?>

				<?php endswitch; ?>

			</div>
			
		<?php endif; ?>

		<div class="post-body pe-wp-default">

			<?php $content->content(); ?>
			<?php $content->linkPages(); ?>

		</div>

		<?php if ( $isSingle && $type === 'post' && has_tag() ) : ?>

			<div class="tags">
				<span class="tags-title">Tags:</span>
				<?php the_tags( '', '&#47; ', '' ); ?>

			</div>

		<?php endif; ?>

		<?php if ( $isSingle ): ?>

			<?php comments_template(); ?>

		<?php endif; ?>

	</div>

<?php endwhile; ?>
