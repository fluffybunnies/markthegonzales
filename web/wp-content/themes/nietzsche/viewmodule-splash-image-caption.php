<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheSplashImageCaption' ); ?>

<?php $classes = array(); ?>
<?php $classes[] = sanitize_html_class( $data->font ); ?>
<?php $classes[] = sanitize_html_class( $data->size ); ?>
<?php $classes[] = sanitize_html_class( $data->weight ); ?>
<?php $classes[] = sanitize_html_class( $data->color ); ?>
<?php $classes[] = sanitize_html_class( $data->margin ); ?>

<?php $dom_element = $data->element ? $data->element : 'span'; ?>

<<?php esc__pe( tag_escape( $dom_element ) ); ?>
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section section-builder section-type-splash-image-caption horizon letter-spaced <?php echo esc_attr( join( ' ', $classes ) ); ?>"
	data-animate-in="opacity:0;scale:1.5;duration:400ms;easing:swing;"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( $data->text ) : ?>

		<?php esc__pe( $data->text ); ?>

	<?php endif; ?>

</<?php esc__pe( tag_escape( $dom_element ) ); ?>>

<div class="clear"></div>