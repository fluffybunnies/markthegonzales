<?php

class PeThemeTemplate {

	public $master;
	public $args;
	protected $datas = array();
	protected $template_stack = array();

	public function __construct($master) {
		$this->master =& $master;
	}

	public function inside($slug) {
		$this->template_stack[] = $slug;
	}

	public function ancestor($slug) {
		return in_array($slug,$this->template_stack);
	}


	public function outside() {
		array_pop($this->template_stack);
	}

	public function exists($slug,$name = null) {
		if (isset($name)) $templates[] = "{$slug}-{$name}.php";
		$templates[] = "{$slug}.php";
		return locate_template($templates);
	}

	public function data() {
		if (func_num_args()) {
			$this->datas[] = func_get_args();;
		} else {
			return array_pop($this->datas);
		}
	}

	public function module($name) {
		$result = array_pop($this->datas);
		if ($name) {
			if ( ! isset( $result[0] ) ) $result[0] = new stdClass();
			$class = "PeThemeViewLayoutModule$name";
			$item = new $class();
			foreach (array_keys($item->fields()) as $key) {
				if (!isset($result[0]->$key)) {
					$result[0]->$key = false;
				}
			}
		}
		return $result;
	}

	public function custom(&$loop,$slug,$name = null) {
		if (isset($name)) $templates[] = "{$slug}-{$name}.php";
		$templates[] = "{$slug}.php";
		if (locate_template($templates)) {
			$this->master->data->set($loop);
			get_template_part($slug,$name);
			return true;
		}
		return false;
	}

	public function comment_form() {
		$loop = false;
		if ($this->custom($loop,"comment-form")) return;
?>
<?php $t =& peTheme(); ?>
<?php $comments =& $t->comments; ?>
<?php if ($comments->open()): ?>
<div id="respond">

	<?php if ($comments->requireRegistered()) : ?>
	
	<div class="row">
		<div class="col-md-12">
			<p class="comment-notes must-log-in"><?php $comments->register(); ?></p>
		</div>
	</div>

	<?php else : ?>

	<div class="row">
		<div class="col-md-12">
			<h3 id="reply-title"><?php echo __("Leave A Comment",'nietzsche') ?> <div class="pull-right"><?php cancel_comment_reply_link(__("Cancel Reply",'nietzsche')); ?></div></h3>
		</div>
	</div>
	
	<!--comment form-->
	<div class="row">
		<div class="col-md-12">
			<form action="<?php $comments->action(); ?>" method="post" id="commentform">
				<?php do_action( 'comment_form_top' ); ?>
				<?php if ($comments->logged()): ?>
				<p class="comment-notes logged-in-as"><?php $comments->logout(); ?></p>

				<?php else: ?>
				<p class="comment-notes"><?php echo __('Your email address will not be published. Required fields are marked','nietzsche'); ?> <span class="required">*</span></p>
				
				<div class="form-group form-group-author">
					<label for="author"><?php _e("Name",'nietzsche'); ?> <span class="required">*</span></label>
					<input class="form-control" id="author" name="author" type="text" value="" size="30" aria-required="true"/>
				</div>
				
				<div class="form-group form-group-email">
					<label for="email"><?php _e("Email",'nietzsche'); ?> <span class="required">*</span></label>
					<input class="form-control" id="email" name="email" type="text" value="" size="30" aria-required="true"/>
				</div>
				
				<div class="form-group form-group-url">
					
					<label for="url"><?php _e("Website",'nietzsche'); ?></label>
					<input class="form-control" id="url" name="url" type="text" value="" size="30"/>
					
				</div>
				<?php endif; ?>
				
				<div class="form-group form-group-comment">
					<textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="<?php _e("Your comment here..",'nietzsche'); ?>"></textarea>
				</div>
				
				<div class="form-group form-group-submit">
					<button class="<?php echo apply_filters("pe_theme_comment_submit_class","btn btn-success"); ?>" type="submit"><?php _e("Post Comment",'nietzsche'); ?></button>
					<?php $comments->fields(); ?>
				</div>
			</form>
		</div>
	</div>
	<!--end comment form-->
	
<?php endif; ?>
</div>
<!--end respond--> 
<?php $comments->end(); ?>
<?php else: ?>
<div class="row">
	<div class="col-md-12">
		<p><?php _e("The comments are now closed.",'nietzsche'); ?></p> 
	</div>
</div>
<?php endif; ?>
<?php
	}


