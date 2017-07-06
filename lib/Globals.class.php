<?php
/**
 *
 * BlazePHP.com - A framework for high performance
 * Copyright 2012 - 2013, BlazePHP.com
 *
 * Licensed under The MIT License
 * Any redistribution of this file's contents, both
 * as a whole, or in part, must retain the above information
 *
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @copyright     Copyright 2012 - 2013, BlazePHP.com
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

	public static $autoload = array(
		'BlazePHP:lib'  // Map all BlazePHP namespace classes to the ABS_ROOT/lib directory
	);
}
class_alias('\BlazePHP\Globals', 'G');
