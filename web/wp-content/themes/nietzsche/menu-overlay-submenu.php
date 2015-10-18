<?php $t =& peTheme(); ?>
<?php list( $menu ) = $t->template->data(); ?>

<ul class="sub-menu">

	<?php foreach ( $menu->items as $item ) : ?>

		<li class="<?php echo sanitize_html_class( ( $item->current ) ? 'current' : '' ); ?>">
			<a href="<?php echo esc_url( $item->url ); ?>"><?php esc__pe( $item->title ); ?></a>
		</li>

	<?php endforeach; ?>

</ul>