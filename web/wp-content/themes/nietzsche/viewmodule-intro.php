<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheIntro' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-intro"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'color:color', 'css' ) ); ?>
>

	<div class="row medium">

		<?php if ( $data->title ) : ?>

			<div class="column width-10">
				<h2 class="weight-light"><?php esc__pe( $data->title ); ?></h2>
			</div>

		<?php endif; ?>

		<?php if ( $data->content ) : ?>

			<div class="column width-11">
				<?php esc__pe( str_replace( '<p>', '<p class="lead">', do_shortcode( apply_filters( 'the_content', $data->content ) ) ) ); ?>
			</div>

		<?php endif; ?>

	</div>

</section>