<?php

class PeThemeFormElementImportDemo extends PeThemeFormElement {

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.importDemo.js",array("jquery-ui-progressbar"),"pe_theme_field_importDemo");
		wp_enqueue_script("pe_theme_field_importDemo");
	}

	protected function template() {
		$buttonLabel = __("Import Demo Content",'nietzsche');
		$nonce = wp_create_nonce("pe_theme_import_demo");
		$messagePlugins = __("Waiting plugins installation.",'nietzsche');
		$messageSaving = __("Importing content, please wait.",'nietzsche');
		$messageImported = __("Demo content successfully imported.",'nietzsche');
		$messageWarning = __("Error occurred while importing the data",'nietzsche');

		$posts = wp_count_posts();
		$pages = wp_count_posts("page");
		if (intval($posts->publish) <= 1 && intval($pages->publish) <= 1) {
			// fresh installation, do not require confirmation when clicking on import button
			$confirm = "no";
		} else {
			$confirm = "yes";
		}
		$html = <<<EOT
<div class="option option-import">
    <h4>[LABEL][TOOLTIP]</h4>
    <div class="section">
        <div class="element">
            <input id="[ID]" type="button" value="$buttonLabel" name="[NAME]" class="button [UPCLASS] pe-theme-import" data-nonce="$nonce" data-confirm="$confirm" />
			<div class="bottom" id="[ID]_messages">
				<div id="[ID]_plugins" class="notify saving"><span class="spinner"></span>$messagePlugins</div>
				<div id="[ID]_saving" class="notify saving"><span class="spinner"></span>$messageSaving</div>
				<div id="[ID]_imported" class="notify imported">$messageImported</div>
				<div id="[ID]_warning" class="notify warning">$messageWarning</div>
			</div>
			<div id="[ID]_log"></div>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	</div>
<script type="text/javascript">
jQuery("#[ID]").peFieldImportDemo();
</script>
EOT;

		return $html;
	}

	protected function addTemplateValues(&$data) {
		$data["[UPCLASS]"]="pe_import_demo";
	}

}