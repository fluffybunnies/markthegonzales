
<?php
// Loads the rating engine!
$ratings = new gonzo_user_rating();

get_header();
// Start the loop
if (have_posts()) : while (have_posts()) : the_post();
    $format = get_post_format();
    if (false === $format) $format = 'standard';
    $category = get_the_category();

// Get the current page url for FB comments
$url = (!empty($_SERVER['HTTPS'])) ? "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] : "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>

<section id="omc-main">	

	<article id="omc-full-article" class="omc-inner-<?php echo $format;?>">
		
		<?php
    //Get the comments option
    $omc_comment_type = get_post_meta(get_the_ID(), 'omc_comment_type', true);

    //Get the video meta data
    $omc_is_video = get_post_meta(get_the_ID(), 'omc_is_video', true);
    $omc_video_encode = get_post_meta(get_the_ID(), 'omc_video_encode', true);

    //Bring in the ratings data
    $omc_review_enable = get_post_meta(get_the_ID(), 'omc_review_enable', true);
    $omc_user_ratings_visibility = get_post_meta(get_the_ID(), 'omc_user_ratings_visibility', true);
    $omc_final_score = get_post_meta(get_the_ID(), 'omc_final_score', true);
    $omc_longer_summary = get_post_meta(get_the_ID(), 'omc_longer_summary', true);
    $omc_brief_summary = get_post_meta(get_the_ID(), 'omc_brief_summary', true);
    $omc_review_type = get_post_meta(get_the_ID(), 'omc_review_type', true);
    $omc_criteria_display = get_post_meta(get_the_ID(), 'omc_criteria_display', true);
    $omc_criteria_header = get_post_meta(get_the_ID(), 'omc_criteria_header', true);
    $omc_c1_rating = get_post_meta(get_the_ID(), 'omc_c1_rating', true);
    $omc_c1_description = get_post_meta(get_the_ID(), 'omc_c1_description', true);
    $omc_c2_rating = get_post_meta(get_the_ID(), 'omc_c2_rating', true);
    $omc_c2_description = get_post_meta(get_the_ID(), 'omc_c2_description', true);
    $omc_c3_rating = get_post_meta(get_the_ID(), 'omc_c3_rating', true);
    $omc_c3_description = get_post_meta(get_the_ID(), 'omc_c3_description', true);
    $omc_c4_rating = get_post_meta(get_the_ID(), 'omc_c4_rating', true);
    $omc_c4_description = get_post_meta(get_the_ID(), 'omc_c4_description', true);
    $omc_c5_rating = get_post_meta(get_the_ID(), 'omc_c5_rating', true);
    $omc_c5_description = get_post_meta(get_the_ID(), 'omc_c5_description', true);
    $omc_c6_rating = get_post_meta(get_the_ID(), 'omc_c6_rating', true);
    $omc_c6_description = get_post_meta(get_the_ID(), 'omc_c6_description', true);

    // Calculate the percentages from the star ratings
    $omc_c1_percentage = $omc_c1_rating * 20;
    $omc_c2_percentage = $omc_c2_rating * 20;
    $omc_c3_percentage = $omc_c3_rating * 20;
    $omc_c4_percentage = $omc_c4_rating * 20;
    $omc_c5_percentage = $omc_c5_rating * 20;
    $omc_c6_percentage = $omc_c6_rating * 20;
    $omc_final_percentage = $omc_final_score * 20;

    // Setup new variable to echo out the sprite width
    $omc_c1_width = $omc_c1_percentage + 2;
    $omc_c2_width = $omc_c2_percentage + 2;
    $omc_c3_width = $omc_c3_percentage + 2;
    $omc_c4_width = $omc_c4_percentage + 2;
    $omc_c5_width = $omc_c5_percentage + 2;
    $omc_c6_width = $omc_c6_percentage + 2;
    $omc_final_width = $omc_final_percentage + 2;

    $format = get_post_format();
    if (false === $format)
        $format = 'standard';
    ?>

    <?php if ($format == 'gallery') { ?>

    <p class="omc-date-time-gallery"><b><?php _e('Published on', 'gonzo'); ?></b> <?php the_time('F jS, Y') ?> |
        <em><?php _e('by', 'gonzo'); ?> <?php the_author() ?></em></p>

        <?php } elseif ($format == 'video') { ?>

    <div class="omc-main-video">

        <?php echo($omc_video_encode);?>

    </div>

    <p class="omc-date-time-video"><b><?php _e('Published on', 'gonzo'); ?></b> <?php the_time('F jS, Y') ?> |
        <em><?php _e('by', 'gonzo'); ?> <?php the_author() ?></em></p>

        <?php } else { ?>

    <div id="omc-inner-placeholder">

        <?php if ($category[0]) {
        echo '<a href="' . get_category_link($category[0]->term_id) . '" class="omc-flex-category">' . $category[0]->cat_name . '</a>';
    } ?>
        <?php if (has_post_thumbnail()) { ?>

        <?php the_post_thumbnail('featured-image', array('class' => 'featured-full-width-top')); ?>

        <?php
    } else {

        echo('<img src="' . get_template_directory_uri() . '/images/no-image-featured-image.png" class="omc-image-resize" alt="no image" />');

    } ?>

        <div class="omc-article-top">

            <p class="omc-date-time-inner <?php echo('omc-format-' . $format);?>">
                <b><?php _e('Published on', 'gonzo'); ?></b> <?php the_time('F jS, Y') ?> |
                <em><?php _e('by', 'gonzo'); ?> <?php the_author() ?></em></p>
            
            <?php if ($omc_comment_type === 'fb') { ?>
            	<span class="omc-comment-count"><fb:comments-count href=<?php echo $url; ?>></fb:comments-count></span>
            <?php } else { ?>    
                <span class="omc-comment-count"><?php comments_number('0', '1', '%'); ?></span>
            <?php } ?>    
        </div>
        <!-- /omc-article-top-->

    </div><!-- /omc-inner-placeholder -->

        <?php } ?>

