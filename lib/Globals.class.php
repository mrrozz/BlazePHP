<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2017, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     2012 - 2017, BlazePHP.com
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
	/**
	 * Globally accessible variables
	 */
	public static $debug = false;
	public static $env;
	public static $db;
	public static $cli;
	public static $log;
	public static $verbose;
	public static $moduleMap;
	public static $controllerMap;
	public static $request;
	public static $route;
	public static $routeAlias;
	public static $autoload = array(
		'BlazePHP:lib'  // Map all BlazePHP namespace classes to the ABS_ROOT/lib directory
	);
}
