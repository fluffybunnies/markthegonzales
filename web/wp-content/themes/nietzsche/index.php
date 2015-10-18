<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php $t->layout->pageTitle = __("The Blog",'nietzsche'); ?>
<?php get_header(); ?>

<div class="row">
	<div class="column width-12">

		<div class="header-title">

			<h1><?php esc__pe( $t->layout->pageTitle ); ?></h1>

		</div>

	</div>
</div>

<div class="section-block row">

	<div class="column width-9 content-inner">

		<?php $t->content->loop(); ?>

	</div>

	<?php get_sidebar(); ?>

</div>

<?php if ( ! is_single() ) : ?>

	<?php $t->content->pager(); ?>

<?php endif; ?>

<?php get_footer(); ?>