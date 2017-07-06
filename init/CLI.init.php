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

require_once(__DIR__.'/_common.init.php');

class initCLI extends \BlazePHP\initCLI_common
{
	public function parse($cli)
	{
		// Add additional parameters/options here for all CLI scripts

		// Configuration environment
		$o              = new \BlazePHP\CLIOption();
		$o->long        = 'config';
		$o->short       = 'c';
		$o->required    = false;
		$o->description = 'The configuration environment used to inititate this script';
		$cli->addOption($o);

		return parent::parse($cli);
	}
}
