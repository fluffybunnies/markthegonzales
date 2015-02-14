<?php get_header(); ?>

<section id="omc-main" class="omc-main-author">	

	<?php if (!is_paged()) { ?>	
	
		<?php if ( get_the_author_meta( 'description' ) ) : ?>
		
			<div id="omc-author-page">		
				
				<?php 
				$name = get_the_author_meta( 'display_name' );
				$website = get_the_author_meta( 'user_url' );
				$twitter = get_the_author_meta( 'twitter' );
				$facebook = get_the_author_meta( 'facebook' ); 
				$linkedin = get_the_author_meta( 'linkedin' ); 				
				$youtube = get_the_author_meta( 'youtube' ); 				
				$google = get_the_author_meta( 'google' ); 				
				$soundcloud = get_the_author_meta( 'soundcloud' ); 
				?>
				
				<span id="omc-author-page-image"><?php  echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 104 ) ); ?>		</span>	
				
				<h1><?php printf( __( 'About %s', 'gonzo' ), get_the_author() ); ?></h1>
				
				<p><?php the_author_meta( 'display_name' ); ?> <?php the_author_meta( 'description' ); ?><p>
				
				<?php if ($website !== '') {?><div class="omc-author-connect omc-author-website"><?php _e('Website', 'gonzo');?>: <a href="<?php echo $website; ?>"><?php echo $website; ?></a></div><?php } ?> 
				
				<div id="omc-author-social-icons">
				
					<?php if($twitter !== '') {?><a class="omc-author-twitter" href="<?php echo $twitter; ?>"></a><?php } ?>
					<?php if($facebook !== '') {?><a class="omc-author-facebook" href="<?php echo $facebook; ?>"></a><?php } ?>
					<?php if($google !== '') {?><a class="omc-author-google" href="<?php echo $google; ?>"></a><?php } ?>
					<?php if($linkedin !== '') {?><a class="omc-author-linkedin" href="<?php echo $linkedin; ?>"></a><?php } ?>
					<?php if($youtube !== '') {?><a class="omc-author-youtube" href="<?php echo $youtube; ?>"></a><?php } ?>
					<?php if($soundcloud !== '') {?><a class="omc-author-soundcloud" href="<?php echo $soundcloud; ?>"></a><?php } ?>						
					
					<br class="clear" />
					
				</div><!-- /omc-author-social-icons -->					
				
				<br class="clear" />
			
			</div><!-- /omc-author-page -->
		
		<?php endif; rewind_posts(); ?>
		
	<?php } ?>
	
	<div class="omc-cat-top"><h1><?php printf( __( 'Author Archives: %s', 'gonzo' ), "<em>" . get_the_author() . "</em>" ); ?></h1></div>		
	<div class="no-display"></div>

	
	<?php get_template_part('loop', 'blog-style-2'); ?>
	
</section><!-- /omc-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>