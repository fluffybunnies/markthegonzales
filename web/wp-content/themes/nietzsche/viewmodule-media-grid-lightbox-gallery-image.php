<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheMediaGridLightboxGalleryImage' ); ?>

<li
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section section-builder section-type-media-grid-lightbox-gallery-image"
>

	<?php if ( $data->image ) : ?>

		<a data-group="<?php echo esc_attr( $data->lightbox_group ); ?>" data-caption="<?php echo esc_attr( $data->lightbox_captions ); ?>" href="<?php echo esc_url( $data->image ); ?>"></a>

	<?php endif; ?>

</li>