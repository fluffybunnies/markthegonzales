<?php

class PeThemeWidgetStats extends PeThemeWidget {

	public function __construct() {
		$this->name = __("Pixelentity - Stats",'nietzsche');
		$this->description = __("Statistical informations and links",'nietzsche');

		$defStats = <<<EOL
<a href="#">8,350<span>RSS</span></a>
<a href="#">4,170<span>Followers</span></a>
<a href="#" class="last">250<span>Articles</span></a>
EOL;

		$defLinks = <<<EOL
<a href="#">Link 1</a>
<a href="#">Link 2</a>
<a href="#">Link 3</a>
EOL;

$this->fields = array(
							  "logo" => 
							  array(
									"label"=>__("Logo/Image",'nietzsche'),
									"type"=>"Upload",
									"section"=>__("General",'nietzsche'),
									"description" => __("Logo/Image to be used as the widget title",'nietzsche'),
									"default"=> PE_THEME_URL."/img/skin/logo.png"
									),
							  "stats" => 
							  array(
									"label"=>__("Statistics",'nietzsche'),
									"type"=>"TextArea",
									"description" => __("Numeric Stats",'nietzsche'),
									"default"=>$defStats
									),
							  "links" => 
							  array(
									"label"=>__("Links",'nietzsche'),
									"type"=>"TextArea",
									"description" => __("Additional links",'nietzsche'),
									"default"=>$defLinks
									)
							  
							  );

		parent::__construct();
	}

	public function &getContent(&$instance) {
		extract($instance);
		$html = '<a href="'.home_url().'" class="logo-foot" title="Home"><img src="'.$logo.'" alt="mentor logo" /></a>';

		if (isset($stats)) {
			$html .= '<div class="widget widget_stats">'.$stats.'</div>';
		}

		if (isset($links)) {
			$html .= '<div class="widget widget_links"><ul>';
			$links = explode("\n",$links);
			foreach ($links as $link) {
				if (!$link) continue;
				$html .= '<li>'.$link.'<span>&rarr;</span></li>';
			}
			$html .= "</ul></div>";
		}

		return $html;
	}


}
?>
