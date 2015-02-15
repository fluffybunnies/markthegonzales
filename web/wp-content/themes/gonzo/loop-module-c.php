<div class="omc-quarter-width-category omc-module-c">
	
	<?php 

	$idObj = get_category_by_slug($category);
	$id = $idObj->term_id;
	$category_link = get_category_link( $id );
	$category_name = get_cat_name( $id );
	
	?>
	
	<h2 class="omc-quarter-width-label"><a href="<?php echo $category_link ;?>"><?php echo $category_name ;?></a></h2>
	
	<?php 	
	global $wp_query,$paged,$post;
	$i = 0;
	$nextargsT = array( 'cat' => $id, 'posts_per_page' => 1);
	$nextloopT = new WP_Query( $nextargsT );
	
	while ( $nextloopT->have_posts() ) : $nextloopT->the_post();		
		$omc_is_video =  get_post_meta(get_the_ID(), 'omc_is_video', true);
		$omc_review_enable =  get_post_meta(get_the_ID(), 'omc_review_enable', true);

	?>

		<article>
		
			<a href="<?php the_permalink();?>" class="omc-title-anchor" title="<?php the_title(); ?>">
			
				<div class="omc-resize-134">
				
					<?php if ($omc_is_video == '1') { ?><span class="module-c-video-icon-big"></span><?php } ?>
					
					<?php if (has_post_thumbnail()) { 
					
							the_post_thumbnail('half-landscape', array('class' => 'omc-image-resize')); 
							
						} else {
						
							echo('<img src="'.get_template_directory_uri().'/images/no-image-half-landscape.png" class="omc-image-resize" alt="no image" />');
							
					} ?>
					
				</div><!-- /resize -->
				
				<h3 class="omc-module-c-heading"><?php the_title();?></h3>
				
			</a>
			
			<p class="omc-module-c-excerpt"><?php wpe_excerpt('module_c', 'wpe_excerptmore'); ?></p>
			
		</article><!-- /half-width-leader -->	
	
	<?php endwhile; ?>
	
</div><!-- /half-width-category -->