<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheMediaGridLightboxGalleryCaption' ); ?>

<?php $classes = array(); ?>
<?php $classes[] = sanitize_html_class( $data->font ); ?>
<?php $classes[] = sanitize_html_class( $data->size ); ?>
<?php $classes[] = sanitize_html_class( $data->weight ); ?>
<?php $classes[] = sanitize_html_class( $data->color ); ?>
<?php $classes[] = sanitize_html_class( $data->margin ); ?>

<?php $dom_element = $data->element ? $data->element : 'span'; ?>

<?php if ( $data->padding ) : ?>

	<div class="bkg- <?php echo esc_attr( $data->padding ); ?>" <?php esc__pe( $content->get_style( $data, 'background-color:bgcolor' ) ); ?>>

<?php endif; ?>

<<?php esc__pe( tag_escape( $dom_element ) ); ?>
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section-type-media-grid-caption letter-spaced <?php echo esc_attr( join( ' ', $classes ) ); ?>"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( $data->text ) : ?>

		<?php esc__pe( $data->text ); ?>

	<?php endif; ?>

</<?php esc__pe( tag_escape( $dom_element ) ); ?>>

<?php if ( $data->padding ) : ?>

	</div>

<?php endif; ?>

<?php if ( 'span' === $dom_element ) : ?>

	<br>

<?php else : ?>

	<div class="clear"></div>

<?php endif; ?>