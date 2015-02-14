<?php get_header(); ?>

<section id="omc-main">	
	
	<div class="omc-cat-top"><h1>404</h1></div>
	
	<h1><?php _e( 'Not Found', 'gonzo' ); ?></h1>
	
	<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'gonzo' ); ?></p>
	
	<div style="width:250px;"><?php get_search_form(); ?></div>

</section><!-- /omc-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>
