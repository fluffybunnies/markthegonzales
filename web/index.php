<?php

include dirname(__FILE__).'/bootshell.php';
use \ace\Ace;


// load wordpress
define('WP_USE_THEMES', true);
require(WEBROOT.'/wp-blog-header.php');