	public function slider_volo($slider,$name = "gallery") {
		if (!$slider || !isset($slider->main->loop)) return "";
		if (!$this->custom($slider,"slider-volo",$name)) {
			$this->slider_volo_gallery($slider);
		}
	}

	public function intro_gallery($id,$w,$h,$name,$cols = 4,$class = "span3",$meta = null) {
		$loop =& $this->master->gallery->getSliderLoop($id,$w,$h,$cols,$class);
		if (!$loop) return;
		if (!$this->custom($loop,"intro-gallery",$name)) {
			$this->{"intro_gallery_$name"}($loop,$meta);
		}
	}

	public function intro_gallery_thumbnails($loop,$galopts = null) {
		$width = $loop->main->width;
		$height = $loop->main->height;
		$id = $loop->main->id;
		$cols = $loop->main->cols;
		$t =& peTheme();
		if ($galopts) {
			// use provided gallery options
			$meta = new StdClass();
			$meta->gallery = $galopts;
		} else {
			// fetch meta from current post
			$meta =& $t->content->meta();
		}
		$flarePlugin = isset($meta->gallery->lbType) && $meta->gallery->lbType ? $meta->gallery->lbType : "default";
		$maxThumbs = isset($meta->gallery->maxThumbs) ? intval($meta->gallery->maxThumbs) : 0;
		$flareScale = isset($meta->gallery->lbScale) && $meta->gallery->lbScale ? $meta->gallery->lbScale : "fit";
		$overClass = apply_filters("pe_theme_image_over_class","peOver","gallery_thumbnail",$loop->main->class);
?>
<?php while ($item =& $loop->next()): ?>
<?php $hidden = ($maxThumbs > 0 && $item->idx >= $maxThumbs); ?>
<?php if ($cols > 0 && ($item->idx % $cols) == 0): ?>
<div class="row post-thumbs">
<?php endif; ?>
<div class="<?php esc__pe($loop->main->class . (($hidden) ? " hiddenLightboxContent" : "")) ?>" >
	<a 
		title="<?php echo esc_attr($item->title); ?>"
		class="<?php echo esc_attr( $overClass ); ?>"
		data-target="flare" 
		data-flare-gallery="galPostThumb<?php echo esc_attr( $id ); ?>"
		id="galPostThumb<?php echo esc_attr( "{$id}_{$item->id}" ); ?>"
		data-flare-thumb="<?php echo esc_url( $t->image->resizedImgUrl($item->img,$width,$height) ); ?>"
		<?php if ($flarePlugin === "shutter"): ?>
		data-flare-bw="<?php echo esc_url( $t->image->bw($item->img) ); ?>"
		<?php endif; ?>
		data-flare-plugin="<?php echo esc_attr( $flarePlugin ); ?>"
		data-flare-scale="<?php echo esc_attr( $flareScale ); ?>"
		href="<?php echo esc_url( $item->img ); ?>"
		>
		<?php esc__pe($hidden ? "" : $t->image->resizedImg($item->img,$width,$height)); ?>
	</a>
</div>
<?php if ($cols > 0 && (($item->idx == $loop->last) || ($item->idx % $loop->main->cols) == ($loop->main->cols-1))): ?>
</div>
<?php endif; ?>
<?php endwhile; ?>
<?php
	}

