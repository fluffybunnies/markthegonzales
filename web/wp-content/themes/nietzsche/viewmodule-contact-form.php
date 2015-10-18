<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheContactForm' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section-builder section-type-contact-form column width-7"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>
	
	<?php if ( $data->title ) : ?>

		<h6
			class="color-gray no-margin-top"
			<?php esc__pe( $content->get_style( $data, 'color:title_color' ) ); ?>
		>
			<?php esc__pe( $data->title ); ?>
		</h6>

	<?php endif; ?>

	<div class="contact-form-container">
		<form class="contact-form peThemeContactForm" method="post">
			<div class="row">
				<div class="column width-6">
					<input type="text" name="author" class="form-fname form-element large" placeholder="<?php echo esc_attr( __( 'First Name*','nietzsche') ); ?>" required>
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
					<?php esc__pe( $data->msgOK ); ?>
				</div>
				<div class="pe-form-response pe-form-error">
					<?php esc__pe( $data->msgKO ); ?>
				</div>
			</div>
		</form>
	</div>

</div>