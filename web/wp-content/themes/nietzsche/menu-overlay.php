<?php $t =& peTheme(); ?>
<?php list( $menu ) = $t->template->data(); ?>

<?php foreach ( $menu->items as $item ) : ?>

	<li class="<?php echo sanitize_html_class( ( $item->current ) ? 'current' : '' ); ?>">

		<a href="<?php echo esc_url( $item->url ); ?>" class="<?php echo sanitize_html_class( ( $item->is_menu ) ? 'contains-sub-menu' : '' ); ?>"><?php esc__pe( $item->title ); ?></a>

		<?php if ( $item->is_menu ) : ?>

			<?php $t->menu->output( $item, 'overlay-submenu' ); ?>

		<?php endif; ?>

	</li>

<?php endforeach; ?>