<?php

class PeThemeNietzsche extends PeThemeController {

	public $preview = array();

	public function __construct() {

		// custom post types
		add_action("pe_theme_custom_post_type",array(&$this,"pe_theme_custom_post_type"));

		// wp_head stuff
		add_action("pe_theme_wp_head",array(&$this,"pe_theme_wp_head"));

		// google fonts
		add_filter("pe_theme_font_variants",array(&$this,"pe_theme_font_variants_filter"),10,2);

		// comment submit button class
		add_filter("pe_theme_comment_submit_class",array(&$this,"pe_theme_comment_submit_class_filter"));

		// use prio 30 so gets executed after standard theme filter
		add_filter("the_content_more_link",array(&$this,"the_content_more_link_filter"),30);

		// portfolio
		add_filter( 'pe_theme_filter_item', array( $this, 'pe_theme_project_filter_item_filter' ), 10, 4 );

		// custom theme options js
		add_action( 'admin_enqueue_scripts', array( $this, 'pe_theme_nietzsche_custom_theme_options_js' ) );

		// builder
		add_filter('pe_theme_view_layout_open',array(&$this,'pe_theme_view_layout_no_parent'));
		add_filter('pe_theme_view_layout_close',array(&$this,'pe_theme_view_layout_no_parent'));
		add_filter('pe_theme_layoutmodule_open',array(&$this,'pe_theme_view_layout_no_parent'));
		add_filter('pe_theme_layoutmodule_close',array(&$this,'pe_theme_view_layout_no_parent'));
		add_filter('pe_theme_view_layout_common_fields',array(&$this,'pe_theme_view_layout_common_fields_filter'));

		// custom builder modules in projects
		add_filter('pe_theme_project_builder_modules',array(&$this,'pe_theme_project_builder_modules_filter'));

		// read more link
		add_filter( 'the_content_more_link', array( $this, 'modify_read_more_link' ), 999 );

		// change skin
		add_filter( 'body_class', array( $this, 'pe_theme_skin_mode' ) );

		// read more link
		add_filter( 'the_content_more_link', array( $this, 'modify_read_more_link' ), 999 );

		// change avatar size in comments
		add_filter( 'pe_theme_comments_default_avatar_size', array( $this, 'modify_default_comments_avatar_size' ) );

		// add footer sidebar manually (for greater markup control)
		add_action( 'widgets_init', array( $this, 'pe_theme_footer_widget' ) );

		if ( ! function_exists( '_wp_render_title_tag' ) ) {

			add_filter( 'wp_title', array( $this, 'wp_title_filter' ), 10, 2 );
			add_action( 'wp_head', array( $this, 'pe_theme_render_title' ) );

		}

		add_theme_support( 'title-tag' );

		// Nietzsche slider image js fix
		add_filter( 'pe_theme_resized_img', array( $this, 'nietzsche_add_data_src' ), 10, 2 );

		new PeThemeNietzscheIcons();

	}

	public function pe_theme_view_layout_common_fields_filter($values) {
		return PeThemeViewLayoutModuleCommon::fields();
	}

	public function pe_theme_render_title() {

		?>

		<title><?php wp_title( '|', true, 'right' ); ?></title>

		<?php

	}

	public function wp_title_filter( $title, $sep ) {

		global $page, $paged;

		$title .= get_bloginfo( 'name' );

		if (( is_home() || is_front_page() ) ) {
			$description = get_bloginfo('description','display');
			if ($description) {
				$title .= " | ".$description;
			}
		}

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 ) {
			$title .= " | ".sprintf(__('Page %s','nietzsche'),max($paged,$page));
		}

