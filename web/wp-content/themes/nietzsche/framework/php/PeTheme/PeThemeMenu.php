<?php

class PeThemeMenu {

	protected $master;
	protected $native = false;
	protected $custom = false;
	protected $sections = false;

	public function __construct(&$master) {
		$this->master =& $master;
		$menus = PeGlobal::$config['custom-menus'];
		if (isset($menus['native'])) {
			$this->native = $menus['native'];
		}

		if (isset($menus['custom'])) {
			$this->custom = $menus['custom'];
			$this->section = array();
			foreach($this->custom as $name=>$data) {
				$section = $data['section'];
				unset($data['section']);
				$this->sections[$section][$name] = $data;
			}
		}

		add_action('wp_setup_nav_menu_item',array(&$this,'wp_setup_nav_menu_item'),10,1);
	}

	public function location($name,$template = 'default') {
		if (!isset($name)) return;
		$locations = get_nav_menu_locations();
		if (isset($locations[$name])) {
			$menu = wp_get_nav_menu_object($locations[$name]);
		} else {
			$menu = wp_get_nav_menu_object($name);
		}

		if (!$menu) {
			$menu = get_pages(array("depth" => 1,'hierarchical' => 0));
			foreach ($menu as $item) {
				$item->url = get_page_link($item->ID);
				$item->title = $item->post_title;
				$item->object = $item->post_type;
				$item->menu_item_parent = 0;
				$item->db_id = $item->ID;
			}
		}

		if ($menu) {
			$this->display($menu,$template);
		}

	}

	public function pe_theme_menu_custom_fields_filter($fields,$item) {
		
		$options = false;


		if (!empty($this->native[$item->object])) {
			$options = $this->native[$item->object];
		} elseif (!empty($item->pe_meta->object)) {
			$key = $item->pe_meta->object;
			if (!empty($this->custom[$key]['fields'])) {
				$options = $this->custom[$key]['fields'];
			}
		}

		$item_id = esc_attr($item->ID);
		$fields = "";

		$values = maybe_unserialize(get_post_meta($item_id,PE_THEME_META,true));

		if ($options) {
			unset($options["object"]);
			foreach ($options as $name=>$data) {
				$optionClass = "PeThemeFormElement{$data['type']}";
				if (is_array($values) && isset($values[$name])) {
					$data["value"] = $values[$name];
				}
				$field = new $optionClass(PE_THEME_META."[$item_id]",$name,$data);
				//$item->registerAssets();
				$fields .= $field->get_render();
			}
		}
		if (!empty($values['object'])) {
			$data['value'] = $values['object'];
			$field = new PeThemeFormElementHidden(PE_THEME_META."[$item_id]",'object',$data);
			$fields .= $field->get_render();
		}
		
		return $fields;
	}

	public function display($menu,$template = 'default') {
		if (is_array($menu)) {
			$items = array_merge(array(),$menu);
			$sorted = $items;
		} else {
			$items = wp_get_nav_menu_items($menu->term_id);
			$sorted = array();

			foreach ($items as $item) {
				$sorted[$item->menu_order] = $item;
			}
		}

		if (empty($items)) {
			return;
		}

		if (!isset($menu->name)) {
			$menu = new StdClass();
		}

		$items = $sorted;

		if (function_exists('_wp_menu_item_classes_by_context')) {
			_wp_menu_item_classes_by_context($items);
		}

		$ref = array();
		$res = array();

		foreach ($items as $item) {
			$parent = $item->menu_item_parent;
			$id = $item->db_id;
			$item = (object) get_object_vars($item);
			$item->is_menu = false;
			$item->depth = 1;

			if (isset($item->object) && $item->object == 'page' && !empty($item->pe_meta->name)) {
				$section = strtr($item->pe_meta->name,array('#' => ''));
				$item->url .= "#section-$section";
			}

			$ref[$id] = $item;
			if ($parent == 0) {
				$res[] = $item;
			} else {
				$item->depth = $ref[$parent]->depth+1;
				$ref[$parent]->is_menu = true;
				$ref[$parent]->items[] = $item;

			}
		}
		
		$menu->depth = 0;
		$menu->items = $res;

		$this->output($menu,$template);
	}

	public function output($menu,$template = 'default') {
		$this->master->template->data($menu);
		$this->master->get_template_part('menu',$template);
	}

	public function admin() {
		add_action('wp_update_nav_menu_item',array(&$this,'wp_update_nav_menu_item'),10,3);
		add_action("current_screen",array(&$this,"current_screen"));
		add_filter('wp_edit_nav_menu_walker',array(&$this,"wp_edit_nav_menu_walker_filter"),10,2);
		add_filter('pe_theme_menu_custom_fields',array(&$this,"pe_theme_menu_custom_fields_filter"),10,3);
		add_action("wp_update_nav_menu",array(&$this,"wp_update_nav_menu"),10,1);
		if (!empty($this->sections)) {
			foreach ($this->sections as $section => $menus) {
				$id = sprintf('pixelentity_custom_nav_items_%s',strtolower(sanitize_html_class($section)));
				add_meta_box($id, $section, array($this,'meta_box'), 'nav-menus', 'side', 'low', array($section,$menus));
			}
		}
	}

