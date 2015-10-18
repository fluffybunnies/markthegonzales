<?php
/**
 * Plugin Name: Pixelentity Portfolio
 * Plugin URI: pixelentity-portfolio
 * Description: Adds Projects/Portfolios to pixelentity/bitfade themes.
 * Version: 1.0.0
 * Author: Pixelentity
 * Author URI: http://pixelentity.com
 *
 * Project custom post type used in pixelentity/bitfade themes 
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package   PixelentityPortfolio
 * @version   1.0.0
 * @since     1.0.0
 * @author    Pixelentity
 * @copyright Pixelenitty
 * @link      http://pixelentity.com
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

if (!defined('PIXELENTITY_PLUGIN_PORTFOLIO')) {

	define('PIXELENTITY_PLUGIN_PORTFOLIO',true);
	
	class Pixelentity_Portfolio {

		public function __construct() {

			add_action( 'plugins_loaded', array( &$this, 'loaded' ), 1 );
			add_action( 'init', array( &$this, 'init' ) );
			
			register_activation_hook( __FILE__, array( &$this, 'activation' ) );
		}

		public function init() {
			$cpt = 
				array(
					  'labels' => 
					  array(
							'name'                   => __( 'Projects', 'pixelentity-portfolio'),
							'singular_name'          => __( 'Project', 'pixelentity-portfolio'),
							'add_new_item'           => __( 'Add New Project', 'pixelentity-portfolio'),
							'search_items'           => __( 'Search Projects', 'pixelentity-portfolio'),
							'popular_items' 	     => __( 'Popular Projects','pixelentity-portfolio'),		
							'all_items' 		     => __( 'All Projects', 'pixelentity-portfolio'),
							'parent_item' 	         => __( 'Parent Project', 'pixelentity-portfolio'),
							'parent_item_colon'      => __( 'Parent Project:', 'pixelentity-portfolio'),
							'edit_item' 		     => __( 'Edit Project', 'pixelentity-portfolio'), 
							'update_item' 	         => __( 'Update Project', 'pixelentity-portfolio'),
							'add_new_item' 	         => __( 'Add New Project', 'pixelentity-portfolio'),
							'new_item_name' 	     => __( 'New Project Name', 'pixelentity-portfolio')
							),
					  'public' => true,
					  'has_archive' => false,
					  'supports' => array('title', 'editor', 'thumbnail', 'post-formats'),
					  'taxonomies' => array('post_format')
					  );

			$tax = 
				array(
					  'project',
					  array(
							'label' => __('Project Tags', 'pixelentity-portfolio'),
							'sort' => true,
							'args' => array('orderby' => 'term_order' ),
							'show_in_nav_menus' => false,
							'rewrite' => array('slug' => 'projects' )
							)
					  );


			register_taxonomy('prj-category',$tax[0],$tax[1]);
			register_post_type('project',$cpt);
		}

		
		public function loaded() {
			load_plugin_textdomain( 'pixelentity-portfolio', false, 'pixelentity-portfolio/languages' );
		}

		public function activation() {
		}
	}

	new Pixelentity_Portfolio();
}
?>