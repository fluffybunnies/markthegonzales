<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>

<div class="section-block row">

	<div class="column width-12 content-inner">

		<?php $content->content(); ?>

	</div>

	<div class="column width-12">

		<?php comments_template(); ?>

	</div>

</div>