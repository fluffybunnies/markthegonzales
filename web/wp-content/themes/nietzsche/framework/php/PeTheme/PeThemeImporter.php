<?php

class PeThemeImporter extends WP_Import {
	public $origUploadUrl;
	public $stats;
	public $umap;
	public $amap = false;

	public function process_attachment($postdata, $remote_url) {
		$this->updateStats();

		if (!$this->origUploadUrl) {
			$tokens = pathinfo($postdata["guid"]);
			$this->origUploadUrl = preg_replace("#/\d+/\d+/?$#","",$tokens["dirname"]);
		}

		// $remote_url = $this->base_url . $remote_url;
		$remote_url = get_site_url() . $remote_url;
		$id = parent::process_attachment($postdata,$remote_url);
		$old = $postdata['guid'];
		$new = wp_get_attachment_url($id);
		$this->amap[$old] = $new;
		$this->umap[sprintf('s:%d:"%s"',strlen($old),$old)] = sprintf('s:%d:"%s"',strlen($new),$new);
		peTheme()->debug->log(peTheme()->debug->memory());
		return $id;
	}

	public function import_start($file) {
		$this->updateStats(__("Parsing import file",'nietzsche'));
		parent::import_start($file);
		peTheme()->debug->log(peTheme()->debug->memory());
	}

	public function process_categories() {
		$this->updateStats(__("Importing categories",'nietzsche'));
		parent::process_categories();
		peTheme()->debug->log(peTheme()->debug->memory());
	}

	public function process_terms() {
		$this->updateStats(__("Importing terms",'nietzsche'));
		parent::process_terms();
		peTheme()->debug->log(peTheme()->debug->memory());
	}

	public function process_posts() {
		$this->updateStats(__("Importing posts",'nietzsche'));
		parent::process_posts();
		peTheme()->debug->log(peTheme()->debug->memory());
	}

	public function backfill_parents() {
		$this->updateStats(__("Fixing orphans",'nietzsche'));
		parent::backfill_parents();
		peTheme()->debug->log(peTheme()->debug->memory());
	}

	public function process_menu_item($item) {
		$this->updateStats();
		parent::process_menu_item($item);
		// We need to step in to import custom meta assigned to a menu item because WP Importer won't do it for us
		// get the post (nav-menu-item) id
		$id = intval($item['post_id']);
		// check if it has been imported by WP Importer
		$id = empty($this->processed_menu_items[$id]) ? false : $this->processed_menu_items[$id];
		if ($id && is_array($item['postmeta'])) {
			// it seems it has, now cycle all metas to search ours 
			foreach ( $item['postmeta'] as $meta ) {
				if ($meta['key'] === PE_THEME_META) {
					// bingo, update the menu item meta
					update_post_meta($id,PE_THEME_META,maybe_unserialize($meta['value']));
					break;
				}
			}
		}
		peTheme()->debug->log(peTheme()->debug->memory());
	}

