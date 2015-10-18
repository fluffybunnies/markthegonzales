<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>

<?php $menu_name = empty( $meta->header->custom_menu ) ? 'main' : $meta->header->custom_menu; ?>

<?php $t->menu->location( $menu_name, 'wrapper-slide-left' ); ?>