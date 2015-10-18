<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheLogo' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section-builder section-type-logo"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( $data->url ) : ?>

		<a href="<?php echo esc_url( $data->url ); ?>" target="_blank">

	<?php else : ?>

		<span>

	<?php endif; ?>

	<?php if ( $data->image ) : ?>

		<img src="<?php echo esc_url( $data->image ); ?>" alt="<?php echo esc_attr( __( 'Logo' ,'nietzsche') ); ?>">

	<?php endif; ?>

	<?php if ( $data->url ) : ?>

		</a>

	<?php else : ?>

		</span>

	<?php endif; ?>

</div>