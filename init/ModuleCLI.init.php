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
use BlazePHP\CLI;
use BlazePHP\Message as M;

require_once(__DIR__.'/common/CLI.common.php');

class initCLI extends \BlazePHP\initCLI_common
{
	public static function parse($cli)
	{
		// Add additional parameters/options here for all CLI scripts

		// Configuration environment
		$o              = new CLI\Option();
		$o->long        = 'config';
		$o->short       = 'c';
		$o->required    = false;
		$o->description = 'The configuration environment used to inititate this script';
		$o->default     = 'default';
		$cli->addOption($o);

		parent::parse($cli);


		$list   = get_included_files();
		$parts  = explode('/module/', $list[0]);
		$parts  = explode('/', $parts[1]);
		$module = $parts[0];

		$configRaw = $cli->config;
		$config    = preg_replace('/[^a-zA-Z0-9_\-\.]/', '', $cli->config);
		$configLoc = dirname(__DIR__).'/module/'.$module.'/conf/'.$config.'.conf.php';

		if($config != $configRaw || !file_exists($configLoc) || is_dir($configLoc)) {
			M::error('ERROR: '.'The configuration ['.$configRaw.'] specified is invalid.  Please check the module config and try again.', M::ADD_NEW_LINE, 'red');
			exit;
		}
		else {
			require($configLoc);
		}

	}
}

// Define the autoloader
require_once(__DIR__.'/autoloader/Module.autoloader.php');
