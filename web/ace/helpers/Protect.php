<?php
/*
	Note
		- reply_to is ignored when sending attachments
*/

namespace ace\helpers;
use \ace\Ace;
use \ace\HelperAbstract;


class Protect extends HelperAbstract {

	public static function preventBruteForce($opts=array()){
		$opts = array_merge(array(
			'cap' => 1000, // 1 call per second
			'bank' => 50,
			'usePath' => true,
		),$opts);
		if (!empty($_GET['debug'])) Ace::varDump($_SERVER);
		//$key = $opts['usePath'] ? REQUEST_PATH : 
	}

}
