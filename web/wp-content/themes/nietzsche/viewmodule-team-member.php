<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheTeamMember' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section-builder section-type-team-member team-content"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( '1' === $data->style ) : ?>

		<?php if ( $data->image ) : ?>

			<img src="<?php echo esc_url( $data->image ); ?>" alt="<?php echo esc_attr( $data->name ); ?>">

		<?php endif; ?>

		<div class="team-content-info">

			<?php if ( $data->name ) : ?>

				<h5><?php esc__pe( $data->name ); ?></h5>

			<?php endif; ?>

			<?php if ( $data->role ) : ?>

				<h6 class="occupation"><?php esc__pe( $data->role ); ?></h6>

			<?php endif; ?>

			<?php if ( $data->signature ) : ?>

				<img class="signature" src="<?php echo esc_url( $data->signature ); ?>" alt="<?php echo esc_attr( $data->name ); ?>">

			<?php endif; ?>

			<?php if ( $data->description ) : ?>

				<?php esc__pe( do_shortcode( apply_filters( 'the_content', $data->description ) ) ); ?>

			<?php endif; ?>

			<?php if ( ! empty( $data->social_icons ) ) : ?>

				<div class="social-list boxed">

					<?php foreach ( $data->social_icons as $icon ) : ?>

						<a href="<?php echo esc_url( $icon['url'] ); ?>" target="_blank" class="<?php echo sanitize_html_class( $icon['icon'] ); ?> small"></a>

					<?php endforeach; ?>

				</div>

			<?php endif; ?>

		</div>

	<?php elseif ( '2' === $data->style ) : ?>

		<div class="team-content-info">

			<?php if ( $data->name ) : ?>

				<h5><?php esc__pe( $data->name ); ?></h5>

			<?php endif; ?>

			<?php if ( $data->role ) : ?>

				<h6 class="occupation"><?php esc__pe( $data->role ); ?></h6>

			<?php endif; ?>

			<div class="divider"></div>
		</div>

		<?php $overlay_class = 'fadein' === $data->overlay ? '' : 'overlay-slide-in-left'; ?>

		<div class="thumbnail <?php echo sanitize_html_class( $overlay_class ); ?>" data-hover-easing="swing">
			<span class="overlay-link">
				
				<?php if ( $data->image ) : ?>

					<img src="<?php echo esc_url( $data->image ); ?>" alt="<?php echo esc_attr( $data->name ); ?>">

				<?php endif; ?>

				<span class="overlay-info animation-slide-in-bottom">
					<span>
						<span>

							<?php if ( $data->signature ) : ?>

								<img src="<?php echo esc_url( $data->signature ); ?>" alt="<?php echo esc_attr( $data->name ); ?>">
								<span class="clear"></span>

							<?php endif; ?>

							<?php if ( $data->description ) : ?>

								<span><?php esc__pe( $data->description ); ?></span>

							<?php endif; ?>

							<?php if ( ! empty( $data->social_icons ) ) : ?>

								<div class="social-list">

									<?php foreach ( $data->social_icons as $icon ) : ?>

										<a href="<?php echo esc_url( $icon['url'] ); ?>" target="_blank" class="<?php echo sanitize_html_class( $icon['icon'] ); ?> small"></a>

									<?php endforeach; ?>

								</div>

							<?php endif; ?>

						</span>
					</span>
				</span>
			</span>
		</div>

	<?php elseif ( '3' === $data->style ) : ?>

		<div class="team-content">
			
			<?php if ( $data->image ) : ?>

				<img data-src="<?php echo esc_url( $data->image ); ?>" src="<?php echo esc_url( $data->image ); ?>" alt="<?php echo esc_attr( $data->name ); ?>">

			<?php endif; ?>

			<div class="team-content-info">
				
				<?php if ( $data->name ) : ?>

					<h5><?php esc__pe( $data->name ); ?></h5>

				<?php endif; ?>

				<?php if ( $data->role ) : ?>

					<h6 class="occupation"><?php esc__pe( $data->role ); ?></h6>

				<?php endif; ?>

				<?php if ( $data->signature ) : ?>

					<img src="<?php echo esc_url( $data->signature ); ?>" alt="<?php echo esc_attr( $data->name ); ?>">

				<?php endif; ?>

				<?php if ( $data->description ) : ?>

					<?php esc__pe( do_shortcode( apply_filters( 'the_content', $data->description ) ) ); ?>

				<?php endif; ?>

				<?php if ( ! empty( $data->social_icons ) ) : ?>

					<div class="social-list">

						<?php foreach ( $data->social_icons as $icon ) : ?>

							<a href="<?php echo esc_url( $icon['url'] ); ?>" target="_blank" class="<?php echo sanitize_html_class( $icon['icon'] ); ?> small"></a>

						<?php endforeach; ?>

					</div>

				<?php endif; ?>

			</div>
		</div>

	<?php endif; ?>

</div>