	public function intro_gallery_fullscreen($loop,$galopts) {
		$t =& peTheme();
		if ($galopts) {
			// use provided gallery options
			$meta = new StdClass();
			$meta->gallery = $galopts;
		} else {
			// fetch meta from current post
			$meta =& $t->content->meta();
		}
		// if a custon url is defined for the gallery (cover), we don't need to add the hidden images for the lightbox window
		if ($meta->gallery->link) return;

		$width =& $loop->main->width;
		$height =& $loop->main->height;
		$id =& $loop->main->id;

		$flarePlugin = isset($meta->gallery->lbType) && $meta->gallery->lbType ? $meta->gallery->lbType : "shutter";
		$flareScale = isset($meta->gallery->lbScale) && $meta->gallery->lbScale ? $meta->gallery->lbScale : "fillmax";
?>
<div class="hiddenLightboxContent">
	<?php while ($item =& $loop->next()): ?>
	<a href="<?php echo esc_url( $item->img ); ?>"
	   title="<?php echo esc_attr($item->title); ?>"
	   data-flare-thumb="<?php echo esc_url( $t->image->resizedImgUrl($item->img,$width,$height) ); ?>"
	   data-flare-bw="<?php echo esc_url( $t->image->bw($item->img) ); ?>"
	   data-target="flare"
	   data-flare-plugin="<?php echo esc_attr( $flarePlugin ); ?>"
	   data-flare-gallery="fsGallery<?php echo esc_attr( $id ); ?>"
	   data-flare-scale="<?php echo esc_attr( $flareScale ); ?>"
	   >
	</a>
	<?php endwhile; ?>
</div>
<?php
	}


	public function gallery_cover($w,$h,$galopts = null) {
		$loop = false;
		if ($this->custom($loop,"gallery-cover")) return;
		$t =& peTheme();
		if ($t->content->type() != "gallery") {
			// gallery is linked to other post, fetch info from post meta
			$gallery = $galopts ? $galopts : $t->content->meta()->gallery;
			$id = $gallery->id;
			$type = $gallery->type;
			$title = isset($gallery->title) ? $gallery->title : "";
		} else {
			// post = gallery, fetch info from gallery itself
			$id = $GLOBALS["post"]->ID;
			$type = "fullscreen";
			$title = "gallery";
		}

		switch ($title) {
		case "gallery":
			$title = $t->gallery->title($id);
			break;
		case "custom":
			$title = $gallery->custom;
			break;
		default:
			$title = false;
		}

		$count = $t->gallery->count($id);

		$info = sprintf('<div class="title"><span>%s</span>%s</div>',
						apply_filters("pe_theme_gallery_cover_count"," &times; $count",$count),
						$title ? sprintf('<a href="%s">%s</a>',get_permalink(),$title) : '<i></i>'
						);

		$info = apply_filters("pe_theme_gallery_cover_info",$info,$title,$count);
		$fullscreen = ($type == "fullscreen" && (is_single() || is_page()));
		$link = isset($gallery->link) && $gallery->link  ? $gallery->link : false;
		$overClass = apply_filters("pe_theme_image_over_class",$fullscreen ? "peOver" : "","gallery_cover");
?>
<!--album cover-->
<div class="portfolioItem galleryCover">
	<?php if ($fullscreen && !$link ): ?>
	<a class="<?php echo esc_attr( $overClass ); ?>" href="#fsGallery<?php echo esc_attr( $id ); ?>" data-target="flare">
	<?php else: ?>		
	<a class="<?php echo esc_attr( $overClass ); ?>" href="<?php if ($link) { echo esc_url( $link );} else { $t->content->link(); } ?>">
	<?php endif; ?>
	<?php if ($t->content->hasFeatImage()): ?>
	<?php $t->content->img($w,$h) ?>
	<?php else: ?>
	<?php esc__pe($t->image->resizedImg($t->gallery->cover($id),$w,$h)); ?>
	<?php endif; ?>
	<?php echo apply_filters("pe_theme_gallery_cover_icon","<span></span>",$count,$title,$fullscreen); ?>
	</a>
	<?php esc__pe($info); ?>
</div>
<!--end album cover-->
<?php
	}


