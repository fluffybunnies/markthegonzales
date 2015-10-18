<?php $t =& peTheme(); ?>
<?php $content = $t->content; ?>
<?php list( $data, $bid ) = $t->template->module( 'NietzscheBlog' ); ?>

<?php $pager = empty( $data->pager ) || $data->pager === 'yes'; ?>

<section
	id="section-<?php echo esc_attr($data->name ? $data->name : $bid); ?>"
	class="section section-builder section-block section-type-blog"
	<?php esc__pe( $content->get_style( $data, 'background-image:bgimage', 'background-color:bgcolor', 'css' ) ); ?>
>
	
	<div class="row">
		
		<?php if ( 'right' === $data->sidebar ) : ?>

			<div class="column width-9 content-inner">

				<?php $t->content->loop( 'blog' ); ?>

			</div>

			<?php get_sidebar(); ?>

		<?php elseif ( 'left' === $data->sidebar ) : ?>

			<?php get_sidebar(); ?>

			<div class="column width-9 content-inner">

				<?php $t->content->loop( 'blog' ); ?>

			</div>

		<?php else : ?>

			<div class="column width-12 content-inner">

				<?php $t->content->loop( 'blog' ); ?>

			</div>

		<?php endif; ?>

	</div>

</section>

<?php if ( $pager ) : ?>

	<?php $t->content->pager(); ?>

<?php endif; ?>