<?php

class PeThemeViewLayoutModuleAccordion extends PeThemeViewLayoutModuleTabs {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Accordion",'nietzsche')
				  );
	}

	public function name() {
		return __("Accordion",'nietzsche');
	}

	public function allowed() {
		return "accordion";
	}

	public function create() {
		return "AccordionItem";
	}

	public function prefix() {
		return "accordion";
	}

	public function tooltip() {
		return __("Use this block to add an accordion component to your layout.",'nietzsche');
	}


}

?>
