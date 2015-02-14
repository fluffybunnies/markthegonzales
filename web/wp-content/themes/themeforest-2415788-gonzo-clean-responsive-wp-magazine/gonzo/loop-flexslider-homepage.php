<div class="flex-container omc-resize-620">
	
		<div class="flexslider">
		
		    <ul class="slides">
		    
			<?php $pageposts = get_posts( array( 'meta_key' => 'omc_featured_post', 'meta_value' => '1', 'posts_per_page' => 8 ) ); ?>

			<?php 			
				$i = 0;
				if ($pageposts):
				foreach ($pageposts as $post):
				setup_postdata($post); 
				$category = get_the_category(); 
				$omc_is_video = get_post_meta(get_the_ID(), 'omc_is_video', true);  
				$i++;
				$format = get_post_format();
				if ($i <9) {
			?>			

		    	<li>	
				
					<?php if($category[0]){ echo '<a href="'.get_category_link($category[0]->term_id ).'" class="omc-flex-category">'.$category[0]->cat_name.'</a>';} ?>
					
		    		<a href="<?php the_permalink();?>">
					
						<?php if ($format == 'video' || $format == 'audio') {?>
						
							<span class="omc-big-video-icon"></span>
							
						<?php } ?>
						
						<?php if (has_post_thumbnail()) { 
						
								the_post_thumbnail('featured-image'); 
								
							} else {
							
								echo('<img src="'.get_template_directory_uri().'/images/no-image-featured-image.png" class="omc-image-resize" alt="no image" />');
								
						} ?>
					
					</a>
					
		    		<div class="flex-caption omc-featured-overlay">
					
					<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
						
						<p><?php wpe_excerpt('wpe_minislider', 'wpe_excerptmore'); ?></p>
						
					</div>
		    	</li>

			<?php } endforeach; 	endif; wp_reset_query();?>		    
			
		    </ul><!-- /slides -->
			
		 </div><!-- /flexsilder -->
		 
	</div><!-- /felx-container -->