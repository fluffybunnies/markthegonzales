<?php 

get_header();

// Get theme options
$theme_options = get_option('option_tree');
$omc_default_blog_style = get_option_tree('omc_default_blog_style', $theme_options, false);
$omc_default_slider = get_option_tree('omc_default_slider', $theme_options, false);
if ( function_exists('shareit_output') ) {
  $h_sticky = shareit_output();
  $dispalyed = false;
}
?>

<section id="omc-main" class="omc-index">
	
	<?php if ($omc_default_slider == 'Yes' && !is_paged() ) {get_template_part( 'loop', 'flexslider-homepage' );} ?>
	
	<?php get_template_part( 'loop', $omc_default_blog_style ); ?>

</section><!-- /omc-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>