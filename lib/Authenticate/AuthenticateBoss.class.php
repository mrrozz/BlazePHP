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

namespace BlazePHP\Authenticate;


/**
 * ConnectionBoss
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class AuthenticateBoss
{
	public static function build($authType)
	{
		switch($authType) {
			case 'File':
				require_once(__DIR__.'/File.class.php');
				return new File();
				break;

		}
	}
}
