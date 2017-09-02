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
use BlazePHP\CLI;
use BlazePHP\Message as M;
use BlazePHP\Globals as G;

require_once(__DIR__.'/_common.init.php');

class initCLI extends initCLI_common
{
	public static function parse($cli)
	{
		// Add additional parameters/options here for all BlazeTest scripts

		G::$autoload[] = 'BlazeTest:test/lib';

		// CLI Option - Configuration name to use for testing.
		$o              = new CLI\Option();
		$o->long        = 'config';
		$o->short       = 'c';
		$o->required    = false;
		$o->default     = 'default';
		$o->description = 'Configuration name to use for testing.';
		G::$cli->addOption($o);

		parent::parse($cli);

		//
		// Validate and load the configuration
		//
		$config         = preg_replace('/[^A-Za-z0-9\-]/', '', G::$cli->config);
		$configLocation = ABS_ROOT.'/test/conf/'.$config.'.conf.php';
		if(!file_exists($configLocation)) {
			$message = 'The configuration ['.$config.'] was not found.  Please review your options and try again';
			M::error('ERROR: '.$message, M::ADD_NEW_LINE, 'red');
			exit;
		}
		else {
			require($configLocation);
		}
	}
}


G::$debug = true;

// Define the autoloader
require_once(__DIR__.'/autoloader/CLI.autoloader.php');
