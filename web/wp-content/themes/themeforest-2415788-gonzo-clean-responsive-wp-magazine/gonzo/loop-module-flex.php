<?php if(!is_paged()) { ?>

<div class="flex-container omc-resize-620">

	<div class="flexslider">

		<ul class="slides">

		<?php 
		$category_ID = get_query_var('cat');
		global $wp_query,$paged,$post;
		$i = 0;
		$nextargsT = array( 'cat' => $category_ID, 'posts_per_page' => '99');
		$nextloopT = new WP_Query( $nextargsT );

		while ( $nextloopT->have_posts() ) : $nextloopT->the_post();	
		$category = get_the_category(); 
		$format = get_post_format();
		$omc_featured_post = get_post_meta(get_the_ID(), 'omc_featured_post', true);

		if ($omc_featured_post === '1' ) {

		$i++;
		if ($i < 9) { 
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

			<?php } } endwhile; wp_reset_query(); ?>	

		</ul><!-- /slides -->

	</div><!-- /flexsilder -->

</div><!-- /felx-container -->

<?php } else {?>

<div class="omc-cat-top"><h1><?php _e('Browsing the', 'gonzo');?> <em>"<?php $thisCat = get_category(get_query_var('cat'),false); print_r($thisCat->name);?>"</em> <?php _e('Category', 'gonzo');?> </h1></div>

<?php } ?>