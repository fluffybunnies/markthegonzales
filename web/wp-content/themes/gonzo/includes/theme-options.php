<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  
  /* OptionTree is not loaded yet */
  if ( ! function_exists( 'ot_settings_id' ) )
    return false;
    
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( ot_settings_id(), array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general_default',
        'title'       => __( 'General', 'gonzo' )
      ),
      array(
        'id'          => 'general',
        'title'       => __( 'Backgrounds &amp; Colours', 'gonzo' )
      ),
      array(
        'id'          => 'typography',
        'title'       => __( 'Typography', 'gonzo' )
      ),
      array(
        'id'          => 'branded_widget',
        'title'       => __( 'Footer Social Widget', 'gonzo' )
      ),
      array(
        'id'          => 'miscellaneous',
        'title'       => __( 'Miscellaneous', 'gonzo' )
      ),
      array(
        'id'          => 'custom_css',
        'title'       => __( 'Custom CSS', 'gonzo' )
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'omc_logo_image',
        'label'       => __( 'Logo Image', 'gonzo' ),
        'desc'        => __( 'Upload your logo image (dimensions for the live preview logo are 254 X 96).', 'gonzo' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_favicon',
        'label'       => __( 'Favicon Image', 'gonzo' ),
        'desc'        => __( 'Upload a favicon icon image for your site.', 'gonzo' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_google_analytics',
        'label'       => __( 'Google Analytics Code', 'gonzo' ),
        'desc'        => __( 'Paste in your entire Google Analytics Code.', 'gonzo' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general_default',
        'rows'        => '7',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_default_blog_style',
        'label'       => __( 'Default Blog Style', 'gonzo' ),
        'desc'        => __( 'If you just want a simple blog - what style do you want?', 'gonzo' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'blog-style-1',
            'label'       => __( 'blog-style-1', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'blog-style-2',
            'label'       => __( 'blog-style-2', 'gonzo' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'omc_default_slider',
        'label'       => __( 'Enable Default Blog Slider', 'gonzo' ),
        'desc'        => __( 'If you are using the default blog for the homepage - enable the slider?', 'gonzo' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => __( 'Yes', 'gonzo' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'omc_global_colour',
        'label'       => __( 'Global Colour', 'gonzo' ),
        'desc'        => __( 'This is the main colour will affect all posts/pages/categories but can be overridden with the individual category and page options.', 'gonzo' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_background_preset',
        'label'       => __( 'Background Preset', 'gonzo' ),
        'desc'        => __( 'Here are some background presets. Courtesy of www.subtlepatterns.com', 'gonzo' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'Argyle',
            'label'       => __( 'Argyle', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Broken_noise',
            'label'       => __( 'Broken_noise', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Diagonal_striped_brick',
            'label'       => __( 'Diagonal_striped_brick', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Dvsup',
            'label'       => __( 'Dvsup', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Graphy',
            'label'       => __( 'Graphy', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Hexellence',
            'label'       => __( 'Hexellence', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Inflicted',
            'label'       => __( 'Inflicted', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Kuji',
            'label'       => __( 'Kuji', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Light_wool',
            'label'       => __( 'Light_wool', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Nami',
            'label'       => __( 'Nami', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Pinstriped_suit',
            'label'       => __( 'Pinstriped_suit', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Purty_wood',
            'label'       => __( 'Purty_wood', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Purty_wood_bw',
            'label'       => __( 'Purty_wood_bw', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'tactile_noise',
            'label'       => __( 'tactile_noise', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'tasky_pattern',
            'label'       => __( 'tasky_pattern', 'gonzo' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'omc_global_background',
        'label'       => __( 'Background Image', 'gonzo' ),
        'desc'        => __( 'This is the main background will affect all posts/pages/categories. To further brand your categories you can use the "Transparent Layer".', 'gonzo' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_background_css',
        'label'       => __( 'Background Position', 'gonzo' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'Tiled',
            'label'       => __( 'Tiled', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Static',
            'label'       => __( 'Static', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'jQuery Full Screen',
            'label'       => __( 'jQuery Full Screen', 'gonzo' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'omc_background_colour',
        'label'       => __( 'Background Colour', 'gonzo' ),
        'desc'        => __( 'If you just want a plain background colour you can choose it here.', 'gonzo' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_global_transparent_layer',
        'label'       => __( 'Transparent Layer', 'gonzo' ),
        'desc'        => __( 'This is a layer on top of the background that you can use for more advanced transparency effects.', 'gonzo' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_main_shadow',
        'label'       => __( 'Main Container Box Shadow', 'gonzo' ),
        'desc'        => __( 'You can adjust the strength of the main container\'s box shadow here.', 'gonzo' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'None',
            'label'       => __( 'None', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Light',
            'label'       => __( 'Light', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Medium',
            'label'       => __( 'Medium', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => 'Strong',
            'label'       => __( 'Strong', 'gonzo' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'omc_header_font',
        'label'       => __( 'Google Font', 'gonzo' ),
        'desc'        => __( 'Take a look at chapter 4.4 in the documentation. There you will find what fonts look good in this theme and what the correct base size is for the "Scale Fonts" option below.', 'gonzo' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_global_font_scale',
        'label'       => __( 'Scale fonts', 'gonzo' ),
        'desc'        => __( 'All fonts are based on em so if you change this value then all fonts will scale up and down accordingly.', 'gonzo' ),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => '10px',
            'label'       => __( '10px', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => '11px',
            'label'       => __( '11px', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => '12px',
            'label'       => __( '12px', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => '13px',
            'label'       => __( '13px', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => '14px',
            'label'       => __( '14px', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => '15px',
            'label'       => __( '15px', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => '16px',
            'label'       => __( '16px', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => '17px',
            'label'       => __( '17px', 'gonzo' ),
            'src'         => ''
          ),
          array(
            'value'       => '18px',
            'label'       => __( '18px', 'gonzo' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'omc_mobile_text',
        'label'       => __( 'Mobile Paragraph Size', 'gonzo' ),
        'desc'        => __( 'If you want to adjust the paragraph font-size for mobile phones you can do so here.', 'gonzo' ),
        'std'         => '',
        'type'        => 'measurement',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_desktop_text',
        'label'       => __( 'Desktop Paragraph Font Size', 'gonzo' ),
        'desc'        => __( 'If you want to adjust the paragraph font-size for desktop/tablets you can do so here.', 'gonzo' ),
        'std'         => '',
        'type'        => 'measurement',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_p_color',
        'label'       => __( 'Paragraph Font Colour', 'gonzo' ),
        'desc'        => __( 'Alter the colour of your body copy here.', 'gonzo' ),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'typography',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_enable_footer_widget',
        'label'       => __( 'Enable the branded widget?', 'gonzo' ),
        'desc'        => __( 'This turns on this widget. For reference, it is the first footer widget on the left of the theme\'s live preview.', 'gonzo' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'branded_widget',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => __( 'Yes', 'gonzo' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'omc_footer_widget_logo',
        'label'       => __( 'Logo Upload', 'gonzo' ),
        'desc'        => __( 'Upload your logo (dimensions for the live preview are 168 X 57)', 'gonzo' ),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'branded_widget',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_footer_facebook',
        'label'       => __( 'Facebook URL', 'gonzo' ),
        'desc'        => __( 'Paste in your Facebook URL. Empty and save to remove.', 'gonzo' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'branded_widget',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_footer_twitter',
        'label'       => __( 'Twitter URL', 'gonzo' ),
        'desc'        => __( 'Paste in your Twitter URL. Empty and save to remove.', 'gonzo' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'branded_widget',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_footer_pinterest',
        'label'       => __( 'Pinterest URL', 'gonzo' ),
        'desc'        => __( 'Paste in your Pinterest URL. Empty and save to remove.', 'gonzo' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'branded_widget',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_footer_vimeo',
        'label'       => __( 'Vimeo URL', 'gonzo' ),
        'desc'        => __( 'Paste in your Vimeo URL. Empty and save to remove.', 'gonzo' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'branded_widget',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_footer_flickr',
        'label'       => __( 'Flickr URL', 'gonzo' ),
        'desc'        => __( 'Paste in your Flickr URL. Empty and save to remove.', 'gonzo' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'branded_widget',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_footer_youtube',
        'label'       => __( 'YouTube URL', 'gonzo' ),
        'desc'        => __( 'Paste in your YouTube URL. Empty and save to remove.', 'gonzo' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'branded_widget',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_footer_google',
        'label'       => __( 'Google+ URL', 'gonzo' ),
        'desc'        => __( 'Add your Google+ page here. Empty and save to delete.', 'gonzo' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'branded_widget',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_footer_widget_text',
        'label'       => __( 'Widget Text', 'gonzo' ),
        'desc'        => __( 'Put the your text for your widget in here.', 'gonzo' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'branded_widget',
        'rows'        => '7',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_enable_copyright',
        'label'       => __( 'Enable Footer Copyright Area?', 'gonzo' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'miscellaneous',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => __( 'Yes', 'gonzo' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'omc_top_menu',
        'label'       => __( 'Enable Top Menu?', 'gonzo' ),
        'desc'        => __( 'This menu will appear at the very top of your page.', 'gonzo' ),
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'miscellaneous',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and',
        'choices'     => array( 
          array(
            'value'       => 'Yes',
            'label'       => __( 'Yes', 'gonzo' ),
            'src'         => ''
          )
        )
      ),
      array(
        'id'          => 'omc_copyright_text',
        'label'       => __( 'Copyright Text', 'gonzo' ),
        'desc'        => __( 'Short copyright info', 'gonzo' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'miscellaneous',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_gallery_page',
        'label'       => __( 'Gallery Page URL', 'gonzo' ),
        'desc'        => __( 'When you create the gallery page paste the url in here.', 'gonzo' ),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'miscellaneous',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'omc_custom_css',
        'label'       => __( 'Custom CSS', 'gonzo' ),
        'desc'        => __( 'Paste in your custom css here. Please avoid altering the original css files as it\'ll cause problems when you update the theme.', 'gonzo' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'custom_css',
        'rows'        => '20',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( ot_settings_id(), $custom_settings ); 
  }
  
  /* Lets OptionTree know the UI Builder is being overridden */
  global $ot_has_custom_theme_options;
  $ot_has_custom_theme_options = true;
  
}