	public function backfill_attachment_urls() {
		$this->updateStats(__("Fixing urls",'nietzsche'),true);
		$url = $this->origUploadUrl;
		
		global $wpdb;
		$pt = $wpdb->posts;
		$pm = $wpdb->postmeta;
		$op = $wpdb->options;

		$attachment = wp_get_attachment_url($wpdb->get_var($wpdb->prepare("SELECT ID FROM $pt WHERE $pt.post_type = '%s' LIMIT 1",'attachment')));

		// replace all img/links pointing to an attachment (not imported) with url of first imported attachment		
		$posts = $wpdb->get_results($wpdb->prepare("SELECT ID,post_content FROM $pt WHERE $pt.post_content LIKE '%s'","%$url%"));
		if (is_array($posts)) {

			$url = addcslashes($url,"/");
			$replace = $attachment;
			foreach($posts as $post) {
				$newContent = preg_replace("/{$url}[^\"]+\.(jpg|jpeg|gif|png)/i",$replace,$post->post_content);
				if ($newContent != $post->post_content) {
					$wpdb->update($pt,array("post_content"=>$newContent),array("ID"=>$post->ID));
				}
			}
		}


		// replaces all img/links pointing to an attachment residing in theme folder.
		$origThemeAssetUrl = $this->getOrigThemeAssetUrl();		
		$newThemeAssetUrl = PE_THEME_URL;

		// fix post metas
		$metaKey = 'pe_theme_meta';
		$posts = $wpdb->get_results("SELECT post_id,meta_value FROM $pm WHERE $pm.meta_key = '$metaKey'");

		if (is_array($posts)) {
			
			foreach($posts as $post) {
				$value = $post->meta_value;
				$update = false;
				if (strpos($value,$origThemeAssetUrl) !== false) { 
					$value = PeThemeUtils::fix_serialize(str_replace($origThemeAssetUrl,$newThemeAssetUrl,$value));
					$update = true;
				}
				if (strpos($value,$this->origUploadUrl)) {
					$fixed = strtr($value,$this->umap);
					if ($fixed != $value) {
						$value = $fixed;
						$update = true;
					}
				}
				if ($update) {
					update_post_meta($post->post_id,$metaKey,maybe_unserialize($value));
				}
			}
		}
		peTheme()->debug->log(peTheme()->debug->memory());
	}
	
	public function getOrigThemeAssetUrl() {
		return "{$this->base_url}/wp-content/themes/".strtolower(PE_THEME_NAME);
	}


	public function remap_featured_images() {
		$this->updateStats(__("Remapping images",'nietzsche'),true);
		parent::remap_featured_images();

		if (defined('PE_MEDIA_TAG')) {
			global $wpdb;
			$pt = $wpdb->posts;

			$aIDS = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $pt WHERE $pt.post_type = '%s'",'attachment'));

			// get all media tags
			$tags = get_terms(PE_MEDIA_TAG,array("hide_empty"=>false,"fields"=>"names"));

			// assign each attachment to all media tags
			foreach ($aIDS as $id) {
				wp_set_post_terms($id,$tags,PE_MEDIA_TAG,false);
			}
		}
		$this->import_additional_files();
		peTheme()->debug->log(peTheme()->debug->memory());
	}

	public function import_revslider_demos() {
		$zips = glob(sprintf('%s/demo/revslider/*.zip',get_template_directory()));
		if (is_array($zips) && count($zips) > 0) {
			$this->updateStats(__("Import Revolution Slider",'nietzsche'),true);
			$map = $this->amap ? $this->amap : get_transient('pe-import-attachment-map');
			peTheme()->revslider->import($zips,$map);
		}
		peTheme()->debug->log(peTheme()->debug->memory());
	}

	public function import_additional_files() {
		if (class_exists('RevSlider')) {
			$this->import_revslider_demos();
		}		
	}
	
	public function import_end() {
		$this->updateStats(__("Final cleanup",'nietzsche'),true);
		if ($this->amap) {
			set_transient('pe-import-attachment-map',$this->amap);
		}
		parent::import_end();
		peTheme()->debug->log(peTheme()->debug->memory());
	}

	public function &ids_mapping() {
		return $this->processed_posts;
	}

	public function updateStats($message = "",$done = false) {
		$stats =& $this->stats;

		if ( empty( $stats["total"] ) ) {

			$stats["total"] = count($this->posts);

		}

		if ( $message ) {

			$stats["step"] = $message;

		}

		if ( ! isset( $stats["progress"] ) ) $stats["progress"] = 0;

		if ( $done && ! empty( $stats["total"] ) ) {

			$stats["progress"] = $stats["total"];

		} else if ( $stats["progress"] < $stats["total"] ) {

			$stats["progress"] = min( ( count( $this->processed_posts ) + count( $this->processed_menu_items ) ), $stats["total"] );

		}

		//$stats["posts"] = count($this->processed_posts);
		//$stats["menus"] = count($this->processed_menu_items);

		set_transient("pe_theme_import_progress",$stats,60*5);
	}

}

?>
