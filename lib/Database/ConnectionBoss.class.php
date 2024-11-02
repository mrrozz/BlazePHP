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

namespace BlazePHP\Database;


/**
 * ConnectionBoss
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class ConnectionBoss
{
	public static function build($connType)
	{
		switch($connType) {
			case 'MySQL':
				require_once(__DIR__.'/connectors/connMySQL.class.php');
				return new connMySQL();
				break;

			case 'Postgres':
				require_once(__DIR__.'/connectors/connPostgres.class.php');
				return new connPostgres();
				break;
		}
	}
}
