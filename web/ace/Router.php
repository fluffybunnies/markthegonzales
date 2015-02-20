<?php

namespace ace;
use \ace\Ace;

class Router {

	private static $routes = array(
		'/hc' => 'hc.php',
		'/id' => 'id.php',
		'/demo' => 'demo.php',
		'/test' => 'test.php',
		'/ace.js' => 'ace/scripts/compile-ace.php',
		'/ace.css' => 'ace/scripts/compile-ace.php',
	);
	private static $redirects = array(
		'/wp-admin' => 'wp-admin/index.php',
	);
	private static $apiPath = '/ace/api';

	public static function route($request){

		if (strpos($request, self::$apiPath) === 0) {
			Api::request( substr($request, strlen(self::$apiPath)+1) );
			exit;
		}

		$r = Ace::g(self::$routes, $request);
		if ($r !== null)
			self::go($r);

		$r = Ace::g(self::$redirects, $request);
		if ($r !== null)
			self::redirect($r);

	}

	private static function go($where){
		include WEBROOT.'/'.$where;
		exit;
	}

	private static function redirect($where){
		header('HTTP/1.1 301 Moved Permanently');
		header("Location: $url");
	}

}
