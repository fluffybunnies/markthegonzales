<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheStat' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section-builder section-type-stat <?php if ( 'large' === $data->size ) echo sanitize_html_class( 'mega-stat' ); ?> stat"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( ! empty( $data->stats ) && is_array( $data->stats ) ) : ?>

		<div class="stat-inner">

			<?php foreach ( $data->stats as $stat ) : ?>

				<p class="counter">
					<span
						class="stat-counter"
						data-count-from="<?php echo absint( $stat['from'] ); ?>"
						data-count-to="<?php echo absint( $stat['to'] ); ?>"
					>
						<?php esc__pe( $stat['description'] ); ?></span><?php esc__pe( $stat['suffix'] ); ?>
					</p>
				<p class="description"><?php esc__pe( $stat['title'] ); ?></p>

			<?php endforeach; ?>

		</div>

	<?php endif; ?>

</div>