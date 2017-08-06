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
namespace BlazePHP\CLI;


/**
 * Argument - Abstract base CLI argument object
 *
 * @author    Matt Roszyk <me@mattroszyk.com>
 * @package   Blaze.Core
 *
 */
class Argument extends \BlazePHP\Struct
{
	public $long        = null;
	public $short       = null;
	public $description = null;
	public $dependants  = array();
}
