<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>

<div class="section-block bkg-grey-ultralight pagination-2">
	<div class="row full-width collapse">

		<?php $previous_post = get_adjacent_post( false, '', true ); ?>
		<?php $previous_post_link = $content->prevPostLink(); ?>

		<?php if ( is_a( $previous_post, 'WP_Post' ) && has_post_thumbnail( $previous_post->ID ) ) : ?>

			<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $previous_post->ID ), 'full' ); ?>

			<div class="column width-6" style="background-image: url( '<?php echo esc_url( $featured_image[0] ); ?>' );">

		<?php else : ?>

			<div class="column width-6">

		<?php endif; ?>


			<a href="<?php echo esc_url( $previous_post_link? $previous_post_link : '#' ); ?>" class="pagination-previous <?php echo sanitize_html_class( $previous_post_link ? '' : ' disabled' ); ?>">
				<small><?php esc__pe( __( 'Previous' ,'nietzsche') ); ?></small>

				<?php if ( is_a( $previous_post, 'WP_Post' ) ) : ?>

					<span><?php esc__pe( $previous_post->post_title ); ?></span>

				<?php else : ?>

					<span><?php esc__pe( __( 'No More Posts' ,'nietzsche') ); ?></span>

				<?php endif; ?>

				
			</a>
		</div>

		<?php $next_post = get_adjacent_post( false, '', false ); ?>
		<?php $next_post_link = $content->nextPostLink(); ?>

		<?php if ( is_a( $next_post, 'WP_Post' ) && has_post_thumbnail( $next_post->ID ) ) : ?>

			<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $next_post->ID ), 'full' ); ?>

			<div class="column width-6" style="background-image: url( '<?php echo esc_url( $featured_image[0] ); ?>' );">

		<?php else : ?>

			<div class="column width-6">

		<?php endif; ?>

			<a href="<?php echo esc_url( $next_post_link? $next_post_link : '#' ); ?>" class="pagination-next <?php echo sanitize_html_class( $next_post_link ? '' : ' disabled' ); ?>">
				<small><?php esc__pe( __( 'Next' ,'nietzsche') ); ?></small>
				
				<?php if ( is_a( $next_post, 'WP_Post' ) ) : ?>

					<span><?php esc__pe( $next_post->post_title ); ?></span>

				<?php else : ?>

					<span><?php esc__pe( __( 'No More Posts' ,'nietzsche') ); ?></span>

				<?php endif; ?>

			</a>
		</div>
	</div>
</div>