<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheGoogleMapLocation' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section-builder section-type-google-map-location"

	<?php if ( $data->lat ) : ?>

		data-latitude="<?php echo esc_attr( $data->lat ); ?>"

	<?php endif; ?>

	<?php if ( $data->lon ) : ?>

		data-longitude="<?php echo esc_attr( $data->lon ); ?>"

	<?php endif; ?>

	<?php if ( $data->marker ) : ?>

		data-marker="<?php echo esc_url( $data->marker ); ?>"

		<?php $attachment_id = $t->image->get_attachment_id( $data->marker ); ?>

		<?php if ( $attachment_id ) : ?>

			<?php $attachment_data = wp_prepare_attachment_for_js( $attachment_id ); ?>

		<?php else : ?>

			<?php $attachment_data = array(); ?>

		<?php endif; ?>

		<?php if ( ! empty( $attachment_data['width'] ) ) : ?>

			data-marker-width="<?php echo absint( intval( $attachment_data['width'] / 2 ) ); ?>"

		<?php else : ?>

			data-marker-width="45"

		<?php endif; ?>

		<?php if ( ! empty( $attachment_data['height'] ) ) : ?>

			data-marker-height="<?php echo absint( intval( $attachment_data['height'] / 2 ) ); ?>"

		<?php else : ?>

			data-marker-height="53"

		<?php endif; ?>

	<?php endif; ?>

	<?php if ( $data->description ) : ?>

		data-description="<?php echo esc_attr( $data->description ); ?>"

	<?php endif; ?>
>
</div>