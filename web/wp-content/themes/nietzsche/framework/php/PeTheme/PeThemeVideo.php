<?php

class PeThemeVideo {

	protected $master;
	protected $options;
	protected $cache;

	public function __construct(&$master) {
		$this->master =& $master;
		add_action('pe_theme_metabox_config_video',array(&$this,'pe_theme_metabox_config_video'));
	}

	public function cpt() {
		$cpt =
			array(
				  'labels' => 
				  array(
						'name'              => __("Videos",'nietzsche'),
						'singular_name'     => __("Video",'nietzsche'),
						'add_new_item'      => __("Add New Video",'nietzsche'),
						'search_items'      => __('Search Videos','nietzsche'),
						'popular_items' 	  => __('Popular Videos','nietzsche'),		
						'all_items' 		  => __('All Videos','nietzsche'),
						'parent_item' 	  => __('Parent Video','nietzsche'),
						'parent_item_colon' => __('Parent Video:','nietzsche'),
						'edit_item' 		  => __('Edit Video','nietzsche'), 
						'update_item' 	  => __('Update Video','nietzsche'),
						'add_new_item' 	  => __('Add New Video','nietzsche'),
						'new_item_name' 	  => __('New Video Name','nietzsche')
						),
				  'public' => true,
				  'has_archive' => false,
				  "supports" => array("title","thumbnail"),
				  "taxonomies" => array("")
				  );
		
		PeGlobal::$config["post_types"]["video"] =& $cpt;
	}

	public function pe_theme_metabox_config_video() {
		$mbox = 
			array(
				  "type" =>"Video",
				  "title" =>__("Video Options",'nietzsche'),
				  "where" => 
				  array(
						"video" => "all",
						),
				  "content"=>
				  array(
						"type" => 
						array(
							  "label"=>__("Type",'nietzsche'),
							  "type"=>"select",	
							  "options" =>
							  array(
									__("Youtube",'nietzsche')=>"youtube",
									__("Vimeo",'nietzsche')=>"vimeo"
									),
							  "default"=>"youtube"
							  ),
						"url" => 
						array(
							  "label"=>__("Url",'nietzsche'),
							  "type"=>"Text",				  
							  "description" => __("Insert here the youtube/vimeo video url.",'nietzsche'),
							  "default"=>""
							  ),
						"fullscreen" =>  
						array(
							  "label"=>__("Play fullscreen",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __("Specify if video should play in a fullscreen lightbox window.",'nietzsche'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"no"
							  ),
						"width" => 
						array(
							  "label"=>__("Max Width",'nietzsche'),
							  "type"=>"Text",				  
							  "description" => __("Max width of the video when played inside the lightbox, use 0 for fullscreen",'nietzsche'),
							  "default"=>"0"
							  )
						)
				  );

		PeGlobal::$config["metaboxes-video"] = 
			array(
				  "video" => $mbox
				  );
	}


	public function option() {
		$posts = get_posts(
						   array(
								 "post_type"=>"video",
								 "posts_per_page"=>-1
								 )
						   );
		if (count($posts) > 0) {
			$options = array();
			foreach($posts as $post) {
				$options[$post->post_title] = $post->ID;
			}
		} else {
			$options = array(__("No videos defined",'nietzsche')=>-1);
		}
		return $options;
	}


	public function &get($id) {
		$post = false;
		if (!isset($id) || $id == "" ) return $post;
		if (isset($this->cache[$id])) return $this->cache[$id];
		$post = get_post($id);
		if (!$post || $post->post_type != "video") {
			$post = false;
			return $post;
		}
		$meta =& $this->master->meta->get($id,$post->post_type);
		$post->meta = $meta;
		switch ($meta->video->type) {
		case "vimeo":
			preg_match("/https?:\/\/(vimeo\.com|www\.vimeo\.com)\/([\w|\-]+)/i",$meta->video->url,$matches);
			break;
		case "youtube":
			preg_match("/https?:\/\/(www.youtube.com\/watch\?v=|youtube.com\/watch\?v=|youtu.be\/)([\w|\-]+)/i",$meta->video->url,$matches);
			break;
		default:
			$matches = false;
		} 
		if ($matches && isset($matches[2])) $meta->video->id = $matches[2];

		$poster = wp_get_attachment_url(get_post_thumbnail_id($id));
		$meta->video->cover = $meta->video->poster = $poster ? $poster : "";

		return $post;
	}

	public function get_video_id( $url, $type ) {

		switch ( $type ) {

			case 'vimeo':
				preg_match( "/https?:\/\/(vimeo\.com|www\.vimeo\.com)\/([\w|\-]+)/i", $url, $matches );
				break;

			case 'youtube':
				preg_match( "/https?:\/\/(www.youtube.com\/watch\?v=|youtube.com\/watch\?v=|youtu.be\/)([\w|\-]+)/i", $url, $matches );
				break;

			default:
				$matches = false;
				break;

		}

		if ( $matches && isset( $matches[2] ) ) {

			return $matches[2];

		}

		return false;

	}

	public function exists($id) {
		return $this->get($id) !== false;		
	}

	public function getInfo($id) {
		$video = $this->get($id);
		return $video === false ? $video : $video->meta->video;		
	}

	public function inline($id) {
		$post = $this->get($id);
		if (!$post) return null;
		$video =& $post->meta->video;
		
		if ($video->fullscreen === "yes" ) {
			$template = '<a href="%s" data-target="flare" data-flare-videoformats="%s" data-poster="%s" data-flare-videoposter="%s" class="peVideo"></a>';
		} else {
			$template = '<a href="%s" data-formats="%s" data-poster="%s" class="peVideo"></a>';
		}

		return sprintf($template,
					   $video->url,
					   join(",",$video->formats),
					   $video->poster,
					   $video->poster
					   );
	}


	public function conf($id = null) {
		if (!$id) {
			global $post;
			$id = $post->ID;
			
			// if not video, get video id from meta
			if ($post->post_type != "video") {
				$meta =& $this->master->meta->get($id,$post->post_type);
				$id = empty($meta->video->id) ? false : $meta->video->id;
			}
		}

		return $id ? $this->getInfo($id) : false;
	}


	public function output($id = null) {
		if ($conf = $this->conf($id)) {
			if (PE_THEME_MODE) {
				$this->master->template->data($conf);
				peTheme()->get_template_part("video",$conf->type);
			} else {
				$video = $conf;
				?>
<?php switch($video->type): case "youtube": ?>
<iframe width="680" height="383" src="http://www.youtube.com/embed/<?php echo esc_attr( $video->id ); ?>?autohide=1&modestbranding=1&showinfo=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
<?php break; case "vimeo": ?>
<iframe src="http://player.vimeo.com/video/<?php echo esc_attr( $video->id ); ?>?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="680" height="383" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
<?php endswitch; ?>
<?php
			}
			
		}

		/*
		if (!$id) {
			global $post;
			$id = $post->ID;
			
			// if not video, get video id from meta
			if ($post->post_type != "video") {
				$meta =& $this->master->meta->get($id,$post->post_type);
				$id = empty($meta->video->id) ? false : $meta->video->id;
			}
		}

		if ($id && ($conf = $this->getInfo($id))) {
			$this->master->template->data($conf);
			get_template_part("video",$conf->type);
		}
		*/
	}

	public function show($id) {
		$inline = $this->inline($id);
		if ($inline) {
			esc__pe( $inline );
		}
		
	}


}

?>
