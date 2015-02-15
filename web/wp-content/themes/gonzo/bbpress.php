<?php get_header(); ?>

<section id="omc-main">	

	<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

	<article id="omc-full-article">		
		
		<?php $omc_comment_type = get_post_meta(get_the_ID(), 'omc_comment_type_page', true);  ?>
		
		<?php 	the_post_thumbnail('blog-full-width', array('class' => 'featured-full-width-top page-margin')); ?>
		
		<?php the_content();?>		
		
		<?php if ($omc_comment_type == 'none' || $omc_comment_type == ''|| $omc_comment_type == 'fb') { ?>
		
			<div class="omc-page-space"></div>
		
		<?php } ?>
		
		<br class="clear" />
		
		<?php 
			// Get the current page url for FB comments
			$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		?>		
		
		<?php if ($omc_comment_type === 'fb' || $omc_comment_type === 'both') { ?>

			<div class="fb-comments" data-href="<?php echo $url; ?>" data-num-posts="4" data-width="620"></div> 
		
		<?php } ?>
		
		<?php if ($omc_comment_type === 'wp' || $omc_comment_type === 'both') { ?>
		
			<?php comments_template( '', true ); ?>
			
		<?php } endwhile; endif; ?>
		
	</article><!-- /omc-full-article -->

</section><!-- /omc-main -->

<?php get_sidebar();?>

<?php get_footer();?>