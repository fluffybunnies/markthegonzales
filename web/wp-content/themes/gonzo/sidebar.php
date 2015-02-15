<section id="omc-sidebar" class="omc-right">

<a href="#top" class="omc-mobile-back-to-top"><?php _e('Back to Top', 'gonzo');?> &#8593;</a>

<ul class="xoxo">
<?php
wp_reset_query();
dynamic_sidebar(get_sidebar_name());
?>	

</ul><!-- /xoxo -->

</section>	

<br class="clear" />

</div> <!-- end of #container -->