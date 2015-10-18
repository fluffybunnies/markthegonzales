<?php $t =& peTheme(); ?>
<?php $layout =& $t->layout; ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php $style = ''; ?>

<?php

$footer_bg = $t->options->get( 'footer_bg' );
$footer_bg = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->footer->footer_type ) && 'global' !== $meta->footer->footer_type ) ? $meta->footer->footer_bg  : $footer_bg;

$footer_logo = $t->options->get( 'footer_logo' );
$footer_logo = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->footer->footer_type ) && 'global' !== $meta->footer->footer_type ) ? $meta->footer->footer_logo  : $footer_logo;

$footer_text_1 = $t->options->get( 'footer_text_1' );
$footer_text_1 = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->footer->footer_type ) && 'global' !== $meta->footer->footer_type ) ? $meta->footer->footer_text_1  : $footer_text_1;
do { $footer_text_1 = preg_replace( '/<script.*?\/script>/s', '', $footer_text_1 ) ? : $footer_text_1; } while ( preg_replace( '/<script.*?\/script>/s', '', $footer_text_1 ) !== $footer_text_1 );

$footer_text_2 = $t->options->get( 'footer_text_2' );
$footer_text_2 = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->footer->footer_type ) && 'global' !== $meta->footer->footer_type ) ? $meta->footer->footer_text_2  : $footer_text_2;
do { $footer_text_2 = preg_replace( '/<script.*?\/script>/s', '', $footer_text_2 ) ? : $footer_text_2; } while ( preg_replace( '/<script.*?\/script>/s', '', $footer_text_2 ) !== $footer_text_2 );

$footer_text_3 = $t->options->get( 'footer_text_3' );
$footer_text_3 = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->footer->footer_type ) && 'global' !== $meta->footer->footer_type ) ? $meta->footer->footer_text_3  : $footer_text_3;
do { $footer_text_3 = preg_replace( '/<script.*?\/script>/s', '', $footer_text_3 ) ? : $footer_text_3; } while ( preg_replace( '/<script.*?\/script>/s', '', $footer_text_3 ) !== $footer_text_3 );

$footer_copyright = $t->options->get( 'footer_copyright' );
$footer_copyright = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->footer->footer_type ) && 'global' !== $meta->footer->footer_type ) ? $meta->footer->footer_copyright  : $footer_copyright;

$footer_links = $t->options->get( 'footer_links' );
$footer_links = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $meta->footer->footer_type ) && 'global' !== $meta->footer->footer_type ) ? $meta->footer->footer_links  : $footer_links;

$is_centered = ( ! empty( $footer_text_1 ) && empty( $footer_text_2 ) && empty( $footer_text_3 ) );

?>

<?php if ( $footer_bg ) : ?>

	<?php $style .= 'style="background-color: ' . esc_attr( $footer_bg ) . ';"'; ?>

<?php endif; ?>

		<footer
			class="footer-1 footer reveal-side-navigation"

			<?php if ( $style ) : ?>

				<?php esc__pe( $style ); ?>

			<?php endif; ?>
		>
			<div class="footer-top left">
				<div class="row">

					<?php if ( $footer_logo ) : ?>

						<div class="column width-12 <?php echo sanitize_html_class( ( $is_centered ) ? 'center' : '' ); ?>">
							<div class="footer-logo">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $footer_logo ); ?>" alt="Logo" /></a>
							</div>
						</div>

					<?php endif; ?>

					<?php if ( $footer_text_1 ) : ?>

						<div class="column <?php echo esc_attr( ( $is_centered ) ? 'width-6 push-3 center' : 'width-5' ); ?>">
							<div class="footer-top-inner">
								<?php esc__pe( apply_filters( 'the_content', $footer_text_1 ) ); ?>
							</div>
						</div>

					<?php endif; ?>

					<?php if ( $footer_text_2 ) : ?>

						<div class="column width-3 push-1">
							<div class="footer-top-inner">
								<?php esc__pe( apply_filters( 'the_content', $footer_text_2 ) ); ?>
							</div>
						</div>

					<?php endif; ?>

					<?php if ( $footer_text_1 ) : ?>

						<div class="column width-3 push-1">
							<div class="footer-top-inner">
								<?php esc__pe( apply_filters( 'the_content', $footer_text_3 ) ); ?>
							</div>
						</div>

					<?php endif; ?>
					
				</div>
			</div>
			<div class="footer-bottom <?php echo sanitize_html_class( ( $is_centered ) ? 'center' : 'left' ); ?>">
				<div class="row">
					<div class="column width-12">
						<div class="footer-bottom-inner">

							<?php if ( $footer_copyright ) : ?>

								<p class="copyright no-margin-bottom"><?php esc__pe( esc_html( $footer_copyright ) ); ?></p>

							<?php endif; ?>

							<?php if ( ! empty( $footer_links ) && is_array( $footer_links ) ) : ?>

								<?php $i = 1; ?>
								<?php $count = count( $footer_links ); ?>

								<ul class="social-list list-horizontal">

									<?php foreach( $footer_links as $footer_link ) : ?>

										<li>
											
											<a href="<?php echo esc_url( $footer_link['url'] ); ?>" target="_blank"><?php esc__pe( $footer_link['description'] ); ?></a>

											<?php if ( $i !== $count ) : ?>

												/

											<?php endif; ?>

										</li>

										<?php $i++; ?>

									<?php endforeach; ?>

								</ul>

							<?php endif; ?>

						</div>
					</div>
				</div> 
			</div>
		</footer>
	
	</div>
</div>

<?php $t->footer->wp_footer(); ?>

</body>
</html>
