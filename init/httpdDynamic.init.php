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
use BlazePHP\Globals as G;

ini_set('max_execution_time', '30');

date_default_timezone_set('UTC');

define('ABS_ROOT',      dirname(__DIR__));
define('ABS_VAR',       ABS_ROOT.'/var');
define('ABS_TMP',       ABS_ROOT.'/var/tmp');
define('ABS_LOCK',      ABS_ROOT.'/var/lock');
define('ABS_RUNTIME',   ABS_ROOT.'/var/runtime');
define('ABS_LOG',       ABS_ROOT.'/var/log');
define('ABS_CHECKSUM',  ABS_ROOT.'/var/checksum');
define('ABS_MODULE',    ABS_ROOT.'/module');

require_once(ABS_ROOT.'/lib/Struct.class.php');
require_once(ABS_ROOT.'/lib/Globals.class.php');
require_once(ABS_ROOT.'/lib/Message.class.php');

/*
 * Define the autoloader
 */
require_once(__DIR__.'/autoloader/Module.autoloader.php');

/*
 * Create the Request object
 */
G::$request = new Request();

/*
 * Load the controller map
 */
$controllerMapLoc = MODULE_ROOT.'/controller/controller.map.php';
if(!file_exists($controllerMapLoc)) {
	$message = 'ERROR: The controller map file does not exist.  Run {BlazePHP_ROOT}/bin/make-module-controllers-map --module-name={module_name} to generate the object map file.';
	die($message);
}
require($controllerMapLoc);


/*
 * Load the module map
 */
$objectMapLoc = dirname(__DIR__).'/module/object.map.php';
if(!file_exists($objectMapLoc)) {
	$message = 'ERROR: The file [{BlazePHP_ROOT}/module/object.map.php] does not exist.  Run {BlazePHP_ROOT}/bin/make-module-map to generate the object map file.';
	die($message);
}
require_once($objectMapLoc);


/*
 * Load the configuration
 */
$configLoc = MODULE_ROOT . '/conf/httpdDynamic.conf.php';
if(!file_exists($configLoc)) {
	throw new \Exception('The configuration file ['.G::$request->getHostConfig().'.conf.php] was not found.', 1);
	exit;
}
require($configLoc);


/*
 * Load the requested controller if it exists
 */
if(!isset(G::$controllerMap[G::$route->getController()])) {
	$message = 'ERROR: The requsted path ['.G::$request->getRequestedPath().'] is invalid.';
	die($message);
}
$controllerConfig = G::$controllerMap[G::$route->getController()];
require($controllerConfig['location']);
$className = '\\'.MODULE_NAMESPACE.'\\'.$controllerConfig['className'];
$controller = new $className();
$action = G::$route->getAction();
$controller->before();
if(method_exists($controller, $action)) {
	$controller->{$action}();
}
else {
	$controller->notfound();
}
$controller->after();
