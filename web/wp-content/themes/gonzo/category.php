<?php get_header(); ?>

<section id="omc-main">	

	<?php // Category - Featured Slider
	$category_ID = get_query_var('cat');
	$category_featured_enabled = get_tax_meta($category_ID,'omc_featured_slider');		
	if ($category_featured_enabled == 'on') { get_template_part('loop', 'module-flex'); } else { ?>

	<div class="omc-cat-top"><h1><?php _e('Browsing the', 'gonzo');?> <em>"<?php $thisCat = get_category(get_query_var('cat'),false); print_r($thisCat->name);?>"</em> <?php _e('Category', 'gonzo');?> </h1></div>	
	
	<?php } ?>
	
	<?php // Determine whether to use a preset blog style or echo content (with shortcodes)
		
	$category_blog_style = get_tax_meta($category_ID,'omc_blog_style');		
	$category_content = get_tax_meta($category_ID,'omc_content_field_id');
	
	if ($category_blog_style == '') {		
		get_template_part('loop', 'blog-style-2');	
	} else if ($category_blog_style == 'shortcodes') {		
		echo do_shortcode($category_content);
	} else {		
		get_template_part('loop', $category_blog_style);		
	}
	?>
	
</section><!-- /omc-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>