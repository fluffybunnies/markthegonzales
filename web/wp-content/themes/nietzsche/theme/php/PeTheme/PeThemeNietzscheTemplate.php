<?php

class PeThemeNietzscheTemplate extends PeThemeTemplate  {

	public function __construct( &$master ) {
		parent::__construct( $master );
	}

	public function paginate_links( $loop ) {

		if ( ! $loop ) return '';
		
	?>

		<div class="section-block pagination-1">
			<div class="row">

				<?php if ( empty( $loop->main->prev->link ) ) : ?>

					<div class="column width-4">&nbsp;</div>

				<?php else : ?>

					<div class="column width-4">
						<a href="<?php echo esc_url( $loop->main->prev->link ); ?>" class="pagination-previous">
							<small><?php esc__pe( __( 'Prev' ,'nietzsche') ); ?></small>
							<span><?php esc__pe( __( 'More Posts' ,'nietzsche') ); ?></span>
						</a>
					</div>

				<?php endif; ?>

				<div class="column width-4">
					<ul class="page-list list-horizontal">

						<?php while ( $page =& $loop->next() ) : ?>

							<?php $is_active = ! ( false === strpos( $page->class, 'active' ) ); ?>

							<li>
								<a
									class="<?php echo esc_attr( $page->class . ' ' ); echo sanitize_html_class( $is_active ? 'current' : '' ); ?>"
									href="<?php echo esc_url( $page->link ); ?>"
								><?php esc__pe( $page->num ); ?></a>
							</li>

						<?php endwhile; ?>

					</ul>
				</div>

				<?php if ( empty( $loop->main->next->link ) ) : ?>

					<div class="column width-4">&nbsp;</div>

				<?php else : ?>

					<div class="column width-4">
						<a href="<?php echo esc_url( $loop->main->next->link ); ?>" class="pagination-next">
							<small><?php esc__pe( __( 'Next' ,'nietzsche') ); ?></small>
							<span><?php esc__pe( __( 'More Posts' ,'nietzsche') ); ?></span>
						</a>
					</div>

				<?php endif; ?>

			</div>
		</div>

	<?php

	}

}

?>