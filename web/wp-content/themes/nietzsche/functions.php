<?php

define("PE_THEME_NAME",'Nietzsche');

// bootstrap the framework
define("PE_THEME_PATH",function_exists('realpath') ? realpath(get_template_directory()) : get_template_directory());
require("framework/php/boot.php");

function nietzsche_custom_excerpt_length( $length ) {

	return 30;
	
}

add_filter( 'excerpt_length', 'nietzsche_custom_excerpt_length', 11 );