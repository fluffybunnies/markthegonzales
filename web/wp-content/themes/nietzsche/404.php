<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php $t->layout->pageTitle = __( '404 - Page not found' ,'nietzsche'); ?>
<?php get_header(); ?>

<div class="section-block">
	<div class="row">
		<div class="column width-12">

			<div class="header-title">

				<h1><?php esc__pe( $t->layout->pageTitle ); ?></h1>
				<p><?php esc__pe( __( 'Oops, the page you are looking for can\'t be found!' ,'nietzsche') ); ?></p>

			</div>

		</div>
	</div>
</div>

<?php get_footer(); ?>