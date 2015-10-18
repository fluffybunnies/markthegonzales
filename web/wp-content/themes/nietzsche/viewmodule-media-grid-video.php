<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php $view = $t->view; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheMediaGridVideo' ); ?>
<?php

switch ( $data->size ) {

	case ( 'portrait' ) :

		$grid_item_size_class = 'portrait';

		break;

	case ( 'large-landscape' ) :

		$grid_item_size_class = 'large';

		break;

	case ( 'large-portrait' ) :

		$grid_item_size_class = 'large portrait';

		break;

	default :

		$grid_item_size_class = '';

		break;

}

?>

<div
	id="grid-item-<?php echo esc_attr( $bid ); ?>"
	class="section-type-media-grid-video grid-item <?php echo esc_attr( $grid_item_size_class ); ?>"
	<?php esc__pe( $content->get_style( $data, 'css' ) ); ?>
>

	<?php if ( $data->video ) : ?>

			<div class="thumbnail">

				<?php if ( 'yes' === $data->lightbox ) : ?>

					<?php if ( $data->image ) : ?>

						<img src="<?php echo esc_url( $data->image ); ?>" alt="<?php echo esc_attr( $data->lightbox_captions ); ?>">

					<?php endif; ?>

					<div class="caption-over-outer">
						<div class="caption-over-inner center">
							
							<?php $lightbox_link = ''; ?>

							<?php if ( false !== strpos( $data->video, 'youtu' ) ) : ?>

								<?php $video_id = $t->video->get_video_id( $data->video, 'youtube' ); ?>
								<?php if ( $video_id ) : ?>

									<?php $lightbox_link = '//www.youtube.com/embed/' . esc_attr( $video_id ) . '?autohide=1&amp;modestbranding=1&amp;showinfo=0&amp;autoplay=1'; ?>
								
								<?php endif; ?>

							<?php elseif ( false !== strpos( $data->video, 'vimeo' ) ) : ?>

								<?php $video_id = $t->video->get_video_id( $data->video, 'vimeo' ); ?>
								<?php if ( $video_id ) : ?>

									<?php $lightbox_link = '//player.vimeo.com/video/' . esc_attr( $video_id ) . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1'; ?>
								
								<?php endif; ?>

							<?php endif; ?>

							<a data-group="lightbox-<?php echo esc_attr( $bid ); ?>" data-caption="<?php echo esc_attr( $data->lightbox_captions ); ?>" class="lightbox-link icon-boxed icon-circled small icon-play <?php echo esc_attr( $data->color ); ?>" href="<?php echo esc_url( $lightbox_link ); ?>"></a>

						</div>
					</div>

				<?php else : ?>

					<?php if ( false !== strpos( $data->video, 'youtu' ) ) : ?>

						<?php $video_id = $t->video->get_video_id( $data->video, 'youtube' ); ?>
						<?php if ( $video_id ) : ?>

							<iframe width="1280" height="720" src="//www.youtube.com/embed/<?php echo esc_attr( $video_id ); ?>?autohide=1&amp;modestbranding=1&amp;showinfo=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						
						<?php endif; ?>

					<?php elseif ( false !== strpos( $data->video, 'vimeo' ) ) : ?>

						<?php $video_id = $t->video->get_video_id( $data->video, 'vimeo' ); ?>
						<?php if ( $video_id ) : ?>

							<iframe src="//player.vimeo.com/video/<?php echo esc_attr( $video_id ); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="1280" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						
						<?php endif; ?>

					<?php endif; ?>

				<?php endif; ?>
			
			</div>

	<?php endif; ?>

</div>