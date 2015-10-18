<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $loop, $bid ) = $t->template->module( 'NietzscheTeam' ); ?>

<?php $team_class = '1' === $data->style ? 'team-2' : ( '2' === $data->style ? 'team-4' : 'team-3' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-team <?php echo sanitize_html_class( $team_class ); ?>"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'color:color', 'css' ) ); ?>
>

	<div class="row">

		<?php if ( $data->title && empty( $data->description ) && empty( $data->content ) ) : ?>

			<div class="column width-12">
				<h5><?php esc__pe( $data->title ); ?></h5>
			</div>

		<?php endif; ?>

		<?php if ( $data->description || $data->content ) : ?>

			<div class="column width-4">

				<?php if ( $data->title ) : ?>

					<h3 class="weight-light"><?php esc__pe( $data->title ); ?></h3>

				<?php endif; ?>

				<?php if ( $data->description ) : ?>

					<?php esc__pe( str_replace( '<p>', '<p class="lead">', do_shortcode( apply_filters( 'the_content', $data->description ) ) ) ); ?>

				<?php endif; ?>

				<?php if ( $data->content ) : ?>

					<?php esc__pe( do_shortcode( apply_filters( 'the_content', $data->content ) ) ); ?>

				<?php endif; ?>

				<div class="separator"></div>
			</div>

		<?php endif; ?>

		<?php if ( ! empty( $loop->main->loop ) ) : ?>

			<?php $content_class = ( empty( $data->description ) && empty( $data->content ) ) ? 'width-12' : 'width-8'; ?>

			<div class="column <?php echo sanitize_html_class( $content_class ); ?>">

				<?php if ( '1' === $data->style || '2' === $data->style ) : ?>

					<?php $columns_count = absint( $data->content_columns ); ?>
					<?php $row = 1; ?>
					<?php $i = 1; ?>

					<div class="row equalize content-grid-<?php echo absint( $data->content_columns ); ?>">

						<?php while ( $item = $loop->next() ) : ?>

							<?php $row_class = 'row-' . $row; ?>

							<div class="grid-item <?php echo sanitize_html_class( $row_class ); ?>">

								<?php $item->view['data']['style'] = $data->style; ?>
								<?php $item->view['data']['overlay'] = $data->overlay; ?>
								<?php $view->outputModule( $item->view ); ?>

							</div>

							<?php if ( $i === $columns_count ) : ?>

								<?php $row++; ?>

								<?php $i = 1; ?>

							<?php else : ?>
								
								<?php $i++; ?>

							<?php endif; ?>

						<?php endwhile; ?>

					</div>

				<?php elseif ( '3' === $data->style ) : ?>

					<div class="tm-slider-container team-slider" data-columns="<?php echo absint( $data->content_columns ); ?>">
						<ul class="tms-slides">

							<?php while ( $item = $loop->next() ) : ?>

								<li class="tms-slide">

									<?php $item->view['data']['style'] = $data->style; ?>
									<?php $view->outputModule( $item->view ); ?>

								</li>

							<?php endwhile; ?>

						</ul>
					</div>

				<?php endif; ?>

			</div>

		<?php endif; ?>

	</div>

</section>