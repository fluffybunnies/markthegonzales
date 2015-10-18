<?php

class PeThemeHeader {

	public function wp_head() {
		if (is_singular() && get_option('thread_comments')) {
			wp_enqueue_script("comment-reply");
		}
		wp_head();
		do_action("pe_theme_wp_head");
	}
}

?>