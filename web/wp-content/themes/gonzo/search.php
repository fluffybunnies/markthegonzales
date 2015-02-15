<?php get_header(); ?>

<section id="omc-main">	
	
	<div class="omc-cat-top"><h1><?php _e('Results for', 'gonzo');?> <em>"<?php printf(get_search_query());?>"</em></h1></div>	

	<?php 
	if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$omc_review_enable =  get_post_meta(get_the_ID(), 'omc_review_enable', true);
	$omc_final_score =  get_post_meta(get_the_ID(), 'omc_final_score', true);
	$omc_final_percentage = $omc_final_score * 20 ;
	?>		

	<article class="omc-blog-two omc-half-width-category" id="post-<?php the_ID(); ?>">		
		
		<div class="omc-resize-290">
		
			<?php $category = get_the_category(); ?>
			
			<?php if ($omc_review_enable == 1) { ?><span class="omc-blog-two-stars-under leading-article"><span class="omc-blog-two-stars-over leading-article" style="width:<?php echo $omc_final_percentage; ?>%"></span></span><?php } ?>
			<a href="<?php the_permalink();?>" ><?php if (has_post_thumbnail()) { 
							the_post_thumbnail('half-landscape', array('class' => 'omc-image-resize')); 
						} else {
							echo('<img src="'.get_template_directory_uri().'/images/no-image-half-landscape.png" class="omc-image-resize" alt="no image" />');
						} ?></a>
			
		</div><!-- /omc-resize-290 -->
		
		<div class="omc-blog-two-text">
		
			<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

			<p class="omc-blog-two-date"><?php the_time('F jS, Y') ?> | <em><?php _e('by', 'gonzo'); ?> <?php the_author() ?></em></p>
			
			<p class="omc-blog-two-exceprt" ><?php wpe_excerpt('blog_2', 'wpe_excerptmore'); ?></p>
			
			<br class="clear" />
		
		</div><!-- /omc-blog-two-text -->
		
	</article>

	<?php endwhile; else: ?>
		
		<h1><?php _e('Sorry, no entries found.', 'gonzo');?></h1>
	
	<?php endif; ?> 

	<br class="clear" />

	<?php kriesi_pagination(); wp_reset_query(); ?>
		
</section><!-- /omc-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
