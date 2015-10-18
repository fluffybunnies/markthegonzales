<?php

class PeThemeConstantProject {
	public $all;
	public $metabox;

	public function __construct() {
		$this->all = $this->all =& peTheme()->project->option();

		$this->metabox = 
			array(
				  "title" =>__("Project",'nietzsche'),
				  "priority" => "core",
				  "type" => "Project",
				  "where" => 
				  array(
						"project" => "all",
						),
				  "content"=>
				  array(
						"subtitle" => 	
						array(
							  "label"=>__("Subtitle",'nietzsche'),
							  "type"=>"Text",
							  "description" => __("Specify a project subtitle. This will be shown on the portfolio single column page as well as the single project pages. ",'nietzsche'),
							  "default"=>'Subtitle here'
							  ),
						"icon" => 	
						array(
							  "label"=>__("Icon",'nietzsche'),
							  "type"=>"Select",
							  "description" => __("Select an icon which represents the contents or theme of this project. This icon will be shown on all portfolio and project pages. ",'nietzsche'),
							  "options" => apply_filters("pe_theme_project_icons",
							  array(
									__("Image",'nietzsche')=>"icon-picture",
									__("Film",'nietzsche')=>"icon-film",
									__("Video",'nietzsche')=>"icon-facetime-video",
									__("Music",'nietzsche')=>"icon-music",
									__("File",'nietzsche')=>"icon-file",
									__("Review",'nietzsche')=>"icon-search",
									__("List",'nietzsche')=>"icon-list",
									__("Thumbnails",'nietzsche')=>"icon-th",
									__("Book",'nietzsche')=>"icon-book",
									__("Photography",'nietzsche')=>"icon-camera",
									__("Typography",'nietzsche')=>"icon-font",
									__("Private",'nietzsche')=>"icon-lock",
									__("Info",'nietzsche')=>"icon-info-sign",
									__("Event",'nietzsche')=>"icon-calendar",
									__("Commentary",'nietzsche')=>"icon-comment",
									__("Announcement",'nietzsche')=>"icon-bullhorn",
									__("Business",'nietzsche')=>"icon-briefcase",
									__("World",'nietzsche')=>"icon-globe",
									__("Location",'nietzsche')=>"icon-map-marker",
									__("Illustration",'nietzsche')=>"icon-pencil",
									__("Person",'nietzsche')=>"icon-user"
									)),
							  "default"=> apply_filters("pe_theme_project_default_icon",'icon-picture')
							  )
						)
				  );

		$layouts = apply_filters("pe_theme_project_layouts",array());
		if (count($layouts) > 0) {
			$this->metabox["content"]["layout"] =
				array(
					  "label"=>__("Layout",'nietzsche'),
					  "type"=>"Select",
					  "description" => __("Select project layout.",'nietzsche'),
					  "options" => $layouts,
					  "default" =>"right"
					  );
		}

		$this->metaboxFeatured = 
			array(
				  "title" =>__("Featured Project",'nietzsche'),
				  "priority" => "core",
				  "where" => 
				  array(
						"page" => "page-portfolio",
						),
				  "content"=>
				  array(
						"featured" => 
						array(
							  "label"=>__("Project",'nietzsche'),
							  "type"=>"Select",
							  "description" => __("Select the project you wish to be featured. (Shown full width at top of page)",'nietzsche'),
							  "options" =>
							  array_merge(
										  array(__("None",'nietzsche') => ""),
										  $this->all
										  ),
							  "default"=>""
							  )
						)
				  );

	}
	
}

?>