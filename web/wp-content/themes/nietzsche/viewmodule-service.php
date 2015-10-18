<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheService' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section-builder section-type-service"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( $data->title ) : ?>

		<h6 class="color-gray"><?php esc__pe( $data->title ); ?></h6>

	<?php endif; ?>

	<?php if ( ! empty( $data->content ) ) : ?>

		<?php esc__pe( do_shortcode( apply_filters( 'the_content', $data->content ) ) ); ?>

	<?php endif; ?>

</div>