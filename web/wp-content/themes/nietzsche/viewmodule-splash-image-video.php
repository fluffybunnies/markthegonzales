<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheSplashImageVideo' ); ?>

<?php if ( $data->url ) : ?>

<div
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section section-builder section-type-splash-image-video video-container"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( false !== strpos( $data->url, 'youtu' ) ) : ?>

		<?php $video_id = $t->video->get_video_id( $data->url, 'youtube' ); ?>
		<?php if ( $video_id ) : ?>

			<iframe width="1280" height="720" src="//www.youtube.com/embed/<?php echo esc_attr( $video_id ); ?>?autohide=1&modestbranding=1&showinfo=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		
		<?php endif; ?>

	<?php elseif ( false !== strpos( $data->url, 'vimeo' ) ) : ?>

		<?php $video_id = $t->video->get_video_id( $data->url, 'vimeo' ); ?>
		<?php if ( $video_id ) : ?>

			<iframe src="//player.vimeo.com/video/<?php echo esc_attr( $video_id ); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="1280" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		
		<?php endif; ?>

	<?php endif; ?>

</div>

<div class="clear"></div>

<?php endif; ?>