	public function wp_update_nav_menu_item($menu_id, $menu_item_db_id, $args) {
		// only consider custom nav menu items
		if (isset($args['menu-item-type']) && $args['menu-item-type'] == 'custom') {
			$custom = false;
			$prefix = 'pe-custom';
			if (defined('DOING_AJAX') && DOING_AJAX) {
				if (!empty($args['menu-item-target']) && strpos($args['menu-item-target'],$prefix) === 0) {
					// draft menu added via ajax call
					$custom = sanitize_key(str_replace("$prefix-",'',$args['menu-item-target']));
					
					update_post_meta($menu_item_db_id, '_menu_item_target','');
					update_post_meta($menu_item_db_id, PE_THEME_META, array("object" => $custom));
				}
			}
		}
	}

	public function wp_setup_nav_menu_item($item) {
		$meta = maybe_unserialize(get_post_meta($item->ID,PE_THEME_META,true));
		if ($meta) {
			$item->pe_meta = $meta = (object) $meta;
			if (isset($meta->object) && !empty($this->custom[$meta->object])) {
				$item->object = 'pe-custom';
				$item->type_label = $this->custom[$meta->object]['type_label'];
			}
		}
		return $item;
	}

	public function meta_box($post,$metabox) {

		global $_nav_menu_placeholder, $nav_menu_selected_id;
        $_nav_menu_placeholder = 0 > $_nav_menu_placeholder ? $_nav_menu_placeholder - 1 : -1;
		$idx = $_nav_menu_placeholder;
		
		list($section,$items) = $metabox['args'];

        ?>

<div class="posttypediv" id="pe-custom-nav-menu">

	<div id="tabs-panel-pe-custom" class="tabs-panel tabs-panel-active">
		<ul id="pe-custom-checklist" class="categorychecklist form-no-clear">
			<?php foreach($items as $key=>$item): ?>
			<li>
				<label class="menu-item-title">
					<input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php esc__pe($idx) ?>][menu-item-label]" value="0"> <?php esc__pe($item['mbox_label']); ?>
				</label>
				<input type="hidden" class="menu-item-type" name="menu-item[<?php esc__pe($idx) ?>][menu-item-type]" value="custom" />
				<input type="hidden" class="menu-item-title" name="menu-item[<?php esc__pe($idx) ?>][menu-item-title]" value="<?php esc__pe($item['menu_title']); ?>" />
				
				<input type="hidden" class="menu-item-url" name="menu-item[<?php esc__pe($idx) ?>][menu-item-url]" value="#" />
				<input type="hidden" class="menu-item-target" name="menu-item[<?php esc__pe($idx) ?>][menu-item-target]" value="pe-custom-<?php esc__pe($key); ?>" />
			</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<p class="button-controls">
		<span class="add-to-menu">
			<input type="submit" class="button-secondary submit-add-to-menu right" value="<?php _e('Add to Menu','nietzsche'); ?>" name="add-pe-custom-nav-menu" id="submit-pe-custom-nav-menu" />
			<span class="spinner"></span>
		</span>
	</p>
</div><!-- /.customlinkdiv -->

<?php 
	}
	

	public function current_screen($screen) {
		if (empty($screen->base)) return;
		if ($screen->base === "nav-menus") {
			$options = array();
			// native
			if (!empty($this->native)) {
				foreach ($this->native as $type) {
					foreach ($type as $field) {
						$options[$field['type']] = true;
					}
				}
			}
			// custom
			if (!empty($this->custom)) {
				foreach ($this->custom as $type) {
					if (!empty($type['fields'])) {
						foreach ($type['fields'] as $field) {
							$options[$field['type']] = true;
						}						
					}
				}
			}
			if (is_array($options) && !empty($options)) {
				$options = array_keys($options);
				add_action("admin_enqueue_scripts",array(&$this,"admin_enqueue_scripts"));
				foreach ($options as $name) {
					$optionClass = "PeThemeFormElement{$name}";
					$item = new $optionClass("","",$null);
					$item->registerAssets();
				}	
			}
		}
	}

	public function admin_enqueue_scripts() {
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.menu.js",array("jquery","pe_theme_tooltip"),"pe_theme_admin_menu");
		wp_enqueue_script("pe_theme_admin_menu");
	}


	public function wp_edit_nav_menu_walker_filter() {
		return "PeThemeMenuEditWalker";
	}

	public function wp_update_nav_menu($menu_id) {
		if (!empty($_POST[PE_THEME_META])) {

			foreach ($_POST[PE_THEME_META] as $id => $value) {
				// this is needed to convert window-style line feeds to unix format, without doing so
				// all serialized values will breaks once exported into xml file
				array_walk_recursive($value,array("PeThemeUtils","dos2unix"));
				update_post_meta($id,PE_THEME_META,apply_filters("pe_theme_update_nav_metadata",$value,$id));
			}
		}
	}

}