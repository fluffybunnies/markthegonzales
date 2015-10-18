<?php

class PeThemeConstantQuote {
	public $metabox;

	public function __construct() {
		$this->metabox = 
			array(
				  "type" =>"",
				  "title" =>__("Quote Options",'nietzsche'),
				  "where" => 
				  array(
						"post" => "quote",
						),
				  "content"=>
				  array(
						"text" => 	
						array(
							  "label"=>__("Content",'nietzsche'),
							  "type"=>"TextArea",
							  "description" => __("Text content of the quote box. ( Basic HTML is supported )",'nietzsche'),
							  "default"=>'"Lorem ipsum dolor sit amet, <a href="#">consectetuer adipiscing elit</a>, donec odio. Quisque volutpat mattis eros."'
							  ),
						"sign" => 	
						array(
							  "label"=>__("Cite",'nietzsche'),
							  "type"=>"Text",
							  "description" => __("Quote cite",'nietzsche'),
							  "default"=>'John Dough, Client'
							  )
						)
				  );
	}
	
}

?>