<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php list( $menu ) = $t->template->data(); ?>

<?php $menu_copyright = $t->options->get( 'menu_copyright' ); ?>
<?php $menu_copyright = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->header->header_type ) && 'global' !== $meta->header->header_type ) ? $meta->header->menu_copyright  : $menu_copyright; ?>

<div class="overlay-navigation-wrapper">
	<div class="overlay-navigation-inner">
		<div class="overlay-navigation-header row full-width">
			<div id="overlay-nav-hide" class="navigation-hide">
				<a href="#">
					<span class="icon-cancel medium"></span>
				</a>
			</div>
		</div>
		<nav class="overlay-navigation">
			<ul>

				<?php $t->menu->output( $menu, 'overlay' ); ?>

			</ul>
		</nav>

		<?php if ( $menu_copyright ) : ?>

			<div class="overlay-navigation-footer row full-width">
				<div class="column width-12">
					<p class="copyright no-margin-bottom"><?php esc__pe( esc_html( $menu_copyright ) ); ?></p>
				</div>
			</div>

		<?php endif; ?>
		
	</div>
</div>