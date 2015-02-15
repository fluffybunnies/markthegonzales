<?php get_header(); ?>

<section id="omc-main">	

	<article id="omc-full-article">
		<div class="omc-resize-620" style="max-width:100%">
		<?php $attachment_size = apply_filters( 'twentyten_attachment_size', 620 );
							echo wp_get_attachment_image( $post->ID, array( $attachment_size, 9999 ) ); // filterable image width with, essentially, no limit for image height. ?>
		</div>
		<p><?php the_title();?></p>
	
	</article><!-- /omc-full-article -->

</section><!-- /omc-main -->
</b>
<?php get_sidebar();?>

<?php get_footer();?>