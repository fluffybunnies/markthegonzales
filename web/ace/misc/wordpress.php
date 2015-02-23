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
  echo '<link rel="stylesheet" type="text/css" href="/ace.css" />';
}

function hook_wpfooter(){
	echo '<script>if (!window.$) window.$ = window.jQuery;</script>';
	echo '<script src="/ace.js" async></script>';
	Tracking::pageView();
}