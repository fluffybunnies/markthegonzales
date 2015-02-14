<?php

// Post Thumbnails
if ( function_exists( 'add_theme_support' ) ) { add_theme_support( 'post-thumbnails'); }
add_image_size( 'blog-one', 300, 300, true );
add_image_size( 'small-square', 50, 50, true );
add_image_size( 'half-landscape', 290, 166, true );
add_image_size( 'featured-image', 620, 350, true );
add_image_size( 'gallery-links', 186, 186, true );
?>