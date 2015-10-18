<?php

class PeThemeViewLayoutModule extends PeThemeView {

	public $data;
	protected static $_common;

	public function name() {
		return __("Layout",'nietzsche');
	}

	public function option() {
		return str_replace("PeThemeViewLayoutModule","",get_class($this));
	}

	public function type() {
		return __("Content",'nietzsche');
	}

	public function capability($cap) {
		return $cap === "layout";
	}

	public function tooltip() {
		return __("Description",'nietzsche');
	}

	public function messages() {
		return array();
	}

	public function fields() {
		return array();
	}

	public function field($key) {
		if (empty(self::$_common)) {
			self::$_common = apply_filters('pe_theme_view_layout_common_fields',true);
		}
		if (empty(self::$_common[$key])) {
			die(sprintf(__('Common field %s not defined','nietzsche'),$key));
		}
		return self::$_common[$key];
	}

	public function jsClass() {
		return "Standard";
	}

	public function cssClass() {
		return "content";
	}

	public function group() {
		return "default";
	}

	public function allowed() {
		return "";
	}

	public function create() {
		return "";
	}

	public function force() {
		return "";
	}

	// only a single instance of this block is allowed
	public function unique() {
		return false;
	}

	// add block on top of the list
	public function prepend() {
		return false;
	}

	public function sortable() {
		return true;
	}

	public function requireAssets() {
		static $registered = false;

		if (!$registered) {
			PeThemeAsset::addScript("framework/js/admin/layout/jquery.theme.layout.module.standard.js",array("jquery"),"pe_theme_layout_module_standard");
			$registered = true;
		}

		$type = str_replace("PeThemeViewLayoutModule","",get_class($this));

		wp_localize_script('pe_theme_layout_module_standard',"pe_theme_layout_module_$type",$this->config());
	}

	public function enqueueAssets() {
		wp_enqueue_script("pe_theme_layout_module_standard");
	}

	public function getData($conf) {
		if (!isset($conf["data"])) return false;
		
		$data = (object) $conf["data"];
		if (!empty($data->content)) {
			$data->content = do_shortcode(apply_filters("the_content",$data->content));
		}

		return $data;
	}

	public function blockClass() {
		return "";
	}

	public function setTemplateData() {
		peTheme()->template->data($this->data);
	}

	public function render() {
		$bid = $this->conf->bid;
		$bc = $this->blockClass();
		$lc = str_replace("pethemeviewlayoutmodule","",strtolower(get_class($this)));
		echo apply_filters("pe_theme_layoutmodule_open",sprintf('<div class="pe-block pe-view-layout-block pe-view-layout-block-%s %s pe-view-layout-class-%s">',$bid,$bc,$lc),$bid,$bc,$lc);
		$this->template();
		echo apply_filters("pe_theme_layoutmodule_close",'</div>',$bid,$bc,$lc);
	}

	public function output($conf) {
		$this->conf = (object) $conf;

		$this->data = $this->getData($conf);

		//if (!($this->data = $this->getData($conf))) return;

		$this->setTemplateData();
		$this->render();
	}

	public function conditions() {
		return false;
	}


	public function config() {
		$options["messages"] = $this->messages();
		$options["fields"] = array();
		$options["jsclass"] = $this->jsClass();
		$options["group"] = $this->group();
		$options["allowed"] = $this->allowed();
		$options["create"] = $this->create();
		$options["force"] = $this->force();
		$options["unique"] = $this->unique();
		$options["prepend"] = $this->prepend();
		$options["sortable"] = $this->sortable() ? "1" : "0";
		$conditions = $this->conditions();
		if (!empty($conditions)) {
			$options['conditions'] = $conditions;
		}


		$class = str_replace("PeThemeViewLayoutModule","",get_class($this));
		$fields = apply_filters("pe_theme_view_layout_module_{$class}_options",$this->fields());
		$options = apply_filters("pe_theme_view_layout_module_{$class}_parameters",$options);

		foreach ($fields as $name=>$params) {
			$params["noscript"] = true;

			$class = "PeThemeFormElement".$params["type"];
			$item = new $class("",$name,$params);
			$item->registerAssets();
			$options["templates"][$name] = $item->get_render();
			$options["script"][$name] = $item->jsInit();
			$options["fields"][] = $name;
		}


		return $options;
	}
   
}
?>
