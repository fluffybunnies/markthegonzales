<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php get_header(); ?>

<div class="section-block row">

	<div class="column width-9 content-inner">

		<?php $t->content->loop(); ?>

	</div>

	<?php get_sidebar(); ?>

</div>

<?php if ( is_singular( 'post' ) ) : ?>

	<?php get_template_part( 'common', 'prevnext' ); ?>

<?php endif; ?>

<?php get_footer(); ?>