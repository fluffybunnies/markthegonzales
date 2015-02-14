<?php 
if ( have_posts() ) : while ( have_posts() ) : the_post(); 
$omc_review_enable =  get_post_meta(get_the_ID(), 'omc_review_enable', true);
$omc_final_score =  get_post_meta(get_the_ID(), 'omc_final_score', true);
$omc_final_percentage = $omc_final_score * 20 ;
$format = get_post_format();
if ( false === $format )
$format = 'standard';

wp_link_pages();

?>			
	
	<article class="omc-blog-one" id="post-<?php the_ID(); ?>">	
		

		<?php $category = get_the_category(); ?>
		
		<h3 class="omc-blog-one-cat"><a href="<?php home_url(); echo ('/?cat='.$category[0]->term_id); ?>"><?php echo $category[0]->cat_name; ?></a></h3>
		
		<a href="<?php the_permalink();?>" >
			
			<?php if ($format == 'video') { ?><span class="module-a-video-icon-big omc-full-width-icon"></span><?php } ?>
			<?php if ($format == 'audio') { ?><span class="module-a-audio-icon-big omc-full-width-icon"></span><?php } ?>
			<?php if ($format == 'gallery') { ?><span class="module-a-gallery-icon-big omc-full-width-icon"></span><?php } ?>
			<?php if ($format == 'standard') { ?><span class="module-a-standard-icon-big omc-full-width-icon"></span><?php } ?>	
			<?php if (has_post_thumbnail()) { 
			
				the_post_thumbnail('blog-one', array('class' => 'omc-image-blog-one')); 
				
			} else {
			
				echo('<img src="'.get_template_directory_uri().'/images/no-image-blog-one.png" class="omc-image-blog-one" alt="no image" />');
				
			} ?>
			
		</a>
		
		<h2 class="omc-blog-one-heading">
		
			<a href="<?php the_permalink();?>"><?php the_title();?></a>
		
			<?php if ($omc_review_enable == 1) { ?>
			
				<span class="omc-module-a-stars-under leading-article"><span class="omc-module-a-stars-over leading-article" style="width:<?php echo $omc_final_percentage; ?>%"></span></span>
					
			<?php } ?>	
		
		</h2>
		
		<p class="omc-date-time-one"><b><?php _e('Published on', 'gonzo'); ?></b> <?php the_time('F jS, Y') ?> |  <em><?php _e('by', 'gonzo'); ?> <?php the_author() ?></em></p>
			
		<p class="omc-blog-one-exceprt"><?php wpe_excerpt('blog_1', 'wpe_excerptmore'); ?>... <a href="<?php the_permalink(); ?>"><b><?php _e('Read More', 'gonzo');?></b></a> <span class="omc-rarr"  >&rarr;</span></p>
		
		<br class="clear" />

		<div <?php post_class(); ?>></div>
		
	</article>
	
<?php endwhile; endif; ?>

<?php kpaginate_links(); wp_reset_query(); ?>