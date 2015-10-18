<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheContactDetails' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section-builder section-type-contact-details column width-5"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>
	
	<div class="<?php echo 'yes' === $data->padding ? esc_attr( 'box xlarge' ) : ''; ?>" <?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'color:color', 'border-color:bgcolor' ) ); ?>>

		<?php if ( $data->title ) : ?>

			<h6
				class="color-gray no-margin-top"
				<?php esc__pe( $content->get_style( $data, 'color:title_color' ) ); ?>
			>
				<?php esc__pe( $data->title ); ?>
			</h6>

		<?php endif; ?>

		<?php if ( $data->subtitle ) : ?>

			<p class="lead"><?php esc__pe( $data->subtitle ); ?></p>

		<?php endif; ?>

		<?php if ( $data->description ) : ?>

			<?php esc__pe( do_shortcode( apply_filters( 'the_content', $data->description ) ) ); ?>

		<?php endif; ?>

		<?php if ( ! empty( $data->details ) ) : ?>

			<p>

				<?php foreach ( $data->details as $detail ) : ?>

					<strong><?php esc__pe( $detail['title'] ); ?></strong> <?php esc__pe( $detail['description'] ); ?><br>

				<?php endforeach; ?>

			</p>

		<?php endif; ?>

	</div>

</div>