	public function slider_volo_gallery($slider) {
		if (!$slider || !isset($slider->main->loop)) return "";

		$deflink = isset($slider->main->link) ? $slider->main->link : null;
		if ($deflink !== false) {
			$deflink = is_single() || is_page() ? false : get_permalink();
		}

		$captionManager = peTheme()->captions;

		$customAttr = peTheme()->gallery->getSliderConf(isset($slider->main->config) ? $slider->main->config : null);
		$customAttr = apply_filters("pe_theme_slider_attributes",$customAttr,$slider);
		$delay = isset($customAttr["delay"]) ? sprintf('data-delay="%s"',esc_attr( $customAttr["delay"] )) : "";
?>
<div class="peSlider peVolo" data-autopause="enabled" <?php esc__pe($this->master->utils->getAttributes($customAttr)); ?>>
	<?php while ($slide =& $slider->next()): ?>
	<?php $customAttr = apply_filters("pe_theme_slider_slide_attributes",array(),$slide,$slider); ?>
	<div <?php esc__pe($delay); ?> <?php esc__pe($this->master->utils->getAttributes($customAttr)); ?> <?php esc__pe($slide->idx == 0 ? ' class="visible"' : ''); ?>>
		<?php if (isset($slide->captions)) $captionManager->output($slide->captions); ?>
		<?php $link = $deflink ? $deflink : (isset($slide->link) ? $slide->link : false); ?>
		<?php $img = peTheme()->image->resizedImg($slide->img,$slider->main->width,$slider->main->height); ?>
		<?php if ($link):  ?>
		<a href="<?php echo esc_url( $link ); ?>">
			<?php esc__pe($img); ?>
		</a>
		<?php else: ?>
		<?php esc__pe($img); ?>
		<?php endif; ?>
	</div>
	<?php endwhile; ?>
</div>
<?php
	}

	public function get_for($id,$slug,$name = "") {
		if (!$id) return;
		$post = get_post($id);
		if ($post) {
			$this->master->data->postSetup($post);
			get_template_part($slug,$name);
			$this->master->data->postReset();
		}
		
	}

	public function get_part(&$args,$slug,$name = "") {
		$this->args =& $args;
		get_template_part($slug,$name);
	}


	public function paginate_links($loop) {
		if (!$loop) return "";
		
		$classes = "row post-pagination";
		$all = "";

		if (apply_filters('pe_theme_pager_load_more',false)) {
			$classes .= ' pe-load-more';
			$all = empty($loop->main->all) ? false : $loop->main->all;
			$all = $all ? sprintf('data-all="%s"',esc_attr(json_encode($all))) : "";
		}
?>
<div class="<?php echo esc_attr( $classes ); ?>" <?php esc__pe($all) ?> data-msg="<?php _e("Load More",'nietzsche'); ?>">
	<div class="<?php echo esc_attr( $loop->main->class ); ?>">
		<div class="pagination">
			<ul>
				<li class="<?php echo esc_attr( $loop->main->prev->class ); ?>">
					<a href="<?php echo esc_url( $loop->main->prev->link ); ?>"><?php _e("Prev",'nietzsche'); ?></a>
				</li>
				<?php while ($page =& $loop->next()): ?>
				<li class="<?php echo esc_attr( $page->class ); ?> pe-is-page">
					<a href="<?php echo esc_url( $page->link ); ?>"><?php esc__pe($page->num); ?></a>
				</li>
				<?php endwhile; ?>
				<li class="<?php echo esc_attr( $loop->main->next->class ); ?>">
					<a href="<?php echo esc_url( $loop->main->next->link ); ?>"><?php _e("Next",'nietzsche'); ?></a>
				</li>
			</ul>
		</div>  
	</div>
</div>
<?php
	}


}

?>