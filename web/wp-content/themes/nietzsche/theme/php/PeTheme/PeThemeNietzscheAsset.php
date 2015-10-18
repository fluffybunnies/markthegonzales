<?php

class PeThemeNietzscheAsset extends PeThemeAsset  {

	public function __construct(&$master) {

		$this->minifiedJS = 'theme/compressed/theme.min.js';
		$this->minifiedCSS = 'theme/compressed/theme.min.css';

		//define( 'PE_THEME_LOCAL_VIDEO_SUPPORT',true);

		parent::__construct($master);
		
	}

	public function registerAssets() {

		add_filter( 'pe_theme_js_init_file',array(&$this, 'pe_theme_js_init_file_filter' ));
		add_filter( 'pe_theme_js_init_deps',array(&$this, 'pe_theme_js_init_deps_filter' ));
		add_filter( 'pe_theme_minified_js_deps',array(&$this, 'pe_theme_minified_js_deps_filter' ));
		
		parent::registerAssets();

		if ($this->minifyCSS) {

			$deps = array(
				'pe_theme_compressed',
			);

		} else {

			// theme styles
			$this->addStyle( 'mediaelement/skin/mejs-snowplayerskin.css',array(), 'pe_theme_nietzsche-mediaelement' );
			$this->addStyle( 'css/timber.css',array(), 'pe_theme_nietzsche-timber' );
			$this->addStyle( 'css/snowbridge.css',array(), 'pe_theme_nietzsche-snowbridge' );
			$this->addStyle( 'css/avalanche.css',array(), 'pe_theme_nietzsche-avalanche' );
			$this->addStyle( 'css/templates.css',array(), 'pe_theme_nietzsche-templates' );
			$this->addStyle( 'css/summit.css',array(), 'pe_theme_nietzsche-summit' );
			$this->addStyle( 'css/skin.css',array(), 'pe_theme_nietzsche-skin' );

			$deps = array(
				'pe_theme_nietzsche-mediaelement',
				'pe_theme_nietzsche-timber',
				'pe_theme_nietzsche-snowbridge',
				'pe_theme_nietzsche-avalanche',
				'pe_theme_nietzsche-templates',
				'pe_theme_nietzsche-summit',
				'pe_theme_nietzsche-skin',
			);

			$deps = array_merge( $deps, $this->registerCustomCSS() );

		}

		$this->addStyle( 'style.css',$deps, 'pe_theme_init' );

		$this->addScript( 'theme/js/pe/pixelentity.controller.js', array(
			'pe_theme_utils_browser',
			'pe_theme_selectivizr',
			'pe_theme_lazyload',
			'pe_theme_widgets_contact',
			'pe_theme_nietzsche-timber',
			'pe_theme_nietzsche-template',
			'pe_theme_nietzsche-custom',
		), 'pe_theme_controller' );

		$this->addScript( 'js/timber.master.min.js',array(), 'pe_theme_nietzsche-timber' );
		$this->addScript( 'js/template-functions.js',array(), 'pe_theme_nietzsche-template' );
		$this->addScript( 'js/custom.js',array(), 'pe_theme_nietzsche-custom' );

	}

	public function pe_theme_js_init_file_filter( $js ) {

		return $js;
		//return 'js/custom.js';

	}

	public function pe_theme_js_init_deps_filter( $deps ) {

		return $deps;
		/*
		  return array(
		  'jquery',
		  );
		*/
	}

	public function pe_theme_minified_js_deps_filter( $deps ) {

		return $deps;
		//return array( 'jquery' );

	}

	public function style() {

		bloginfo( 'stylesheet_url' ); 

	}

	public function enqueueAssets() {

		$this->registerAssets();

		$t =& peTheme();

		if ( $this->minifyJS && file_exists( PE_THEME_PATH . '/preview/init.js' ) ) {

			$this->addScript( 'preview/init.js', array( 'jquery' ), 'pe_theme_preview_init' );
			
			wp_localize_script( 'pe_theme_preview_init', 'o', array(
			//'dark' => PE_THEME_URL.'/css/dark_skin.css',
				'css' => $this->master->color->customCSS( true, 'color1' )
			) );

			wp_enqueue_script( 'pe_theme_preview_init' );

		}	

		wp_enqueue_style( 'pe_theme_init' );
		wp_enqueue_script( 'pe_theme_init' );

		wp_localize_script( 'pe_theme_init', '_nietzsche', array(
			'ajax_url'     => admin_url( 'admin-ajax.php' ),
 			'ajax-loading' => PE_THEME_URL . '/images/ajax-loader.gif',
			'home_url'     => home_url( '/' ),
		) );

		wp_enqueue_script( 'pe_nietzsche_gmap', '//maps.googleapis.com/maps/api/js?v=3', array( 'jquery') );

		if ( $this->minifyJS && file_exists( PE_THEME_PATH . '/preview/preview.js' ) ) {

			$this->addScript( 'preview/preview.js',array( 'pe_theme_init' ), 'pe_theme_skin_chooser' );

			wp_localize_script( 'pe_theme_skin_chooser', 'pe_skin_chooser', array( 'url' => urlencode( PE_THEME_URL . '/' ) ) );
			wp_enqueue_script( 'pe_theme_skin_chooser' );

		}

	}


}