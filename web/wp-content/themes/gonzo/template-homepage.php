<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

<section id="omc-main">	
				<?php 
      $displayed = false;
      if (function_exists('shareit_output')) {
        $h_sticky = shareit_output();
        $home_page = get_option ('shareit_home', 0);
        if (!$displayed and $h_sticky && $home_page == 1) {
          echo $h_sticky;
          $displayed = true;
        } 
      }
      ?>
	<?php get_template_part( 'loop', 'flexslider-homepage' ); ?>

	<?php 	if ( have_posts() ) : while ( have_posts() ) : the_post(); 	?>
	
		<?php the_content(); ?>		
	
	<?php endwhile; endif; ?>	
	
	<br class="clear" />
	
</section><!-- /main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>