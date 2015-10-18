<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php $t->layout->pageTitle = __("The Blog",'nietzsche'); ?>
<?php get_header(); ?>

<?php if ( 'editor' === $meta->content->type ) : ?>

	<div class="section-block row">

		<div class="column width-12 content-inner">

			<?php $t->content->loop(); ?>

		</div>

	</div>

	<?php get_template_part( 'common', 'prevnext' ); ?>

<?php else : ?>

	<?php while ( $content->looping() ) : ?>

		<div id="page-builder-wrap">

			<?php $content->builder(); ?>

			<?php get_template_part( 'common', 'prevnext' ); ?>

		</div>

	<?php endwhile; ?>

<?php endif; ?>

<?php get_footer(); ?>