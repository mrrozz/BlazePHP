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
use BlazePHP\Globals as G;
use BlazePHP\Message as M;
use BlazePHP\Struct;


/**
 * Database Manager List Options object class handles all entity relations with a specific table
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class ManagerListOptions extends Struct
{
	public $start      = 0;
	public $count      = null; // Return all records
	public $fields     = '*';
	public $conditions = null;
	public $dumpSQL    = false;
}