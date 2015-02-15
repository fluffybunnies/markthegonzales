<?php // Get theme options
$theme_options = get_option('option_tree');
$omc_gallery_page = get_option_tree('omc_gallery_page', $theme_options, false);
?>

<div class="omc-full-width-category omc-gallery-list">

	<?php 
	if ($category !== 'all') {
		$idObj = get_category_by_slug($category);
		$id = $idObj->term_id;
		$category_link = get_category_link( $id );
		$category_name = get_cat_name( $id );
	} 
	
	?>

	<h1 class="omc-half-width-label omc-module-gallery"><a class="omc-gallery-header" href="<?php if ($omc_gallery_page !== NULL) { echo $omc_gallery_page;} else {echo ('#');}?>"><?php _e('Galleries', 'gonzo');?></a></h1>
	
	<div id="carousel" class="es-carousel-wrapper">

		<div class="es-carousel">
		
			<ul>
			
			<?php 

				global $wp_query,$paged,$post;					
				
				if ($category === 'all') {				
					$nextargsT = array('posts_per_page' => 999 );					
				} else {				
					$nextargsT = array('posts_per_page' => 999, 'cat' => $id );	
				}
				
				$nextloopT = new WP_Query( $nextargsT );
				$i = 0;
				
				while ( $nextloopT->have_posts() ) : $nextloopT->the_post();
					
					$format = get_post_format();
					if ( false === $format )
						$format = 'standard';			
					
					if ($format == 'gallery' ) { $i++; 
						
						if ($i < 15) { ?>
						
						<li>
						
							<span><?php the_title();?></span>
							
							<a href="<?php the_permalink();?>">
							
							<?php if (has_post_thumbnail()) { 
		
								the_post_thumbnail('gallery-links'); 
								
							} else {
							
								echo('<img src="'.get_template_directory_uri().'/images/no-image-gallery-links.png" alt="no image" />');
								
							} ?>	
							
							</a>
							
						</li>
					
					<?php } ?>
				
				<?php } ?>
				
			<?php endwhile; ?>
				
			</ul>
			
		</div>
		
	</div><!-- End Elastislide Carousel -->

</div><!-- /omc-gallery-list -->