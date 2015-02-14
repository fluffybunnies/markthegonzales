<?php
/*
Template Name: Gallery List Page
*/
?>

<?php get_header(); ?>

<section id="omc-main">	

	
	<div class="omc-cat-top">
	
		<h1><em><?php _e('Galleries', 'gonzo');?></em></h1>
		
	</div>
	
	<?php 
	
	global $wp_query,$paged,$post;						
	$nextargsT = array('posts_per_page' => 999 );
	$nextloopT = new WP_Query( $nextargsT );
	$i = 0;
	while ( $nextloopT->have_posts() ) : $nextloopT->the_post();
	$format = get_post_format();
	if ( false === $format )
	$format = 'standard';	
	if ($format == 'gallery' ) { ?>
		
	<article class="omc-blog-two omc-half-width-category" id="post-<?php the_ID(); ?>">		
		
		<div class="omc-resize-290 omc-blog">
		
			<?php if ($format == 'video') { ?><span class="module-a-video-icon-big omc-half-width-icon omc-module-b-left"></span><?php } ?>
			<?php if ($format == 'audio') { ?><span class="module-a-audio-icon-big omc-half-width-icon"></span><?php } ?>
			<?php if ($format == 'gallery') { ?><span class="module-a-gallery-icon-big omc-half-width-icon"></span><?php } ?>
			<?php if ($format == 'standard') { ?><span class="module-a-standard-icon-big omc-half-width-icon"></span><?php } ?>
		
			<?php $category = get_the_category(); ?>
			
			<h3 class="omc-blog-two-cat"><a href="<?php echo home_url(); echo ('/?cat='.$category[0]->term_id); ?>"><?php echo $category[0]->cat_name; ?></a></h3>
			
			<a href="<?php the_permalink();?>" >
			
				<?php if (has_post_thumbnail()) { 
				
					the_post_thumbnail('half-landscape', array('class' => 'omc-image-resize')); 
					
				} else {
				
					echo('<img src="'.get_template_directory_uri().'/images/no-image-half-landscape.png" class="omc-image-resize" alt="no image" />');
					
				} ?>

			</a>
			
		</div><!-- /omc-resize-290 -->
		
		<div class="omc-blog-two-text">
		
			<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

			<p class="omc-blog-two-date"><?php the_time('F jS, Y') ?> | <em><?php _e('by', 'gonzo'); ?> <?php the_author() ?></em></p>
			
			<p class="omc-blog-two-exceprt" ><?php wpe_excerpt('blog_2', 'wpe_excerptmore'); ?></p>
			
			<br class="clear" />
		
		</div><!-- /omc-blog-two-text -->
		
	</article>

	<?php } endwhile;  wp_reset_query(); ?> 

	<br class="clear" />
		
</section><!-- /omc-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>