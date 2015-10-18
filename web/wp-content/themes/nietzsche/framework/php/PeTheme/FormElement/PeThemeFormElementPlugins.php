<?php

class PeThemeFormElementPlugins extends PeThemeFormElement {

	public function registerAssets() {
		parent::registerAssets();
		PeThemeAsset::addScript("framework/js/admin/jquery.theme.field.wp-plugins.js",array("jquery-ui-progressbar"),"pe_theme_field_wpPlugins");
		wp_enqueue_script("pe_theme_field_wpPlugins");
	}

	protected function template() {
		$buttonLabel = __('Install / Activate / Update All Plugins','nietzsche');

		$messageSaving = __("Installing plugins, please wait.",'nietzsche');
		$messageDone = __("All plugins are active and updated to the latest version.",'nietzsche');
		$messageWarning = __("Error occurred while performing the action",'nietzsche');
		$messageWarning2 = __("Please try to install/activate/update the plugin manually.",'nietzsche');
		
		$html = <<<EOT
<div class="option option-plugins option-import">
    <h4>[LABEL][TOOLTIP]</h4>
    <div class="section">
        <div class="element">
			<input id="[ID]" type="button" value="$buttonLabel" name="[NAME]" class="button pe-theme-import"  />
			<div class="bottom" id="[ID]_messages">
				<div id="[ID]_saving" class="notify saving"><span class="spinner"></span><span class="pe-log">$messageSaving</span></div>
				<div id="[ID]_done" class="notify imported">$messageDone</div>
				<div id="[ID]_warning" class="notify warning">$messageWarning<span class="pe-log"></span>$messageWarning2</div>
			</div>
			<div class="pe-plugins-list">[STATUS]</div>
        </div>
        <div class="description">[DESCRIPTION]</div>
    </div>
	<script type="text/javascript">jQuery("#[ID]").peFieldWPPlugins();</script>
</div>
EOT;
		return $html;
	}

	protected function addTemplateValues(&$data) {
		$data["[STATUS]"] = PixelentityThemeBundledPlugins::$instance->options();
	}

}

?>
