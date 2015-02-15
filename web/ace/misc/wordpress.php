<?php

namespace ace\misc;

use \ace\Ace;
use \ace\helpers\Tracking;

// disables this: "Changes double line-breaks in the text into HTML paragraphs (<p>...</p>)."
//remove_filter('the_content', 'wpautop');
//remove_filter('the_excerpt', 'wpautop');

add_action('wp_head', '\ace\misc\hook_wphead');
add_action('wp_footer', '\ace\misc\hook_wpfooter');

function hook_wphead(){
  echo '<meta name="description" content="Mark IS the Gonzales" />';
  echo '<link rel="stylesheet" type="text/css" href="'.Ace::vres('/assets/ace.css').'" />';
}

function hook_wpfooter(){
	echo '<script src="'.Ace::vres('/assets/ace.js').'" async></script>';
	Tracking::pageView();
}