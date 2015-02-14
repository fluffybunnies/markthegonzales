<?php
/*
Template Name: Author List Page
*/
?>

<?php get_header(); ?>

<section id="omc-main">	

	
	<div class="omc-cat-top">
	
		<h1><em><?php the_title();?></em></h1>
		
	</div>
	
<?php
$display_admins = true;
$order_by = 'display_name'; // 'nicename', 'email', 'url', 'registered', 'display_name', or 'post_count'
$role = ''; // 'subscriber', 'contributor', 'editor', 'author' - leave blank for 'all'
$avatar_size = 100;
$hide_empty = true; // hides authors with zero posts
 
if(!empty($display_admins)) {
	$blogusers = get_users('orderby='.$order_by.'&role='.$role);
} else {
	$admins = get_users('role=administrator');
	$exclude = array();
	foreach($admins as $ad) {
		$exclude[] = $ad->ID;
	}
	$exclude = implode(',', $exclude);
	$blogusers = get_users('exclude='.$exclude.'&orderby='.$order_by.'&role='.$role);
}
$authors = array();
foreach ($blogusers as $bloguser) {
	$user = get_userdata($bloguser->ID);
	if(!empty($hide_empty)) {
		$numposts = count_user_posts($user->ID);
		if($numposts < 1) continue;
	}
	$authors[] = (array) $user;
}
 
echo '<ul class="omc-contributers">';
foreach($authors as $author) { 
	$display_name = $author['data']->display_name;
	$description = get_userdata($author['ID'])->user_description;
	$website = get_the_author_meta( 'user_url' );
	$twitter = get_userdata($author['ID'])->twitter;
	$facebook = get_userdata($author['ID'])->facebook;
	$linkedin = get_userdata($author['ID'])->linkedin; 				
	$youtube = get_userdata($author['ID'])->youtube;			
	$google = get_userdata($author['ID'])->google; 				
	$soundcloud = get_userdata($author['ID'])->soundcloud;
	$numposts2 = count_user_posts($author->ID);	

	$avatar = get_avatar($author['ID'], $avatar_size);
	$author_profile_url = get_author_posts_url($author['ID']);
 
echo '<li><a href="', $author_profile_url, '">', $avatar , '</a><a href="', $author_profile_url, '" class="contributor-link">', $display_name, ' <span> &rarr;</span></a><p>'.$description.'</p>'; ?>
		
	<div id="omc-author-social-icons">	
		<?php if($twitter !== '') {?><a class="omc-author-twitter" href="<?php echo $twitter; ?>"></a><?php } ?>
		<?php if($facebook !== '') {?><a class="omc-author-facebook" href="<?php echo $facebook; ?>"></a><?php } ?>
		<?php if($google !== '') {?><a class="omc-author-google" href="<?php echo $google; ?>"></a><?php } ?>
		<?php if($linkedin !== '') {?><a class="omc-author-linkedin" href="<?php echo $linkedin; ?>"></a><?php } ?>
		<?php if($youtube !== '') {?><a class="omc-author-youtube" href="<?php echo $youtube; ?>"></a><?php } ?>
		<?php if($soundcloud !== '') {?><a class="omc-author-soundcloud" href="<?php echo $soundcloud; ?>"></a><?php } ?>
		<br class="clear" />
	</div>
<?php }
echo '</li></ul>';
?>
	
	<br class="clear" />
		
</section><!-- /omc-main -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>