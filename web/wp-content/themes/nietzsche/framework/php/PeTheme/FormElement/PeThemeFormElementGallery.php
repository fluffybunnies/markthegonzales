<?php

class PeThemeFormElementGallery extends PeThemeFormElement {

	public function registerAssets() {
		parent::registerAssets();

		PeThemeAsset::addStyle("framework/css/jquery.theme.field.gallery.css",array("pe_theme_admin"),"pe_theme_field_gallery");
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.gallery.js",array("pe_theme_utils","pe_theme_tooltip"),"pe_theme_field_gallery");

		wp_enqueue_style("pe_theme_field_gallery");
		wp_enqueue_script("pe_theme_field_gallery");

	}

	public function jsInit() {
		return 'jQuery("#[ID]").peFieldGallery({api:true});';
	}

	protected function validate($data) {
		global $wpdb;
		$pt = $wpdb->posts;

		$data = implode(",",$data);

		// make sure every id exists and is an attachment
		$ids = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $pt WHERE $pt.post_type = '%s' AND ID IN ($data) ORDER BY FIELD(ID,$data)",'attachment'));

		return $ids;
	}

	protected function addTemplateValues(&$data) {
		parent::addTemplateValues($data);

		$images = isset($this->data["value"]) ? $this->validate($this->data["value"]) : false;

		$data["[IMAGES]"] = $images && is_array($images) && count($images) > 0 ? implode(",",$images) : "false";
		
		if (!isset($this->data["noscript"])) {
			$data['[SCRIPT]'] = sprintf('<script type="text/javascript">%s</script>',str_replace("[ID]",$data['[ID]'],$this->jsInit()));
		} else {
			$data['[SCRIPT]'] = "";
		}

	}

	protected function template() {

		$addLabel = __("Add Images",'nietzsche');
		$editLabel = __("Edit Images",'nietzsche');

		$html = <<<EOT
<div class="option pe-field-gallery" id="[ID]">
    <h4>[LABEL][TOOLTIP]</h4>
    <div class="section">
        <div class="element">
			<input class="button" type="button" value="$addLabel" data-add="$addLabel" data-edit="$editLabel"/>
        </div>
        <div class="description">[DESCRIPTION]</div>
		<div class="thumbnails"></div>
		<div class="pe-data" data-name="[NAME]" data-images="[IMAGES]"></div>
    </div>
</div>
[SCRIPT]
EOT;
		return $html;
	}
	
	

}

?>
