<?php

class PeThemeConstantGmap {
	public $metabox;

	public function __construct() {
		$this->metabox = 
			array(
				  "title" =>__("Google Map",'nietzsche'),
				  "where" => 
				  array(
						"page" => "page-contact",
						),
				  "content"=>
				  array(
						"show" =>
						array(
							  "label"=>__("Show Google Map",'nietzsche'),
							  "type"=>"RadioUI",
							  "description" => __("Specify whether or not to show the Google map",'nietzsche'),
							  "options" => PeGlobal::$const->data->yesno,
							  "default"=>"yes"
							  ),
						"latitude" => 	
						array(
							  "label"=>__("Latitude",'nietzsche'),
							  "type"=>"Text",
							  "description" => __("Latitudinal location for the map center. See the help documentation for a link to a utility used to convert addresses into lat/long numbers",'nietzsche'),
							  "default"=>'51.50813'
							  ),
						"longitude" => 	
						array(
							  "label"=>__("Longitude",'nietzsche'),
							  "type"=>"Text",
							  "description" => __("Longitudinal location for the map center. See the help documentation for a link to a utility used to convert addresses into lat/long numbers",'nietzsche'),
							  "default"=>'-0.12801'
							  ),
						"zoom" => 	
						array(
							  "label"=>__("Zoom Level",'nietzsche'),
							  "type"=>"Text",
							  "description" => __("Enter the zoom level of the map upon page load. The user is then free to adjust this zoom level using the map UI",'nietzsche'),
							  "default"=>'12'
							  ),
						"title" => 	
						array(
							  "label"=>__("Map Marker Title",'nietzsche'),
							  "type"=>"Text",
							  "description" => __("Enter a title for the map marker flyout",'nietzsche'),
							  "default"=>'Custom title here'
							  ),
						"description" => 	
						array(
							  "label"=>__("Map Marker Description",'nietzsche'),
							  "type"=>"TextArea",
							  "description" => __("Enter a description for the map marker flyout",'nietzsche'),
							  "default"=>'Custom description here'
							  )
						)
				  );
	}
	
}

?>