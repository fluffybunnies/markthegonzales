<?php
/*
Template Name: Best Reviews Page
*/
?>

<?php get_header(); ?>

<section id="omc-main" class="omc-index">

<?php
if ( have_posts() ) : while ( have_posts() ) : the_post(); 
$omc_review_loop =  get_post_meta(get_the_ID(), 'omc_review_loop', true);
$omc_review_category =  get_post_meta(get_the_ID(), 'omc_review_category', true);
$omc_review_count =  get_post_meta(get_the_ID(), 'omc_review_count', true);
$i = 0; 
?>
	<div class="omc-cat-top"><h1><?php the_title(); ?></h1></div>	
	
	<article id="omc-full-article" class="omc-inner-standard">

		<?php the_content(); ?>
		
	</article>

<?php 
endwhile; endif; 
?>
	
<?php 
$idObj = get_category_by_slug($omc_review_category);
$id = $idObj->term_id;
$category_link = get_category_link( $id );
$category_name = get_cat_name( $id );
?>

<?php if ($omc_review_loop === 'blog_one') { ?>

	<?php
	$r = new WP_Query(array('showposts' => $omc_review_count, 'meta_key' => 'omc_final_score', 'orderby' => 'meta_value', 'cat' => $id, 'nopaging' => 0, 'post_status' => 'publish'));
	if ($r->have_posts()) : while ($r->have_posts()) : $r->the_post();  
	$omc_review_enable =  get_post_meta(get_the_ID(), 'omc_review_enable', true);
	$omc_final_score =  get_post_meta(get_the_ID(), 'omc_final_score', true);
	$omc_final_percentage = $omc_final_score * 20 + 2 ;
	$format = get_post_format();
	if ( false === $format )
	$format = 'standard';
	$i++;
	?>			
		
		<article class="omc-blog-one" id="post-<?php the_ID(); ?>">			

			<?php $category = get_the_category(); ?>
			
			<h3 class="omc-blog-one-cat"><a href="<?php echo home_url(); echo ('/?cat='.$category[0]->term_id); ?>"><?php echo $category[0]->cat_name; ?></a></h3>
			
			<a href="<?php the_permalink();?>" >
				
				<span class="omc-blog-one-counter position-fix-<?php if ($i > 9) {echo ('on');} else {echo('off');} ?>"><?php echo $i; ?></span>
				
				<?php if ($format == 'video' || $format == 'audio') { ?><span class="module-a-video-icon-big omc-blog2-icon"></span><?php } ?>

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
			
		</article>
		
	<?php endwhile; endif; wp_reset_query();  ?>

<?php } elseif ($omc_review_loop === 'blog_two') { ?>

	<?php 
	$r = new WP_Query(array('showposts' => $omc_review_count, 'meta_key' => 'omc_final_score', 'orderby' => 'meta_value', 'cat' => $id, 'nopaging' => 0, 'post_status' => 'publish'));
	if ($r->have_posts()) : while ($r->have_posts()) : $r->the_post(); 
	$omc_review_enable =  get_post_meta(get_the_ID(), 'omc_review_enable', true);
	$omc_final_score =  get_post_meta(get_the_ID(), 'omc_final_score', true);
	$omc_final_percentage = $omc_final_score * 20 + 2 ;
	$format = get_post_format();
	if ( false === $format )
	$format = 'standard';
	$i++;
	?>		

	<article class="omc-blog-two omc-half-width-category" id="post-<?php the_ID(); ?>">		
		
		<div class="omc-resize-290 omc-blog">		

			<?php $category = get_the_category(); ?>
			
			<h3 class="omc-blog-two-cat"><a href="<?php echo home_url(); echo ('/?cat='.$category[0]->term_id); ?>"><?php echo $category[0]->cat_name; ?></a></h3>
			
			<?php if ($omc_review_enable == 1) { ?><span class="omc-blog-two-stars-under leading-article"><span class="omc-blog-two-stars-over leading-article" style="width:<?php echo $omc_final_percentage; ?>%"></span></span><?php } ?>
			
			<a href="<?php the_permalink();?>" >
			
				<?php if ($format == 'video' || $format == 'audio') { ?><span class="module-a-video-icon-big omc-half-width-icon omc-module-b-left"></span><?php } ?>
				
				<?php if (has_post_thumbnail()) { 
				
					the_post_thumbnail('half-landscape', array('class' => 'omc-image-resize')); 
					
				} else {
				
					echo('<img src="'.get_template_directory_uri().'/images/no-image-half-landscape.png" class="omc-image-resize" alt="no image" />');
					
				} ?>

			</a>
			
		</div><!-- /omc-resize-290 -->
		
		<div class="omc-blog-two-text">
		
			<h2><span class="omc-blog-two-counter"><?php echo $i; ?></span> <a href="<?php the_permalink();?>"><?php the_title();?></a></h2>

			<p class="omc-blog-two-date"><?php the_time('F jS, Y') ?> | <em><?php _e('by', 'gonzo'); ?> <?php the_author() ?></em></p>
			
			<p class="omc-blog-two-exceprt" ><?php wpe_excerpt('blog_2', 'wpe_excerptmore'); ?></p>
			
			<br class="clear" />
		
		</div><!-- /omc-blog-two-text -->
		
	</article>

	<?php endwhile;  endif; ?> 

	<br class="clear" />

	<?php kriesi_pagination(); wp_reset_query(); ?>

<?php } elseif ($omc_review_loop === 'small') { ?>

	<?php
	$r = new WP_Query(array('showposts' => $omc_review_count, 'meta_key' => 'omc_final_score', 'orderby' => 'meta_value', 'cat' => $id, 'nopaging' => 0, 'post_status' => 'publish'));
	if ($r->have_posts()) : while ($r->have_posts()) : $r->the_post();  
	$omc_review_enable =  get_post_meta(get_the_ID(), 'omc_review_enable', true);
	$omc_final_score =  get_post_meta(get_the_ID(), 'omc_final_score', true);
	$omc_final_percentage = $omc_final_score * 20 + 2 ;
	$format = get_post_format();
	if ( false === $format )
	$format = 'standard';
	$i++;
	?>			
		
		<article class="omc-review-small" id="post-<?php the_ID(); ?>">			

			<?php $category = get_the_category(); ?>
						
			<a href="<?php the_permalink();?>" >
			
				<span class="omc-reviews-small-count"><?php echo $i;?></span>

				<?php if (has_post_thumbnail()) { 
				
					the_post_thumbnail('gallery-links', array('class' => 'omc-small-square-reviews')); 
					
				} else {
				
					echo('<img src="'.get_template_directory_uri().'/images/no-image-small-square.png" class="omc-image-blog-one" alt="no image" />');
					
				} ?>
				
			</a>
			
			<div class="omc-review-small-text">
			
				<h2 class="omc-blog-one-heading">
				
					<a href="<?php the_permalink();?>"><?php the_title();?></a>
				
					<?php if ($omc_review_enable == 1) { ?>
					
						<span class="omc-module-a-stars-under leading-article"><span class="omc-module-a-stars-over leading-article" style="width:<?php echo $omc_final_percentage; ?>%"></span></span>
							
					<?php } ?>	
				
				</h2>
				
				<p class="omc-date-time-one"><b><?php _e('Published on', 'gonzo'); ?></b> <?php the_time('F jS, Y') ?> |  <em><?php _e('by', 'gonzo'); ?> <?php the_author() ?></em></p>
			
			</div>
				
			<br class="clear" />
			
		</article>
		
	<?php endwhile; endif; wp_reset_query();  ?>


<?php } ?>


</section><!-- /omc-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>