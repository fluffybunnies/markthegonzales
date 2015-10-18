<?php

class PeThemeViewLayoutModuleFaqsItem extends PeThemeViewLayoutModuleTabsItem {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("FAQ",'nietzsche')
				  );
	}

	public function fields() {
		$fields = parent::fields();
		return 
			array(
				  "title" => $fields["title"],
				  "closed" => 
				  array(
						"label" => __("Closed",'nietzsche'),
						"type"=>"RadioUI",
						"options" => PeGlobal::$const->data->yesno,
						"default"=> "yes"
						),
				  "content" => $fields["content"]
				  );
	}


	public function type() {
		return "FAQs";
	}

	public function group() {
		return "faqs";
	}

	public function tooltip() {
		return __("Use this block to add simple text content to the FAQ item.",'nietzsche');
	}

}

?>
