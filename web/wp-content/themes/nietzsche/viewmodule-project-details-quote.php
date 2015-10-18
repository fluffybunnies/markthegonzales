<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheProjectDetailsQuote' ); ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section-builder section-type-project-details-quote"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( $data->quote ) : ?>
	
		<blockquote class="left icon">
			<span class="icon-quote"></span>
			<p><?php esc__pe( $data->quote ); ?>

				<?php if ( $data->author ) : ?>

					<cite><?php esc__pe( $data->author ); ?></cite>

				<?php endif; ?>

			</p>
		</blockquote>

	<?php endif; ?>

</div>