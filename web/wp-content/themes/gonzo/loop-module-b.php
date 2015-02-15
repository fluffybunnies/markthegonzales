<div class="omc-full-width-category omc-module-b">
		
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
			$nextargsT = array( 'cat' => $id, 'posts_per_page' => 6);
			$nextloopT = new WP_Query( $nextargsT );
			
			while ( $nextloopT->have_posts() ) : $nextloopT->the_post();		
				$omc_review_enable =  get_post_meta(get_the_ID(), 'omc_review_enable', true);
				$omc_final_score =  get_post_meta(get_the_ID(), 'omc_final_score', true);
				$omc_final_percentage = $omc_final_score * 20 + 2 ;
				$format = get_post_format();
				if ( false === $format )
				$format = 'standard';
				$i++		
		?>
	
	<?php if ($i == 1) { ?>	
	
		<div class="omc-module-b-left-column omc-resize-290-40margin">
		
			<article class="omc-half-width-post leading">
			
			<a href="<?php the_permalink();?>" class="omc-title-anchor">
			
				<div class="omc-resize-290 omc-relative omc-module">
										
					<?php if ($format == 'video' || $format == 'audio') { ?><span class="module-a-video-icon-big omc-half-width-icon omc-module-b-left"></span><?php } ?>

					<?php if (has_post_thumbnail()) { 
					
						the_post_thumbnail('half-landscape', array('class' => 'omc-image-resize')); 
						
					} else {
					
						echo('<img src="'.get_template_directory_uri().'/images/no-image-half-landscape.png" class="omc-image-resize" alt="no image" />');
						
					} ?>
					
				</div><!-- /resize -->
				
				<h2 class="omc-module-b-header"><?php the_title();?>				
				
				<?php if ($omc_review_enable == 1) { ?>
				
					<span class="omc-module-a-stars-under leading-article"><span class="omc-module-a-stars-over leading-article" style="width:<?php echo $omc_final_percentage; ?>%"></span></span>
						
				<?php } ?>	
				
				</h2>
				
			</a>
			
			<span class="omc-post-details"><span><?php the_time('F jS') ?>  | <?php _e('by', 'gonzo');?></span> <?php the_author();?></span>
			
			<p><?php wpe_excerpt('module_b', 'wpe_excerptmore'); ?>...</p>
			
		</article><!-- /half-width-post -->
		
		</div><!-- /omc-module-b-left-column -->
		
		<div class="omc-module-b-right-column omc-resize-290 drop-background">
	
	<?php } else { ?>
	
		<article class="omc-modulule-b following">
			
			<h3><a href="<?php the_permalink();?>" title="<?php the_title();?>" class="omc-title-anchor"><?php the_title();?></a></h3>
			
		</article><!-- half-width-article -->				
		
	<?php } endwhile; ?>		

		<span class="one-px-line"></span>
		
		<h5 class="omc-also-in">also in the <a href="<?php echo $category_link ;?>"><?php echo $category_name ;?></a> category</h5>
		
		<div class="omc-category-block">
		
			<?php $parent_cat = array( 'child_of' => $id, 'style' => 'none'); wp_list_categories($parent_cat); ?>
			
		</div>
	
	</div><!-- /omc-module-a-right-column" -->
	
	<br class="clear" />

</div><!-- /omc-module-b -->
