<?php 

add_action( 'widgets_init', 'recentthumbnailposts_load_widgets' );


function recentthumbnailposts_load_widgets() {
	register_widget( 'WP_Widget_Recent_Posts_Thumbnails' );
}


class WP_Widget_Recent_Posts_Thumbnails extends WP_Widget {

	function WP_Widget_Recent_Posts_Thumbnails() {
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "The most recent posts with thumbnails on your blog", "gonzo") );
		$this->WP_Widget('recent-posts', __('Latest Posts with Thumbnails', 'gonzo'), $widget_ops);
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( isset($cache[$args['widget_id']]) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'gonzo') : $instance['title']);
		if ( !$number = (int) $instance['number'] )
			$number = 10;
		else if ( $number < 1 )
			$number = 1;
		else if ( $number > 15 )
			$number = 15;

		$r = new WP_Query(array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish'));
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li>
			<a href="<?php the_permalink();?>">				
				<?php if (has_post_thumbnail()) {					
						the_post_thumbnail('small-square', array('class' => 'wpp-thumbnail wp-post-image')); 						
					} else {					
						echo('<img src="'.get_template_directory_uri().'/images/no-image-small-square.png" class="wpp-thumbnail wp-post-image" style="width:50px; height:50px;" alt="no image" />');						
					} ?>					
			</a>				
			<a href="<?php the_permalink();?>" title="<?php the_title();?>">				
				<span class="wpp-post-title"><?php the_title();?></span>				
			</a>  				
			<span class="post-stats"><?php the_time('F jS') ?> | by <span class="wpp-author"><?php the_author();?></span></span>				
		</li><?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
			wp_reset_query();  // Restore global post data stomped by the_post().
		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_add('widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		if ( !isset($instance['number']) || !$number = (int) $instance['number'] )
			$number = 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'gonzo'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'gonzo'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
		<small><?php _e('(at most 15)', 'gonzo'); ?></small></p>
<?php
	}
}
