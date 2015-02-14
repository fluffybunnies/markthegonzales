<?php


class best_reviews_widget extends WP_Widget {


    /** constructor */
    function best_reviews_widget() {
        parent::WP_Widget(false, $name = 'Gonzo Best Reviews');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {	
        extract( $args );
		global $wpdb;
		
        $title = apply_filters('widget_title', $instance['image']);
		$alt = $instance['alt'];
		$image = $instance['image'];
		$number = $instance['number'];
	
		
		echo $before_widget; ?>
  	<?php echo $before_title . $alt . $after_title; ?>
	
	<ul>
		<?php  	
				$idObj = get_category_by_slug($image);
				$id = $idObj->term_id;
				$category_link = get_category_link( $id );
				$category_name = get_cat_name( $id );
		
				$r = new WP_Query(array('showposts' => $number, 'meta_key' => 'omc_final_score', 'orderby' => 'meta_value', 'cat' => $id, 'nopaging' => 0, 'post_status' => 'publish'));
				if ($r->have_posts()) : while ($r->have_posts()) : $r->the_post(); 
				
				$omc_is_video =  get_post_meta(get_the_ID(), 'omc_is_video', true);
				$omc_review_enable =  get_post_meta(get_the_ID(), 'omc_review_enable', true);
				$omc_final_score =  get_post_meta(get_the_ID(), 'omc_final_score', true);
				$omc_final_percentage = $omc_final_score * 20 + 2 ;
				
		?>
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
			<?php if ($omc_review_enable == 1) { ?>
					
					<br />
					<span class="omc-module-a-stars-under leading-article"><span class="omc-module-a-stars-over leading-article" style="width:<?php echo $omc_final_percentage; ?>%"></span></span>
						
				<?php } ?>				
		</li><?php endwhile; endif; wp_reset_query(); ?>
	</ul>
	
  	<?php echo $after_widget;
	}

  // Save the settings for this instance
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['alt'] = strip_tags($new_instance['alt']);
		$instance['number'] =  strip_tags($new_instance['number']);
		
		return $instance;
	}

  // Display the widget form in the admin interface
	function form( $instance ) {


    // Generate a title based on the image URL


?>
    <?php // Hidden title field for the admin interface to display ?>
    <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="hidden" value="<?php echo $title; ?>" />
		
		<p>
			<label for="<?php echo $this->get_field_id('alt'); ?>">Title:
				<input class="widefat" id="<?php echo $this->get_field_id('alt'); ?>" name="<?php echo $this->get_field_name('alt'); ?>" type="text" value="<?php echo $instance['alt']; ?>" />
				<br />
				<small></small>
			</label>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>">Category Slug:				
				<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo $instance['image']; ?>" />
			</label>
		</p>
		
		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of reviews to show:', 'gonzo'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $instance['number']; ?>" size="3" /><br />
		<small><?php _e('(at most 15)', 'gonzo'); ?></small></p>
		

	

        <?php 
    }


} // class utopian_recent_posts
// register Recent Posts widget
add_action('widgets_init', create_function('', 'return register_widget("best_reviews_widget");'));
