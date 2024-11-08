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
namespace BlazePHP;


/**
 * Globals
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Globals extends Struct
{
	const DATA_ONLY_TRUE  = true;
	const DATA_ONLY_FALSE = false;
	/**
	 * Globally accessible variables
	 */
	public static $debug = false;
	public static $env;
	public static $db;
	public static $cli;
	public static $log;
	public static $lock;
	public static $verbose;
	public static $moduleMap;
	public static $controllerMap;
	public static $request;
	public static $route;
	public static $routeAlias;
	public static $session;
	public static $autoload = array(
		 'BlazePHP:lib'  // Map all BlazePHP namespace classes to the ABS_ROOT/lib directory
		,'BlazePHP:trait' // Map all BlazePHP namespace traits to the ABS_ROOT/trait directory
	);
}
