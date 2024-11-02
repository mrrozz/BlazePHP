<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2024, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2024, BlazePHP.com
 * @link          http://blazePHP.com
 *
 */
use \BlazePHP\Globals as G;
use \BlazePHP\Debug as D;

/**
 * Define the autoload method from the Environment object
 */
spl_autoload_register(
	function($className) {
		$parts   = explode('\\', $className);
		$search  = array();
		$replace = array();
		if(count(G::$autoload) > 0) {

			foreach(G::$autoload as $translate) {
				$map = explode(':', $translate);
				if(count($map) != 2) {
					ob_start();
					debug_print_backtrace();
					$backtrace = ob_get_contents();
					ob_clean();
					throw new \Exception(
						'AUTOLOADER - The G::$autoload array contains invalid data ['.$translate.'].'
						."\n\n"
						.$backtrace
					);
				}
				$search[]  = '/'.$map[0].'/';
				$replace[] = $map[1];
			}
			$path = preg_replace($search, $replace, implode('/', $parts));
		}

		$fileLocation = '';
		if(file_exists(ABS_ROOT.'/'.$path.'.class.php')) {
			$fileLocation = ABS_ROOT.'/'.$path.'.class.php';
		}
		elseif(file_exists(ABS_ROOT.'/'.$path.'.trait.php')) {
			$fileLocation = ABS_ROOT.'/'.$path.'.trait.php';
		}
		elseif(isset(G::$moduleMap[$className])) {
			$fileLocation = ABS_ROOT.'/module/'.G::$moduleMap[$className];
		}
		elseif(isset(G::$controllerMap[$className])) {
			$fileLocation = ABS_ROOT.'/module/'.G::$controllerMap[$className];
		}
		// else {
		// 	ob_start();
		// 	debug_print_backtrace();
		// 	$backtrace = ob_get_contents();
		// 	ob_clean();
		// 	throw new \Exception(
		// 		'AUTOLOADER - The class ['.$className.'] does not exist.'
		// 		."\n\n"
		// 		.$backtrace
		// 	);
		// }
		// print_r($fileLocation."\n");
		// print_r(array('include file: ', require_once($fileLocation)));
		// print_r(get_declared_classes());
		if(file_exists($fileLocation)) {
			require_once($fileLocation);
		}
		return;
	}
);
