<?php

class PeThemeViewLayoutModuleGmap extends PeThemeViewLayoutModule {

	public function name() {
		return __("Google Map",'nietzsche');
	}

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Google Map",'nietzsche')
				  );
	}

	public function fields() {
		return
			array(
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
						),
				  "layout" =>
				  array(
						"label"=>__("Layout",'nietzsche'),
						"description" => __("Map container layout.",'nietzsche'),
						"type"=>"RadioUI",
						"options" => 
						array(
							  __("Boxed",'nietzsche')=>"boxed",
							  __("Full Width",'nietzsche') => "fullwidth"
							  ),
						"default"=>"boxed"
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
						)
				  );
		
	}

	public function blockClass() {
		return empty($this->data->layout) || $this->data->layout != "fullwidth" ? "" : "pe-escape-container";
	}


	public function template() {
		peTheme()->get_template_part("viewmodule","gmap");
	}

	public function tooltip() {
		return __("Use this block to add a Google Maps module to your layout. Woth this module you may specify the lattitude, longitude and zoom level of the displayed map.",'nietzsche');
	}


}

?>
