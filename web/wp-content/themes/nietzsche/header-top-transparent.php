<?php $t =& peTheme();?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>

<?php $menu_type = $t->options->get( 'menu_type' ); ?>
<?php $menu_type = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->header->header_type ) && 'global' !== $meta->header->header_type ) ? $meta->header->menu_type  : $menu_type; ?>

<?php $logo = $t->options->get( 'logo' ); ?>
<?php $logo = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->header->logo ) ) ? $meta->header->logo : $logo; ?>

<?php $alternative_logo = $t->options->get( 'alternative_logo' ); ?>
<?php $alternative_logo = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->header->header_type ) && 'global' !== $meta->header->header_type ) ? $meta->header->alternative_logo  : $alternative_logo; ?>

<header class="header-1 header header-type-top-transparent" data-bkg-threshold="window-height" data-compact-threshold="window-height">
	<div class="header-inner">
		<div class="row nav-bar reveal-side-navigation">
			<div class="column width-12 nav-bar-inner">

				<?php if ( ! empty( $logo ) ) : ?>

					<div class="logo">

						<?php if ( ! empty( $alternative_logo ) ) : ?>

							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url( $alternative_logo ); ?>" alt="Logo">
							</a>

						<?php endif; ?>

						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url( $logo ); ?>" alt="Logo">
						</a>

					</div>					

				<?php else : ?>

					<div class="logo logo-text">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<h3><?php esc__pe( $t->options->get( 'siteTitle' ) );?></h3>
						</a>
					</div>

				<?php endif; ?>

				<?php $main_menu_name = empty( $meta->header->custom_menu ) ? '' : $meta->header->custom_menu; ?>

				<?php $menu_args_check = empty( $main_menu_name ) ? array( 'theme_location' => 'main', 'echo' => false, ) : array( 'menu' => $main_menu_name, 'echo' => false, ); ?>

				<?php $wp_nav_menu = wp_nav_menu( $menu_args_check ); ?>

				<?php if ( $wp_nav_menu ) : ?>

					<div id="<?php echo esc_attr( ( 'overlay' === $menu_type ) ? 'overlay-nav-show' : 'side-nav-show' ); ?>" class="navigation-show">
						<a href="#">
							<span class="icon-menu medium"></span>
						</a>
					</div>

				<?php endif; ?>
				
				<?php $menu_name = empty( $meta->header->custom_side_menu ) ? 'side' : $meta->header->custom_side_menu; ?>

				<?php $t->menu->location( $menu_name, 'wrapper-side' ); ?>

			</div>
		</div>
	</div>
</header>