<?php $t =& peTheme(); ?>
<?php list( $menu ) = $t->template->data(); ?>

<?php foreach ( $menu->items as $item ) : ?>

	<li class="<?php echo sanitize_html_class( ( $item->current ) ? 'current' : '' ); ?>">
		<a href="<?php echo esc_url( $item->url ); ?>"><?php esc__pe( $item->title ); ?></a>
	</li>

	<?php if ( $item->is_menu ) : ?>

		<?php $t->menu->output( $item, 'side' ); ?>

	<?php endif; ?>

<?php endforeach; ?>