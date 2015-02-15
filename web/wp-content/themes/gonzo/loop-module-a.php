<div class="omc-half-width-category omc-module-a">
	
	<?php 
	
	$idObj = get_category_by_slug($category);
	$id = $idObj->term_id;
	$category_link = get_category_link( $id );
	$category_name = get_cat_name( $id );
	
	?>
	
	
	
	<h1 class="omc-half-width-label"><a href="<?php echo $category_link ;?>"><?php echo $category_name ;?></a></h1>
	
	<?php 	
			global $wp_query,$paged,$post;
			$i = 0;
			$nextargsT = array( 'cat' => $id, 'posts_per_page' =>5);
			$nextloopT = new WP_Query( $nextargsT );
			
			while ( $nextloopT->have_posts() ) : $nextloopT->the_post();		
				$omc_is_video =  get_post_meta(get_the_ID(), 'omc_is_video', true);
				$omc_review_enable =  get_post_meta(get_the_ID(), 'omc_review_enable', true);
				$omc_final_score =  get_post_meta(get_the_ID(), 'omc_final_score', true);
				$omc_final_percentage = $omc_final_score * 20 + 2 ;
				$format = get_post_format();
				if ( false === $format )
				$format = 'standard';
				$i++		
	?>
	
	<?php if ($i == 1) { ?>
	
		<article class="omc-half-width-post leading">
		
			<a href="<?php the_permalink();?>" class="omc-title-anchor" >
			
				<div class="omc-resize-290 omc-module">
				
					<?php if ($format == 'video') { ?><span class="module-a-video-icon-big omc-half-width-icon"></span><?php } ?>
					<?php if ($format == 'audio') { ?><span class="module-a-audio-icon-big omc-half-width-icon"></span><?php } ?>
					<?php if ($format == 'gallery') { ?><span class="module-a-gallery-icon-big omc-half-width-icon"></span><?php } ?>
					<?php if ($format == 'standard') { ?><span class="module-a-standard-icon-big omc-half-width-icon"></span><?php } ?>
		
					<?php if (has_post_thumbnail()) { 
			
						the_post_thumbnail('half-landscape', array('class' => 'omc-image-resize')); 
						
					} else {
					
						echo('<img src="'.get_template_directory_uri().'/images/no-image-half-landscape.png" class="omc-image-resize" alt="no image" />');
						
					} ?>	
					
				</div><!-- /resize -->
				
				<h2><em><?php the_title();?></em>
				
				<?php if ($omc_review_enable == 1) { ?>
				
					<span class="omc-module-a-stars-under leading-article"><span class="omc-module-a-stars-over leading-article" style="width:<?php echo $omc_final_percentage; ?>%"></span></span>
						
				<?php } ?>	
				
				</h2>
					
			</a>
			
			<p><?php wpe_excerpt('wpe_module_a', 'wpe_excerptmore'); ?>...</p>
			
		</article><!-- /half-width-leader -->	
	
	<?php } elseif ($i < 5) { ?>
	
		<article class="omc-half-width-post following">
		
			<a href="<?php the_permalink();?>"><?php if ($omc_is_video == '1') { ?><span class="omc-small-video-icon"></span><?php } ?><?php the_post_thumbnail('small-square');?></a>
			
			<h3><?php $category = get_the_category(); if($category[0]){echo '<a class="omc-title-category-context" href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?><a href="<?php the_permalink();?>" class="omc-title-anchor"><?php the_title();?></a> <em style="color:#F9BA000;">   &rarr;</em> </h3>
			
			<?php if ($omc_review_enable == 1) { ?>
			
				<span class="omc-module-a-stars-under"><span class="omc-module-a-stars-over" style="width:<?php echo $omc_final_percentage; ?>%"></span></span>
				
			<?php } else { ?>			
			
				<span class="omc-post-details"><span><?php the_time('F jS') ?>  | <?php _e('by', 'gonzo');?></span> <?php the_author();?></span>
				
			<?php } ?>
			
		</article><!-- half-width-article -->
	
	<?php } endwhile; ?>
	
</div><!-- /half-width-category -->