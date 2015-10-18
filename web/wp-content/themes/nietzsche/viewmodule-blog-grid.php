<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheBlogGrid' ); ?>

<?php $grid_width_class = 'yes' === $data->full_width ? 'full-width' : ''; ?>
<?php $pager = empty( $data->pager ) || $data->pager === 'yes'; ?>

<section
	id="section-<?php echo esc_attr($data->name ? $data->name : $bid); ?>"
	class="section section-builder section-block section-type-blog-grid blog-masonry small-margins <?php echo sanitize_html_class( $grid_width_class ); ?>"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'css' ) ); ?>
>
	
	<div class="row">
		<div class="column width-12">
			<div class="row content-grid-<?php echo esc_attr( $data->columns ? $data->columns : 3 ); ?> masonry-grid clearfix">

				<?php $t->get_template_part( 'loop', 'grid' ); ?>

			</div>
		</div>
	</div>

</section>

<?php if ( $pager ) : ?>

	<?php $t->content->pager(); ?>

<?php endif; ?>