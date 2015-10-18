<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php list( $menu ) = $t->template->data(); ?>

<?php $menu_copyright = $t->options->get( 'menu_copyright' ); ?>
<?php $menu_copyright = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->header->header_type ) && 'global' !== $meta->header->header_type ) ? $meta->header->menu_copyright  : $menu_copyright; ?>

<?php $menu_icons = $t->options->get( 'menu_icons' ); ?>
<?php $menu_icons = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->header->header_type ) && 'global' !== $meta->header->header_type ) ? $meta->header->menu_icons  : $menu_icons; ?>

<?php $menu_bg = $t->options->get( 'menu_bg' ); ?>
<?php $menu_bg = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->header->header_type ) && 'global' !== $meta->header->header_type ) ? $meta->header->menu_bg  : $menu_bg; ?>

<?php $menu_logo = $t->options->get( 'menu_logo' ); ?>
<?php $menu_logo = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->header->header_type ) && 'global' !== $meta->header->header_type ) ? $meta->header->menu_logo  : $menu_logo; ?>

<aside
	id="mobile-access"
	class="side-navigation-wrapper enter-right"

	<?php if ( ! empty( $menu_bg ) ) : ?>

		style="background-image: url( <?php echo esc_url( $menu_bg ); ?> );"

	<?php endif; ?>
>
	<div class="side-navigation-header">

		<?php if ( $menu_logo ) : ?>

			<div class="logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $menu_logo ); ?>" alt="Logo" /></a>
			</div>

		<?php endif; ?>

		<div id="side-nav-hide" class="navigation-hide">
			<a href="#">
				<span class="icon-cancel medium"></span>
			</a>
		</div>
	</div>
	<nav class="side-navigation">
		<ul>

			<?php $t->menu->output( $menu, 'overlay' ); ?>

		</ul>
	</nav>
	<div class="side-navigation-footer">

		<?php if ( ! empty( $menu_icons ) && is_array( $menu_icons ) ) : ?>

			<ul class="social-list list-horizontal">

				<?php foreach( $menu_icons as $menu_icon ) : ?>

					<li><a href="<?php echo esc_url( $menu_icon['url'] ); ?>" class="<?php echo esc_attr( $menu_icon['icon'] ); ?> small" target="_blank"></a></li>

				<?php endforeach; ?>

			</ul>

		<?php endif; ?>

		<?php if ( $menu_copyright ) : ?>

			<span><?php esc__pe( esc_html( $menu_copyright ) ); ?></span>

		<?php endif; ?>

	</div>
</aside>