<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheHero' ); ?>

<section
	id="section-<?php echo esc_attr( $data->name ? $data->name : $bid ); ?>"
	class="section section-builder section-block section-type-hero hero-5"
	data-bg-image-1="<?php echo esc_url( $data->column_1_bgimage ); ?>"
	data-bg-color-1="<?php echo esc_attr( $data->column_1_bgcolor ); ?>"
	data-opacity-1="<?php echo esc_attr( $data->column_1_bgopacity ); ?>"
	data-bg-image-2="<?php echo esc_url( $data->column_2_bgimage ); ?>"
	data-bg-color-2="<?php echo esc_attr( $data->column_2_bgcolor ); ?>"
	data-opacity-2="<?php echo esc_attr( $data->column_2_bgopacity ); ?>"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'color:color', 'css' ) ); ?>
>
	
	<div class="row">

		<?php if ( $data->column_1_content || $data->column_1_image || ( $data->column_1_video && $data->column_1_video_text ) || 'yes' === $data->column_1_form ) : ?>

			<div
				class="column width-6"
				<?php esc__pe( $content->get_style( $data, 'color:column_1_color' ) ); ?>
			>
				<div class="hero-content split-hero-content <?php echo sanitize_html_class( $data->column_1_align ); ?>">
					<div class="hero-content-inner">

						<?php if ( ! $data->column_1_form || 'no' == $data->column_1_form ) : ?>

							<?php if ( $data->column_1_image ) : ?>

								<img src="<?php echo esc_url( $data->column_1_image ); ?>" alt=""/>

							<?php endif; ?>

							<?php esc__pe( do_shortcode( apply_filters( 'the_content', $data->column_1_content ) ) ); ?>

							<?php if ( $data->column_1_video && $data->column_1_video_text  ) : ?>

								<?php if ( false !== strpos( $data->column_1_video, 'youtu' ) ) : ?>

									<?php $video_id = $t->video->get_video_id( $data->column_1_video, 'youtube' ); ?>
									<?php if ( $video_id ) : ?>

										<a href="//www.youtube.com/embed/<?php echo esc_attr( $video_id ); ?>?autohide=1&amp;modestbranding=1&amp;showinfo=0&amp;autoplay=1" class="lightbox-link button bkg-charcoal bkg-hover-charcoal color-white color-hover-white large"><span class="icon-play"></span><?php esc__pe( $data->column_1_video_text ); ?></a>
									
									<?php endif; ?>

								<?php elseif ( false !== strpos( $data->column_1_video, 'vimeo' ) ) : ?>

									<?php $video_id = $t->video->get_video_id( $data->column_1_video, 'vimeo' ); ?>
									<?php if ( $video_id ) : ?>

										<a href="//player.vimeo.com/video/<?php echo esc_attr( $video_id ); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1" class="lightbox-link button bkg-charcoal bkg-hover-charcoal color-white color-hover-white large"><span class="icon-play"></span><?php esc__pe( $data->column_1_video_text ); ?></a>
									
									<?php endif; ?>

								<?php endif; ?>

							<?php endif; ?>

						<?php else : ?>

							<div class="contact-form-container">
								<form class="contact-form peThemeContactForm" method="post">
									<div class="row">
										<div class="column width-6">
											<input type="text" name="author" class="form-fname form-element large" placeholder="<?php echo esc_attr( __('First Name*','nietzsche') ); ?>" required>
										</div>
										<div class="column width-6">
											<input type="text" name="last_name" class="form-lname form-element large" placeholder="<?php echo esc_attr( __('Last Name','nietzsche') ); ?>">
										</div>
										<div class="column width-6">
											<input type="text" name="subject" class="form-website form-element large" placeholder="<?php echo esc_attr( __('Subject*','nietzsche') ); ?>" required>
										</div>
										<div class="column width-6">
											<input type="email" name="email" class="form-email form-element large" placeholder="<?php echo esc_attr( __('Email address*','nietzsche') ); ?>" required>
										</div>
									</div>
									<div class="row">
										<div class="column width-12">
											<textarea name="message" class="form-message form-element medium" placeholder="<?php echo esc_attr( __('Message*','nietzsche') ); ?>" required></textarea>
											<input type="submit" value="<?php echo esc_attr( __('Send Email','nietzsche') ); ?>" class="form-submit medium button bkg-charcoal bkg-hover-charcoal color-white color-hover-white">
										</div>
									</div>
									<div class="form-response">
										<div class="pe-form-response pe-form-success">
											<?php esc__pe( $data->column_1_msgOK ); ?>
										</div>
										<div class="pe-form-response pe-form-error">
											<?php esc__pe( $data->column_1_msgKO ); ?>
										</div>
									</div>
								</form>
							</div>

						<?php endif; ?>

					</div>
				</div>
			</div>

		<?php endif; ?>

		<?php if ( $data->column_2_content || $data->column_2_image || ( $data->column_2_video && $data->column_2_video_text ) || 'yes' === $data->column_2_form ) : ?>

			<div
				class="column width-6"
				<?php esc__pe( $content->get_style( $data, 'color:column_2_color' ) ); ?>
			>
				<div class="hero-content split-hero-content <?php echo sanitize_html_class( $data->column_2_align ); ?>">
					<div class="hero-content-inner">

						<?php if ( ! $data->column_2_form || 'no' == $data->column_2_form ) : ?>

							<?php if ( $data->column_2_image ) : ?>

								<img src="<?php echo esc_url( $data->column_2_image ); ?>" alt=""/>

							<?php endif; ?>

							<?php esc__pe( do_shortcode( apply_filters( 'the_content', $data->column_2_content ) ) ); ?>

							<?php if ( $data->column_2_video && $data->column_2_video_text ) : ?>

								<?php if ( false !== strpos( $data->column_2_video, 'youtu' ) ) : ?>

									<?php $video_id = $t->video->get_video_id( $data->column_2_video, 'youtube' ); ?>
									<?php if ( $video_id ) : ?>

										<a href="//www.youtube.com/embed/<?php echo esc_attr( $video_id ); ?>?autohide=1&amp;modestbranding=1&amp;showinfo=0&amp;autoplay=1" class="lightbox-link button bkg-charcoal bkg-hover-charcoal color-white color-hover-white large"><span class="icon-play"></span><?php esc__pe( $data->column_2_video_text ); ?></a>
									
									<?php endif; ?>

								<?php elseif ( false !== strpos( $data->column_2_video, 'vimeo' ) ) : ?>

									<?php $video_id = $t->video->get_video_id( $data->column_2_video, 'vimeo' ); ?>
									<?php if ( $video_id ) : ?>

										<a href="//player.vimeo.com/video/<?php echo esc_attr( $video_id ); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1" class="lightbox-link button bkg-charcoal bkg-hover-charcoal color-white color-hover-white large"><span class="icon-play"></span><?php esc__pe( $data->column_2_video_text ); ?></a>
									
									<?php endif; ?>

								<?php endif; ?>

							<?php endif; ?>

						<?php else : ?>

							<div class="contact-form-container">
								<form class="contact-form peThemeContactForm" method="post">
									<div class="row">
										<div class="column width-6">
											<input type="text" name="author" class="form-fname form-element large" placeholder="<?php echo esc_attr( __( 'First Name*','nietzsche') ); ?>" required>
										</div>
										<div class="column width-6">
											<input type="text" name="last_name" class="form-lname form-element large" placeholder="<?php echo esc_attr( __( 'Last Name','nietzsche') ); ?>">
										</div>
										<div class="column width-6">
											<input type="text" name="subject" class="form-website form-element large" placeholder="<?php echo esc_attr( __( 'Subject*','nietzsche') ); ?>" required>
										</div>
										<div class="column width-6">
											<input type="email" name="email" class="form-email form-element large" placeholder="<?php echo esc_attr( __( 'Email address*','nietzsche') ); ?>" required>
										</div>
									</div>
									<div class="row">
										<div class="column width-12">
											<textarea name="message" class="form-message form-element medium" placeholder="<?php echo esc_attr( __( 'Message*','nietzsche') ); ?>" required></textarea>
											<input type="submit" value="<?php echo esc_attr( __( 'Send Email','nietzsche') ); ?>" class="form-submit medium button bkg-charcoal bkg-hover-charcoal color-white color-hover-white">
										</div>
									</div>
									<div class="form-response">
										<div class="pe-form-response pe-form-success">
											<?php esc__pe( $data->column_2_msgOK ); ?>
										</div>
										<div class="pe-form-response pe-form-error">
											<?php esc__pe( $data->column_2_msgKO ); ?>
										</div>
									</div>
								</form>
							</div>

						<?php endif; ?>

					</div>
				</div>
			</div>

		<?php endif; ?>

	</div>

</section>