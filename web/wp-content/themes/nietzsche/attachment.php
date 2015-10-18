<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php get_header(); ?>

<?php if ( wp_attachment_is_image( $post->id ) ) : ?>

	<div class="section-block row">

		<div class="column width-12 content-inner">

			<h1><?php $content->title(); ?></h1>

			<?php if ( ! post_password_required( $post->ID ) ): ?>

				<div class="post-media">

					<?php $img = wp_get_attachment_image_src( $post->id, 'full' ); ?>
					<?php $content->img( 1140, 0, $img[0] ); ?>

				</div>
				
			<?php else : ?>

				<?php echo get_the_password_form(); ?>

			<?php endif; ?>

		</div>

	</div>

<?php endif; ?>

<?php get_footer(); ?>