<?php get_header(); ?>

<section id="omc-main">	

	
	<div class="omc-cat-top"><h1><?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <em>%s</em>', 'gonzo' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <em>%s</em>', 'gonzo' ), get_the_date('F Y') ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <em>%s</em>', 'gonzo' ), get_the_date('Y') ); ?>
<?php else : ?>
				<?php _e( 'Blog Archives', 'gonzo' ); ?>
<?php endif; ?></h1></div>	

	
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