<?php $t =& peTheme();?>
<?php list( $menu ) = $t->template->data(); ?>

<nav class="navigation">
	<ul>

		<?php $t->menu->output( $menu, 'side' ); ?>

	</ul>
</nav>