<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheSplashSliderSlideLightbox' ); ?>


<span
	id="section-<?php echo esc_attr( $bid ); ?>"
	class="section section-builder section-type-splash-slider-slide-lightbox tms-caption no-transition"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( false !== strpos( $data->video, 'youtu' ) ) : ?>

		<?php $video_id = $t->video->get_video_id( $data->video, 'youtube' ); ?>
		<?php if ( $video_id ) : ?>

			<a href="//www.youtube.com/embed/<?php echo esc_attr( $video_id ); ?>?autohide=1&amp;modestbranding=1&amp;showinfo=0&amp;autoplay=1" class="lightbox-link icon-boxed icon-play icon-circled small no-margin-right <?php echo esc_attr( $data->color ); ?>"></a>
		
		<?php endif; ?>

	<?php elseif ( false !== strpos( $data->video, 'vimeo' ) ) : ?>

		<?php $video_id = $t->video->get_video_id( $data->video, 'vimeo' ); ?>
		<?php if ( $video_id ) : ?>

			<a href="//player.vimeo.com/video/<?php echo esc_attr( $video_id ); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1" class="lightbox-link icon-boxed icon-play icon-circled small no-margin-right <?php echo esc_attr( $data->color ); ?>"></a>
		
		<?php endif; ?>

	<?php endif; ?>

</span>

<div class="clear"></div>