<h1 class="omc-post-heading-<?php echo $format;?>"><?php the_title();?></h1>

    <?php if ($omc_criteria_display == 'b' || $omc_criteria_display == 'n' || $omc_criteria_display == '') {
        the_content();
    } ?>

    <?php if ($omc_criteria_display !== 'n') { ?>

        <?php if ($omc_review_enable == 1) { ?>

        <div itemscope itemtype="http://data-vocabulary.org/Review" id="omc-review-wrapper" class="omc-review-placement-<?php echo($omc_criteria_display); ?>">
        	
        	<span style="display:none" itemprop="itemreviewed"><?php the_title();?></span>
        	
        	<span style="display:none" itemprop="reviewer"><?php the_author(); ?></span>
        		
            <?php if ($omc_criteria_header !== '') { ?>

            <div id="omc-review-header">
                <h2><?php echo $omc_criteria_header; ?></h2>
            </div><!-- /omc-review-header -->

            <?php } ?>

            <?php if ($omc_review_type == 'percent') { ?>

            <?php if ($omc_c1_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c1_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c1_description; ?>
                        - <?php echo $omc_c1_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c2_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c2_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c2_description; ?>
                        - <?php echo $omc_c2_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c3_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c3_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c3_description; ?>
                        - <?php echo $omc_c3_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c4_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c4_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c4_description; ?>
                        - <?php echo $omc_c4_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c5_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c5_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c5_description; ?>
                        - <?php echo $omc_c5_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c6_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-percent">
                    <span class="omc-criteria-percentage" style="width:<?php echo $omc_c6_percentage; ?>%"></span>
                    <span class="omc-criteria-description"><?php echo $omc_c6_description; ?>
                        - <?php echo $omc_c6_percentage; ?>%</span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php } else { //START THE STAR LOOP /////////////////////////////////////////// ?>

            <?php if ($omc_c1_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c1_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c1_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c2_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c2_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c2_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c3_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c3_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c3_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c4_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c4_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c4_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c5_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c5_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c5_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php if ($omc_c6_rating !== '') { ?>
                <div class="omc-review-criteria omc-criteria-star">
                    <span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                style="width:<?php echo $omc_c6_width;?>%"></span></span>
                    <span class="omc-criteria-description"><?php echo $omc_c6_description; ?></span>
                </div><!-- /criteria -->
                <?php } ?>

            <?php } ?>



            <div class="omc-review-summary omc-final-score-<?php echo $omc_review_type ?>">

                <div id="omc-short-summary">
                    <p><strong>Summary:</strong> <?php echo $omc_longer_summary;?></p>
                </div>
                <!-- /omc-short-summary -->

                <div id="omc-criteria-final-score">
                    <span itemprop="rating"><h3><?php if ($omc_review_type == 'percent') {
                        echo ($omc_final_percentage . '<span>%</span>');
                    } else {
                        echo $omc_final_score;
                    } ?></h3></span>
                    <h4><?php echo $omc_brief_summary;?></h4>
                    <?php if ($omc_review_type == 'stars') { ?><span id="omc-final-score-stars-under"><span
                    id="omc-final-score-stars-top" style="width:<?php echo $omc_final_width;?>%"></span></span> <?php } ?>
                </div>
                <!-- /final-score -->

                <br class="clear"/>

            </div>
            <!-- /omc-review-summary -->

		<?php if($omc_user_ratings_visibility == 1) {?>		

            <div itemscope itemtype="http://data-vocabulary.org/Review-aggregate" class="omc-user-review-criteria">

                <span class="omc-user-review-description"><b><span class="your_rating"
                                                                   style="display:none;"><?php _e('Your Rating', 'gonzo'); ?></span><span
                    class="user_rating"><?php _e('User Rating', 'gonzo'); ?></span></b>: <span
                    class="score"><?php echo $ratings->current_rating; ?></span> <em>(<span
                    class="count"><?php echo $ratings->count; ?></span> <?php _e('votes', 'gonzo'); ?>)</em></span>
						
						<span class="omc-user-review-rating">
							<span class="omc-criteria-star-under"><span class="omc-criteria-star-top"
                                                                        style="width:<?php echo $ratings->current_position; ?>%"></span></span>
						</span>

            </div><!-- /omc-user-review-criteria -->
	
	<?php } ?>
	
        </div><!-- /omc-review-wrapper -->

            <?php } ?>

        <?php } ?>

    <?php if ($omc_criteria_display == 't') {
        the_content();
    } ?>

<p class="omc-single-tags"><?php the_tags('<b>Tags:</b> ', ', ', '<br />'); ?></p>

    <?php wp_link_pages(); endwhile; endif; ?>

<br class="clear"/>

<div class="omc-authorbox">

    <h4><?php _e('About the Author', 'gonzo');?></h4>

    <div class="omc-author-pic"><a
        href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_avatar(get_the_author_meta('user_email'), '80', ''); ?></a>
    </div>

    <p><?php the_author_posts_link(); ?> <?php the_author_meta('description'); ?></p>

</div>

<br class="clear" />

<div class="omc-related-posts">

    <h4><?php _e('Related Posts', 'gonzo'); ?></h4>

    <?php if (has_tag()) { ?>
    <?php
    //for use in the loop, list 3 post titles related to first tag on current post
    $backup = $post; // backup the current object
    $tags = wp_get_post_tags($post->ID);
    $tagIDs = array();

    if ($tags) {

        $tagcount = count($tags);
        for ($i = 0; $i < $tagcount; $i++) {
            $tagIDs[$i] = $tags[$i]->term_id;

        }

        $args = array('tag__in' => $tagIDs, 'post__not_in' => array($post->ID), 'showposts' => 4, 'ignore_sticky_posts' => 1);
        $my_query = new WP_Query($args);

        if ($my_query->have_posts()) {

            while ($my_query->have_posts()) : $my_query->the_post(); ?>

                <article class="omc-related-post omc-module-c omc-quarter-width-category">

                    <a href="<?php the_permalink();?>" title="<?php the_title();?>">

                        <?php if (has_post_thumbnail()) {

                        the_post_thumbnail('half-landscape', array('class' => 'omc-image-resize'));

                    } else {

                        echo('<img src="' . get_template_directory_uri() . '/images/no-image-half-landscape.png" class="omc-image-resize" alt="no image" />');

                    } ?>

                    </a>

                    <h5 class="omc-related-article"><a href="<?php the_permalink();?>"
                                                       title="<?php the_title();?>"><?php the_title();?></a><span> &rarr;</span>
                    </h5>

                </article><!-- /omc-related-post -->

                <?php endwhile; ?>

            <br class="clear"/>

            <?php } else { ?>

            <h2><?php _e('No related posts found!', 'gonzo'); ?></h2>

            <?php
        }
    }
    $post = $backup; // copy it back
    wp_reset_query(); // to use the original query again
    ?>
    <?php } else { ?>

    <?php //if no tags then pull out content from the category

    $cat = get_the_category();

    $category = $cat[0]->cat_ID;

    global $wp_query, $paged, $post;

    $nextargs = array('cat' => $category, 'posts_per_page' => 4, 'post__not_in' => array($post->ID),);

    $nextloop = new WP_Query($nextargs);

    while ($nextloop->have_posts()) : $nextloop->the_post();

        ?>

        <article class="omc-related-post omc-module-c omc-quarter-width-category">

            <a href="<?php the_permalink();?>" title="<?php the_title();?>">

                <?php if (has_post_thumbnail()) {

                the_post_thumbnail('half-landscape', array('class' => 'omc-image-resize'));

            } else {

                echo('<img src="' . get_template_directory_uri() . '/images/no-image-half-landscape.png" class="omc-image-resize" alt="no image" />');

            } ?>

            </a>

            <h5 class="omc-related-article"><a href="<?php the_permalink();?>"
                                               title="<?php the_title();?>"><?php the_title();?></a><span> &rarr;</span>
            </h5>

        </article><!-- /omc-related-post -->

        <?php endwhile;
    rewind_posts();
    wp_reset_query(); ?>

    <br class="clear"/>

    <?php } ?>

</div><!-- /omc-related-posts -->

<br class="clear"/>

<?php if ($omc_comment_type === 'fb' || $omc_comment_type === 'both') { ?>
    
    <div id="fb-root"></div><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";  fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
    <div class="fb-comments" data-href="<?php echo $url; ?>" data-num-posts="4" data-width="620"></div>

<?php } ?>

<?php if ($omc_comment_type === 'wp' || $omc_comment_type === 'both' || $omc_comment_type == '') { ?>

    <?php comments_template('', true); ?>

    <?php } ?>
		
	</article><!-- /omc-full-article -->

</section><!-- /omc-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>