		return $title;	

	}

	public function pe_theme_footer_widget() {

		register_sidebar( array(
			'name'          => 'Footer Sidebar',
			'id'            => 'footer-sidebar',
			'before_widget' => '<div id="%1$s" class="%2$s footer-widget color-on-dark">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="footer-title color-on-dark">',
			'after_title'   => '</h3>',
		) );

	}

	public function modify_read_more_link( $read_more ) {

		return str_replace( __( 'Continue Reading...' ,'nietzsche'), __( 'Read More' ,'nietzsche'), $read_more );

	}

	public function nietzsche_add_data_src( $src, $url ) {

		return str_replace( 'src=', 'data-src="' . $url . '" src=', $src );

	}

	public function pe_theme_skin_mode( $classes ) {

		$skin_type = $this->options->get( 'skin' );

		if ( ! $skin_type ) {

			$skin_type = 'edge';

		}

		$skin_type = ( ( is_page() || is_singular( 'project' ) ) && ! empty( $this->content->meta()->skin->skin ) && 'global' !== $this->content->meta()->skin->skin ) ? $this->content->meta()->skin->skin  : $skin_type;

		$classes[] = 'pe-skin';
		$classes[] = 'skin-' . $skin_type;

		return $classes;

	}

	public function modify_default_comments_avatar_size( $size ) {

        $size = 90;

        return $size;

    }

	public function pe_theme_view_layout_no_parent( $markup ) {
		return "";
	}

	public function pe_theme_nietzsche_custom_theme_options_js( $hook ) {

		if ( 'appearance_page_pe_theme_options' !== $hook ) {

			// we only need our script on Theme Options page
			return;

		}

		PeThemeAsset::addScript( 'js/theme-options-conditionals.js' ,array( 'jquery' ), 'pe_theme_nietzsche_custom_theme_options_js' );
		wp_enqueue_script( 'pe_theme_nietzsche_custom_theme_options_js' );

	}

	public function the_content_more_link_filter( $link ) {
		return sprintf( '<div class="clearfix mt20"><div class="pull-left"><a class="read-more-link blog-post-more" href="%s">%s</a></div></div>', get_permalink(), __( 'Continue Reading...' ,'nietzsche') );
	}

	public function pe_theme_project_filter_item_filter( $html, $aclass, $slug, $name ) {

		$template = '<li><a href="#" class="%s" data-filter="%s">%s</a></li>';

		return sprintf( $template, ( '' === $slug ) ? 'active' : '', ( '' === $slug ) ? '*' : ".filter-$slug", ( '' === $slug ) ? __( 'All' ,'nietzsche') : $name );
	
	}

	public function pe_theme_wp_head() {
		$this->font->apply();
		$this->color->apply();

		// custom CSS field
		if ($customCSS = $this->options->get("customCSS")) {
			printf('<style type="text/css">%s</style>',stripslashes($customCSS));
		}

		// custom JS field
		if ($customJS = $this->options->get("customJS")) {
			printf('<script type="text/javascript">%s</script>',stripslashes($customJS));
		}

	}

	public function pe_theme_font_variants_filter( $variants, $font ) {

		$variants="$font:400,300,700,400italic,700italic,300italic";

		return $variants;

	}

	public function pe_theme_menu_custom_fields_filter( $options, $depth = false, $item = false ) {

		if ( ! empty( $item->object ) && $item->object != "page" ) {

			// if menu item is not a page, no custom option
			return $options;

		}
		
		$options = array(
			"name" => array(
				"label"       => __( "Section" ,'nietzsche'),
				"type"        => "Text",
				"description" => __( "Optional section link name." ,'nietzsche'),
				"default"     => "",
			)
		);

		return $options;

	}

	public function pe_theme_comment_submit_class_filter() {
		return "contour-btn red";
	}

	public function init() {
		parent::init();

		if (PE_THEME_PLUGIN_MODE) {
			return;
		}
		
		if ($this->options->get("retina") === "yes") {
			add_filter("pe_theme_resized_img",array(&$this,"pe_theme_resized_retina_filter"),10,5);
		} else if ($this->options->get("lazyImages") === "yes") {
			add_filter("pe_theme_resized_img",array(&$this,"pe_theme_resized_img_filter"),10,4);
		}
	}

	public function pe_theme_custom_post_type() {
		if (defined('PIXELENTITY_PLUGIN_PORTFOLIO')) {
			$this->project->load();
		}
	}

	public function boot() {
		parent::boot();

		require_once(get_template_directory()."/framework/php/lib/pixelentity-theme-bundled-plugins/class-pixelentity-theme-bundled-plugins.php");
		
		PeGlobal::$config["content-width"] = 990;
		PeGlobal::$config["post-formats"] = array("video","gallery");
		PeGlobal::$config["post-formats-project"] = array("video","gallery");

		PeGlobal::$config["image-sizes"]["thumbnail"] = array(120,90,true);
		PeGlobal::$config["image-sizes"]["post-thumbnail"] = array(260,200,false);

		PeGlobal::$config["nav-menus"]["side"] = __("Side menu",'nietzsche');
		

		// blog layouts
		PeGlobal::$config["blog"] = array(
			__("Default",'nietzsche')   => "",
			__("Search",'nietzsche')    => "search",
			__("Alternate",'nietzsche') => "project",
		);

		PeGlobal::$config["views"] = array(
			'LayoutModuleNietzscheBlog',
			'LayoutModuleNietzscheBlogGrid',
			'LayoutModuleNietzscheColumns',
			'LayoutModuleNietzscheContact',
			'LayoutModuleNietzscheContactDetails',
			'LayoutModuleNietzscheContactForm',
			'LayoutModuleNietzscheGoogleMap',
			'LayoutModuleNietzscheGoogleMapLocation',
			'LayoutModuleNietzscheHero',
			'LayoutModuleNietzscheIntro',
			'LayoutModuleNietzscheLogo',
			'LayoutModuleNietzscheLogos',
			'LayoutModuleNietzscheMediaGrid',
			'LayoutModuleNietzscheMediaGridAudio',
			'LayoutModuleNietzscheMediaGridCaption',
			'LayoutModuleNietzscheMediaGridImage',
			'LayoutModuleNietzscheMediaGridLightboxGallery',
			'LayoutModuleNietzscheMediaGridLightboxGalleryCaption',
			'LayoutModuleNietzscheMediaGridLightboxGalleryImage',
			'LayoutModuleNietzscheMediaGridSlider',
			'LayoutModuleNietzscheMediaGridSliderSlide',
			'LayoutModuleNietzscheMediaGridVideo',
			'LayoutModuleNietzscheProjectDetails',
			'LayoutModuleNietzscheProjectDetailsQuote',
			'LayoutModuleNietzscheProjectDetailsText',
			'LayoutModuleNietzscheProjectsGrid',
			'LayoutModuleNietzscheService',
			'LayoutModuleNietzscheServices',
			'LayoutModuleNietzscheSplash',
			'LayoutModuleNietzscheSplashImage',
			'LayoutModuleNietzscheSplashImageCaption',
			'LayoutModuleNietzscheSplashImageVideo',
			'LayoutModuleNietzscheSplashParallax',
			'LayoutModuleNietzscheSplashParallaxSlide',
			'LayoutModuleNietzscheSplashSlider',
			'LayoutModuleNietzscheSplashSliderSlide',
			'LayoutModuleNietzscheSplashSliderSlideCaption',
			'LayoutModuleNietzscheSplashSliderSlideLightbox',
			'LayoutModuleNietzscheStat',
			'LayoutModuleNietzscheStats',
			'LayoutModuleNietzscheTeam',
			'LayoutModuleNietzscheTeamMember',
			'LayoutModuleNietzscheTestimonial',
			'LayoutModuleNietzscheTestimonialsSlider',
			'LayoutModuleNietzscheTestimonialsSliderTestimonial',
			'LayoutModuleNietzscheText',
		);

		PeGlobal::$config["sidebars"] = array(
			"default" => __( 'Default post/page' ,'nietzsche'),
			"project" => __( 'Projects' ,'nietzsche'),
		);

		PeGlobal::$config['colors'] = array(
			'color1' => array(
				'label'     => __( 'Minimal Main Color' ,'nietzsche'),
				'selectors' => array(
					'.skin-minimal a:hover' => 'color',
					'.skin-minimal p a:hover' => 'color',
					'.skin-minimal .box a:not(.button):hover' => 'color',
					'.skin-minimal h1 a:hover' => 'color',
					'.skin-minimal h2 a:hover' => 'color',
					'.skin-minimal h3 a:hover' => 'color',
					'.skin-minimal h4 a:hover' => 'color',
					'.skin-minimal h5 a:hover' => 'color',
					'.skin-minimal h6 a:hover' => 'color',
					'.skin-minimal .color-yellow-light' => 'color',
					'.skin-minimal .pagination-2 [style] a:hover' => 'color',
					'.skin-minimal .masonry-set-dimensions .post-media:hover .post-content h2 a' => 'color',

					'.skin-minimal .bkg-yellow-light' => 'border-color',
					'.skin-minimal .form-element.required-field' => 'border-color',
					'.skin-minimal textarea.required-field' => 'border-color',
					'.skin-minimal .fullscreen-section .form-element.required-field' => 'border-color',
					'.skin-minimal .fullscreen-section textarea.required-field' => 'border-color',

					'.skin-minimal  .bkg-yellow-light' => 'background-color',
					'.skin-minimal .team-slider-grid' => 'background-color',
					'.skin-minimal .hero-5-contact > .row:before' => 'background-color',
				),
				'default' => '#fdeb74',
			),
			'color2' => array(
				'label'     => __( 'Edge Main Color' ,'nietzsche'),
				'selectors' => array(
					'.skin-edge a' => 'color',
					'.skin-edge p a' => 'color',
					'.skin-edge .box a:not(.button)' => 'color',
					'.skin-edge h1 a:hover' => 'color',
					'.skin-edge h2 a:hover' => 'color',
					'.skin-edge h3 a:hover' => 'color',
					'.skin-edge h4 a:hover' => 'color',
					'.skin-edge h5 a:hover' => 'color',
					'.skin-edge h6 a:hover' => 'color',
					
					'.skin-edge .form-element.required-field' => 'border-color',
					'.skin-edge textarea.required-field' => 'border-color',
					'.skin-edge .fullscreen-section .form-element.required-field' => 'border-color',
					'.skin-edge .fullscreen-section textarea.required-field' => 'border-color',
				),
				'default' => '#bb9b69',
			),
			'background_color' => array(
				'label'     => __( 'Body background' ,'nietzsche'),
				'selectors' => array(
					'#builder-page' => 'background-color',
					'body'          => 'background-color',
				),
				'default' => '#fff',
			),
		);
		

		PeGlobal::$config['fonts'] = array(
			'edgeGeneral' => array(
				'label'     => __( 'Edge General' ,'nietzsche'),
				'selectors' => array(
					'.skin-edge',
					'.skin-edge h1',
					'.skin-edge h2',
					'.skin-edge h3',
					'.skin-edge h4',
					'.skin-edge h5',
					'.skin-edge h6',
					'.skin-edge .navigation ul li a',
					'.skin-edge .overlay-navigation ul li a',
				),
				'default' => 'Lato',
			),
			'edgeAlternative' => array(
				'label'     => __( 'Edge Alternative' ,'nietzsche'),
				'selectors' => array(
					'skin-edge .font-alt-2',
				),
				'default' => 'Crimson Text',
			),
			'minimalGeneral' => array(
				'label'     => __( 'Minimal General' ,'nietzsche'),
				'selectors' => array(
					'.skin-minimal',
					'.skin-minimal h1',
					'.skin-minimal h2',
					'.skin-minimal h3',
					'.skin-minimal h4',
					'.skin-minimal h5',
					'.skin-minimal h6',
					'.skin-minimal .navigation ul li a',
					'.skin-minimal .side-navigation ul li a',
				),
				'default' => 'Lato',
			),
			'minimalAlternative' => array(
				'label'     => __( 'Minimal Alternative' ,'nietzsche'),
				'selectors' => array(
					'.skin-minimal .lead',
					'.skin-minimal .project-description',
					'.skin-minimal .project-details',
					'.skin-minimal [class*="pagination-"] small',
					'.skin-minimal .post-info',
					'.skin-minimal .single-post-tags',
					'.skin-minimal .team-3 h6.occupation',
					'.skin-minimal .team-4 h6.occupation',
					'.skin-minimal .stats-2 .description',
					'.skin-minimal .copyright',
					'.skin-minimal .side-navigation-footer',
					'.skin-minimal .comment-meta',
					'.skin-minimal .sidebar a',
					'.skin-minimal cite',
					'.skin-minimal .font-alt-2',
				),
				'default' => 'Lekton',
			),
		);

		$tdir = get_template_directory_uri();
		
		PixelentityThemeBundledPlugins::init(
			array(
				array(
					"slug" => "pixelentity-portfolio",
					"name" => __("Pixelentity Portfolio",'nietzsche'),
					"version" => "1.0.0",
					"download_link" => "$tdir/wp-plugins/pixelentity-portfolio.1.0.0.zip",
				),
			)
		);
				
		$options = array();
		$options = array_merge(
			$options,
			array(
				"plugins" => array(
					"label"=>__("Required Plugins",'nietzsche'),
					"type"=>"Plugins",
					"section"=>__("General",'nietzsche'),
					"description" => __("Plugin installation isn't mandatory but some theme features won't be available without them.<br/><br/>To take full advantage of all theme features, please make sure all plugins are installed and activated by clicking the button.",'nietzsche')
				),				  
				"import_demo" => $this->defaultOptions["import_demo"],
				'skin' => array(
					'label'       => __( 'Skin' ,'nietzsche'),
					'type'        => 'RadioUI',
					'options'     => array(
						__( 'Edge' ,'nietzsche')    => 'edge',
						__( 'Minimal' ,'nietzsche') => 'minimal',
					),
					'default' => 'edge',
					'section' => __( 'General' ,'nietzsche'),
				),
				"logo" => array(
					"label"       => __("Logo",'nietzsche'),
					"type"        => "Upload",
					"section"     => __("General",'nietzsche'),
					"description" => __("This is the main site logo image. The image should be a .png file.",'nietzsche'),
					"default"     => '',
				),
				"siteTitle" => array(
					"wpml"        => true,
					"label"       => __("Header Title",'nietzsche'),
					"type"        => "Text",
					"section"     => __("General",'nietzsche'),
					"description" => __("Used if logo is left empty.",'nietzsche'),
					"default"     => "Nietzsche",
				),
				"favicon" => array(
					"label"       => __("Favicon",'nietzsche'),
					"type"        => "Upload",
					"section"     => __("General",'nietzsche'),
					"description" => __("This is the favicon for your site. The image can be a .jpg, .ico or .png with dimensions of 16x16px ",'nietzsche'),
					"default"     => PE_THEME_URL."/images/favicon.ico",
				),
				"customCSS" => $this->defaultOptions["customCSS"],
				"customJS"  => $this->defaultOptions["customJS"],
				"colors"    => array(
					"label"       => __("Custom Colors",'nietzsche'),
					"type"        => "Help",
					"section"     => __("Colors",'nietzsche'),
					"description" => __("In this page you can set alternative colors for the main colored elements in this theme. One color options has been provided. To change the color used on these elements simply write a new hex color reference number into the fields below or use the color picker which appears when each field obtains focus. Once you have selected your desired colors make sure to save them by clicking the <b>Save All Changes</b> button at the bottom of the page. Then just refresh your page to see the changes.<br/><br/><b>Please Note:</b> Some of the elements in this theme are made from images (Eg. Icons) and these items may have a color. It is not possible to change these elements via this page, instead such elements will need to be changed manually by opening the images/icons in an image editing program and manually changing their colors to match your theme's custom color scheme. <br/><br/>To return all colors to their default values at any time just hit the <b>Restore Default</b> link beneath each field.",'nietzsche'),
				),
				"googleFonts" => array(
					"label"       => __("Custom Fonts",'nietzsche'),
					"type"        => "Help",
					"section"     => __("Fonts",'nietzsche'),
					"description" => __("In this page you can set the typefaces to be used throughout the theme. For each elements listed below you can choose any front from the Google Web Font library. Once you have chosen a font from the list, you will see a preview of this font immediately beneath the list box. The icons on the right hand side of the font preview, indicate what weights are available for that typeface.<br/><br/><strong>R</strong> -- Regular,<br/><strong>B</strong> -- Bold,<br/><strong>I</strong> -- Italics,<br/><strong>BI</strong> -- Bold Italics<br/><br/>When decideing what font to use, ensure that the chosen font contains the font weight required by the element. For example, main headings are bold, so you need to select a new font for these elements which supports a bold font weight. If you select a font which does not have a bold icon, the font will not be applied. <br/><br/>Browse the online <a href='http://www.google.com/webfonts'>Google Font Library</a><br/><br/><b>Custom fonts</b> (Advanced Users):<br/> Other then those available from Google fonts, custom fonts may also be applied to the elements listed below. To do this an additional field is provided below the google fonts list. Here you may enter the details of a font family, size, line-height etc. for a custom font. This information is entered in the form of the shorthand 'font:' CSS declaration, for example:<br/><br/><b>bold italic small-caps 1em/1.5em arial,sans-serif</b><br/><br/>If a font is specified in this field then the font listed in the Google font drop menu above will not be applied to the element in question. If you wish to use the Google font specified in the drop down list and just specify a new font size or line height, you can do so in this field also, however the name of the Google font <b>MUST</b> also be entered into this field. You may need to visit the Google fonts web page to find the exact CSS name for the font you have chosen.",'nietzsche'),
				),
				'contactEmail' => $this->defaultOptions['contactEmail'],
				'contactSubject' => $this->defaultOptions['contactSubject'],
				'header_type' => array(
					'label'       => __( 'Header type' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => array(
						__( 'Top' ,'nietzsche')                  => 'top',
						__( 'Top - large' ,'nietzsche')          => 'top-large',
						__( 'Top - transparent' ,'nietzsche')    => 'top-transparent',
						__( 'Bottom - transparent' ,'nietzsche') => 'bottom-transparent',
					),
					'default' => 'top',
					'section' => __( 'Header' ,'nietzsche'),
				),
				'alternative_logo' => array(
					'label'       => __( 'Alternative logo' ,'nietzsche'),
					'type'        => 'Upload',
					'description'  => __( 'This logo will be displayed when header goes from transparent state to fully opaque state.' ,'nietzsche'),
					'default'     => '',
					'section' => __( 'Header' ,'nietzsche'),
				),
				'menu_type' => array(
					'label'       => __( 'Menu type' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => array(
						__( 'Overlay' ,'nietzsche')          => 'overlay',
						__( 'Slide in - left' ,'nietzsche')  => 'slide-left',
						__( 'Slide in - right' ,'nietzsche') => 'slide-right',
					),
					'default' => 'Overlay',
					'section' => __( 'Header' ,'nietzsche'),
				),
				'menu_bg' => array(
					'label'       => __( 'Menu background' ,'nietzsche'),
					'type'        => 'Upload',
					'default'     => '',
					'section' => __( 'Header' ,'nietzsche'),
				),
				'menu_logo' => array(
					'label'       => __( 'Menu logo' ,'nietzsche'),
					'type'        => 'Upload',
					'default'     => '',
					'section' => __( 'Header' ,'nietzsche'),
				),
				'menu_icons' => array(
					'label'       => __( 'Header icons' ,'nietzsche'),
					'type'         => 'Items',
					'description'  => __( 'Add one or more icon to the top menu bar.' ,'nietzsche'),
					'button_label' => __( 'Add Icon' ,'nietzsche'),
					'sortable'     => true,
					'auto'         => 'icon-facebook',
					'unique'       => false,
					'editable'     => false,
					'legend'       => false,
					'fields'       => 
					array(
						array(
							'label'   => 'Icon',
							'name'    => 'icon',
							'type'    => 'icon',
							'width'   => 200, 
							'default' => '',
						),
						array(
							'label'   => 'Url',
							'name'    => 'url',
							'type'    => 'text',
							'width'   => 300, 
							'default' => '#',
						),
					),
					'section' => __( 'Header' ,'nietzsche'),
				),
				'menu_copyright' => array(
					'label'       => __( 'Menu copyright' ,'nietzsche'),
					'type'        => 'Text',
					'default' => '&copy; 2015 Nietzsche All Rights Reserved.',
					'section' => __( 'Header' ,'nietzsche'),
				),
				'footer_bg' => array(
					'label'   => __( 'Footer background color' ,'nietzsche'),
					'type'    => 'Color',
					'default' => '#222',
					'section' => __( 'Footer' ,'nietzsche'),
				),
				'footer_logo' => array(
					'label'   => __( 'Footer logo' ,'nietzsche'),
					'type'    => 'Upload',
					'default' => '',
					'section' => __( 'Footer' ,'nietzsche'),
				),
				'footer_text_1' => array(
					'label'       => __( 'Footer text #1' ,'nietzsche'),
					'type'        => 'TextArea',
					'default' => 'Nietzsche is a solid, well designed and unique template for agencies or inviduals looking to put their work forward in a professional and coherent manner. Built on our own solid framework, it comes with a range of prestyled modules and content blocks, several in-hosue developed plugins such as sliders, parallax sections, counters and much much more.',
					'section' => __( 'Footer' ,'nietzsche'),
				),
				'footer_text_2' => array(
					'label'       => __( 'Footer text #2' ,'nietzsche'),
					'type'        => 'TextArea',
					'default' => '<h3>Main Headquarters</h3>'
					           . '<address>126-130 Crosby Street, Soho<br>New York City, NY 10012, U.S.<br>Tel: +1 212-249-2390<br>Email: <a href="mailto:#">info@nietzsche.com</a></address>',
					'section' => __( 'Footer' ,'nietzsche'),
				),
				'footer_text_3' => array(
					'label'       => __( 'Footer text #3' ,'nietzsche'),
					'type'        => 'TextArea',
					'default' => '<h3>LOS ANGELES</h3>'
					           . '<address>1823 Monroe Street No. 107<br>Santa Monica, CA 90404, U.S.<br>Tel: +1 404-610-4576<br>Email: <a href="mailto:#">info@nietzschela.com</a></address>',
					'section' => __( 'Footer' ,'nietzsche'),
				),
				'footer_copyright' => array(
					"label"       => __( 'Copyright' ,'nietzsche'),
					"wpml"        =>  true,
					"type"        => 'TextArea',
					"section"     => __( 'Footer' ,'nietzsche'),
					"description" => __( 'This is the footer copyright message displayed on the bottom of the left side of the footer area.' ,'nietzsche'),
					"default"     => '&copy; 2015 Nietzsche All Rights Reserved.',
				),
				'footer_links' => array(
					'label'       => __( 'Footer links' ,'nietzsche'),
					'type'         => 'Items',
					'description'  => __( 'Add one or more links to the footer.' ,'nietzsche'),
					'button_label' => __( 'Add Link' ,'nietzsche'),
					'sortable'     => true,
					'auto'         => '#',
					'unique'       => false,
					'editable'     => false,
					'legend'       => false,
					'fields'       => 
					array(
						array(
							'label'   => 'Url',
							'name'    => 'url',
							'type'    => 'text',
							'width'   => 220, 
							'default' => '#',
						),
						array(
							'label'   => 'Description',
							'name'    => 'description',
							'type'    => 'text',
							'width'   => 300, 
							'default' => 'Home',
						),
					),
					'section' => __( 'Footer' ,'nietzsche'),
				),
			)
		);

		// we don't need the favicon option in WP > 4.3
		if ( function_exists( 'wp_site_icon' ) ) {

			unset( $options['favicon'] );

		}

		foreach( PeGlobal::$const->gmap->metabox["content"] as $key => $value ) {

			PeGlobal::$const->gmap->metabox["content"][ $key ]["section"] = __("Footer",'nietzsche');

		}

		unset( PeGlobal::$const->gmap->metabox["content"]["title"] );
		unset( PeGlobal::$const->gmap->metabox["content"]["description"] );
		
		//$options = array_merge($options, PeGlobal::$const->gmap->metabox["content"]);

		$options = array_merge($options,$this->font->options());
		$options = array_merge($options,$this->color->options());

		//$options["retina"] =& $this->defaultOptions["retina"];
		//$options["lazyImages"] =& $this->defaultOptions["lazyImages"];
		$options["minifyJS"] =& $this->defaultOptions["minifyJS"];
		$options["minifyCSS"] =& $this->defaultOptions["minifyCSS"];

		$options["minifyJS"]['default'] = 'yes';

		$options["adminThumbs"] =& $this->defaultOptions["adminThumbs"];
		if (!empty($this->defaultOptions["mediaQuick"])) {
			$options["mediaQuick"] =& $this->defaultOptions["mediaQuick"];
			$options["mediaQuickDefault"] =& $this->defaultOptions["mediaQuickDefault"];
		}

		$options["adminLogo"] =& $this->defaultOptions["adminLogo"];
		$options["adminUrl"] =& $this->defaultOptions["adminUrl"];

		
		
		PeGlobal::$config["options"] = apply_filters("pe_theme_options",$options);

	}

	public function pe_theme_metabox_config_page() {
		parent::pe_theme_metabox_config_page();

		$builder = isset(PeGlobal::$config["metaboxes-page"]["builder"]) ? PeGlobal::$config["metaboxes-page"]["builder"] : false;
		$builder = $builder ? array("builder"=> $builder) : array();

		$created_menus = get_terms( 'nav_menu' );
		$menu_choices = array(
			__( 'None' ,'nietzsche') => '',
		);

		if ( ! empty( $created_menus ) && is_array( $created_menus ) ) {

			foreach ( $created_menus as $menu ) {

				$menu_choices[ $menu->name ] = $menu->slug;
	
			}

		}

		$header = array(
			'type'     => 'Conditional',
			'title'    => __( 'Header' ,'nietzsche'),
			'priority' => 'core',
			'options'  => array(
				'menu_type' => array(
					'overlay' => array(
						'hide' => 'menu_icons,menu_logo,menu_bg',
					),
					'slide-left' => array(
						'show' => 'menu_icons,menu_logo,menu_bg',
					),
					'slide-right' => array(
						'show' => 'menu_icons,menu_logo,menu_bg',
					),
				),
				'header_type' => array(
					'global' => array(
						'hide' => 'menu_type,menu_logo,menu_icons,menu_copyright,menu_bg,alternative_logo',
					),
					'top' => array(
						'show' => 'menu_type,menu_copyright',
					),
					'top-large' => array(
						'show' => 'menu_type,menu_copyright',
					),
					'top-transparent' => array(
						'show' => 'menu_type,menu_copyright,alternative_logo',
					),
					'bottom-transparent' => array(
						'show' => 'menu_type,menu_copyright,alternative_logo',
					),
				),
			),
			'where'    => array(
				'post' => 'all',
			),
			'content' => array(
				'logo' => array(
					'label'       => __( 'Logo' ,'nietzsche'),
					'type'        => 'Upload',
					'description'  => __( 'If set, it will overwrite the logo defined in Theme Options -> General.' ,'nietzsche'),
					'default'     => '',
				),
				'header_type' => array(
					'label'       => __( 'Header type' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => array(
						__( 'Global' ,'nietzsche')               => 'global',
						__( 'Top' ,'nietzsche')                  => 'top',
						__( 'Top - large' ,'nietzsche')          => 'top-large',
						__( 'Top - transparent' ,'nietzsche')    => 'top-transparent',
						__( 'Bottom - transparent' ,'nietzsche') => 'bottom-transparent',
					),
					'default' => 'default',
				),
				'alternative_logo' => array(
					'label'       => __( 'Alternative logo' ,'nietzsche'),
					'type'        => 'Upload',
					'description'  => __( 'This logo will be displayed when header goes from transparent state to fully opaque state.' ,'nietzsche'),
					'default'     => '',
				),
				'menu_type' => array(
					'label'       => __( 'Menu type' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => array(
						__( 'Overlay' ,'nietzsche')          => 'overlay',
						__( 'Slide in - left' ,'nietzsche')  => 'slide-left',
						__( 'Slide in - right' ,'nietzsche') => 'slide-right',
					),
					'default' => 'Overlay',
				),
				'menu_bg' => array(
					'label'       => __( 'Menu background' ,'nietzsche'),
					'type'        => 'Upload',
					'default'     => '',
				),
				'menu_logo' => array(
					'label'       => __( 'Menu logo' ,'nietzsche'),
					'type'        => 'Upload',
					'default'     => '',
				),
				'menu_icons' => array(
					'label'       => __( 'Header icons' ,'nietzsche'),
					'type'         => 'Items',
					'description'  => __( 'Add one or more icon to the top menu bar.' ,'nietzsche'),
					'button_label' => __( 'Add Icon' ,'nietzsche'),
					'sortable'     => true,
					'auto'         => 'icon-facebook',
					'unique'       => false,
					'editable'     => false,
					'legend'       => false,
					'fields'       => 
					array(
						array(
							'label'   => 'Icon',
							'name'    => 'icon',
							'type'    => 'icon',
							'width'   => 200, 
							'default' => 'icon-facebook',
						),
						array(
							'label'   => 'Url',
							'name'    => 'url',
							'type'    => 'text',
							'width'   => 300, 
							'default' => '#',
						),
					),
				),
				'menu_copyright' => array(
					'label'       => __( 'Menu copyright' ,'nietzsche'),
					'type'        => 'Text',
					'default' => '&copy; 2015 Nietzsche All Rights Reserved.',
				),
				'custom_menu' => array(
					'label'       => __( 'Custom Main menu' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => $menu_choices,
					'description' => __( 'If you want to display custom Main menu on this page, please select one of the menus on this list.' ,'nietzsche'),
					'default'     => '',
				),
				'custom_side_menu' => array(
					'label'       => __( 'Custom Side menu' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => $menu_choices,
					'description' => __( 'If you want to display custom Side menu on this page, please select one of the menus on this list.' ,'nietzsche'),
					'default'     => '',
				),
			),
			'context' => 'side',
		);

		$footer = array(
			'type'     => 'Conditional',
			'title'    => __( 'Footer' ,'nietzsche'),
			'priority' => 'core',
			'options'  => array(
				'footer_type' => array(
					'global' => array(
						'hide' => 'footer_bg,footer_logo,footer_text_1,footer_text_2,footer_text_3,footer_copyright,footer_links',
					),
					'custom' => array(
						'show' => 'footer_bg,footer_logo,footer_text_1,footer_text_2,footer_text_3,footer_copyright,footer_links',
					),
				),
			),
			'where'    => array(
				'post' => 'all',
			),
			'content' => array(
				'footer_type' => array(
					'label'       => __( 'Footer type' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => array(
						__( 'Global' ,'nietzsche') => 'global',
						__( 'Custom' ,'nietzsche') => 'custom',
					),
					'default' => 'global',
				),
				'footer_bg' => array(
					'label'   => __( 'Footer background color' ,'nietzsche'),
					'type'    => 'Color',
					'default' => '#222',
				),
				'footer_logo' => array(
					'label'   => __( 'Footer logo' ,'nietzsche'),
					'type'    => 'Upload',
					'default' => '',
				),
				'footer_text_1' => array(
					'label'       => __( 'Footer text #1' ,'nietzsche'),
					'type'        => 'TextArea',
					'default' => 'Nietzsche is a solid, well designed and unique template for agencies or inviduals looking to put their work forward in a professional and coherent manner. Built on our own solid framework, it comes with a range of prestyled modules and content blocks, several in-hosue developed plugins such as sliders, parallax sections, counters and much much more.',
				),
				'footer_text_2' => array(
					'label'       => __( 'Footer text #2' ,'nietzsche'),
					'type'        => 'TextArea',
					'default' => '<h3>Main Headquarters</h3>'
					           . '<address>126-130 Crosby Street, Soho<br>New York City, NY 10012, U.S.<br>Tel: +1 212-249-2390<br>Email: <a href="mailto:#">info@nietzsche.com</a></address>',
				),
				'footer_text_3' => array(
					'label'       => __( 'Footer text #3' ,'nietzsche'),
					'type'        => 'TextArea',
					'default' => '<h3>LOS ANGELES</h3>'
					           . '<address>1823 Monroe Street No. 107<br>Santa Monica, CA 90404, U.S.<br>Tel: +1 404-610-4576<br>Email: <a href="mailto:#">info@nietzschela.com</a></address>',
				),
				'footer_copyright' => array(
					'label'       => __( 'Copyright' ,'nietzsche'),
					'type'        => 'TextArea',
					'description' => __( 'This is the footer copyright message displayed on the bottom of the left side of the footer area.' ,'nietzsche'),
					'default'     => '&copy; 2015 Nietzsche All Rights Reserved.',
				),
				'footer_links' => array(
					'label'       => __( 'Footer links' ,'nietzsche'),
					'type'         => 'Items',
					'description'  => __( 'Add one or more links to the footer.' ,'nietzsche'),
					'button_label' => __( 'Add Link' ,'nietzsche'),
					'sortable'     => true,
					'auto'         => '#',
					'unique'       => false,
					'editable'     => false,
					'legend'       => false,
					'fields'       => 
					array(
						array(
							'label'   => 'Url',
							'name'    => 'url',
							'type'    => 'text',
							'width'   => 220, 
							'default' => '#',
						),
						array(
							'label'   => 'Description',
							'name'    => 'description',
							'type'    => 'text',
							'width'   => 300, 
							'default' => 'Home',
						),
					),
				),
			),
			'context' => 'side',
		);

		$skin = array(
			'type'     => '',
			'title'    => __( 'Skin' ,'nietzsche'),
			'priority' => 'core',
			'where'    => array(
				'post' => 'all',
			),
			'content' => array(
				'skin' => array(
					'label'       => __( 'Skin' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => array(
						__( 'Global' ,'nietzsche')  => 'global',
						__( 'Edge' ,'nietzsche')    => 'edge',
						__( 'Minimal' ,'nietzsche') => 'minimal',
					),
					'default' => 'global',
				),
			),
			'context' => 'side',
		);

		if (PE_THEME_MODE && $builder) {
			// top level builder element can only member of the "section" group
			$builder["builder"]["content"]["builder"]["allowed"] = "section";
		}

		PeGlobal::$config["metaboxes-page"] = array_merge(
			$builder
		);

		PeGlobal::$config["metaboxes-page"]['header'] = $header;
		PeGlobal::$config["metaboxes-page"]['footer'] = $footer;
		PeGlobal::$config["metaboxes-page"]['skin'] = $skin;
	}

	public function pe_theme_project_builder_modules_filter($default) {
		return
			array(
				'LayoutModuleNietzscheColumns',
				'LayoutModuleNietzscheContact',
				'LayoutModuleNietzscheContactDetails',
				'LayoutModuleNietzscheContactForm',
				'LayoutModuleNietzscheGoogleMap',
				'LayoutModuleNietzscheGoogleMapLocation',
				'LayoutModuleNietzscheHero',
				'LayoutModuleNietzscheIntro',
				'LayoutModuleNietzscheLogo',
				'LayoutModuleNietzscheLogos',
				'LayoutModuleNietzscheMediaGrid',
				'LayoutModuleNietzscheMediaGridCaption',
				'LayoutModuleNietzscheMediaGridImage',
				'LayoutModuleNietzscheMediaGridLightboxGallery',
				'LayoutModuleNietzscheMediaGridLightboxGalleryCaption',
				'LayoutModuleNietzscheMediaGridLightboxGalleryImage',
				'LayoutModuleNietzscheMediaGridSlider',
				'LayoutModuleNietzscheMediaGridSliderSlide',
				'LayoutModuleNietzscheMediaGridVideo',
				'LayoutModuleNietzscheProjectDetails',
				'LayoutModuleNietzscheProjectDetailsQuote',
				'LayoutModuleNietzscheProjectDetailsText',
				'LayoutModuleNietzscheProjectsGrid',
				'LayoutModuleNietzscheService',
				'LayoutModuleNietzscheServices',
				'LayoutModuleNietzscheSplash',
				'LayoutModuleNietzscheSplashImage',
				'LayoutModuleNietzscheSplashImageCaption',
				'LayoutModuleNietzscheSplashImageVideo',
				'LayoutModuleNietzscheSplashParallax',
				'LayoutModuleNietzscheSplashParallaxSlide',
				'LayoutModuleNietzscheSplashSlider',
				'LayoutModuleNietzscheSplashSliderSlide',
				'LayoutModuleNietzscheSplashSliderSlideCaption',
				'LayoutModuleNietzscheSplashSliderSlideLightbox',
				'LayoutModuleNietzscheStat',
				'LayoutModuleNietzscheStats',
				'LayoutModuleNietzscheTeam',
				'LayoutModuleNietzscheTeamMember',
				'LayoutModuleNietzscheTestimonial',
				'LayoutModuleNietzscheTestimonialsSlider',
				'LayoutModuleNietzscheTestimonialsSliderTestimonial',
				'LayoutModuleNietzscheText',
			);
	}
	
	public function pe_theme_metabox_config_project() {
		$mboxes = parent::pe_theme_metabox_config_project();

		unset( $mboxes['video']['content']['id'] );
		$mboxes['video']['content']['url'] = array(
			'label'       => __( 'Video url' ,'nietzsche'),
			'description' => __( 'YouTube or Vimeo url only' ,'nietzsche'),
			'type'        => 'Text',
			'default'     => '',
		);
		
		// top level builder element can only member of the "section" group
		$mboxes['builder']['content']['builder']['allowed'] = 'section';

		// add show/hide title control
		$mboxes['content']['type'] = 'Conditional';
		$mboxes['content']['options'] = array(
			'type' => array(
				'editor' => array(
					'hide' => 'show_title',
				),
				'builder' => array(
					'show' => 'show_title',
				),
			),
		);

		$created_menus = get_terms( 'nav_menu' );
		$menu_choices = array(
			__( 'None' ,'nietzsche') => '',
		);

		if ( ! empty( $created_menus ) && is_array( $created_menus ) ) {

			foreach ( $created_menus as $menu ) {

				$menu_choices[ $menu->name ] = $menu->slug;
	
			}

		}

		$mboxes['header'] = array(
			'type'     => 'Conditional',
			'title'    => __( 'Header' ,'nietzsche'),
			'priority' => 'core',
			'options'  => array(
				'menu_type' => array(
					'overlay' => array(
						'hide' => 'menu_icons,menu_logo,menu_bg',
					),
					'slide-left' => array(
						'show' => 'menu_icons,menu_logo,menu_bg',
					),
					'slide-right' => array(
						'show' => 'menu_icons,menu_logo,menu_bg',
					),
				),
				'header_type' => array(
					'global' => array(
						'hide' => 'menu_type,menu_logo,menu_icons,menu_copyright,menu_bg,alternative_logo',
					),
					'top' => array(
						'show' => 'menu_type,menu_copyright',
					),
					'top-large' => array(
						'show' => 'menu_type,menu_copyright',
					),
					'top-transparent' => array(
						'show' => 'menu_type,menu_copyright,alternative_logo',
					),
					'bottom-transparent' => array(
						'show' => 'menu_type,menu_copyright,alternative_logo',
					),
				),
			),
			'where'    => array(
				'post' => 'all',
			),
			'content' => array(
				'logo' => array(
					'label'       => __( 'Logo' ,'nietzsche'),
					'type'        => 'Upload',
					'description'  => __( 'If set, it will overwrite the logo defined in Theme Options -> General.' ,'nietzsche'),
					'default'     => '',
				),
				'header_type' => array(
					'label'       => __( 'Header type' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => array(
						__( 'Global' ,'nietzsche')               => 'global',
						__( 'Top' ,'nietzsche')                  => 'top',
						__( 'Top - large' ,'nietzsche')          => 'top-large',
						__( 'Top - transparent' ,'nietzsche')    => 'top-transparent',
						__( 'Bottom - transparent' ,'nietzsche') => 'bottom-transparent',
					),
					'default' => 'default',
				),
				'alternative_logo' => array(
					'label'       => __( 'Alternative logo' ,'nietzsche'),
					'type'        => 'Upload',
					'description'  => __( 'This logo will be displayed when header goes from transparent state to fully opaque state.' ,'nietzsche'),
					'default'     => '',
				),
				'menu_type' => array(
					'label'       => __( 'Menu type' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => array(
						__( 'Overlay' ,'nietzsche')          => 'overlay',
						__( 'Slide in - left' ,'nietzsche')  => 'slide-left',
						__( 'Slide in - right' ,'nietzsche') => 'slide-right',
					),
					'default' => 'Overlay',
				),
				'menu_bg' => array(
					'label'       => __( 'Menu background' ,'nietzsche'),
					'type'        => 'Upload',
					'default'     => '',
				),
				'menu_logo' => array(
					'label'       => __( 'Menu logo' ,'nietzsche'),
					'type'        => 'Upload',
					'default'     => '',
				),
				'menu_icons' => array(
					'label'       => __( 'Header icons' ,'nietzsche'),
					'type'         => 'Items',
					'description'  => __( 'Add one or more icon to the top menu bar.' ,'nietzsche'),
					'button_label' => __( 'Add Icon' ,'nietzsche'),
					'sortable'     => true,
					'auto'         => 'icon-facebook',
					'unique'       => false,
					'editable'     => false,
					'legend'       => false,
					'fields'       => 
					array(
						array(
							'label'   => 'Icon',
							'name'    => 'icon',
							'type'    => 'icon',
							'width'   => 200, 
							'default' => 'icon-facebook',
						),
						array(
							'label'   => 'Url',
							'name'    => 'url',
							'type'    => 'text',
							'width'   => 300, 
							'default' => '#',
						),
					),
				),
				'menu_copyright' => array(
					'label'       => __( 'Menu copyright' ,'nietzsche'),
					'type'        => 'Text',
					'default' => '&copy; 2015 Nietzsche All Rights Reserved.',
				),
				'custom_menu' => array(
					'label'       => __( 'Custom Main menu' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => $menu_choices,
					'description' => __( 'If you want to display custom Main menu on this page, please select one of the menus on this list.' ,'nietzsche'),
					'default'     => '',
				),
				'custom_side_menu' => array(
					'label'       => __( 'Custom Side menu' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => $menu_choices,
					'description' => __( 'If you want to display custom Side menu on this page, please select one of the menus on this list.' ,'nietzsche'),
					'default'     => '',
				),
			),
			'context' => 'side',
		);

		$mboxes['footer'] = array(
			'type'     => 'Conditional',
			'title'    => __( 'Footer' ,'nietzsche'),
			'priority' => 'core',
			'options'  => array(
				'footer_type' => array(
					'global' => array(
						'hide' => 'footer_bg,footer_logo,footer_text_1,footer_text_2,footer_text_3,footer_copyright,footer_links',
					),
					'custom' => array(
						'show' => 'footer_bg,footer_logo,footer_text_1,footer_text_2,footer_text_3,footer_copyright,footer_links',
					),
				),
			),
			'where'    => array(
				'post' => 'all',
			),
			'content' => array(
				'footer_type' => array(
					'label'       => __( 'Footer type' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => array(
						__( 'Global' ,'nietzsche') => 'global',
						__( 'Custom' ,'nietzsche') => 'custom',
					),
					'default' => 'global',
				),
				'footer_bg' => array(
					'label'   => __( 'Footer background color' ,'nietzsche'),
					'type'    => 'Color',
					'default' => '#222',
				),
				'footer_logo' => array(
					'label'   => __( 'Footer logo' ,'nietzsche'),
					'type'    => 'Upload',
					'default' => '',
				),
				'footer_text_1' => array(
					'label'       => __( 'Footer text #1' ,'nietzsche'),
					'type'        => 'TextArea',
					'default' => 'Nietzsche is a solid, well designed and unique template for agencies or inviduals looking to put their work forward in a professional and coherent manner. Built on our own solid framework, it comes with a range of prestyled modules and content blocks, several in-hosue developed plugins such as sliders, parallax sections, counters and much much more.',
				),
				'footer_text_2' => array(
					'label'       => __( 'Footer text #2' ,'nietzsche'),
					'type'        => 'TextArea',
					'default' => '<h3>Main Headquarters</h3>'
					           . '<address>126-130 Crosby Street, Soho<br>New York City, NY 10012, U.S.<br>Tel: +1 212-249-2390<br>Email: <a href="mailto:#">info@nietzsche.com</a></address>',
				),
				'footer_text_3' => array(
					'label'       => __( 'Footer text #3' ,'nietzsche'),
					'type'        => 'TextArea',
					'default' => '<h3>LOS ANGELES</h3>'
					           . '<address>1823 Monroe Street No. 107<br>Santa Monica, CA 90404, U.S.<br>Tel: +1 404-610-4576<br>Email: <a href="mailto:#">info@nietzschela.com</a></address>',
				),
				'footer_copyright' => array(
					'label'       => __( 'Copyright' ,'nietzsche'),
					'type'        => 'TextArea',
					'description' => __( 'This is the footer copyright message displayed on the bottom of the left side of the footer area.' ,'nietzsche'),
					'default'     => '&copy; 2015 Nietzsche All Rights Reserved.',
				),
				'footer_links' => array(
					'label'       => __( 'Footer links' ,'nietzsche'),
					'type'         => 'Items',
					'description'  => __( 'Add one or more links to the footer.' ,'nietzsche'),
					'button_label' => __( 'Add Link' ,'nietzsche'),
					'sortable'     => true,
					'auto'         => '#',
					'unique'       => false,
					'editable'     => false,
					'legend'       => false,
					'fields'       => 
					array(
						array(
							'label'   => 'Url',
							'name'    => 'url',
							'type'    => 'text',
							'width'   => 220, 
							'default' => '#',
						),
						array(
							'label'   => 'Description',
							'name'    => 'description',
							'type'    => 'text',
							'width'   => 300, 
							'default' => 'Home',
						),
					),
				),
			),
			'context' => 'side',
		);

		$mboxes['skin'] = array(
			'type'     => '',
			'title'    => __( 'Skin' ,'nietzsche'),
			'priority' => 'core',
			'where'    => array(
				'post' => 'all',
			),
			'content' => array(
				'skin' => array(
					'label'       => __( 'Skin' ,'nietzsche'),
					'type'        => 'Select',
					'options'     => array(
						__( 'Global' ,'nietzsche')  => 'global',
						__( 'Edge' ,'nietzsche')    => 'edge',
						__( 'Minimal' ,'nietzsche') => 'minimal',
					),
					'default' => 'global',
				),
			),
			'context' => 'side',
		);

		// grid mbox
		$mboxes['grid'] = array(
			'type'     => '',
			'title'    => __( 'Grid' ,'nietzsche'),
			'priority' => 'core',
			'where'    => array(
				'post' => 'all',
			),
			'content' => array(
				'size' => array(
					'label'   => __( 'Grid size' ,'nietzsche'),
					'type'    => 'Select',
					'options' => array(
						__( 'Normal - landscape' ,'nietzsche') => 'landscape',
						__( 'Normal - portrait' ,'nietzsche')  => 'portrait',
						__( 'Large - landscape' ,'nietzsche')  => 'large-landscape',
						__( 'Large - portrait' ,'nietzsche')  => 'large-portrait',
					),
					'description' => __( 'Specify the size this project will take when used in Projects Grid builder module.' ,'nietzsche'),
					'default' => 'landscape',
				),
			),
			'context' => 'side',
		);

		PeGlobal::$config["metaboxes-project"] = $mboxes;
	}

	protected function init_asset() {
		return new PeThemeNietzscheAsset($this);
	}

	protected function init_template() {
		return new PeThemeNietzscheTemplate($this);
	}

}